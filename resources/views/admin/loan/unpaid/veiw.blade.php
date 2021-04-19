@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <?php $progress = 0; ?>
        <!--START REQUEST DIV -->
         @forelse ($loans as $loan)
            <div class="col-md-4 layout-top-spacing">
            <div class="card component-card_8">
                    <div class="card-body">

                        <div class="progress-order">
                            <div class="progress-order-header">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                      
                                        <span class="badge badge-info">UNPAID LOAN</span>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                    <h6 class="text-center">{{$loan->borrower_id}}</h6>
                                        <p>
                                            <b class="text-info" style="text-transform: uppercase;">
                                                {{$loan->customer['first_name']}} 
                                                {{$loan->customer['other_name']}} 
                                                {{$loan->customer['last_name']}}
                                            </b>
                                            <br>
                                            <b>Product:</b> <label class="text-warning">
                                            {{$loan->product['name']}}</label>
                                            <br>
                                            <b>Approved Amount:</b> <label class="text-warning">
                                             ₦{{number_format($loan->disbursed_amount,2)}}</label>
                                            <br>
                                            <b>Branch:</b>  {{$loan->branch['state']}} - {{$loan->branch['title']}}
                                            <br>
                                            <b>Created By:</b> 
                                                @if ($loan->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                                @else
                                                {{$loan->createdBy['first_name']}} {{$loan->createdBy['last_name']}}
                                                @endif
                                             
                                            <br>
                                            <b>Created Date:</b>    {{$loan->created_at}}
                                            <br>
                                            
                                             @if(is_numeric($loan->confirmation_status))
                                                @if(checkConfirmationProcess($loan->confirmation_stage->privilege, "offer_letter"))
                                                    
                                             <b>Offer Letter:</b>   
                                            @if(checkLetterStatus($loan->id))
    
                                                        @if(checkLetterStatus($loan->id) == "pending")
                                                             <span class="badge badge-danger"> Pending Approval </span>
                                                        @elseif(checkLetterStatus($loan->id) == "active")
                                                             <span class="badge badge-success"> Accepted </span>
                                                        @endif
                                                        
                                                    @else
                                                         <span class="badge badge-dark"> Waiting to send </span>
                                                   @endif
                                                   
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                    <div class="col-md-12 text-right">
                                       
                                        <a href="{{url('loan/loan/showloan-detail',$loan->id)}}" class="badge badge-success" style="float:right;">View Loan</a>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
        @empty
            <div class="col-md-12 layout-top-spacing">
                <div class="card component-card_8">
                        <div class="card-body">
                            <p class="text-info">You don't have any request...</p>
                        </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
