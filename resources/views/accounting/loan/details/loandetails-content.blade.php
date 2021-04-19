<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing" style="margin-left:-25px;">
   <!-- START TAB DIV -->
            <div class="col-lg-12 col-12 layout-spacing">
            
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <!-- start header -->
                            <div class="content-section  animated animatedFadeInUp fadeInUp">

                                                <div class="row inv--head-section">

                                                    <div class="col-sm-6 col-12">
                                                        <h3 class="in-heading">{{trans('general.loan_detail')}}</h3>
                                                        <div class="avatar avatar-xl">
                                                            
                                                            @if($data->customer->customer_type == "employee")
                                                                <img alt="avatar" style="width:100px; hieght:100px;" src="https://ukdiononline.com/public/employeepictures/{{$data->customer->avatar}}" class="rounded" />
                                                             @else
                                                                <img alt="avatar" style="width:100px; hieght:100px;" src="{{ asset('customerfiles/profilepicture')}}/{{$data->customer->avatar}}" class="rounded" />
                                                            @endif
                                                            <br><br>
                                                            <span class="badge badge-primary" data-toggle="modal" data-target="#faderightModal-Profile-Info"> Profile Info </span> 
                                                            
                                                            <span class="badge badge-secondary" data-toggle="modal" data-target="#zoomuModal-loan-list"> Loan List </span> 
                                        
                                         <a href="#" class="badge badge-info" title="000-{{$data->id}}">Customer Code: 000-{{$data->customer->id}}</a>
                                                     
                                                     </div>
                                                    </div>
                                                    <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                                        <td class="text-center">
                                                             <!-- start Check if employee view-->  
                                                            @if(checkEmpLoanView() == 0)
                                                            
                                                             @if(can('Make Repayment'))
                                                                 <label id="text_repayment_btn"></label>
                                                                 <a  href="#" id="repayment_btn" class="badge badge-secondary" data-toggle="modal" data-target="#make-repaymentModal"> Make Repayment</a>

                                                             @endif
                                                         @endif
                                                    
                                                        </td>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row inv--detail-section" style="text-transform: uppercase;">

                                                    <div class="col-sm-7 align-self-center">
                                                        
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                                        <p class="inv-detail-title text-dark">Loan Officer : @if(isset($data->loan_officer->first_name) && isset($data->loan_officer->last_name))  {{$data->loan_officer->first_name}} {{$data->loan_officer->last_name}} @endif</p>
                                                        <p>View Customer Credit Score <a href="{{url('loan/loan/show/customer-credit-score',$data->customer_credit_score)}}"  class="btn btn-info mb-4 mr-2 btn-sm" target="_blank">View Customer Credit Score</a></p>
                                                    </div>
                                                   
                                                    
                                                    <div class="col-sm-7 align-self-left" style="color:#000;">
                                                        <p class="inv-customer-name text-dark"><b>Branch:</b>  {{$data->branch->title}}-{{$data->branch->state}}</p>
                                                        <p class="inv-street-addr text-dark"><b>Product:</b> {{$data->product->name}}</p>
                                                        <p class="inv-email-address text-info"><b>{{trans('general.loan_amount')}}:</b> ₦{{number_format($data->principal,2)}}</p>
                                                        <p class="inv-email-address text-danger"><b>{{trans('general.disbursed_amount')}}:</b> ₦{{number_format($data->disbursed_amount,2)}}</p>
                                                        <p class="inv-email-address text-dark"><b>{{trans('general.disbursed_date')}}:</b> {{$data->release_date}}</p>
                                                        <p class="inv-email-address text-dark"><b>{{trans('general.loan_purpose')}}:</b> <label style="text-transform: lowercase;">{{$data->loan_purpose}}<label></p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-left order-2">
                                                        <!--<p class="inv-list-number"><span class="inv-title text-info">Loan ID :</span> <span class="badge badge-secondary">000-{{$data->id}}</span></p>-->
                                                        <p class="inv-created-date text-dark"><span class="inv-title"><b>{{trans('general.created_by')}}:</b> </span> <span class="inv-date"> @if(isset($data->createdBy)) {{$data->createdBy->first_name}} {{$data->createdBy->first_name}}@endif</span></p>
                                                        <p class="inv-due-date text-dark"><span class="inv-title"><b>{{trans('general.created_date')}}:</b> : </span> <span class="inv-date">{{$data->created_at}}</span></p>
                                                    </div>
                                                </div>
                        </div>
                         <!-- end header -->
                         <!-- Start Customer Information -->
                          <div class="widget-content widget-content-area">

                                    <div id="iconsAccordion" class="accordion-icons">
                                     <!-- start Check if employee view-->  
                                        @if($data->customer->customer_type != "employee")
                                           @include('accounting.loan.includes.customer-general-info')
                                            
                                           @include('accounting.loan.includes.customer-employment-info')
                                        @endif
                                     <!-- End Check if employee view--> 
                                    </div>

                                </div>
                         <!-- End Customer Information -->
                           
                               
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area animated-underline-content">
                                    
                                    <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="true">
                                             Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pay-calender-tab" data-toggle="tab" href="#pay-calender" role="tab" aria-controls="pay-calender" aria-selected="false">
                                             Repayment Calender</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" id="audit-details-tab" data-toggle="tab" href="#audit-details" role="tab" aria-controls="audit-details" aria-selected="false">
                                             Transactions</a>
                                        </li> --}}
                                         <!-- start Check if employee view-->  
                                        @if($data->customer->customer_type != "employee")
                                        <li class="nav-item">
                                            <a class="nav-link" id="files-details-tab" data-toggle="tab" href="#files-details" role="tab" aria-controls="files-details" aria-selected="false">
                                             Files</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="gurantors-details-tab" data-toggle="tab" href="#gurantors-details" role="tab" aria-controls="gurantors-details" aria-selected="false">
                                             Guarantors</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="comments-details-tab" data-toggle="tab" href="#comments-details" role="tab" aria-controls="comments-details" aria-selected="false">
                                             Comments</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="audit-details-tab" data-toggle="tab" href="#audit-details" role="tab" aria-controls="audit-details" aria-selected="false">
                                             Audit Trails</a>
                                        </li>
                                        @endif
                                         <!-- End Check if employee view-->  
                                    </ul>

                                    <div class="tab-content" id="animateLineContent-4">
                                    
                                    <!-- start make-repayment-->  
                                     @if(checkEmpLoanView() == 0)
                                            @include('accounting.loan.details.make-repayment')
                                        @endif
                                    <!-- end make-repayment-->
                                    
                                        <!-- start calender -->
                                             @include('accounting.loan.includes.pay-calender')
                                        <!-- end calender-->
                                        
                                        <!-- start files-->
                                        <div class="tab-pane fade" id="files-details" role="tabpanel" aria-labelledby="files-details-tab">
                                                <p class="mb-4">
                                                   <!-- customer files-->
                                                        @include('accounting.loan.includes.customer-files')
                                                    <!-- customer files-->
                                                </p>      
                                        </div>
                                        <!-- end files-->
                                        <!-- start gurantors-->
                                             @include('accounting.loan.includes.gurantors')
                                        <!-- end gurantors-->

                                        <!-- start Comments-->
                                        @include('accounting.loan.includes.loan_comment')
                                        <!-- end Comments-->

                                        <!-- start Audit Trails-->
                                            @include('accounting.loan.includes.audit_trial')
                                        <!-- end Audit Trails-->

                                <div class="tab-pane fade active show" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                           

                                <div class="col-sm-12">
                                     <!-- start Audit Trails-->
                                        @include('accounting.loan.includes.loan-details')
                                    <!-- end Audit Trails-->
                                </div>


                                        </div>
                                    </div>

                                
                                 </div>
                                </div>
                            </div>
                            
                        </div>
        <!-- END TAB DIV -->

                    </div>


