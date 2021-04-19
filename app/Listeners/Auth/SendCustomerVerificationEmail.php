<?php

namespace App\Listeners\Auth;

use App\Jobs\Customer\AssignLoanOfficer;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Events\CustomerRegistration;


class SendCustomerVerificationEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */

    public function handle(CustomerRegistration $event)
    {
        if ($event->user instanceof MustVerifyEmail
                && ! $event->user->hasVerifiedEmail()) {
            $event->user->sendEmailVerificationNotification();
        }
    }
}
