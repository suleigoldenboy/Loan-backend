<!DOCTYPE html>
<html>
<head>
  <title>Offer Letter</title>
  <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="row" style="background-color:#FFF;">
     <div class="col-md-12">
      <img src="{{ asset('https://ukdiononline.com/assets/images/maxer.jpg')}}" class="img-responsive">
      </div>
    
    <div class="col-md-12" style="margin-top:70px; padding-top:72px;">
        <?php
       
        $param_val = $post_data = json_decode($letter->offerLetter->param);
        $repayment_amount = $param_val->repayment_amount;
        $total_interest = $param_val->total_interest;
        $deduction = $param_val->deduction;
        $nex_pay_month = '<b class="text-primary">'.$param_val->nex_pay_month.'</b>';
        $last_pay_month = '<b class="text-primary">'.$param_val->last_pay_month.'</b>';
        
       
       
        $customer_code =  '<b class="text-primary">'.'000-'.$letter->customer->id.'</b>';
        $customer_address = $letter->customer->address;
        $loanType = '<b class="text-primary">'.$letter->product->name.'</b>';
        $loanPurpose = $letter->loan_purpose;
        $loanDuration = '<b class="text-primary">'.$letter->loan_duration_length.' Months</b>';
        $customer_name = '<b class="text-primary">'.strtoupper($letter->customer->first_name.' '.$letter->customer->last_name.' '.$letter->customer->other_name).'</b>';
        $appied_loan_amount = $letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal;
        $dAmount =  '<b style="color:#dc3545;">NGN'.number_format($appied_loan_amount - $deduction,2).'</b>';
        $principal_plus_accrued_interest =  '<b style="color:#dc3545;">NGN'.number_format($repayment_amount,2).'</b>';
        $outstanding_principal_plus_outstanding_interest =  '';//'<b style="color:#dc3545;">N'.number_format($repayment_amount + $total_interest,2).'</b>';
        $current_date = date('d-m-Y');
        $appied_loan_amount = '<b style="color:#dc3545;">NGN'.number_format($appied_loan_amount,2).'</b>';
        $the_letter =  str_replace("customer",$customer_name, $letter->product->offer_letter->letter); //Customer Name
        $the_letter =  str_replace("LAmount",$appied_loan_amount, $the_letter);//Loan Amount
        $the_letter =  str_replace("crdate",$current_date, $the_letter);//Current date
        $the_letter =  str_replace("fdate",$nex_pay_month, $the_letter);//first payment date
        $the_letter =  str_replace("Payment_Due_Date",$last_pay_month, $the_letter);//Payment Due Date
        $the_letter =  str_replace("custcode",$customer_code, $the_letter);//Customer Code
        $the_letter =  str_replace("custddress",$customer_address, $the_letter);//Customer Address
        $the_letter =  str_replace("loantype",$loanType, $the_letter);//Loan Type
        $the_letter =  str_replace("loanpurpose",$loanPurpose, $the_letter);//Loan purpose
        $the_letter =  str_replace("loantenor",$loanDuration, $the_letter);//Loan duration
        $the_letter =  str_replace("dAmount",$dAmount, $the_letter);//Disburse amount
        $the_letter =  str_replace("principal_plus_accrued_interest",$principal_plus_accrued_interest, $the_letter);//principal plus accrued interest
        $the_letter =  str_replace("outstanding_principal_plus_outstanding_interest",$outstanding_principal_plus_outstanding_interest, $the_letter);//outstanding principal plus outstanding interest
        
        $the_letter =  str_replace("ddate","Disbursement Date:".$letter->release_date, $the_letter);
        $the_letter =  str_replace("mdate","Maturity Date:".$letter->maturity_date, $the_letter);
         $the_letter =  str_replace("rate_percent",$letter->interest_rate."%", $the_letter);
        
        // $mystring = 'home/cat1/subcat2/';
         $first = strtok($the_letter, '/');
        ?>
      
            {!!nl2br($the_letter)!!}
            
            
              
