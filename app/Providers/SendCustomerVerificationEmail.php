<?php

namespace App\Providers;

use App\Providers\CustomerRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCustomerVerificationEmail
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
     * @param  CustomerRegistration  $event
     * @return void
     */
    public function handle(CustomerRegistration $event)
    {
        //
    }
}
