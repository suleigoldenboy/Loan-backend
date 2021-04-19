<?php

namespace App\Jobs\Loan\Recovery;

use App\Models\Customer\CustomerEmployment;
use App\User\CustomerLoan\Loan;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutomaticRecovery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Loan $loan)
    {
        /**
         * Get all running Loans, get it's duration,
         * convert it to months in array,
         * get the one for the current month,
         * check for defaulting Loan Payments
         * query both current and defaulting Loan
         * check if the user has paid for that month and
         * check the pay day for that user
         * Create a notification for the user 3 days before payment day
         * check if we have past the paid date and user has not paid for that month
         * run the right action base on the above check
         **/
        // return 'Hello';
        $loans = $loan->getRunningLoan();
        foreach ($loans as $value) {
            $loan_duration = $this->loanDurationInMonths($value);
            foreach ($value->loanPeriodInArray() as $dates) {
                if ($dates->month <= Carbon::now()->month && $dates->year <= Carbon::now()->year) {
                    if ($value->recovery()->whereMonth('date_paid', Carbon::now()->month)->latest()->first() == null) {
                        $this->checkUserPayDay($value);
                    }
                }
            }
        }
    }

    private function loanDurationInMonths($value)
    {
        return Carbon::parse($value->release_date)->addMonths($value->getDuration());
    }

    private function checkUserPayDay($value)
    {
        $payDay = $value->payDay();
        ((intval(now()->day) == intval($payDay)) ? queryPayment($value) : ((int)now()->day < (int)$payDay || ((int)$payDay - (int)now()->day) <= (int)config('loan.notifyDays'))) ? notifyUser($value) : latePayment($value);
    }
}
