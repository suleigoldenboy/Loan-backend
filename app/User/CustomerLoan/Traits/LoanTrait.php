<?php

namespace App\User\CustomerLoan\Traits;

use App\Models\Loan\Loan_Repayment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

/**
 * This Trait Major often use Loan Functions
 */
trait LoanTrait
{

    /**
     * @return Object App\Models\Loan\Loan
     */
    public function getMonthlyRepayAbleLoan($loans = null)
    {
        $LoanSimple = [];
        if (is_null($loans)) {
            foreach ($this->getRunningLoan() as $loan) {
                foreach ($loan->loanPeriodInArray() as $singleDate) {
                    if ($singleDate->month <= Carbon::now()->month && $singleDate->year <= Carbon::now()->year) {
                        array_push($LoanSimple, [$loan->load('customer')->load('recovery'), Carbon::parse($singleDate)->month(Carbon::now()->month)->format('Y-m-d')]);
                    }
                }
            }
        }
        if (!is_null($loans) && (is_array($loans) && count($loans) >= 1)) {
            foreach ($loans as $loan) {
                foreach ($loan->loanPeriodInArray() as $singleDate) {
                    if ($singleDate->month <= Carbon::now()->month && $singleDate->year <= Carbon::now()->year) {
                        array_push($LoanSimple, [$loan->load('customer')->load('recovery'), Carbon::parse($singleDate)->month(Carbon::now()->month)->format('Y-m-d')]);
                    }
                }
            }
        } else {
            foreach ($loans->loanPeriodInArray() as $singleDate) {
                if ($singleDate->month <= Carbon::now()->month && $singleDate->year <= Carbon::now()->year) {
                    array_push($LoanSimple, [$loan->load('customer')->load('recovery'), Carbon::parse($singleDate)->month(Carbon::now()->month)->format('Y-m-d')]);
                }
            }
        }
        return $LoanSimple;
    }

    public function getAmountDue()
    {
        $paidAmount = ($this->disbursed_amount !== null) ? $this->disbursed_amount : $this->principal;
        return (($paidAmount / $this->getDuration()) + (percent($this->interest_rate) * $paidAmount));
    }

    public function getLoanInterest($balance)
    {
        return (getRepaymentRate($this->getDuration()) * $balance) / $this->getDuration();
    }

    public function getDuration()
    {
        return ($this->loan_duration !== 'year') ? $this->loan_duration_length : 12 * $this->loan_duration_length;
    }

    public function getByHash($hash)
    {
        foreach ($this->all() as $key => $value) {
            if (hashId($value->id) === $hash) {
                return $value;
            }
        }
    }

    public function checkLoan()
    {
        $loan = $this->paidForXMonth(Carbon::now()->month);
        return ($loan != null) ? true : false;
    }

    public function hasPaid($month)
    {
        return ($this->paidForXMonth($month) != null) ? true : false;
    }

    private function paidForXMonth($month)
    {
        return $this->recovery()->whereMonth('date_paid', '=', $month)->first();
    }

    public function recovery()
    {
        return $this->hasMany(Loan_Repayment::class, 'loan_id', 'id');
    }
    /**
     * Get
     */
    public function nextPayDay()
    {
        $payDateForSameMonth = Carbon::parse($this->startDate())->day($this->payDay());
        $created_date = Carbon::parse($this->startDate());
        if ($payDateForSameMonth <= $created_date) {
            return $created_date->addMonth()->day($this->payDay())->format('Y-m-d');
        }
        return $payDateForSameMonth->format('Y-m-d');
    }

    public function payDay()
    {
        return $this->apiCustomer->employment()->latest()->first()->salary_pay_day;
    }

    public function martinsCheck()
    {

        return (Carbon::parse()->diffInDays($this->nextPayDay()) <= 15) ? true : false;
    }

    public function latestLoanRepayment()
    {
        return $this->hasOne(Loan_Repayment::class)->latest();
    }

    public function getRunningLoan()
    {
        return $this->whereNotNull(['release_date', 'disbursed_amount'])->where([
            ['status', '!=', 'processing'],
            ['status', '!=', 'fully_paid'],
        ])->orderBy('created_at', 'desc')->get();
    }

    public function loanDurationInMonths()
    {
        return Carbon::parse($this->martinsStartDate())->addMonths($this->getDuration());
    }

    public function loanPeriodInArray()
    {
        return CarbonPeriod::create($this->martinsStartDate(), '1 month', $this->loanDurationInMonths());
    }

    public function martinsNumber()
    {
        return Carbon::parse($this->startDate())->diffInDays($this->nextPayDay());
    }

    public function startDate()
    {
        return ($this->release_date != null) ? $this->release_date : $this->created_at;
    }

    public function getRepaymentInstrument()
    {
        return $this->repayment_instrument;
    }

    public function martinsStartDate()
    {
        if ($this->nextPayDay() < $this->startDate()) {
            if (Carbon::parse($this->startDate())->diffInDays($this->payDay()) < 15) {
                return Carbon::parse($this->startDate())->addMonth()->format('Y-m-d');
            } else {
                return Carbon::parse($this->startDate())->format('Y-m-d');
            }
        } else {
            if (Carbon::parse($this->startDate())->diffInDays($this->nextPayDay()) > 15) {
                return Carbon::parse($this->startDate())->format('Y-m-d');
            } else {
                return Carbon::parse($this->startDate())->addMonth()->format('Y-m-d');
            }
        }
    }

    public function employee()
    {
        return $this->hasMany(Comment::class, 'foreign_key', 'local_key');
    }
}
