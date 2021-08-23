<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CacheOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        if ($order->create_order_success !== 1) return;

        cache()->rememberForever("order.{$order->id}", function () use ($order) {
            $order->load(
                'subOrders',
                'subOrders.shop',
                'subOrders.items',
                'subOrders.items.pivot.variant',
                'paymentMethod',
                'billingAddress'
            );

            return $order;
        });
    }
}
