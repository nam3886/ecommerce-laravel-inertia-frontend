<?php

namespace App\Listeners;

use App\Contracts\CartContract;
use App\Events\OrderCreated;
use App\Traits\SessionShippingFee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DestroyCart
{
    use SessionShippingFee;
    
    /**
     * @var \App\Contracts\CartContract
     */
    protected $cartRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CartContract $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $this->cartRepository->destroyCart();
        $this->addressChangeHandling();
    }
}
