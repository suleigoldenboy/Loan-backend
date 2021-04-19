@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12 layout-top-spacing">
        <h3 class="text-default">Decline Loan List</h3>
    </div>
    <div class="row layout-top-spacing">
        
        <!--START REQUEST DIV -->
         @forelse ($data as $req)
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
                                            <b>Product:</b> <label class="text-warning">
                                            {{$req->product['name']}}</label>
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
                                                        Reason for decline <div class="icons"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                    </div>
                                                </section>
                                            </div>

                                            <div id="iconAccordionOne{{$req->id}}" class="collapse" aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                                <div class="card-body">
                                                    <p class="">
                                                        {{$req->decline_reason}}
                                                    </p> 
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
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                                            <a class="dropdown-item text-info" href="{{url('loan/loan/reactivate/decline',$req->id)}}">Re-Activate Loan</a>
                                                            {{-- <a class="dropdown-item text-warning" href="javascript:void(0);">Edit</a> --}}
                                                        </div>
                                                    </div>
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
                        <p class="text-info">You don't have any request...</p>
                    </div>
            </div>
        </div>
        @endforelse
         
        <!-- END REQUEST DIV -->





    </div>
</div>
@endsection
