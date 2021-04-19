<?php

function printHello2()
{
    return 'Hello Golden 22';
}
function have($val)
{
    if($val > 1){
        return true;
    }

    return false;
}

function can($permission)
{
    $result = App\Models\Admin\RoleHasPermissions::where('role_id',Auth::user()->role_id)->get();
    
    foreach ($result as $role) {

       $check = App\Models\Admin\CheckPermission::where('id',$role->permission_id)->first();
        if ($check != null && $check->name == $permission) {
            return true;
        }
    }
   
    return false;

}
function roleCan($role_id,$permission)
{
    $result = App\Models\Admin\RoleHasPermissions::where('role_id',$role_id)->get();

    foreach ($result as $role) {

       $check = App\Models\Admin\CheckPermission::where('id',$role->permission_id)->first();
        if ($check != null && $check->name == $permission) {
            return true;
        }
    }

    return false;

}

function checkConfirmationProcess($privilege,$permission)
{
     $variableAry=explode(",",$privilege); 
    
     foreach($variableAry as $var){
        
        if($var == $permission){
            return true;   
        }
    }
    
    return false;
}

function getAdminUserName($id)
{
    $result = App\Models\HRManagement\Employee::where('id',$id)->first();
    if($result){
         return $result->first_name.' '.$result->last_name;
    }else{
        return '';
    }
   
}

function adminGetLoanProduct($id)
{
    $result = App\Models\Loan\Product::where('id',$id)->first();

    return $result;
}

function convertDateToString($the_date_)
{

    $a_Dcdate = new \DateTime($the_date_);
    $Ac_tualDueDate_ =  $a_Dcdate->format('D M d, Y');
    return $Ac_tualDueDate_;
 
}
function convertDateToStringWithTime($the_date_)
{

    $a_Dcdate = new \DateTime($the_date_);
    $Ac_tualDueDate_ =  $a_Dcdate->format('D M d, Y h:i:s a');
    return $Ac_tualDueDate_;
 
}
function getCustomerLoans($cus_id){
    
    return App\Models\Loan\Loan::where('customer_id',$cus_id)->get();
}

function caLoanMaturityDate($disburseDate,$l_duration,$durationLenght)
{
    //Calculate the first payment date 
    $loanMaturity = '';
    if($l_duration == "month"){
        $loanMaturity = date('Y-m-d', strtotime("+".$durationLenght." months", strtotime($disburseDate)));
   }else if($l_duration == "year"){ 
        $loanMaturity = date('Y-m-d', strtotime("+".$durationLenght." years", strtotime($disburseDate)));
   }else{
       return '';
   }

   return $loanMaturity;
}

function calPercentage($percentage,$amount)
{
    return ($percentage / 100) * $amount;
}

function calPercentageAndDeduction($duration,$insurance_charge,$processing_charge,$amount,$vat)
{
    $insurance = calPercentage($insurance_charge,$amount);
    $processing = calPercentage($processing_charge,$amount) * $duration;
    $vat = calPercentage($vat,$processing);
    
    return $insurance + $processing + $vat;
                                                                
}

function checkLetterStatus($loan_id)
{
    $result = App\Models\Loan\TheLoanOfferLetter::where('loan_id',$loan_id)->first();
    
   if($result != null){
       
       return $result->status;
   }
   
    return false;

}

function getAcceptedLetterInfo($loan_id)
{
    $result = App\Models\Loan\TheLoanOfferLetter::where('loan_id',$loan_id)->first();
    
   if($result != null){
       
       return $result;
   }
   
    return false;

}
function getSignature($name)
{
    $result = App\Models\Admin\Sign::where('name',$name)->first();
    return $result->sign;

}
function getFullEmployerName($id)
{
    $result = App\Models\HRManagement\Employee::where('id',$id)->first();

    return $result->first_name.' '.$result->last_name.' '.$result->other_name;
}
function getFullCustomerName($id)
{
    $result = App\Models\Customer\Customer::where('id',$id)->first();
    return $result ?  $result->first_name.' '.$result->last_name.' '.$result->other_name : '';
    
}
function getFullCustomerNameWithLoanID($id)
{
    $result = App\Models\Loan\Loan::where('id',$id)->first();
    
    if($result){
         $result = App\Models\Customer\Customer::where('id',$result->customer_id)->first();
         return $result ?  $result->first_name.' '.$result->last_name.' '.$result->other_name : '';
    }
    
    return '';
   
    
}
function getFullCustomerInfo($id)
{
    return App\Models\Customer\Customer::where('id',$id)->first();

}
function getBranchName($id)
{
    $result = App\Models\Admin\Branch::where('id',$id)->first();

    return (isset($result->state)) ? $result->state.'-'.$result->title : ' all Branch ';
}