<br><br>
 <div class="row">
    <div class="media">
        <div class="media-body">
             <div class="table-responsive">
             <?php
                $loan_amount = $letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal;
                 $pay_day = $letter->customer->employment->salary_pay_day;
                 if($pay_day < 10){
                     $pay_day = '0'.$pay_day;
                 }
                 
               
                 $in = date_create($letter->created_at);
                
                $out = date_create($in->format('Y-m-'.$pay_day));
               
                // $the_release_date = $out->format('Y-m-d');
                 $the_release_date = $letter->release_date ? $letter->release_date : date('Y-m-d');
                                
                $cal_result = App\Http\Controllers\Loan\RepaymentController::repaymentScheduleCalendar($letter->id,$loan_amount,$letter->interest_rate,$letter->loan_duration,$letter->loan_duration_length,$the_release_date,$pay_day);
                $get_result = json_decode($cal_result, true);

                $total_begining_balance = 0; $total_repayment_amount = 0;
                $total_penaltie = 0; $total_interest = 0;
                $total_principal = 0; $balance = 0; $total_balance = 0;
                $next_pay = false; 
                $total_paid = 0;
                $total_amount_paid = 0;
                                
            ?>
            <h4 class="text-center">{{trans('general.calendar_title')}}</h4>
            <div class="row">
                <div class="col-md-6">
                   
                   
                        <?php
                        $insurance = calPercentage($letter->insurance_charge,$loan_amount);
                        $processing = calPercentage($letter->processing_charge,$loan_amount) * $letter->loan_duration_length;
                        $vat = calPercentage(7.5,$processing);
                        $total_deductions = $insurance + $processing + $vat;
                        ?>
                          
                        </div>
                        <div class="col-md-6">
                        
                </div>
            </div>
            
             
            
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr style="font-size:12px;">
                                <th></th>
                                <th>Date</th>
                                <th>Begining Balance</th>
                                <th>Repayment Amount</th>
                                <!--<th>Penalty</th>-->
                                <th>Interest</th>	
                                <th>Principal</th>
                                <!--<th>Stutus</th>-->
                                <!--<th>Amount Paid</th>-->
                                <th>Ending Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($get_result as $value) 
                                <tr style="font-size:12px;">
                                    <td width="5">{{$loop->iteration}}</td>
                                    <td>
                                        <b>{{$value['date']}}</b>
                                        @if (!$next_pay)
                                                @if (App\Http\Controllers\Loan\RepaymentController::getNextPayMonth($letter->id,$value['date']))
                                                    
                                                    <input type="hidden" id="next_month_payment" value="{{$value['date']}}">
                                                    <?php $the_next_payment = str_replace( ',', '', $value['next_payment']); ?>
                                                    <input type="hidden" id="next_instalment_amount" value="{{$the_next_payment}}">
                                                    <?php $next_pay = true; ?>
                                                @endif
                                        @else
                                        <?php 
                                           //******
                                         ?>
                                        @endif
                                    </td>
                                    <td><b>NGN{{$value['begining_balance']}}</b></td>
                                    <td><b>NGN{{$value['repayment_amount']}}</b></td>
                                    <!--<td><b>NGN{{$value['penalties']}}</b></td>-->
                                    <td><b>NGN{{$value['interest']}}</b></td>
                                    <td><b>NGN{{$value['principal']}}</b></td>
                                   
                                    @if ($value['status'] == true)
                                    <!-- <td class="text-success">-->
                                    <!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>-->
                                        
                                    <!--</td>-->
                                    @else
                                    <!--<td class="text-danger">-->
                                    <!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>-->
                                    <!--</td>-->
                                    @endif
                                    <!--<td><b>NGN{{$value['amount_paid']}}</b></td>-->
                                    <td><b>NGN{{$value['balance']}}</b></td>
                                </tr>

                                <?php
                                $total_begining_balance += str_replace( ',', '', $value['begining_balance']);
                                //$total_begining_balance += floatval($value['begining_balance']); 
                                $total_repayment_amount += str_replace( ',', '', $value['repayment_amount']);
                                $total_penaltie += str_replace( ',', '', $value['penalties']); 
                                $total_interest += str_replace( ',', '', $value['interest']);
                                $total_principal += str_replace( ',', '', $value['principal']); 
                                $balance += str_replace( ',', '', $value['principal']);
                                $total_amount_paid += str_replace( ',', '', $value['amount_paid']); 
                                $total_balance += str_replace( ',', '', $value['total_balance']); 
                                
                                ?>
                                
                            @endforeach

                             <tr>
                                    <td></td>
                                    <td><b class="text-danger">Total</b></td>
                                    <td>
                                        <!--<b class="text-danger">NGN{{number_format($total_begining_balance,2)}}</b>-->
                                        </td>
                                    <td><b class="text-danger">NGN{{number_format($total_repayment_amount,2)}}</b></td>
                                    <!--<td><b class="text-danger">NGN{{number_format($total_penaltie,2)}}</b></td>-->
                                    <td><b class="text-danger">NGN{{number_format($total_interest,2)}}</b></td>
                                    <td><b class="text-danger">NGN{{number_format($total_principal,2)}}</b></td>
                                    <!--<td class="text-success"></td>-->
                                    <!--<td><b class="text-danger">NGN{{number_format($total_amount_paid,2)}}</b></td>-->
                                    <!--<td class="text-danger">-->
                                        <!--<b>NGN{{$balance}}</b>-->
                                    <!--    </td>-->
                                </tr>
                            
                        </tbody>
                    </table>
                    <h4 class="text-danger">Total Balance: NGN{{number_format($total_balance,2)}}</h4>
                    <input type="hidden" id="full_balance_to_pay_amount" value="{{$total_balance}}" >
                </div>
            </div>
        </div>
    </div>
</div>
<div class=row>
    <table>
        <td>
              <br>
            Thank you.<br>
            Yours faithfully<br>
            For: UK-Dion<br><br>
            
            <img src="{{ asset('staff/staffsign')}}/{{getSignature('head_of_loan')}}" title="view image" style="width:20%;"> 
             <br>
        Head of Loans  
        </td>
        <td width="50"></td>
        <td>
             <br> <br> <br> <br><br>
            <img src="{{ asset('staff/staffsign')}}/{{getSignature('complaince_officer')}}" title="view image" style="width:20%;">
            <br> <br>
            Head, Conpliance
        </td>
    </table>
   
</div>
<br> <br> <br>
<h4 class="text-secondary">Memorandum of Acceptance</h4>
<br>
I,  <b class="text-primary">{{strtoupper($letter->customer->first_name.' '.$letter->customer->last_name.' '.$letter->customer->other_name)}}</b> hereby 
accept the terms and conditions contained in this offer letter for DEFF of <b style="color:#dc3545;">NGN{{number_format($letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal,2)}}</b> dated {{date('d-m-Y')}} of which this is a copy.

I have read and understood the statements above and my signature hereunder represents my true and authentic manual signature and is evidence of my agreement to be bound 
by the terms of this contract between myself and the Lender.
 <br>
Signature & Date 

    <label>
        <img src="{{ asset('customerfiles/files')}}/{{$letter->customer->employment->sign}}" class="img-responsive" style="width:20%;">
        {{date('d-m-Y')}} 
    </label>
            
             
       
    </div>
                              </div>
                            </div>
                          </div>
                         
                        

                        </div>


                    </div>
                </div>                            
            </div>

          

        </div>
    </div>
    

</div>
</body>
</html>