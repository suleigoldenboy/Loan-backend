<?php

namespace App\Listeners\Customer;

use App\Events\Customer\GuarantorRegistration;
use App\Notifications\Customer\Guarantor\GuarantorNotification;

class NotifyGuarantor
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
     * @param  GuarantorRegistration  $event
     * @return void
     */
    public function handle(GuarantorRegistration $event)
    {
        $event->user->notify(new GuarantorNotification());
    }
}
