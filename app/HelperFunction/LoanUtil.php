<?php

namespace App\HelperFunction;

use Carbon\Carbon;
// issue with creation date
class LoanUtil
{
    public static function generateCalendar($loan)
    {
        $calendarDates =  $loan->loanPeriodInArray();
        $calendar = [];
        $balance = ($loan->disbursed_amount == null) ? $loan->principal : $loan->disbursed_amount;
        foreach ($calendarDates as $date) {
            $repayment = self::monthlyRepayment($loan);
            $interest = self::monthlyInterest($loan, $balance);
            array_push($calendar, [
                'payment_date' => Carbon::parse($date)->day($loan->payDay())->format('Y-m-d'),
                'beginningBalance' => format_number($balance),
                'monthlyRepayment' =>  format_number($repayment),
                'monthlyInterest' => format_number($interest),
                'monthlyPrincipal' => format_number($repayment - $interest),
                'nextBalance' => format_number($balance - ($repayment - $interest)),
                'hasPaid' => $loan->hasPaid($date->month)
            ]);
            $balance = $balance - ($repayment - $interest);
        }
        return $calendar;
    }

    public static function monthlyRepayment($loan)
    {
        return $loan->getAmountDue();
    }

    public static function monthlyInterest($loan, $balance)
    {
        return $loan->getLoanInterest($balance);
    }
}
