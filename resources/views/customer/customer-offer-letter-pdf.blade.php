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
        $customer_name = $letter->customer->first_name;
        $appied_loan_amount = $letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal;
        $appied_loan_amount = '<b style="color:#dc3545;">N'.number_format($appied_loan_amount,2).'</b>';
         $the_letter =  str_replace("customer",$customer_name, $letter->product->offer_letter->letter);
        $the_letter =  str_replace("amount",$appied_loan_amount, $the_letter);
        $the_letter =  str_replace("ddate","Disbursement Date:".$letter->release_date, $the_letter);
        $the_letter =  str_replace("mdate","Maturity Date:".$letter->maturity_date, $the_letter);
         $the_letter =  str_replace("rate_percent",$letter->interest_rate."%", $the_letter);
        
        ?>
        </br></br></br>
            {!!nl2br($the_letter)!!}
            
            
            
            
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
               
                 //$the_release_date = $out->format('Y-m-d');
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
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($get_result as $value) 
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
                                    <td><b>N{{$value['begining_balance']}}</b></td>
                                    <td><b>N{{$value['repayment_amount']}}</b></td>
                                    <!--<td><b>₦{{$value['penalties']}}</b></td>-->
                                    <td><b>N{{$value['interest']}}</b></td>
                                    <td><b>N{{$value['principal']}}</b></td>
                                   
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
                                    <td><b>N{{$value['balance']}}</b></td>
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
                                    <td><b class="text-danger">N{{number_format($total_repayment_amount,2)}}</b></td>
                                    <!--<td><b class="text-danger">₦{{number_format($total_penaltie,2)}}</b></td>-->
                                    <td><b class="text-danger">N{{number_format($total_interest,2)}}</b></td>
                                    <td><b class="text-danger">N{{number_format($total_principal,2)}}</b></td>
                                    <!--<td class="text-success"></td>-->
                                    <!--<td><b class="text-danger">₦{{number_format($total_amount_paid,2)}}</b></td>-->
                                    <!--<td class="text-danger">-->
                                        <!--<b>₦{{$balance}}</b>-->
                                    <!--    </td>-->
                                </tr>
                            
                        </tbody>
                    </table>
                    <h4 class="text-danger">Total Balance: N{{number_format($total_balance,2)}}</h4>
                    <input type="hidden" id="full_balance_to_pay_amount" value="{{$total_balance}}" >
                </div>
            </div>
        </div>
    </div>
</div>

            
            
            
       
    </div>
    

</div>
</body>
</html>