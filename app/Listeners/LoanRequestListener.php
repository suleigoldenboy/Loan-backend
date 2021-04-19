<?php

namespace App\Listeners;

use App\Events\LoanRequestEvent;
use App\Jobs\System\Loan\Worker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoanRequestListener
{
    public $loan;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    /**
     * Handle the event.
     *
     * @param  LoanRequestEvent  $event
     * @return void
     */
    public function handle(LoanRequestEvent $event)
    {
        dispatch_now(new Worker($event->loan));
    }
}
