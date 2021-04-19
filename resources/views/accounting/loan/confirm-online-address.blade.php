@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
      <h5 class="modal-title text-primary layout-top-spacing">Customer Address Confirmation</h5>
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
                                           <?php $cus_info = getFullCustomerInfo($req->customer_id); ?>
                                            <b>Name:</b> 
                                             <b class="text-info" style="text-transform: uppercase;">
                                                {{ $cus_info->first_name }}
                                                {{ $cus_info->last_name }}
                                                {{ $cus_info->other_name }}
                                            </b>
                                            <br>
                                            <b>Branch:</b>  {{$cus_info->branch['state']}} - {{$cus_info->branch['title']}}
                                            <br>
                                            <b>Phone Number:</b> 
                                                {{ $cus_info->phone_number }}
                                            <br>
                                            <b>Home Address:</b> 
                                                {{ $cus_info->address }}
                                            <br>
                                            
                                            <b>Place of Work:</b>  <b>{{$req->employers_name}}</b>
                                            <br>

                                            <input type="hidden" id="{{$req->id}}get_home_img" value="{{$req->address_picture}}" />
                                            <!--<b>Office Address:</b> -->
                                              
                                            <br>
                                           
                                        </p>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <a href="#" onClick="setActionID({{$req->customer_id}})" data-toggle="modal" data-target="#zoomuModal-loan-list" class="badge badge-success" style="float:right;">Confirm</a>
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


  <!-- Start modal -->  

                    <div id="zoomuModal-loan-list" class="modal animated zoomInUp custo-zoomInUp" role="dialog">
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
                                                          <h4 class="text-danger">Are you sure you want to confirm?</h4>
                                                         <form action="{{url('loan/loan/confirm/customer/address')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                                                        {{csrf_field()}}
                                                              <input type="hidden" id="customer_id" name="customer_id" value="" />
                                                              <br>
                                                              <label>Upload Address Picture</label><br>
                                                               <input type="file" id="home_img" name="home_img" required/>
                                                               <input type="hidden" id="old_home_img" name="old_home_img" value="" />
                                                               <br> 
                                                               <label>Other Address Picture</label><br>
                                                               <input type="file" id="home_img_2" name="home_img_2"/>
                                                               <br>
                                                              <label>Comment</label>
                                                              <textarea class="form-control" name="address_comment" placeholder="Comment" required></textarea>
                                                        
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                        <button type="submit" class="btn btn-success">Yes Confirm</button>
                                                    </div>
                                                      </form>
                                                </div>
                                            </div>
                                        </div>
                    <!-- End modal -->   



    </div>
</div>

<script> 
    function setActionID(id){
        document.getElementById('customer_id').value = id;
        document.getElementById('old_home_img').value = document.getElementById(id+'get_home_img').value;
    }
   
</script>
@endsection
