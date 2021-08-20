<?php

namespace App\Listeners;

use App\Events\CartChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearSessionShippingFee
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
     * @param  CartChanged  $event
     * @return void
     */
    public function handle(CartChanged $event)
    {
        $event->clearTotalShippingFee();
        $event->clearShippingFeeByShopId($event->shopId);
    }
}