function getRejectionMessage($id,$type)
{
    $second_val = 'Loan disbursement rejected back';
    
    $result = App\Models\AuditTrail::where('action_id',$id)
                                    ->where('note', 'like', '%' . $type . '%')
                                    ->orWhere('note', 'like', '%' . $second_val . '%')
                                    ->orderBy('id','DESC')->get();
    
    if($result != null){
        return $result;
        //return $result->note;
    }
     
     return '';
    
}

function checkIfLastConfirmation($get_user_process)
{
     $max = App\Models\Settings\LoanConfirmationProcess::max('process');
     $max = (int)$max;
     if($get_user_process >= $max){
           return false;
      }else{
        return false;
      }
}

 //get all branch to confirmation values
function getAllBranchToConfirm($id)
    {
       $accOfficer =  App\Models\Admin\AccountOfficer::where('employee_id', '=', $id)->first();
        if($accOfficer == null){
            return "";
        }else{

              $confirmations = array();
              $variableAry=explode(",",$accOfficer->branch); 
              foreach($variableAry as $var){

                 $confirmations[] = $var;
               
              }

              return $confirmations;
 

        }
        
    }


//Check if employee loan view
function checkEmpLoanView(){
    // Program to display URL of current page. 
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $link = "https"; 
    }else{
        $link = "http"; 
    }
      
    // Here append the common URL characters. 
    $link .= "://"; 
      
    // Append the host(domain name, ip) to the URL. 
    $link .= $_SERVER['HTTP_HOST']; 
      
    // Append the requested resource location to the URL 
    $link .= $_SERVER['REQUEST_URI']; 
    
    //check if a link contains a specific word?
    if (strpos($link, 'employee/loan/show') !== false) {
        return 1;
    }else{
        return 0;
    }
}

function checkIfGL_reporting_is_registered($action_name)
{
     $result = App\Models\Account\GeneralLedgerReportSettings::where('action_name',$action_name)->first();
    
     if($result != null){
           return true;
      }else{
        return false;
      }
}
function get_chart_of_account_name($id)
{
     $result = App\Models\Account\AccountsChart::where('id',$id)->first();
     if($result){
         return $result->name;
     }else{
         return '';
     }
}
function check_if_loan_is_liquidated($loan_id)
{
     $check = App\Models\Loan\Loan_Repayment::where('loan_id',$loan_id)->get();
    
     foreach($check as $data){
         
         if($data->complete_payment_status == "true"){
             return $data;
         }
     }
     
     return false;
}
function get_confirmation_by_amount_settings($id)
{
     $result = App\Models\Settings\ConfirmationProcessByAmountSettings::where('process',$id)->first();
     if($result){
         return 'From ₦'.number_format($result->min,2).' To ₦'.number_format($result->max,2);
     }else{
         return '';
     }
}

function getRepaymentRateTwo($duration_lenght,$interest_rate)
{
  $answer = array();
    switch ($interest_rate) {
        case 4:// Deff 
    $answer = [
        '1' => 0.04,
        '2' => 0.105758601993969,
        '3' => 0.17663345462259,
        '4' => 0.24851786288091,
        '5' => 0.320112033452584,
        '6' => 0.390917212986019,
        '7' => 0.460730591516251,
        '8' => 0.529476313698839,
        '9' => 0.597138901315496,
        '10' => 0.663732594770515,
        '11' => 0.729286871860761,
        '12' => 0.793838717676319,
        ];
            break;
        
        case 2.5://Staff Loan
            $answer = [
                '1' => 0.025,
                '2' => 0.0663062538515683,
                '3' => 0.111152209745262,
                '4' => 0.156979835468918,
                '5' => 0.202953537476838,
                '6' => 0.248732340377215,
                '7' => 0.294157940177175,
                '8' => 0.339157145689811,
                '9' => 0.383692297332166,
                '10' => 0.42774978017704,
                '11' => 0.471326477296335,
                '12' => 0.514425293086433,
        ];
          break;
        case 3.2://Deff
            $answer = [
                '1' => 0.032,
                '2' => 0.085,
                '3' => 0.14182,
                '4' => 0.1999,
                '5' => 0.2580,
                '6' => 0.3155,
                '7' => 0.3727,
                '8' => 0.4291,
                '9' => 0.48465,
                '10' => 0.5395,
                '11' => 0.5936,
                '12' => 0.6471,
        ];
        break;
    case 3://Federal
            $answer = [
                '6' =>0.593316083600496,
                '7' =>0.600715101864192,
                '8' =>0.605335092494485,
                '9' =>0.608058469693074,
                '10' =>0.609444187697498,
                '11' =>0.609862552256321,
                '12' =>0.609567881289501,
                '13' =>0.60874004804079,
                '14' =>0.607509411944756,
                '15' =>0.605972397587611,
                '16' =>0.604201569683529,
                '17' =>0.602252343492316,
                '18' =>0.600167570866252
                ];
                    break;
        
        default:
            # code...
            break;
    }

    return  $answer[$duration_lenght];
}
