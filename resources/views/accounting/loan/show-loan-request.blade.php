@extends('layouts.admin-app')

@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
    
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
                                                        <h3 class="in-heading">Loan Request Details</h3>
                                                    </div>
                                                    <div class="col-sm-6 col-12 align-self-center text-sm-left">
                                                        <div class="company-info">
                                                         <div class="avatar avatar-xl">
                                                            
                                                             @if($data->customer->customer_type == "employee")
                                                                <img alt="avatar" style="width:100px; hieght:100px;" src="https://ukdiononline.com/public/employeepictures/{{$data->customer->avatar}}" class="rounded" />
                                                             @else
                                                                <img alt="avatar" style="width:100px; hieght:100px;" src="{{ asset('customerfiles/profilepicture')}}/{{$data->customer->avatar}}" class="rounded" />
                                                            @endif
                                                        </div>
                                                        <br>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row inv--detail-section" style="text-transform: uppercase;">

                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-to">Customer: 
                                                            <b title="{{$data->customer->id}}">
                                                                {{$data->customer->first_name}} 
                                                                {{$data->customer->other_name}} 
                                                                {{$data->customer->last_name}}
                                                            </b>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                                        <p class="inv-detail-title text-left">Relationship Officer : 
                                         @if ($data->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                        <!--<a href="{{url('loan/loan/assign-officer',$data->id)}}" class="btn btn-warning mb-4 mr-2 btn-sm" style="padding:3px; margin-top:23px;">Assign Officer</a>-->
                                        @else
                                        {{$data->loan_officer->first_name}} {{$data->loan_officer->last_name}} {{$data->loan_officer->other_name}}
                                        @endif
                                        </p>
                                                    </div>
                                                   
                                        
                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-customer-name"><b>Branch:</b>  {{$data->branch->title}}-{{$data->branch->state}}</p>
                                                        <p class="inv-street-addr"><b>Product:</b> 
                                                        @if($data->product['id'] == 3)
                                                        <span class="badge outline-badge-warning">{{$data->product->name}} </span>
                                                        @elseif($data->product['id'] == 4)
                                                        <span class="badge outline-badge-success"> {{$data->product->name}} </span>
                                                        @else
                                                        <span class="badge outline-badge-info"> {{$data->product->name}}</span>
                                                        @endif
                                                        
                                                        
                                                        </p>
                                                        <p class="inv-email-address"><b>Loan Amount:</b> ₦{{number_format($data->principal,2)}}</p>
                                                        <p class="inv-email-address"><b>Loan Purpose:</b> <label style="text-transform: lowercase;">{{$data->loan_purpose}}<label></p>
                                                        
                    
                    
                   

 @if ($data->status != "active")
        @if(is_numeric($data->confirmation_status) && $data->confirmation_stage->privilege)
            @if(checkConfirmationProcess($data->confirmation_stage->privilege, "offer_letter"))
            
                    @if(checkLetterStatus($data->id))
                        
                        @if(checkLetterStatus($data->id) == "pending")
                        <p class="inv-email-address"><b>Offer Letter:</b> <label style="text-transform: lowercase;">
                             <a  href="#" class="badge badge-danger"> Awaiting Signed offer letter</a>
                            <a  href="{{url('admin/show/loan/offer-letter',$data->id)}}" class="badge badge-info" target="_blank"> View</a>
                             <a id="email_param"  href="{{url('admin/send/loan/offer-letter',[date('Y-m-d'),$data->id,$data->customer->id,$data->customer->email])}}" class="badge badge-warning"> Re-send offer letter</a>
                        @elseif(checkLetterStatus($data->id) == "active")
                            <p class="inv-email-address"><b>Offer Letter:</b> <label style="text-transform: lowercase;">
                             <a  href="#" class="badge badge-success">ACCEPTED</a>
                             <a target="_blank" href="{{url('admin/show/loan/accepted/offer-letter',[$data->id])}}" class="badge badge-secondary"> View offer Letter</a>
    
                            
                        @endif
                        
                    @else
                    <p class="inv-email-address"><b>Offer Letter:</b> <label style="text-transform: lowercase;">
                       
                        <a id="email_param" href="{{url('admin/send/loan/offer-letter',[date('Y-m-d'),$data->id,$data->customer->id,$data->customer->email])}}" class="badge badge-primary"> Send offer letter</a>
                   
                    @endif

            @endif
        @endif
 @endif
 
  @if(checkLetterStatus($data->id) && $data->product_id != 4)
    @if(checkLetterStatus($data->id) == "active")
        <?php $letter_info = getAcceptedLetterInfo($data->id); ?>
        
        @if($data->customer->cardInstrument)
         <br>
         <label class="text-info">Card Verification Info</label>
         <br>
         
       
         <?php
            $numItems = count($data->customer->cardInstrument);
            $i = 0;
        ?>
         
         @foreach($data->customer->cardInstrument as $card)
            
            @if(++$i === $numItems)
                <button class="btn btn-dark mb-2">
                   Name :  {{$card->last_name}} {{$card->first_name}}<br>
                   EXP MONTH : {{$card->exp_month}}<br>
                   EXP YEAR :  {{$card->exp_year}}<br>  
                 </button>
            @endif

         
         @endforeach
         
         <br> 
        @endif

        
        <!-- <a id="email_param" href="{{url('admin/send/loan/offer-letter',[$data->id,$data->customer->id,$data->customer->email])}}" class="badge badge-primary"> Send offer nn letter</a>
                    -->
        <a target="_blank" href="{{url('admin/show/loan/accepted/offer-letter',[$data->id])}}" class="badge badge-secondary"> View offer Letter</a>
        
        <!--<a id="email_param"  href="{{url('admin/send/loan/offer-letter',[$data->id,$data->customer->id,$data->customer->email])}}" class="badge badge-warning"> Re-send offer letter</a>-->
        <!--<a  href="#" class="badge badge-secondary" data-toggle="modal" data-target=".bd-example-modal-accepted-offer-letter"> View Letter</a>-->
        <!--<a  href="#" class="badge badge-secondary" data-toggle="modal" data-target=".bd-example-modal-accepted-application-form"> View Application Form</a>-->
                                                                  
    @endif
  @endif
                 
                    <label></p>
                                                     
                                                     </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-left order-2">
                                                        <p class="inv-list-number"><span class="inv-title text-info">
                                    <!--Loan ID :</span> <span class="badge badge-secondary">000-{{$data->id}}</span>-->
                                    </p>
                                            <p class="inv-created-date"><span class="inv-title"><b>Created By:</b> </span> <span class="inv-date"> 
                                        @if ($data->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                          
                                          <p class="inv-created-date">
                                              <b>Address Confirmed By:</b>  
                                              {{getAdminUserName($data->customer->employment->online_address_confirm_by)}} <br>
                                              <b>Date:</b> {{$data->customer->employment->online_address_confirm_date}}
                                          </p>
                                           <p class="inv-created-date">
                                              <b>File Uploaded By:</b>  
                                              {{getAdminUserName($data->customer->employment->online_file_confirm_by)}} <br>
                                              <b>Date:</b> {{$data->customer->employment->online_file_confirm_date}}
                                              <br>
                                             
                                               <a href="#" data-toggle="modal" data-target="#zoomuModal-loan-list-image1" class="badge badge-primary" style="float:right;">Address Image 1</a>
                                               <a href="#" data-toggle="modal" data-target="#zoomuModal-loan-list-image2" class="badge badge-primary" style="float:right;">Address Image 2</a>
                                          </p>
                                          
                                        
                                         @elseif($data->product->id == 3)
                                             {{$data->customer->first_name}} 
                                             {{$data->customer->other_name}} 
                                            {{$data->customer->last_name}}
                                        @else
                                        {{$data->createdBy->first_name}} {{$data->createdBy->last_name}}
                                        @endif
                                        </span></p>
        <p class="inv-due-date"><span class="inv-title"><b>Created Date:</b> : </span> <span class="inv-date">{{$data->created_at}}</span></p>
        
        @if($data->confirmation_stage)
             @if(checkConfirmationProcess($data->confirmation_stage->privilege, "confirm_bvn"))
               <a class="btn btn-danger mb-4 mr-2 btn-sm" style="padding:3px;" target="_blank" href="https://webserver.creditreferencenigeria.net/CRCWeb/vw/SB?p=9MOCRqXKwmF0F6tJEfi2FJuNTLLo5Y3U">Check BVN</a>
             @endif
        @endif    
         
        @if($data->customer_credit_score)
        
        @if($data->status == 'approve')
         <a href="{{url('loan/loan/show/customer-credit-score',$data->customer_credit_score)}}"  class="btn btn-info mb-4 mr-2 btn-sm" target="_blank">View Customer Credit Score</a>
         @endif
         
         @if($data->confirmation_stage)
          @if(checkConfirmationProcess($data->confirmation_stage->privilege, "view_credit_score"))                                           
           <a href="{{url('loan/loan/show/customer-credit-score',$data->customer_credit_score)}}"  class="btn btn-info mb-4 mr-2 btn-sm" target="_blank">View Customer Credit Score</a>
           <a class="text-danger" data-toggle="modal" data-target="#customerCreditScoreModal" >Change Credit Score </a>
           @endif
         @endif
          
        @else
        @if($data->confirmation_stage)
            @if(checkConfirmationProcess($data->confirmation_stage->privilege, "upload_credit_score"))
            <a class="btn btn-primary mb-4 mr-2 btn-sm" style="padding:3px;" data-toggle="modal" data-target="#customerCreditScoreModal" >Customer Credit Score </a>
            @endif
         @endif
        @endif
         
                                        </div>
                                                </div>
                        </div>
                         <!-- end header -->
                         <!-- Start Customer Information -->
                          <div class="widget-content widget-content-area">

                                    <div id="iconsAccordion" class="accordion-icons">
                                       @include('accounting.loan.includes.customer-general-info')
                                        
                                       @include('accounting.loan.includes.customer-employment-info')
                                       
                                       @if(checkLetterStatus($data->id))
                                        @if(checkLetterStatus($data->id) == "active")
                                             <?php $letter_info = getAcceptedLetterInfo($data->id); ?>
                                             
                                        @endif
                                      @endif
                                     
                                        
                                    
                                    </div>

                                </div>
                         <!-- End Customer Information -->
                            @if ($data->rejection_status)
                                 <div class="col-md-12">
                                
                                     <div id="toggleAccordion">
                                        <div class="card">
                                            <div class="card-header" id="...">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne">
                                                      <div class="spinner-grow text-danger align-self-center" style="font-size:10px;">Loading...</div>
                                                      <b class="text-danger">Click to see Loan Rejection Details</b>  <div class="icons"><svg> ... </svg></div>
                                                    </div>
                                                </section>
                                            </div>
                                    
                                            <div id="defaultAccordionOne" class="collapse" aria-labelledby="..." data-parent="#toggleAccordion">
                                                <div class="card-body">
                                                
                                                      @foreach(getRejectionMessage($data->id,'Loan rejected back') as $reg_data)
                                          
                                                      @if($data->id == $reg_data->action_id)
                                                        <div class="col-lg-12">
                                                                <div class="jumbotron" style="padding:7px; background-color:#FFF; border:1px #CCC solid;">
                                                                  
                                                                  <p class="mb-5">
                                                                  <label class="text-info">From: {{ getAdminUserName($reg_data->user_id)}}</label>
                                                                  <br>
                                                                  {{$reg_data->note}}
                                                                  <br>
                                                                   <label class="text-info">Rejected Date: {{ convertDateToStringWithTime($reg_data->created_at)}}</label>
                                                                  </p>
                                                                 
                                                                </div>
                                                            </div> 
                                                      @endif
                                                            
                                                    @endforeach
                                    
                                                </div>
                                            </div>
                                        </div>
                                    
                                       
                                    </div>
                                     
                                    
                                    
                                </div>
                            @endif
                               
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
                                            <a class="nav-link" onClick="seeCredential('calender');" id="pay-calender-tab" data-toggle="tab" href="#pay-calender" role="tab" aria-controls="pay-calender" aria-selected="false">
                                             Repayment Calender</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" onClick="seeCredential('files');"  id="files-details-tab" data-toggle="tab" href="#files-details" role="tab" aria-controls="files-details" aria-selected="false">
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
                                        <li class="nav-item">
                                            <a class="nav-link" id="check-list-details-tab" data-toggle="tab" href="#check-list-details" role="tab" aria-controls="check-list-details" aria-selected="false">
                                             <b class="text-danger">Check List</b></a>
                                        </li>
                                    </ul> 

                                    <div class="tab-content" id="animateLineContent-4">
                                        <!-- start files-->
                                        <div class="tab-pane fade" id="files-details" role="tabpanel" aria-labelledby="files-details-tab">
                                                <p class="mb-4">
                                                   <!-- customer files-->
                                                        @if ($data->customer_request)
                                                            @include('accounting.loan.includes.online-customer-files')
                                                        @else
                                                            @include('accounting.loan.includes.customer-files')
                                                        @endif
                                                    <!-- customer files-->
                                                </p>      
                                        </div>
                                        <!-- end files-->
                                         <!-- start calender -->
                                                @include('accounting.loan.includes.pay-calender')
                                        <!-- end calender-->
                                        <!-- start gurantors-->
                                             @include('accounting.loan.includes.gurantors')
                                        <!-- end gurantors-->

                                        <!-- start Comments-->
                                        @include('accounting.loan.includes.loan_comment')
                                        <!-- end Comments-->

                                        <!-- start Audit Trails-->
                                            @include('accounting.loan.includes.audit_trial')
                                        <!-- end Audit Trails-->
                                         <!-- start check list Trails-->
                                         @include('accounting.loan.includes.check-list')
                                        <!-- end check list Trails-->


                                <div class="tab-pane fade active show" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                           

                                <div class="col-sm-12">

                                  <!-- start Loan Details-->
                                    @include('accounting.loan.includes.loan-details')
                                 <!-- end Loan Details-->
                                
                                </div>


                                        </div>
                                    </div>

                                @include('accounting.loan.includes.change-amount-modal')
                        <!--@include('accounting.loan.includes.offer-letter')-->
                                <!-- Action Confirmation and rejection Div Start-->
                                    <div class="text-right">
                                    @if (App\Http\Helpers\AdminHelper::check_if_user_is_the_one_to_disburse())
                                    
                                 @if($data->confirmation_status != "decline")
                                            @if($data->status != "active" && $data->status != "approve")
                                            <button type="button" style="visibility:hidden" id="approve_btn" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#approveFormModal">
                                              Approve Loan<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                           </button>
                                           @endif
                                 @endif
                                          {{-- @include('accounting.loan.includes.disbursement-modal') --}}
                                          @include('accounting.loan.includes.approve-modal')
                                     @else
                                         @if ($data->rejection_status && $data->confirmation_status != "decline")
                                    
                                       @if($data->status != "active" && $data->status != "approve")
                                       <button type="button" style="visibility:hidden" id="re_confirm_btn"  class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Re-Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
                                        @endif
                                        
                                         @else
                                         
                                    @if($data->confirmation_status != "decline")
                                    

 @if ($data->status != "active")
        @if(is_numeric($data->confirmation_status) && $data->confirmation_stage->privilege)
            @if(checkConfirmationProcess($data->confirmation_stage->privilege, "offer_letter"))
            
                    @if(checkLetterStatus($data->id))
                        
                        @if(checkLetterStatus($data->id) == "pending")
                            
                                <p class="text-danger">Awaiting Signed offer letter</p>
                        @elseif(checkLetterStatus($data->id) == "active")
                            @if($data->status != "active" && $data->status != "approve")
                            <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
                                        @endif
                        @endif
                        
                    @else
                    
                            @if($data->status != "active" && $data->status != "approve")
                                <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                                    Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                                </button>
                            @endif
                    
                    @endif
            @else
            
                    @if($data->status != "active" && $data->status != "approve")
                     <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                                    Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                                </button>
                    @endif
                    

            @endif
        @endif
 @else
 @if($data->status != "active" && $data->status != "approve")
 <button type="button" style="visibility:hidden" id="confirm_btn" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#confirmLoanModal">
                                            Confirm<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> 
                                        </button>
                                        @endif
 @endif
                                        
                                    @endif
                                        @endif

                                    @endif
                                    @if($data->status != "active" && $data->status != "approve")
                                        <button type="button" class="btn btn-danger mb-2 mr-2" data-toggle="modal" data-target="#rejectLoanModal">
                                            Reject<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </button>
                                        <button type="button" class="btn btn-dark mb-2 mr-2" data-toggle="modal" data-target="#declineModal">
                                            Decline<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        </button>
                                        @endif
                                        
                                        @include('accounting.loan.includes.confirm-loan-model-actions')
                                <!-- End Action Confirmation and rejection Div -->
                                    <br>
                                    @if($data->status != "active" && $data->status != "approve")
                                    <label class="text-danger" id="see_credential_msg">Make sure you view all the re-payment calender and the files before you proceed</label>
                                    @endif
                                    
                                 </div>
                                </div>
                            </div>
                            
                        </div>
        <!-- END TAB DIV -->
        
        
         @if ($data->customer_request)
          <!-- Start Customer picture modal -->  

                    <div id="zoomuModal-loan-list-image1" class="modal animated zoomInUp custo-zoomInUp" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                         <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->address_picture}}" class="img-responsive" style="width:100%;">
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                        <!--<button type="submit" class="btn btn-success">Yes Confirm</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div id="zoomuModal-loan-list-image2" class="modal animated zoomInUp custo-zoomInUp" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->address_picture_2}}" class="img-responsive" style="width:100%;">
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                        <!--<button type="submit" class="btn btn-success">Yes Confirm</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    <!-- End Customer picture modal --> 
                @endif


    </div>
