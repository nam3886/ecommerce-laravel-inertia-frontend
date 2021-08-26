<?php

namespace App\Services\Checkout;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Services\Checkout\CheckoutService;

class VNPayCheckoutService extends CheckoutService
{
    public function __construct(array $params = [], Order $order = null)
    {
        parent::__construct($params);
        $order && $this->order = $order;
    }

    public function execute()
    {
        $this->createOrder();

        return redirect()->route('checkout.vnpay.create', $this->order->order_code);
    }

    public function success()
    {
        $this->order->transaction->is_paid              =   true;
        $this->order->transaction->transaction_number   =   $this->params['vnp_BankCode']; // Mã giao dịch tại VNPAY
        $this->order->transaction->bank_tran_number     =   $this->params['vnp_BankTranNo']; // Ngân hàng thanh toán
        $this->order->transaction->bank_code            =   $this->params['vnp_TransactionNo']; // Mã giao dịch tại Ngân hàng
        $this->order->create_order_success              =   1;
        $this->order->transaction->save();
        $this->order->save();

        OrderCreated::dispatch($this->order);
    }

    public function failed($errorMessage)
    {
        $this->order->transaction->is_paid              =   false;
        $this->order->transaction->bank_tran_number     =   null;
        $this->order->transaction->bank_code            =   null;
        $this->order->create_order_success              =   2;
        $this->order->transaction->save();
        $this->order->save();
    }
}
