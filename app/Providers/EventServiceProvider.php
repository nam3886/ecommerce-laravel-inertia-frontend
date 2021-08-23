<?php

namespace App\Providers;

use App\Events\CartChanged;
use App\Events\OrderCreated;
use App\Events\UserAddressChanged;
use App\Listeners\CacheOrder;
use App\Listeners\ClearSessionShippingFee;
use App\Listeners\ClearVoucher;
use App\Listeners\DestroyCart;
use App\Listeners\SendMailOrder;
use App\Listeners\SetSessionUserAddressChanged;
use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CartChanged::class => [
            ClearSessionShippingFee::class,
        ],
        UserAddressChanged::class => [
            SetSessionUserAddressChanged::class,
        ],
        OrderCreated::class => [
            DestroyCart::class,
            ClearVoucher::class,
            CacheOrder::class,
            SendMailOrder::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
    }
}
