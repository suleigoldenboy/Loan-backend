@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
     <h5 class="modal-title text-primary layout-top-spacing">Customer Files Confirmation</h5>
    <div class="row layout-top-spacing">
       
        <?php $progress = 0; ?>
        <!--START REQUEST DIV -->
         @forelse ($data as $req)
         <?php $cus_info = getFullCustomerInfo($req->customer_id); ?>
         @if($cus_info->branch_id == Auth::user()->branch_id)
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
                                      
                                        <span class="badge badge-secondary">IN PROGRESS</span>
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                    <h6 class="text-center">{{$req->borrower_id}}</h6>
                                         <p>
                                           
                                            <b>Name:</b> 
                                             <b class="text-info" style="text-transform: uppercase;">
                                                {{ $cus_info->first_name }}
                                                {{ $cus_info->last_name }}
                                                {{ $cus_info->other_name }}
                                            </b>
                                            <br>
                                            <b>Home Address:</b> 
                                                {{ $cus_info->address }}
                                            <br>
                                            
                                            <b>Place of Work:</b>  <b>{{$req->employers_name}}</b>
                                            <br>

                                            
                                            <!--<b>Office Address:</b> -->
                                               
                                            <br>
                                           
                                        </p>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <a href="{{url('loan/loan/show/to/confirm/files',$req->customer_id)}}" class="badge badge-success" style="float:right;">Confirm</a>
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




    </div>
</div>


@endsection
