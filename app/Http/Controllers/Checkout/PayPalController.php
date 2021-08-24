<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\BaseController;
use App\Models\Order;
use App\Services\Checkout\PayPalCheckoutService;
use App\Services\PaypalService;

class PayPalController extends BaseController
{
    private $paypalService;

    function __construct(PaypalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    /**
     * Create orders and process payments
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function expressCheckout(Order $order)
    {
        $response = $this->paypalService->createOrder($order->id);

        abort_if($response->statusCode !== 201, 500);

        $order->transaction->transaction_number = $response->result->id;

        $order->save();

        foreach ($response->result->links as $link) {
            if ($link->rel == 'approve') return redirect($link->href);
        }
    }

    /**
     * payment cancellation processing
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function cancelCheckout(Order $order)
    {
        (new PayPalCheckoutService(order: $order))->failed();

        return $this->responseRedirect('checkout.index', trans('response.checkout.cancel'), 'error');
    }

    /**
     * successful payment processing
     *
     * @param  \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function expressCheckoutSuccess(Order $order)
    {
        $response   =   $this->paypalService->captureOrder($order->transaction->transaction_number);

        $service    =   new PayPalCheckoutService(order: $order);

        if ($response->result->status != 'COMPLETED') {

            $service->failed();

            return $this->responseRedirect('checkout.index', trans('response.checkout.error.store'), 'error');
        }

        $service->success();

        return $this->responseRedirect(
            route: 'checkout.show',
            message: trans('response.checkout.success.store'),
            type: 'success',
            routeParams: $order->id
        )->with('checkout_success', true);
    }
}