</div>
<script>
let check_calender = false;
let check_files = false;
function seeCredential(val){
    
    switch(val){
        
        case 'calender':
            check_calender = true;
            break;
        case 'files':
            check_files = true;
            break;

    }

    if(check_calender && check_files){

        document.getElementById('see_credential_msg').innerHTML ='';
        hideOrDisplay('visible');

    }else if(check_calender && !check_files){

        document.getElementById('see_credential_msg').innerHTML ='Make sure you view all the files before you proceed.';
        //hideOrDisplay('visible');

    }else if(!check_calender && check_files){

        document.getElementById('see_credential_msg').innerHTML ='Make sure you view all the re-payment calender before you proceed';
       //hideOrDisplay('visible');

    }else if(!check_calender && !check_files){
        
        document.getElementById('see_credential_msg').innerHTML ='Make sure you view the re-payment calender and the files before you proceed';
        //hideOrDisplay('visible');
    }else{
        hideOrDisplay('visible');
    }

}

function hideOrDisplay(val){
    let confirm_btn = document.getElementById('confirm_btn');//.style.display ='true';
    let re_confirm_btn = document.getElementById('re_confirm_btn');//.style.display ='true';
    let approve_btn = document.getElementById('approve_btn');//.style.display ='true';
    if(confirm_btn){
        confirm_btn.style.visibility = val;
    }
    if(re_confirm_btn){
        re_confirm_btn.style.visibility = val;
    }
    if(approve_btn){
        approve_btn.style.visibility = val;
    }
}

