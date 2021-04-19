<?php

namespace App\Listeners;

use App\Events\AssignedManager;
use App\Jobs\Customer\AssignLoanOfficer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyLoanManager
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
     * @param  AssignedManager  $event
     * @return void
     */
    public function handle(AssignedManager $event)
    {
        dispatch_now(new AssignLoanOfficer($event->loan));
    }
}
