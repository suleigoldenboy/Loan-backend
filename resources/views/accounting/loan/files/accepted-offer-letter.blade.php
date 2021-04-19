<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Loan Offer Letter</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/pages/helpdesk.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->  
    
 
    <link href="{{ asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="helpdesk container">
        <nav class="navbar navbar-expand navbar-light">
            <a class="navbar-brand" href="#">
               
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    
                </ul>
            </div>
        </nav>

        <div class="helpdesk layout-spacing">

            <div class="hd-header-wrapper">
                <div class="row">                                
                    <div class="col-md-12 text-center">
                        <h4 class="">Loan Offer Letter</h4>
                        
                       <h4 style="text-align:center; background-color:#FFF;">
                                @if($letter->offerLetter)
                                    
                                     @if($letter->offerLetter->status == "active")
                                        <h4 class="text-secondary" style="background-color:#FFF; border-radius:2px; font-size:22px;">
                                            Offer Accepted Using the code: {{$letter->offerLetter->code}}
                                        </h4>
                                    @else
                                        <h4 class="text-danger" style="background-color:#FFF; border-radius:2px; font-size:22px;">Awaiting Signed offer letter </h4>
                                    @endif
                                    
                                @else
                                   <h4 class="text-danger" style="background-color:#FFF;  border-radius:2px; font-size:22px">Awaiting Signed offer letter </h4>
                                @endif
                            </h4>
                    </div>
                </div>
            </div>

            <div class="hd-tab-section" style="margin-top:-90px;">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="hd-statistics">
                        
                          <div class="card">
                            <div class="card-header" id="hd-statistics-2">
                              <div class="mb-0">
                                <div class=" collapsed" data-toggle="collapse" role="navigation" data-target="#collapse-hd-statistics-2" aria-expanded="true" aria-controls="collapse-hd-statistics-2">
                                   <img src="{{ asset('https://ukdiononline.com/assets/images/maxer.jpg')}}" class="img-responsive">
                                </div>
                              </div>
                            </div>
                            <div id="collapse-hd-statistics-2" class="collapse show" aria-labelledby="hd-statistics-2" data-parent="#hd-statistics">
                              <div class="card-body">
                                
    
    <div class="col-md-12" style="">
        <?php
        
        
        // repaymentInstrument
        // 
        
        // 
        // durationInterest
        // totalntAmount
        
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
        $appied_loan_amount = '<b style="color:#dc3545;">N'.number_format($appied_loan_amount,2).'</b>';
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
                 $the_release_date = $letter->release_date ? $letter->release_date : $letter->loan_start;//date('Y-m-d');
                                
                $cal_result = App\Http\Controllers\Loan\RepaymentController::repaymentScheduleCalendar($letter->product_id,$letter->id,$loan_amount,$letter->interest_rate,$letter->loan_duration,$letter->loan_duration_length,$the_release_date,$pay_day);
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
                        $get_adjusted_interest = 0;
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
                             <?php
                                
                                $get_adjusted_interest = str_replace( ',', '', $value['adjusted_interest']); 
                                ?>
                                
                                <tr>
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
                                    <td><b>₦{{$value['begining_balance']}}</b></td>
                                    <td><b>₦{{$value['repayment_amount']}}</b></td>
                                    <!--<td><b>₦{{$value['penalties']}}</b></td>-->
                                    <td><b>₦{{$value['interest']}}</b></td>
                                    <td><b>₦{{$value['principal']}}</b></td>
                                   
                                    @if ($value['status'] == true)
                                    <!-- <td class="text-success">-->
                                    <!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>-->
                                        
                                    <!--</td>-->
                                    @else
                                    <!--<td class="text-danger">-->
                                    <!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>-->
                                    <!--</td>-->
                                    @endif
                                    <!--<td><b>₦{{$value['amount_paid']}}</b></td>-->
                                    <td><b>₦{{$value['balance']}}</b></td>
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
                                        <!--<b class="text-danger">₦{{number_format($total_begining_balance,2)}}</b>-->
                                        </td>
                                    <td><b class="text-danger">₦{{number_format($total_repayment_amount,2)}}</b></td>
                                    <!--<td><b class="text-danger">₦{{number_format($total_penaltie,2)}}</b></td>-->
                                    <td><b class="text-danger">₦{{number_format($total_interest,2)}}</b></td>
                                    <td><b class="text-danger">₦{{number_format($total_principal,2)}}</b></td>
                                    <!--<td class="text-success"></td>-->
                                    <!--<td><b class="text-danger">₦{{number_format($total_amount_paid,2)}}</b></td>-->
                                    <!--<td class="text-danger">-->
                                        <!--<b>₦{{$balance}}</b>-->
                                    <!--    </td>-->
                                </tr>
                            
                        </tbody>
                    </table>
                    <h4 class="text-danger">Total Balance: ₦{{number_format($total_balance+$get_adjusted_interest,2)}}</h4>
                    <input type="hidden" id="full_balance_to_pay_amount" value="{{$total_balance}}" >
                </div>
            </div>
        </div>
    </div>
</div>
<div class=row>
    <div class=col-md-4>
        <br>
        Thank you.<br>
        Yours faithfully<br>
        For: UK-Dion<br>
        
        <img src="{{ asset('staff/staffsign')}}/{{getSignature('head_of_loan')}}" title="view image" style="width:20%;"> 
        <br>
        Head of Loans                              
        <br>
    </div>
     <div class=col-md-4>
         <br><br><br><br>
         <img src="{{ asset('staff/staffsign')}}/{{getSignature('complaince_officer')}}" title="view image" style="width:20%;">
         <br>
         Head, Conpliance
    </div>
</div>
<br>
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

    <div id="miniFooterWrapper" class="">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="position-relative">
                        <div class="arrow text-center">
                            <p class="">Up</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright align-self-center">
                            <p class="mt-md-0 mt-4 mb-0">{{date('Y')}} &copy; <a target="_blank" href="#">UK-DION</a>.</p>
                        </div>
                        <div class="col-xl-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-right text-center align-self-center">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/pages/helpdesk.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
</body>


</html>