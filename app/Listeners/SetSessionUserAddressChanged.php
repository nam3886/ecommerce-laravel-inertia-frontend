<?php

namespace App\Listeners;

use App\Events\UserAddressChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetSessionUserAddressChanged
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
     * @param  UserAddressChanged  $event
     * @return void
     */
    public function handle(UserAddressChanged $event)
    {
        $event->addressChangeHandling();
    }
}
