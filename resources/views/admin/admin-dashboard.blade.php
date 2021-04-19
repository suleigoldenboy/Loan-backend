@extends('layouts.admin-app')

@section('content')

<div class="widget-content widget-content-area text-center split-buttons">
                                    <p class="mb-2"> <b>Quick Start</b></p>

                                    <!--<a href="{{url('loan/loan/show/request')}}" class="btn btn-primary mb-4 mr-3 btn-lg">Loan Request</a>-->
                                    <a href="{{url('customer/view')}}" class="btn btn-info mb-4 mr-3 btn-lg">View Customers</a>
                                    <!--<a href="{{url('loan/loan/disburse/loan')}}" class="btn btn-success mb-4 mr-3 btn-lg">Disbursement</a>-->
                                    <a href="{{route('employee.index')}}" class="btn btn-primary mb-4 mr-2 btn-lg">Human Resorces</a>
                                    <a href="{{url('loan/loan/show/decline')}}" class="btn btn-danger mb-4 mr-3 btn-lg">Declined Loans</a>
                                    <button class="btn btn-secondary mb-4 mr-3 btn-lg">Commission</button>
                                    <a href="{{url('loan/loan/view')}}" class="btn btn-primary mb-4 mr-3 btn-lg">View Loan</a>
                                     <a href="{{url('loan/show/request/status')}}" class="btn btn-secondary mb-4 mr-3 btn-lg">Loan Status</a>
                                     <a href="{{url('unpaid/loans')}}" class="btn btn-info mb-4 mr-3 btn-lg">Unpaid Loans</a>
                                    <a href="{{url('admin/offer-letter')}}" class="btn btn-primary mb-4 mr-3 btn-lg">Offer Letter</a>
                                    <!-- <button class="btn btn-primary mb-4 mr-2 btn-lg">Calculator</button> -->
                                    <button class="btn btn-primary mb-4 mr-3 btn-lg">Manage Charges</button>
                                    <!-- <button class="btn btn-primary mb-4 mr-3 btn-lg">Manage Payroll</button> -->
                                    <!--<button class="btn btn-primary mb-4 mr-3 btn-lg">Sales Funnel</button> -->
                                    <a href="{{url('loan/loan/show/request',1)}}" class="btn btn-secondary mb-4 mr-3 btn-lg">e-Request</a>
                                    <a href="{{url('loan/loan/show/request',2)}}" class="btn btn-secondary mb-4 mr-3 btn-lg">e-Request-Recovery</a>
                                    <a href="{{url('loan/loan/show/request',3)}}" class="btn btn-warning mb-4 mr-3 btn-lg">Risk One</a>
                                    <a href="{{url('loan/loan/show/request',4)}}" class="btn btn-warning mb-4 mr-3 btn-lg">Risk Two</a>
                                    <a href="{{url('loan/loan/show/request',5)}}" class="btn btn-warning mb-4 mr-3 btn-lg">Final Risk</a>
                                      <a href="{{url('loan/loan/disburse/loan')}}" class="btn btn-success mb-4 mr-3 btn-lg">Exchequer One</a>
                                    <a href="{{url('loan/loan/disburse/loan/payment')}}" class="btn btn-success mb-4 mr-3 btn-lg">Exchequer Two</a>
                                    <a href="{{url('loan/loan/view')}}" class="btn btn-dark mb-4 mr-3 btn-lg">Recovery Search</a>
                                     <a href="{{url('account/disburse/report')}}" class="btn btn-dark mb-4 mr-3 btn-lg">Disbursement Tool</a>
                                    <a href="{{url('recovery-history')}}" class="btn btn-dark mb-4 mr-3 btn-lg">Card/Remiter Recovery</a>
                                   

                                   
                                </div>
                                

