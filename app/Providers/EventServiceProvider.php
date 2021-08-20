<?php

namespace App\Providers;

use App\Events\CartChanged;
use App\Events\UserAddressChanged;
use App\Listeners\ClearSessionShippingFee;
use App\Listeners\SetSessionUserAddressChanged;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
