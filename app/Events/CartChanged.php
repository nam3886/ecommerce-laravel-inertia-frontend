<?php

namespace App\Events;

use App\Traits\SessionShippingFee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CartChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels, SessionShippingFee;

    public int $shopId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $shopId)
    {
        $this->shopId = $shopId;
    }
}
