@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Create Borrower</h6>
                                              <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <!-- start header -->
                            <div class="content-section  animated animatedFadeInUp fadeInUp">

                                                

                                                <div class="row inv--detail-section" style="text-transform: uppercase;">

                                        
                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-customer-name"><b>Branch:</b>  {{$data->branch->title}}-{{$data->branch->state}}</p>
                                                        <p class="inv-street-addr"><b>Product:</b> {{$data->product->name}}</p>
                                                        <p class="inv-email-address text-info"><b>Loan Amount:</b> ₦{{number_format($data->principal,2)}}</p>
                                                        <p class="inv-email-address text-danger"><b>Disbursed Amount:</b> ₦{{number_format($data->disbursed_amount,2)}}</p>
                                                        <p class="inv-email-address"><b>Disbursed Date:</b> {{$data->release_date}}</p>
                                                        <p class="inv-email-address"><b>Loan Purpose:</b> <label style="text-transform: lowercase;">{{$data->loan_purpose}}<label></p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-left order-2">
                                                        <p class="inv-list-number"><span class="inv-title text-info">ID : </span> <span class="inv-number">UKD-{{$data->id}}</span></p>
                                                        <p class="inv-detail-title">Loan Officer : {{$data->loan_officer->name}}</p>
                                                        <p class="inv-created-date"><span class="inv-title"><b>Created By:</b> </span> <span class="inv-date"> {{$data->createdBy->name}}</span></p>
                                                        <p class="inv-due-date"><span class="inv-title"><b>Created Date:</b> : </span> <span class="inv-date">{{$data->created_at}}</span></p>
                                                    </div>
                                                </div>
                        </div>
                         <!-- end header -->
                         </div>
                                             </div>
                                            <div class="row">
                                            <!-- Start Loan Information -->
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
                                            </ul>

                                            <div class="tab-content" id="animateLineContent-4">
                                            
                                            
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
                                            <!-- End Loan Information -->
                                            </div>
                                        </div>

                                        

                                        <div class="row">

                                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="padding-left:79px;">
                                            
                                             <h1><svg xmlns="#" width="74" height="74" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle text-info"><circle cx="12" cy="12" r="10"></circle><polyline points="12 16 16 12 12 8"></polyline><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                                             Assign to {{$officer->first_name}} {{$officer->last_name}} {{$officer->other_name}}</h1>
                                            <form action="{{url('borrower/store')}}" method="POST" id="actionForm">
                                                {{csrf_field()}}
                                                <input type="hidden" name="loan_id" value="{{$data->id}}" >
                                                 <input type="hidden" name="loan_officer_id" value="{{$officer->id}}" >
                                                <div class="col-md-6">
                                                <div class="form-row mb-4">
                                                        <div class="col">
                                                            <h4>Priority</h4>
                                                            <select name="priority" class="form-control  basic" required>
                                                               <option value="">Select</option>
                                                               <option value="Law">Law</option>
                                                               <option value="Medium">Medium</option>
                                                               <option value="Hight">Hight</option>
                                                            </select>
                                                        </div>
                                                        </div>
                                                        <div class="form-row mb-4">
                                                            <div class="col">
                                                                <h4>Note</h4>
                                                                <textarea name="note" placeholder="Note" class="form-control" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                 <button class="btn btn-primary mb-4 mr-2 btn-lg" style="">Submit</button> 
                                           

                                                </form>
                                            
                                        </div>
                                    </div>
                                    
                            </div>
                           
                            
                            </div>
                        </div>
                    </div>

                  
                </div>

            </div>


@endsection
