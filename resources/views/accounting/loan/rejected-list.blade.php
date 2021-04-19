@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12 layout-top-spacing">
        <h3 class="text-default">Rejected Loan List</h3>
    </div>
    <div class="row layout-top-spacing">
        
        <!--START REQUEST DIV -->
     @forelse ($data as $req)
        <div class="col-md-4 layout-top-spacing">
        @if($req->product['id'] == 3)
            <div class="card component-card_8" style="background-color: #c2d5ff;">
            @elseif($req->product['id'] == 4)
            <div class="card component-card_8" style="border: 1px solid #8dbf42;">
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
                                        <span class="badge badge-info">ID:000-{{$req->id}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body" style="margin-top:-18px;">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                    <h6 class="text-center">{{$req->borrower_id}}</h6>
                                        <h6 class="text-center">{{$req->borrower_id}}</h6>
                                        <p>
                                            <b class="text-info" style="text-transform: uppercase;">
                                                {{$req->customer['first_name']}} 
                                                {{$req->customer['other_name']}} 
                                                {{$req->customer['last_name']}}
                                            </b>
                                            <br>
                                            <b>Product:</b><label class="text-warning">
                                            @if($req->product['id'] == 3)
                                            <span class="badge outline-badge-warning"> {{$req->product['name']}} </span>
                                            @elseif($req->product['id'] == 4)
                                            <span class="badge outline-badge-success"> {{$req->product['name']}} </span>
                                            @else
                                            <span class="badge outline-badge-info"> {{$req->product['name']}} </span>
                                            @endif</label>
                                            <br>
                                            <b>Loan Amount:</b> <label class="text-warning">
                                             ₦{{number_format($req->principal,2)}}</label>
                                            <br>
                                            <b>Branch:</b>  {{$req->branch['state']}} - {{$req->branch['title']}}
                                            <br>
                                            <b>Created By:</b> 
                                                @if ($req->customer_request)
                                                    <span class="badge badge-secondary">Online Request</span>
                                                @else
                                                {{$req->createdBy['first_name']}} {{$req->createdBy['last_name']}}
                                                @endif
                                             
                                            <br>
                                            <b>Created Date:</b>    {{$req->created_at}}
                                        </p>
                                        <div id="iconsAccordion" class="accordion-icons">
                                     <div class="card">
                                            <div class="card-header" id="headingOne3">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionOne{{$req->id}}" aria-expanded="true" aria-controls="iconAccordionOne">
                                                        <div class="accordion-icon"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                                                     <b class="text-danger">Check Rejection Reason</b>  <div class="icons"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                    </div>
                                                </section>
                                            </div>

                                            <div id="iconAccordionOne{{$req->id}}" class="collapse" aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                                <div class="card-body">
                                                  
                                                    
                                                    <div class="row">
            
            
            
   
                                     @foreach(getRejectionMessage($req->id,'Loan rejected back') as $data)
                                          
                                          @if($data->action_id == $req->id)
                                            <div class="col-lg-12">
                                                <div class="jumbotron" style="padding:7px;">
                                                  <p class="mb-5">{{$data->note}}</p>
                                                  <label>Rejected Date: {{ convertDateToStringWithTime($data->created_at)}}</label>
                                                </div>
                                            </div> 
                                           @endif
                                @endforeach
                       
                        
                             </div>
                                                   
                                                </div>
                                            </div>
                                      </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                        <td class="text-center">
                                    <?php $registration_step_status = 'general_info'; ?>
            @if($req->product_id == 4)<!-- Federal product -->
            <a href="{{url('customer/registration/continue/federal',[$req->customer->id,$req->id,$registration_step_status])}}" class="badge badge-success" style="float:right;">Re-Confirm</a>
            @else
            <a href="{{url('customer/registration/continue',[$req->customer->id,$registration_step_status])}}" class="badge badge-success" style="float:right;">Re-Confirm</a>
           @endif                      
                                    </td>
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
                        <p class="text-info">You don't have any rejection request...</p>
                    </div>
            </div>
        </div>
        @endforelse
         
        <!-- END REQUEST DIV -->





    </div>
</div>
@endsection
