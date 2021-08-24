<?php

namespace App\Services\Checkout;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Services\Checkout\CheckoutService;

class PayPalCheckoutService extends CheckoutService
{
    public function __construct(array $params = null, Order $order = null)
    {
        parent::__construct($params);
        $this->order = $order;
    }

    public function execute()
    {
        $this->createOrder();

        return redirect()->route('checkout.paypal.create', $this->order->order_code);
    }

    public function success()
    {
        $this->order->transaction->is_paid              =   true;
        $this->order->transaction->bank_tran_number     =   null;
        $this->order->transaction->bank_code            =   null;
        $this->order->create_order_success              =   1;
        $this->order->transaction->save();
        $this->order->save();

        OrderCreated::dispatch($this->order);
    }

    public function failed($exception = null)
    {
        $this->order->transaction->is_paid              =   false;
        $this->order->transaction->bank_tran_number     =   null;
        $this->order->transaction->bank_code            =   null;
        $this->order->create_order_success              =   2;
        $this->order->transaction->save();
        $this->order->save();
    }
}
