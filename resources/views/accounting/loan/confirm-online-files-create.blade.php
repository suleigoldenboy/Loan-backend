@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
     <h5 class="modal-title text-primary layout-top-spacing">File Upload</h5>
    <div class="row layout-top-spacing">
       
        <?php $progress = 0; ?>
        <!--START REQUEST DIV -->
       
         
        <div class="col-md-6 layout-top-spacing">
            <div class="card component-card_8">
                    <div class="card-body">

                        <div class="progress-order">
                            <div class="progress-order-header">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <h6></h6>
                                    </div>
                                    <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                                      
                                    </div>
                                </div>
                            </div>

                            <div class="progress-order-body">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                         <p>
                                           <?php $cus_info = getFullCustomerInfo($data->customer_id); ?>
                                            <b>Customer Name:</b> 
                                             <b class="text-info" style="text-transform: uppercase;">
                                                {{ $cus_info->first_name }}
                                                {{ $cus_info->last_name }}
                                                {{ $cus_info->other_name }}
                                            </b>
                                            <br>
                                            
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        
                                        <form action="{{url('loan/loan/confirm/customer/files')}}" method="POST" id="actionForm"  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <input type="hidden" name="customer_id" value="{{$data->customer_id}}">
                                             <div class="form-group">
                                                                                            <label>Profile Picture</label>
                                                                                            <input type="file" name="avatar" accept="image/*" class="form-control" required>
                                                                                            <?php $cus_info = getFullCustomerInfo($data->customer_id); ?>
                                                                                             @if ($cus_info->avatar)
                                                                                             <input type="hidden" name="old_avatar" value="{{$cus_info->avatar}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                      <img src="{{ asset('customerfiles/profilepicture')}}/{{$cus_info->avatar}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_avatar">
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_avatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="pdf">
                                                                                                                        <object data="pdf_file_name.pdf" type="application/pdf" width="600" height="400">
                                                                                                                             <a class="btn btn-warning" href="{{ asset('customerfiles/profilepicture')}}/{{$cus_info->avatar}}">Click to open file</a>
                                                                                                                        </object>
                                                                                                                    </div>
                                                                                                                    <img src="{{ asset('customerfiles/profilepicture')}}/{{$cus_info->avatar}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        </div>
                                             <div class="form-group">
                                                                                            <label >Bank Statement</label>
                                                                                            <input type="file" name="bank_statement" class="form-control" required>
                                                                                             @if ($data->bank_statement)
                                                                                             <input type="hidden" name="old_bank_statement" value="{{$data->bank_statement}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($data->bank_statement, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_files">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->bank_statement}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_files">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="pdf">
                                                                                                                        <object data="pdf_file_name.pdf" type="application/pdf" width="600" height="400">
                                                                                                                             <a class="btn btn-warning" href="{{ asset('customerfiles/files')}}/{{$data->bank_statement}}">Click to open file</a>
                                                                                                                        </object>
                                                                                                                    </div>
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->bank_statement}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        </div>
                                                                                        @if ($cus_info->avatar && $data->bank_statement)
                                                                                            <button type="submit" class="btn btn-warning">Update File</button>
                                                                                        @else
                                                                                          <button type="submit" class="btn btn-primary">Submit</button>
                                                                                        @endif
                                                                                 </form>
                                                                                
                                                                                 @if ($cus_info->avatar && $data->bank_statement)
                                                                                 
                                      <a href="#" data-toggle="modal" data-target="#zoomuModal-loan-list" class="btn btn-success" style="float:right;">Confirm Files</a>                                            
                                                                                 
                                                                                 
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
                                                         <form action="{{url('loan/loan/confirm/customer/files/final')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                              <input type="hidden" id="customer_id" name="customer_id" value="{{$data->customer_id}}" />
                                                        
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
                                                                                 @endif
                                       
                                        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
         </div>
       
     
        <!-- END REQUEST DIV -->




    </div>
</div>


@endsection
