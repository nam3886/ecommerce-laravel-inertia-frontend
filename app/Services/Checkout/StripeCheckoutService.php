<?php

namespace App\Services\Checkout;

use App\Events\OrderCreated;
use App\Services\Checkout\CheckoutException;
use App\Services\StripeService;
use Cartalyst\Stripe\Exception\CardErrorException;

class StripeCheckoutService extends CheckoutService
{
    public function execute()
    {
        try {
            $this->createOrder();
            (new StripeService)->createOrder($this->order);
            $this->success();
        } catch (CardErrorException $e) {
            $this->failed($e);
            throw new CheckoutException($e->getMessage(), $e->getCode());
        }

        return $this->order;
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

    public function failed($exception)
    {
        $this->order->transaction->is_paid              =   false;
        $this->order->transaction->bank_tran_number     =   null;
        $this->order->transaction->bank_code            =   null;
        $this->order->create_order_success              =   2;
        $this->order->transaction->save();
        $this->order->save();
    }
}
