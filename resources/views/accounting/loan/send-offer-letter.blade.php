@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">

   
    <div class="col-xl-12 col-md-12 col-sm-12 col-12 layout-top-spacing">
                <h3 class="text-info"  style="text-align: center;">Send Offer Letter</h3>
    </div>
    <div class="row layout-top-spacing">
        <?php $progress = 0; ?>
        <!--START REQUEST DIV -->
         @forelse ($data as $req)
         
        @if($req->status !="approve" && $req->status !="active" || $req->customer->registration_step_status =="complete") 
        <div class="col-md-4 layout-top-spacing">
            @if($req->product['id'] == 3)
            <div class="card component-card_8" style="background-color: #c2d5ff;">
                            @else
                           <div class="card component-card_8">
                            @endif
            
                    <div class="card-body">
                        
                        <div class="progress-order">
                            <div class="progress-order-header">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                      
                                        <span class="badge badge-info">IN PROGRESS</span>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                    <h6 class="text-center">{{$req->borrower_id}}</h6>
                                        <p>
                                            <b class="text-info" style="text-transform: uppercase;">
                                                {{$req->customer['first_name']}} 
                                                {{$req->customer['other_name']}} 
                                                {{$req->customer['last_name']}}
                                            </b>
                                            <br>
                                            <b>Product:</b> <label class="text-warning">
                                            {{$req->product['name']}}</label>
                                            <br>
                                            <b>@if(request()->id > 3 ) Approve @else Loan @endif Amount:</b> <label class="text-warning">
                                                @if(request()->id > 3 ) @if($req->disbursed_amount != null )  ₦{{number_format($req->disbursed_amount,2)}} @else ₦{{number_format($req->principal,2)}} @endif @else  ₦{{number_format($req->principal,2)}} @endif  
                                             </label>
                                            <br>
                                            <b>Branch:</b>  {{$req->branch['state']}} - {{$req->branch['title']}}
                                            <br>
                                            <b>Created By:</b> 
                                                @if ($req->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                                @elseif($req->product['id'] == 3)
                                                     {{$req->customer['first_name']}} 
                                                     {{$req->customer['other_name']}} 
                                                     {{$req->customer['last_name']}}
                                                @else
                                                {{$req->createdBy['first_name']}} {{$req->createdBy['last_name']}}
                                                @endif
                                             
                                            <br>
                                            <b>Created Date:</b>    {{$req->created_at}}
                                            <br>
                                            
                                             @if(is_numeric($req->confirmation_status))
                                                @if(checkConfirmationProcess($req->confirmation_stage->privilege, "offer_letter"))
                                                    
                                             <b>Waiting to Send</b>   
                                            @if(checkLetterStatus($req->id))
    
                                                        @if(checkLetterStatus($req->id) == "pending")
                                                             <span class="badge badge-danger"> Pending Approval </span>
                                                        @elseif(checkLetterStatus($req->id) == "active")
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
                                        @if ($req->customer_request)
                                               

                                            @if($req->confirmation_status == 2)
                                                <div  class="btn btn-outline-dark mb-2">
                                                    
                                                     @if($req->customer->employment->online_address_confirm_status == 1)
                                                      <a href="#" class="badge badge-dark" data-toggle="modal" data-target="#zoomuModal-loan-list" style="font-size:11px;">Confirm Address</a>
                                                     @else
                                                         @if($req->customer->employment->online_address_confirm_status == "confirmed")
                                                          <span class="text-success">Address Confirmed</span>
                                                         @else
                                                            <a href="{{url('loan/loan/online/confirmaddress',$req->customer_id)}}" class="badge badge-danger">Confirm Address</a>
                                                        @endif
                                                     @endif
                                                      @if($req->customer->employment->online_file_confirm_status == 1)
                                                        <a href="#" class="badge badge-dark" data-toggle="modal" data-target="#zoomuModal-loan-list" style="font-size:11px;">Confirm Files</a>
                                                     @else
                                                         @if($req->customer->employment->online_file_confirm_status == "confirmed")
                                                             <span class="text-success">Files Confirmed</span>
                                                         @else
                                                            <a style="margin-left:7px;" href="{{url('loan/loan/online/confirmfiles',$req->customer_id)}}" class="badge badge-danger">Confirm Files</a>
                                                         @endif
                                                     @endif
                                                </div>
                                            @else
                                               
                                                 <a href="{{url('loan/loan/show-request',$req->id)}}" class="badge badge-success" style="float:right;">Confirm</a>

                                            @endif
                                            
                                            @if($req->customer->employment->online_address_confirm_status == "confirmed" && $req->customer->employment->online_file_confirm_status == "confirmed")
                                                <a href="{{url('loan/loan/show-request',$req->id)}}" class="badge badge-success" style="float:right;">Confirm</a>
                                            @endif
                                            
                                        @else
                                               
                                        <a href="{{url('loan/loan/show-request',$req->id)}}" class="badge badge-success" style="float:right;">Confirm</a>

                                         @endif
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
         @endif
         
        @empty
        <div class="col-md-12 layout-top-spacing">
            <div class="card component-card_8">
                    <div class="card-body">
                        <p class="text-info">You don't have any request...</p>
                    </div>
            </div>
        </div>
        @endforelse
        <!-- END REQUEST DIV -->


  <!-- Start Loan List -->  

                    <div id="zoomuModal-loan-list" class="modal animated zoomInUp custo-zoomInUp" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <h2 class="text-info">Waiting for confirmation</h2>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                        {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    <!-- End Loan List -->   



    </div>
</div>
@endsection