<script>
function otherPay(val){
    document.getElementById('div_other_amount').style.visibility = val;
     document.getElementById('pay_liquidation_amount').value = '';
     document.getElementById('pay_other_amount').value = '';
     document.getElementById('pay_other_amount').readOnly = false; 
    if(val ==='visible'){
       document.getElementById('pay_other_amount').required = true; 
    }else{
         document.getElementById('pay_other_amount').required = false; 
    }
}
function preliquidationPay(val){
    document.getElementById('div_other_amount').style.visibility = val;
    total_principal_balance
    if(val ==='visible'){
         const outstanding_blnc = document.getElementById('total_principal_balance').value;
         const outstanding_int = document.getElementById('next_instalment_interest').value;
         const total = outstanding_blnc * 1.02;
         let amt_to_pay = parseFloat(total) + parseFloat(outstanding_int);
        // amt_to_pay = amt_to_pay.toFixed(2); parseFloat
        //  console.log(total);
        //  console.log(outstanding_int);
        //  console.log(amt_to_pay);
         document.getElementById('pay_other_amount').required = true; 
         document.getElementById('pay_other_amount').value = amt_to_pay.toFixed(2); 
         document.getElementById('pay_other_amount').readOnly = true; 
         document.getElementById('pay_liquidation_amount').value = 'true'; 
    }else{
        document.getElementById('pay_liquidation_amount').value = ''; 
         document.getElementById('pay_other_amount').required = false; 
    }
}
function otherPayBalance(val){
    document.getElementById('div_other_amount_balance').style.visibility = val;
     document.getElementById('pay_liquidation_amount').value = ''; 
    if(val ==='visible'){
       document.getElementById('pay_other_amount_balance').required = true; 
    }else{
         document.getElementById('pay_other_amount_balance').required = false; 
    }
}
</script>