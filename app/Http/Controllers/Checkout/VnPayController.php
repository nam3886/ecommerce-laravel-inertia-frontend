<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Services\Checkout\VNPayCheckoutService;
use App\Services\VNPayService;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VnPayController extends BaseController
{
    private $vnPayService;

    public function __construct()
    {
        $this->vnPayService = new VNPayService;
    }

    public function create(Order $order)
    {
        $url = $this->vnPayService->createUrlOrder($order);

        return Inertia::location($url);
    }

    public function return(Request $request)
    {
        $order                  =   Order::whereOrderCode($request->vnp_TxnRef)->firstOrFail();
        $isValidSecureHash      =   $this->vnPayService->isValidSecureHash($request->vnp_SecureHash);
        // comment in production
        $vnPayCheckoutService   =   new VNPayCheckoutService(params: $request->all(), order: $order);

        if ($isValidSecureHash && $request->vnp_ResponseCode == '00') {
            // comment in production
            $vnPayCheckoutService->success();

            return $this->responseRedirect(
                route: 'checkout.show',
                message: trans('response.checkout.success.store'),
                type: 'success',
                routeParams: $order->id
            )->with('checkout_success', true);
        }

        if (!$isValidSecureHash) {
            $errorMessage = "Chữ ký không hợp lệ";
        } elseif ($request->vnp_ResponseCode != '00') {
            $errorMessage = "Giao dịch không thành công";
        }
        // comment in production
        $vnPayCheckoutService->failed($errorMessage);

        return $this->responseRedirect('checkout.index', $errorMessage, 'error');
    }

    public function notification(Request $request): void
    {
        $isSuccess              =   false;
        $order                  =   Order::whereOrderCode($request->vnp_TxnRef)->first();
        $vnPayCheckoutService   =   new VNPayCheckoutService(params: $request->all(), order: $order);

        try {
            //Kiểm tra checksum của dữ liệu
            if ($this->vnPayService->isValidSecureHash($request->vnp_SecureHash)) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                $orderTotal = $request->vnp_Amount / $this->vnPayService->moneyTrans;

                if ($order) {
                    if ($order->grandtotal == $orderTotal) {
                        if ($order->create_order_success == 0) {
                            //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
                            $vnPayCheckoutService->success();
                            //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công
                            $returnData['RspCode'] = '00';
                            $returnData['Message'] = 'Confirm Success';
                        } else {
                            $returnData['RspCode'] = '02';
                            $returnData['Message'] = 'Order already confirmed';
                        }

                        $isSuccess = true;
                    } else {
                        $returnData['RspCode'] = '04';
                        $returnData['Message'] = 'Invalid amount';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Chu ky khong hop le';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }

        !$isSuccess && $vnPayCheckoutService->failed($returnData['Message']);
        //Trả lại VNPAY theo định dạng JSON
        echo json_encode($returnData);
    }
}
