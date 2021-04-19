<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use Carbon\Carbon;
use App\Models\Loan\Loan_Repayment;
use Auth;


class RepaymentController extends Controller
{
    
    /**
     * Calculate and get loan repayment Schedule Calendar
     *
     * @return \Illuminate\Http\Response
     */
    public static function repaymentScheduleCalendar($product_id,$loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date,$pay_day)
    {
    
        $loan_start_dat = date('Y-m-d', strtotime($loan_start_date));
        $loan_end_date = static::setLoanEndDate($duration,$duration_lenght,$loan_start_date);
        $period = array();
        if($product_id == 4){//Federal Loan
            $period = \Carbon\CarbonPeriod::create($loan_start_dat, '30 days', $loan_end_date);
        }else{
            $period = \Carbon\CarbonPeriod::create($loan_start_dat, '1 month', $loan_end_date);
        }
        $payemnt_result = array();
        $tem_start_date = $loan_start_dat; 
        $begining_balance = $loan_amount;
        $num_of_months = static::getNumOfMonths($loan_start_dat,$loan_end_date);       
        $cal_interest = $interest_rate/1200;
        $_count = 2;
        $amount_paid = 0;
        $check_month_change = false;
        $new_month = '';
        $loan_adjusted_days = 0;
        $init_amount = 0;
        $isDateChnage = false;
        foreach ($period as $dt) {

           if($_count > 1){
               
               if($_count == 2){

                    if($product_id == 4){//Federal Loan
                        $the_new_change_date = static::checkMoratorium($loan_start_date);
                        $pay_day = date('d',strtotime($the_new_change_date['date']));
                        // print_r($the_new_change_date);
                        // dd('Start Date: '.$loan_start_date.'___');
                    }else{
                        $the_new_change_date = static::checkDayLenght($loan_start_date,$pay_day);
                    }
                   $pay_date = date('Y-m-d', strtotime($the_new_change_date['date'])); 
                   $check_month_change = true;
                   $pay_date = date('Y-m', strtotime($pay_date)).'-01';
                   $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
                   $isDateChnage = $the_new_change_date['isDateChange'];

               }else  if($_count > 2 && $check_month_change){
                     $pay_date =  $new_month;
                     $pay_date =  date('Y-m', strtotime($pay_date)).'-01';
                     $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
                     $pay_date =  static::getNumberOfDaysInThisMonth($pay_date,$pay_day);
                  
               }else{
                     $pay_date = $dt->format("Y-m-d");
                  
               }
               $check_ifPaidTwo = static::checkIfPaidIsTrue($loan_id,$pay_date);
               if($_count == 2 && $check_ifPaidTwo !=null){
                 $pay_day = substr($check_ifPaidTwo->date_paid, strrpos($check_ifPaidTwo->date_paid, '-') + 1);//date('d', strtotime($check_ifPaidTwo->date_paid));
                 $pay_date =  date('Y-m', strtotime($pay_date)).'-'.$pay_day;
               }

               $check_ifPaid = static::checkIfPaid($loan_id,$pay_date);
               if($product_id == 4){//Federal Loan
                $interest_pay = getRepaymentRateTwo($duration_lenght,$interest_rate) * $begining_balance / 12;
               }else{
                $interest_pay = getRepaymentRateTwo($duration_lenght,$interest_rate) * $begining_balance / $duration_lenght;   
               }
               $monthly_repayment = static::monthlyRepayment($loan_amount,$interest_rate,$duration_lenght,$interest_pay);
               $principal = $monthly_repayment - $interest_pay;
               $penalties = 0;
               $balance = $begining_balance - $principal;
               $next_payment = $monthly_repayment + $penalties;
               $total_balance = 0;
               $status = false;
               $complete_payment_status = false;
               $in_complete_payment = false;
               $in_complete_balance = 0;

               if($check_ifPaid != null){

                    $status = true;
                    $balance = $balance + $check_ifPaid->balance;
                    $amount_paid =  $check_ifPaid->amount;
                    $balance = bcadd(0,$balance,2);

                    if($check_ifPaid->complete_payment_status == "true"){
                        $complete_payment_status = true;
                    }
                    if($check_ifPaid->in_complete_payment){
                         $in_complete_payment = true;
                         $in_complete_balance = $check_ifPaid->balance;
                    }

               }else{
                    $amount_paid = 0;
                    $total_balance =  $next_payment;//$monthly_repayment + $interest_pay + $penalties;
                    $complete_payment_status = false;
               }

               //Make this change for all new loan account and igore all the running loan that start from 25-02-2021
               if(strtotime($loan_start_date) > strtotime('25-02-2011') 
                      ){
                        
                           //Check if the pay day is greater than the total number of the days if this month
                           //\\if(intval($pay_day) > 27){
                               $pay_date =  static::getNumberOfDaysInThisMonth($pay_date,$pay_day);
                           //}
                      }

                       //Get adjusted days and calculate adjusted interest  
               if($_count == 2){
              
                 if($product_id != 4){
                      $adj_values = static::cal_AdjustedInterest($loan_amount,$loan_start_date,$pay_date,$interest_rate,$isDateChnage);
                      $init_amount = $adj_values['amount'];
                      $monthly_repayment  = $init_amount + $monthly_repayment;
                      $loan_adjusted_days = $adj_values['days'];
                }
                
               }

               $payemnt_result[] = array(
                    "date"=> $pay_date,
                    "in_complete_payment"=> $in_complete_payment, 
                    "in_complete_balance"=> $in_complete_balance,
                    "begining_balance"=> number_format($begining_balance,2),
                    "repayment_amount"=> number_format($monthly_repayment,2),
                    "penalties"=> number_format($penalties,2),
                    "interest"=> number_format($interest_pay,2),
                    "principal"=> number_format($principal,2),
                    "status"=> $status,
                    "amount_paid"=> $amount_paid, 
                    "adjusted_days"=> $loan_adjusted_days,
                    "adjusted_interest"=> number_format($init_amount,2),
                    "complete_payment_status"=> $complete_payment_status,
                    "balance"=> number_format($balance,2),
                    "next_payment"=> number_format($next_payment,2),
                    "total_balance"=> number_format($total_balance,2),
                );

                   
                $begining_balance = $balance;
                $the_check = $duration_lenght + 1;
                if($_count == $the_check){
                     break;
                }
                 //check if complete payment
                if($complete_payment_status){
                    break;
                }
                
           }
           $_count ++;
        }

        return json_encode($payemnt_result); 
    }
     /**
     * Calculate and get loan repayment Schedule Calendar
     *
     * @return \Illuminate\Http\Response
     */
    public static function searchRepaymentScheduleCalendar($search_start_date,$search_end_date,$search_status,$loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date,$pay_day)
    {
       
        $loan_start_dat = date('Y-m-d', strtotime($loan_start_date));
        $loan_end_date = static::setLoanEndDate($duration,$duration_lenght,$loan_start_date);
        $period = \Carbon\CarbonPeriod::create($loan_start_dat, '1 month', $loan_end_date);
        $payemnt_result = array();
        $tem_start_date = $loan_start_dat;
        $begining_balance = $loan_amount;
        $num_of_months = static::getNumOfMonths($loan_start_dat,$loan_end_date);       
        $cal_interest = $interest_rate/1200;
        $_count = 1;
        $amount_paid = 0;
        $check_month_change = false;
        $new_month = '';
        foreach ($period as $dt) {

           if($_count > 1){
               
               if($_count == 2){
                   $the_new_change_date = static::checkDayLenght($loan_start_date,$pay_day); 
                   $pay_date = date('Y-m-d', strtotime($the_new_change_date['date'])); //date('Y-m-d', strtotime('2020-03-07'));
                   $check_month_change = true;
                   $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));

               }else  if($_count > 2 && $check_month_change){
                     $pay_date =  $new_month;
                     $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
                     
               }else{
                     $pay_date = $dt->format("Y-m-d");
               }

               $check_ifPaid = static::checkIfPaid($loan_id,$pay_date);            
               $interest_pay = getRepaymentRate($duration_lenght, $interest_rate) * $begining_balance / $duration_lenght;
               
                $monthly_repayment = static::monthlyRepayment($loan_amount,$interest_rate,$duration_lenght,$interest_pay);
                
               $principal = $monthly_repayment - $interest_pay;
               $penalties = 0;
               $balance = $begining_balance - $principal;
               $next_payment = $monthly_repayment + $penalties;
               $total_balance = 0;
               $status = false;
               $complete_payment_status = false;
               $in_complete_payment = false;
               $in_complete_balance = 0;

               if($check_ifPaid != null){
                    $status = true;
                    $balance = $balance + $check_ifPaid->balance;
                    $amount_paid =  $check_ifPaid->amount;
                    $balance = bcadd(0,$balance,2);
                    if($check_ifPaid->complete_payment_status == "true"){
                        $complete_payment_status = true;
                    }
                    if($check_ifPaid->in_complete_payment){
                         $in_complete_payment = true;
                         $in_complete_balance = $check_ifPaid->balance;
                    }
               }else{
                    $amount_paid = 0;
                    $total_balance =  $next_payment;//$monthly_repayment + $interest_pay + $penalties;
                    $complete_payment_status = false;
               }

               $startDatedt = strtotime($search_start_date);
               $endDatedt = strtotime($search_end_date);
               $chec_pay_date = strtotime($pay_date);
               $add_to_array = false;
               if($chec_pay_date >= $startDatedt && $chec_pay_date <= $endDatedt){
                
                if($search_status == "due_payment"){ 
                    
                        //Check if complete payment
                        if ($amount_paid > 0 && $in_complete_balance < 1){
                            //echo '_'.$pay_date.'__'.$amount_paid.' *** '.$in_complete_balance.'<br>';
                            
                        }else{
                            
                            //Check if incomplete payment
                            if($in_complete_balance > 0){
                                $monthly_repayment = $in_complete_balance;
                            }
                             $add_to_array = true; //Display both due_payment, incomplete and past_due_date;
                            
                        }

                
                }else if($search_status == "incomplete"){
                    
                    if ($status == true && $in_complete_payment == true){
                        $add_to_array = true; //Display incomplete Payment 
                        
                        $monthly_repayment = $in_complete_balance;
                    }

                }else if($search_status == "past_due_date"){

                    if (strtotime($search_end_date) > strtotime($pay_date)){
                        $add_to_array = true; //Display pass due date 
                    }

                }else{
                    $add_to_array = false;
                }
                //Check and add data to array if add to array is true
                if($add_to_array){

                    $payemnt_result[] = array(
                        "date"=> $pay_date,
                        "in_complete_payment"=> $in_complete_payment, 
                        "in_complete_balance"=> $in_complete_balance,
                        "begining_balance"=> number_format($begining_balance,2),
                        "repayment_amount"=> number_format($monthly_repayment,2),
                        "penalties"=> number_format($penalties,2),
                        "interest"=> number_format($interest_pay,2),
                        "principal"=> number_format($principal,2),
                        "status"=> $status,
                        "amount_paid"=> $amount_paid,
                        "complete_payment_status"=> $complete_payment_status,
                        "balance"=> number_format($balance,2),
                        "next_payment"=> number_format($next_payment,2),
                        "total_balance"=> number_format($total_balance,2),
                    );
                }
                

               }
              
               $begining_balance = $balance;
                 //check if complete payment
                if($complete_payment_status){
                    break;
                }
           }
           $_count ++;
        }

        return $payemnt_result; 
    }
    /**
     * Get the first and the last day of loan payment
     *
     * @return \Illuminate\Http\Response
     */
    public static function getFirstAndLastPaymentDate($loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date,$pay_day)
    {
        
        $loan_start_dat = date('Y-m-d', strtotime($loan_start_date));
        $loan_end_date = static::setLoanEndDate($duration,$duration_lenght,$loan_start_date);
        $period = \Carbon\CarbonPeriod::create($loan_start_dat, '1 month', $loan_end_date);
        $payemnt_result = array();
        $begining_balance = $loan_amount;
        $_count = 1;
        $amount_paid = 0;
        $check_month_change = false;
        $new_month = '';
        $first_date = '';
        $last_date = '';
        foreach ($period as $dt) {

           if($_count > 1){
               
               if($_count == 2){
                   
                   $the_new_change_date = static::checkDayLenght($loan_start_date,$pay_day);
                   $pay_date = date('Y-m-d', strtotime($the_new_change_date['date'])); //date('Y-m-d', strtotime('2020-03-07'));
                   $check_month_change = true;
                   $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
       
               }else  if($_count > 2 && $check_month_change){
                     $pay_date =  $new_month;
                     $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
                     
               }else{
                     $pay_date = $dt->format("Y-m-d");
               }

              if($_count == 2){

                $first_date = $pay_date;

              }
              $last_date = $pay_date;
              
           }
           $_count ++;
        }

        $payemnt_result["first_date"] = $first_date;
        $payemnt_result["last_date"] = $last_date;
        return $payemnt_result;
    }
    /**
     * Search pay date from re-payment calendar
     *
     * @return \Illuminate\Http\Response
     */
    public static function searchPayDate($search_date,$loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date,$pay_day)
    {
        

        $loan_start_dat = date('Y-m-d', strtotime($loan_start_date));
        $loan_end_date = static::setLoanEndDate($duration,$duration_lenght,$loan_start_date);
        $period = \Carbon\CarbonPeriod::create($loan_start_dat, '1 month', $loan_end_date);
        $begining_balance = $loan_amount;

        $_count = 1;
        $check_month_change = false;
        $new_month = '';
        foreach ($period as $dt) {

           if($_count > 1){
               
               if($_count == 2){
                   
                  $the_new_change_date = static::checkDayLenght($loan_start_date,$pay_day);
                  
                   $pay_date = date('Y-m-d', strtotime($the_new_change_date['date'])); //date('Y-m-d', strtotime('2020-03-07'));
                   $check_month_change = true;
                   $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
                   
                 
                   
               }else  if($_count > 2 && $check_month_change){
                     $pay_date =  $new_month;
                     $new_month = date('Y-m-d', strtotime($pay_date . "+1 months"));
                     
               }else{
                     $pay_date = $dt->format("Y-m-d");
               }

               $check_ifPaid = static::checkIfPaid($loan_id,$pay_date);
               
               $interest_pay = 0.23 * $begining_balance / $duration_lenght;
               
                $monthly_repayment = static::monthlyRepayment($loan_amount,$interest_rate,$duration_lenght,$interest_pay);
                
               $principal = $monthly_repayment - $interest_pay;
               $balance = $begining_balance - $principal;
               $complete_payment_status = false;
               

               if($check_ifPaid != null){

                    $balance = $balance + $check_ifPaid->balance;
                    
                    $balance = bcadd(0,$balance,2);

                    if($check_ifPaid->complete_payment_status == "true"){
                        $complete_payment_status = true;
                    }
                    
               }else{
                    $complete_payment_status = false;
               }

             //Check if search date is equal to the current pay date
              if(date('Y-m-d', strtotime($search_date)) == date('Y-m-d', strtotime($pay_date)) ){
                return number_format($monthly_repayment,2);
              }
             
               //check if complete payment
               if($complete_payment_status){
                 return false;
              }
              
           }
           $_count ++;
        }

      
        return false;
    }
    /**
     * check if day is more or less than 15
     *
     * return date
     */
    public static function checkDayLenght($start_date,$pay_day)
    {
       
        $result_date = '';
        if($pay_day < 10){
            //$pay_day = '0'.$pay_day;
        }

        //Get the day of start date
        $start_date_day = date('d', strtotime($start_date));

        //Check if the day of start date is more or less than the pay day
        if(intval($pay_day) > intval($start_date_day)){

             //Check if pay day is more than 30 days
            if(intval($pay_day) > 30){

                $in = date_create($start_date);
                $out = date_create($in->format('Y-m-'.$pay_day));
                $n_date = $out->format('Y-m-d');
                //Make this change for all new loan account and igore all the running loan that start from 25-02-2021
                if(date('Y-m-d', strtotime($start_date)) >= date('Y-m-d', strtotime('25-02-2021'))  
                      ){
                        $result_date = date('Y-m-d', strtotime($n_date . "-1 months"));
                      }else{
                          $result_date = date('Y-m-d', strtotime($n_date . "+1 months"));
                      }
            }else{
                $in = date_create($start_date);
                $out = date_create($in->format('Y-m-'.$pay_day));
                $result_date = $out->format('Y-m-d');
            } 
            
           
        }else{ 
            $in = date_create($start_date);
            $out = date_create($in->format('Y-m-'.$pay_day));
            $n_date = $out->format('Y-m-d');
            $result_date = date('Y-m-d', strtotime($n_date . "+1 months"));
           
            
        }
        
        //check number of days between two dates
        $checkResult = static::dateDiffInDays($start_date, $result_date) + 1;
       
        if($checkResult < 16){
             static::setIfDateChange(true);
             return array(
                "date"=> date('Y-m-d', strtotime($result_date . "+1 months")),
                "isDateChange"=> true, 
            );
                
        }
        return array(
            "date"=> static::checkAndValidateDate($start_date,$result_date,$pay_day),
            "isDateChange"=> false, 
        );
        
    }

   public static function checkMoratorium($start_date)
   {
      
       if(intval(date('d',strtotime($start_date))) > 3 && intval(date('d',strtotime($start_date))) < 18){

             return array(
                "date"=> date('Y-m-d', strtotime($start_date . "+60 days")),
                "isDateChange"=> true, 
            );
                
        }
        return array(
            "date"=> date('Y-m-d', strtotime($start_date . "+30 days")),
            "isDateChange"=> false, 
        );
   }
    
    public static function checkAndValidateDate($start_date,$result_date,$pay_day)
    {
        $s_date_m = date('m', strtotime($start_date));
        $s_date_d = date('d', strtotime($start_date));
        $r_date_m = date('m', strtotime($result_date));
        $r_date_d = date('d', strtotime($result_date));
        
        if($s_date_m  == $r_date_m && intval($s_date_d) > intval($r_date_d) && intval($pay_day) > 30){

            return date('Y-m-d', strtotime($result_date . "+1 months"));
        }

        return date('Y-m-d', strtotime($result_date));
    }
    
    //Check if the pay day is greater than the total number of the days in the month
    public static function  getNumberOfDaysInThisMonth($the_date,$day){
 
        try {
            $total_days = cal_days_in_month(CAL_GREGORIAN,date('m', strtotime($the_date)),date('Y', strtotime($the_date)));
    
            if(intval($day) > intval($total_days) ){
                return date('Y-m', strtotime($the_date)).'-'.$total_days;
            }
        
            return  date('Y-m', strtotime($the_date)).'-'.$day;;
        } catch (\Throwable $th) {
            return  '';
        }
    }
   //Start to check id the first payment date move to the next month
    public static $check_if_date_change;

    public static function setIfDateChange($check_if_date_change) {
      static::$check_if_date_change = $check_if_date_change;
    }

    public static function getIfDateChange() {
      return static::$check_if_date_change;
    }
    /**
     * Function to find the difference between two dates. 
     *
     * return number
     */
    public static function dateDiffInDays($date1, $date2)  
    { 
        // Calculating the difference in timestamps 
        $diff = strtotime($date2) - strtotime($date1); 
 
        return abs(round($diff / 86400)) + 1; 
    } 
     /**
     * Function to find the difference between two dates. 
     *
     * return number
     */
    public static function getDateDiffrence($date1, $date2)  
    { 
        // Calculating the difference in timestamps 
        $diff = strtotime($date2) - strtotime($date1); 
 
        return abs(round($diff / 86400)) + 1; 
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
    public static function monthlyRepayment($amt ,$iterest,$num_of_months,$interest) 
    {
        
        try {
            
              $val_1 = $amt / $num_of_months;
              $val_2 =  ($iterest/100) * $amt;
              return $val_1 + $val_2;
        } catch(DivisionByZeroError $e){
            echo "got $e";
        } catch(ErrorException $e) {
            echo "got $e";
        }
       
        
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
     * return bolen true or false
     */
    public static function getNextPayMonth($loan_id,$pay_date)
    {

        $check = Loan_Repayment::where('loan_id',$loan_id)->where('date_paid',$pay_date)->first();

        if($check == null){
            return true;
        }

        return false;

    }


     /**
     * check if paid
     *
     * return bolen true or false
     */
    public static function checkIfPaid($loan_id,$pay_date)
    {

        return Loan_Repayment::where('loan_id',$loan_id)
        ->where('date_paid',$pay_date)->first();
        //->orWhere('date_paid', 'like', '%' . $pay_date . '%')->first();

    }
    /**
     * check if paid
     *
     * return bolen true or false
     */
    public static function checkIfPaidIsTrue($loan_id,$pay_date)
    {

        return Loan_Repayment::where('loan_id',$loan_id)->where('amount','>',0)->first();

    }
    
     /**
     * Check and calculate adjusted days
     * 
     * return bolen true or false
     */
    public static function cal_AdjustedInterest($amount,$disburse_date,$first_repay_date,$rate,$isDateChnage)
    {
        if(!$isDateChnage){
            $first_repay_date =  $first_repay_date;
        }else{
            $first_repay_date =  date('Y-m-d', strtotime($first_repay_date . "-1 months"));
            
        }
       
        
        $adjusted_days = static::getDateDiffrence($disburse_date,$first_repay_date);
  
        if($adjusted_days > 0 && $adjusted_days < 15){
            $t_amount = ((($rate * 12) * $amount) / 365 ) * ($adjusted_days / 100);
            return array(
                    "amount"=> $t_amount,
                    "days"=> $adjusted_days, 
                );
        }else{
            return 0;
        }
    }
     

}