function calMaxLoanOffer2(){
  const net = $("#net_pay").val();
  let input = document.getElementById("change_principal");
  let prin_val = parseInt(document.getElementById("change_principal").value);

  let p_max = $("#validate_max").val();
  let p_min = $("#validate_min").val();
  let principal_max = $("#principal_max").val();
  
//   console.log(':: '+p_max);
//   console.log(':: '+p_min);
let A = net * 0.4;
let B = A * parseInt($("#loan_duration").val());
let C = 0.032 * parseInt($("#loan_duration").val());
let D = C + 1;
let E = B / D;
let d_total = E;

//   let total = net * 0.4;
//   total = total / 1.032; 
//   const d_total = total * parseInt($("#loan_duration").val());

  if(d_total > p_max){
      d_total = p_max;
  }
  if(d_total > principal_max){
      d_total = principal_max;
  }
  
  
  

  //console.log('Total:: '+d_total);

  input.setAttribute("max",d_total);
  input.setAttribute("min",p_min);
  $("#max_l_amount").val(d_total);
  
  if(prin_val < p_min){
        p_min = parseInt(p_min);
       $("#max_loan_msg").html('Minimum Eligible Loan Amount is ₦'+putComma(p_min));
       $("#change_amt_btn").hide();
         return false
  }
  $("#change_amt_btn").show();
 
  
  if(prin_val > d_total){
        $("#change_principal").val('');
        
        if(Number.isInteger(d_total)){
             $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(d_total));
        }else{
             $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(d_total));
        }
        
       
    }else{
        $("#max_loan_msg").html('');
    }
    
  if(Number.isInteger(d_total)){
             $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(d_total));
        }else{
             $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(d_total));
        }

}

function isFloat(n) {
    return n === +n && n !== (n|0);
}

function putComma(x) {
    //convert to two decimals
    x = x.toFixed(2);
    //put comma
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>
@endsection