<!--  BEGIN CONTENT PART  -->
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">
                                        {{trans('general.currency_symbol')}}
                                        {{number_format(App\Http\Controllers\DashboardController::getTotalDisburseLoan(),2)}}</h6>
                                        <p class="">Total Disbursed Loan</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content" style="margin-bottom: 43px;">
                                    <div class="w-info">
                                       <h2 class="w-value">
                                         <p class="">Running DEFF Loan</p></label>
                                        </h2>
                                        <div class="info">
                                        <h6 class="value">
                                        {{trans('general.currency_symbol')}}
                                        <strong>{{number_format(App\Http\Controllers\DashboardController::getRunningLoanAmount(),2)}}</strong></h6>
                                       </div>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            {{number_format(App\Http\Controllers\DashboardController::getRunningLoan())}}
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="acc-action">
                                        <a href="{{ url('loan/active/2') }}" class="btn btn-info">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content" style="margin-bottom: 43px;">
                                    <div class="w-info">
                                       <h2 class="w-value">
                                         <p class="">Running Federal Loan</p></label>
                                        </h2>
                                        <div class="info">
                                        <h6 class="value">
                                        {{trans('general.currency_symbol')}}
                                        <strong>{{number_format(App\Http\Controllers\DashboardController::getRunningFederalLoanAmount(),2)}}</strong></h6>
                                       </div>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            {{number_format(App\Http\Controllers\DashboardController::getRunningFederalLoan())}}
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="acc-action">
                                        <a href="{{ url('loan/active/2') }}" class="btn btn-info">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-account-invoice-two">
                            <div class="widget-content">
                                <div class="account-box">
                                    <div class="info" style="margin: 19px 0px;">
                                        <h5 class="">Staff Loan Details</h5>
                                        <p>{{number_format(App\Http\Controllers\DashboardController::getStaffRunningLoan()->count())}}</p>
                                    </div>
                                    <div class="info" style="margin: auto 0px;">
                                        <h6 class="value" style="color: #fff;font-size: larger;">
                                        @php $total = 0; @endphp
                                        @foreach(App\Http\Controllers\DashboardController::getStaffRunningLoan() as $loan)
                                            @php 
                                                $total += $loan->disbursed_amount ? $loan->disbursed_amount : $loan->principal;
                                            @endphp
                                        @endforeach
                                        {{trans('general.currency_symbol')}}
                                        <strong>{{number_format($total)}}</strong></h6>
                                    </div>
                                    <div class="acc-action">
                                        <a href="{{ url('loan/active/3') }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value"> 
                                        {{trans('general.currency_symbol')}}
                                        {{number_format(App\Http\Controllers\DashboardController::getTotalRepayment(),2)}}</h6>
                                        </h6>
                                        <p class="">Total Re-Paid Amount</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info">
                                        <h6 class="value">  
                                        @php $total = 0; @endphp
                                            @foreach(App\Http\Controllers\DashboardController::getTotalRunningLoan()['total_loan'] as $loan)
                                                @php 
                                                    $total += $loan->disbursed_amount ? $loan->disbursed_amount : $loan->principal;
                                                @endphp
                                            @endforeach
                                            {{number_format($total)}}
                                        </h6>
                                        <p class="">Total Active Loan</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                            {{ App\Http\Controllers\DashboardController::getTotalRunningLoan()['total_loan_count'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-card-four">
                            <div class="widget-content">
                                <div class="w-content">
                                    <div class="w-info" style="margin: 19px 0px;">
                                        <h6 class="value">
                                        {{ App\Http\Controllers\DashboardController::getTotalRunningLoan()['total_e_request_amount']->sum('disbursed_amount') }}</h6>
                                        <p class="">Total Online Request</p>
                                    </div>
                                    <div class="">
                                        <div class="w-icon">
                                        {{ App\Http\Controllers\DashboardController::getTotalRunningLoan()['total_e_request'] }}
                                        </div>
                                    </div>
                                </div>
                                 <div class="acc-action ">
                                        <a class="btn btn-primary" href="{{ url('loan/active/online-request') }}">View Details</a>
                                    </div>
                            </div>
                        </div>
                    </div> -->


                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-four">
                            <!--<div class="widget-heading">-->
                            <!--    <h5 class="">Loan Clasification</h5>-->
                            <!--</div>-->
                            <div class="widget-content">
                                <div class="vistorsBrowser">
                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                        <div class="w-browser-details">
                                             <div class="w-browser-info">
                                                <h6>e-Request</h6><h6>₦{{ number_format(App\Http\Controllers\DashboardController::riskLoan(1)->sum('principal'), 2) }}</h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::riskLoan(1)->count() }}</h5>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                        <div class="w-browser-details">
                                             <div class="w-browser-info">
                                                <h6>e-Request-Recovery</h6><h6>₦{{ number_format(App\Http\Controllers\DashboardController::riskLoan(2)->sum('principal'), 2) }}</h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::riskLoan(2)->count() }}</h5>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            
                                            <div class="w-browser-info">
                                                <h6>Risk 1</h6><h6>₦{{ number_format(App\Http\Controllers\DashboardController::riskLoan(3)->sum('principal'), 2) }}</h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::riskLoan(3)->count() }}</h5>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>  

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            
                                            <div class="w-browser-info">
                                                <h6>Risk 2</h6><h6>₦
                                                @php 
                                                    $amount=0;
                                                    foreach(App\Http\Controllers\DashboardController::riskLoan(4) as $loan){
                                                        if($loan->disbursed_amount != null){
                                                            $amount = $amount + $loan->disbursed_amount;
                                                        } else{
                                                            $amount = $amount +  $loan->principal;
                                                        }
                                                    }
                                                    echo number_format($amount, 2);
                                                @endphp
                                                </h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::riskLoan(4)->count() }}</h5>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-gradient" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            
                                            
                                            <div class="w-browser-info">
                                                <h6>Risk 3</h6><h6>₦
                                                @php 
                                                    $amount=0;
                                                    foreach(App\Http\Controllers\DashboardController::riskLoan(5) as $loan){
                                                        if($loan->disbursed_amount != null){
                                                            $amount = $amount + $loan->disbursed_amount;
                                                        } else{
                                                            $amount = $amount +  $loan->principal;
                                                        }
                                                    }
                                                    echo number_format($amount, 2);
                                                @endphp
                                                </h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::riskLoan(5)->count() }}</h5>
                                            </div>

                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    
                                    
                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                        <div class="w-browser-details">
                                            <div class="w-browser-info">
                                                <h6>Exchequer 1</h6><h6>₦
                                                @php 
                                                    $amount=0;
                                                    foreach(App\Http\Controllers\DashboardController::exCheckerOne() as $loan){
                                                        if($loan->disbursed_amount != null){
                                                            $amount = $amount + $loan->disbursed_amount;
                                                        } else{
                                                            $amount = $amount +  $loan->principal;
                                                        }
                                                    }
                                                    echo number_format($amount, 2);
                                                @endphp</h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::exCheckerOne()->count() }}</h5>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                        
                                        
                                        <div class="w-browser-details">
                                            <div class="w-browser-info">
                                                <h6>Exchequer 2</h6> <h6>₦
                                                @php
                                                    $amount=0;
                                                        foreach(App\Http\Controllers\DashboardController::exCheckerTwo() as $loan){
                                                            $set_disburse_Amount = $loan->disbursed_amount ? $loan->disbursed_amount : $loan->principal;
                                                            $total_charge = calPercentageAndDeduction($loan->loan_duration_length, $loan->insurance_charge, $loan->processing_charge, $set_disburse_Amount, 7.5);
                                                            $amount = $amount + ( $set_disburse_Amount - $total_charge);
                                                        }
                                                    echo number_format($amount, 2);
                                                @endphp
                                                </h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::exCheckerTwo()->count() }}</h5>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="browser-list">
                                        <div class="w-icon">
                                            <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                                        </div>
                                       
                                        <div class="w-browser-details">
                                            <div class="w-browser-info">
                                                <h6>Declined Loans</h6> <h6>₦
                                                    @php
                                                        $amount=0;
                                                        foreach(App\Http\Controllers\DashboardController::declineLoan() as $loan){
                                                            if($loan->disbursed_amount != null){
                                                                $amount = $amount + $loan->disbursed_amount;
                                                            } else{
                                                                $amount = $amount +  $loan->principal;
                                                            }
                                                        }
                                                        echo number_format($amount, 2);
                                                    @endphp
                                                </h6>
                                                <h5 class="browser-count">{{ App\Http\Controllers\DashboardController::declineLoan()->count() }}</h5>
                                            </div>
                                            <div class="w-browser-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 100%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>


                    

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                        <div class="widget widget-five">
                            <div class="widget-content">

                                <div class="header">
                                    <div class="header-body">
                                        <h6>Human Resorces</h6>
                                        <p class="meta-date">{{date('d-m-Y')}}</p>
                                    </div>
                                    <div class="task-action">
                                        <div class="dropdown  custom-dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="pendingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="pendingTask">
                                                <a class="dropdown-item" href="{{ route('employee.create') }}">Add Employee</a>
                                                <a class="dropdown-item" href="{{route('employee.index')}}">View Employee</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Commission</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Salary</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-content">
                                    <div class="">                                            
                                        <p class="task-left">
                                        {{number_format(App\Http\Controllers\DashboardController::getTotalOfEmployees())}}</h6>
                                        </p>
                                        <p class="task-completed"><span>Total Number of Staff</span></p>
                                        <!-- <p class="task-hight-priority"><span>3 Task</span> with High priotity</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-card-two">
                            <div class="widget-content">

                                <div class="media">
                                    <!-- <div class="w-img">
                                        <img src="assets/img/g-8.png" alt="avatar">
                                    </div> -->
                                    <div class="media-body">
                                        <h6>Recent Borrowers</h6>
                                        <br><br>
                                        <!-- <p class="meta-date-time">Bronx, NY</p> -->
                                    </div> 
                                </div>

                                <div class="card-bottom-section">
                                    <h5>Total Disbursed ( {{number_format(App\Http\Controllers\DashboardController::getRunningLoan())}} )</h5>
                                    <div class="img-group">
                                     @foreach (App\Http\Controllers\DashboardController::getRecentBorrowers() as $data)
                                        <img alt="avatar" style="width:50px; hieght:50px;" src="{{ asset('customerfiles/profilepicture')}}/{{$data->customer->avatar}}"/>
                                     @endforeach
                                        
                                    </div>
                                    <a href="{{url('customer/view')}}" class="btn">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-chart-three">
                            <div class="widget-heading">
                                <div class="">
                                    <h5 class="">Inflow Graph</h5>
                                </div>

                                <div class="dropdown  custom-dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="uniqueVisitors">
                                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div id="uniqueVisits"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-activity-three">

                            <div class="widget-heading">
                                <h5 class="">Notifications</h5>
                            </div>

                            <div class="widget-content">

                                <div class="mt-container mx-auto">
                                    <div class="timeline-line">
                                        
                                        <div class="item-timeline timeline-new">
                                            <div class="t-dot">
                                                <div class="t-primary"><svg xmlns="# width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                                            </div>
                                            <div class="t-content">
                                                <div class="t-uppercontent">
                                                    <h5>Logs</h5>
                                                    <span class="">08 Oct, 2020</span>
                                                </div>
                                            </div>
                                        </div>
                                                    <div class="badge badge-primary">Loan</div>
                                                    <div class="badge badge-success">HR</div>
                                                    <div class="badge badge-warning">Compliant</div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    
                    

                </div>

            </div>
        <!--  END CONTENT PART  -->
@endsection