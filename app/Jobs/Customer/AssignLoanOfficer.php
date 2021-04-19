<?php

namespace App\Jobs\Customer;

use App\User\Loan\LoanManagerRelationship;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignLoanOfficer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public  $loan;
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
    public function handle()
    {
        // get the The Next Loan Officer. using a general Function
        // get the Loan
        $manager = getNextLoanManager($this->loan);
        return LoanManagerRelationship::create([
            'loan_id' => $this->loan->id,
            'loan_manager_id' => ($manager != null) ? $manager->id : 0
        ]);
    }
}
