<?php

namespace App\Jobs\System\Loan;

use App\Models\Loan\Loan;
use Illuminate\Bus\Queueable;
use App\HelperFunction\LoanUtil;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Worker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $loan;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Loan $loans)
    {
        foreach ($loans->all() as $loan) {
            LoanUtil::generateCalendar($loan);
        }
    }
}
