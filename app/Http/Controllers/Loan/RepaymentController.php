<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Loan\Loan_Repayment;


class RepaymentController extends Controller
{
    /**
     * Calculate and get loan repayment Schedule Calendar
     *
     * @return \Illuminate\Http\Response
     */
    public static function repaymentScheduleCalendar($loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date)
    {
       
        // $duration = 'months';
        // $duration_lenght = '7';
        // $loan_start_date = '2020-01-28';
        $loan_start_dat = date('Y-m-d', strtotime($loan_start_date));

        
        $loan_end_date = static::setLoanEndDate($duration,$duration_lenght,$loan_start_date);

        $period = \Carbon\CarbonPeriod::create($loan_start_dat, '1 month', $loan_end_date);

        $payemnt_result = array();
        $tem_start_date = $loan_start_dat;
        $begining_balance = $loan_amount;

        $num_of_months = static::getNumOfMonths($loan_start_dat,$loan_end_date);
        $monthly_repayment = static::monthlyRepayment($loan_amount,$interest_rate,$duration_lenght);

        // echo 'amt:: '.$loan_amount.'<br>';
        // echo 'int:: '.$interest_rate.'<br>';
        // echo 'months:: '.$num_of_months.'<br>';
        // echo 'pmt:: '.$monthly_repayment.'<br>';
        $cal_interest = $interest_rate/1200;
        
        $_count = 1;
        foreach ($period as $dt) {

           if($_count > 1){
                $pay_date = $dt->format("Y-m-d");
               
              
               $interest_pay = $begining_balance * $cal_interest;
               $principal = $monthly_repayment - $interest_pay;
               $balance = $begining_balance - $principal;
               $total_balance = $monthly_repayment + $interest_pay;

          
            
               $payemnt_result[] = array(
                    "date"=> $pay_date,
                   // "days"=> $num_days,
                    "begining_balance"=> number_format($begining_balance,2),
                    "repayment_amount"=> number_format($monthly_repayment,2),
                    "penalties"=> 0,
                    "interest"=> number_format($interest_pay,2),
                    "principal"=> number_format($principal,2),
                    "total_balance"=> number_format($total_balance,2),
                    "stutus"=> '',
                    "balance"=> number_format($balance,2)
                );

                    //echo $begining_balance.'<hr>';
                    $begining_balance = $balance;

                //$tem_start_date = $pay_date;
           }
           $_count ++;
        }

        return json_encode($payemnt_result); 
    }
    /**
     * Set loan end date
     *
     * return date
     */
    public static function setLoanEndDate($duration,$duration_lenght,$loan_start_date)
    {

        
        $loan_end_date = '';
        
        //Set the ending date of the loan
        if($duration == "month" || $duration[0] == 'm'){

            $loan_end_date = date('Y-m-d', strtotime("+".$duration_lenght." months", strtotime($loan_start_date)));

        }else if($duration == "year" || $duration[0] == 'y'){

            $loan_end_date = date('Y-m-d', strtotime("+".$duration_lenght." years", strtotime($loan_start_date)));
        }
        
        return $loan_end_date;

    }
    /**
     * calculate percentage of number
     *
     * return num
     */
    public static function getPercentage($amount,$percentage)
    {
        $percentage = 50;

        return ($percentage / 100) * $amount;
    }
    /**
     * calculate monthly repayment fee
     *
     * return num
     */
    public static function monthlyRepayment($amt ,$iterest,$num_of_months) 
    {

        $num_of_months = $num_of_months * 12;
        $iterest = $iterest/1200;
        $get_iterest = 1+$iterest;
        $r1 = pow($get_iterest, $num_of_months);
         
        $pmt = $amt*($iterest*$r1)/($r1-1);
        
        return $pmt;
        
    }
    /**
     * get number of days between two dats
     *
     * return num
     */
    public static function getNumberOfDays($start,$end)
    {

        $get_start_date = strtotime($start);
        $get_end_date = strtotime($end);
        $datediff = $get_start_date - $get_end_date;
        
        return round($datediff / (60 * 60 * 24));
    }
    /**
     * get number of months
     *
     * return num
     */
    public static function getNumOfMonths($start,$end)
    {

        $period = \Carbon\CarbonPeriod::create($start, '1 month', $end);
        $count_num = 0;
        foreach ($period as $dt) {
            //echo $dt->format("Y-m") . "<br>\n";
            $count_num += 1;
        }

        return $count_num-1;
    }

    /**
     * get next payment month
     *
     * return month
     */
    public static function getNextPayMonth($loan_id,$pay_date)
    {

        $check = Loan_Repayment::where('loan_id',$loan_id)->where('pay_date',$pay_date)->first();

        if($check == null){
            return true;
        }

    }

     

}
