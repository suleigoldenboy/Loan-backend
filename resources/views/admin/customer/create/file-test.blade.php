@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/file')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 @if (session()->get('customer_registration_id'))
                                    <input type="hidden" name="customer_id" value="{{session()->get('customer_registration_id')}}">
                                 @endif
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                
                                   <!-- Start Files Information-->
                             <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Files Upload</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                         <div id="fuMultipleFile" class="col-lg-12 layout-spacing">
                                                                            <div class="statbox widget box box-shadow">
                                                                               
                                                                                   <div class="row" style="padding-left:27px;">
                                                                                         <div class="form-group">
                                                                                            <label >ID Card<b class="text-danger" style="font-size:22px;">*</b></label>
                 @if ($employment->id_card)
                  <input type="file" name="id_card" id="id_card" class="form-control-file" onChange="check_if_all_files_uploaded()">
                 @else
                  <input type="file" name="id_card" id="id_card" class="form-control-file" onChange="check_if_all_files_uploaded()" required>
                 @endif
                
               
                                                                                             @if ($employment->id_card)
                 <input type="hidden" name="old_id_card" id="old_id_card" value="{{$employment->id_card}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->id_card, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_id_card">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->id_card}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_id_card">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_id_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->id_card}}" class="img-responsive" style="width:100%;">
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
                                                                                            <label >Bank Statement<b class="text-danger" style="font-size:22px;">*</b></label>
                                                                            
                @if ($employment->bank_statement)
                    <input type="file" name="bank_statement" id="bank_statement" class="form-control-file" onChange="check_if_all_files_uploaded()">
                @else
                    <input type="file" name="bank_statement" id="bank_statement" class="form-control-file" onChange="check_if_all_files_uploaded()" required>
                @endif
                
                                    @if ($employment->bank_statement)
                                                                                             <input type="hidden" name="old_bank_statement" id="old_bank_statement" value="{{$employment->bank_statement}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($employment->bank_statement, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_files">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->bank_statement}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_files">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="pdf">
                                                                                                                        <object data="pdf_file_name.pdf" type="application/pdf" width="600" height="400">
                                                                                                                             <a class="btn btn-warning" href="{{ asset('customerfiles/files')}}/{{$employment->bank_statement}}">Click to open file</a>
                                                                                                                        </object>
                                                                                                                    </div>
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->bank_statement}}" class="img-responsive" style="width:100%;">
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
                                                                                            <label >Utility bill<b class="text-danger" style="font-size:22px;">*</b></label>
                            
                            @if ($employment->utility_bill)
                            <input type="file" name="utility_bill" id="utility_bill" class="form-control-file" onChange="check_if_all_files_uploaded()">
                            @else
                            <input type="file" name="utility_bill" id="utility_bill" class="form-control-file" onChange="check_if_all_files_uploaded()" required>
                            @endif
                            
                                                                                             @if ($employment->utility_bill)
                                                                                             <input type="hidden" name="old_utility_bill" id="old_utility_bill" value="{{$employment->utility_bill}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->utility_bill, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_utility_bill">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->utility_bill}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_utility_bill">
                                                                                                    @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_utility_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->utility_bill}}" class="img-responsive" style="width:100%;">
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
                                    <label >Signature<b class="text-danger" style="font-size:22px;">* <labe style="font-size:14px;">Upload Image file only.</label></b></label>
                                        @if ($employment->sign)
                                            <input type="file" name="sign" id="sign" accept="image/*"  class="form-control-file" onChange="check_if_all_files_uploaded()">
                                        @else
                                        <input type="file" name="sign" id="sign" accept="image/*"  class="form-control-file" onChange="check_if_all_files_uploaded()" required>
                                        @endif
                                        
                                                                                             @if ($employment->sign)
                                                                                             <input type="hidden" name="old_sign" id="old_sign" value="{{$employment->sign}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->sign, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_sign">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->sign}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_sign">
                                                                                                    @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_cheque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->sign}}" class="img-responsive" style="width:100%;">
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
                                                                                            <label >Cheque</label>
                                                                                            <input type="file" name="cheque" class="form-control-file">
                                                                                             @if ($employment->cheque)
                                                                                             <input type="hidden" name="old_cheque" value="{{$employment->cheque}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($employment->cheque, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_cheque">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->cheque}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_cheque">
                                                                                                    @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_cheque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->cheque}}" class="img-responsive" style="width:100%;">
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
                                                                                            <label >Others</label>
                                                                                            <input type="file" name="other_files" class="form-control-file">
                                                                                                @if ($employment->other_files)
                                                                                                <input type="hidden" name="old_other_files" value="{{$employment->other_files}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($employment->other_files, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_other_files">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->other_files}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_other_files">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_other_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->other_files}}" class="img-responsive" style="width:100%;">
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
                                                                                   </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!-- End Files Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                 <a href="{{ url('customer/create/loan') }}" class="mr-2 btn btn-primary  html">Previous</a> 
                                 {{-- <button class="mr-2 btn btn-primary  html" style="float:right;">Next</button> --}}
                                 
                                 <label id="error_submit_btn" class="text-danger"> 
                                  PLease Select ID Card, Bank Statement, Utility bil and Signature
                                 </label>
                                 <label id="submit_btn" style="float:right; display:none;">
                                    @include('inc.submit-btn-warning') 
                                </label>
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');

 
 function check_if_all_files_uploaded(){
    const id_card = $("#id_card").val();
    const old_id_card = $("#old_id_card").val();
    const bank_statement = $("#bank_statement").val();
    const old_bank_statement = $("#old_bank_statement").val();
    const utility_bill = $("#utility_bill").val();
    const old_utility_bill = $("#old_utility_bill").val();
    const sign = $("#sign").val();
    const old_sign = $("#old_sign").val();

    const set_id_card = id_card ? id_card: old_id_card;
    const set_bank_statement = bank_statement ? bank_statement: old_bank_statement;
    const set_utility_bill = utility_bill ? utility_bill: old_utility_bill;
    const set_sign = sign ? sign: old_sign;

    if(set_id_card && set_bank_statement && set_utility_bill && set_sign){
        $("#submit_btn").show();
        $("#error_submit_btn").hide();
    }else{
        $("#error_submit_btn").show();
    }

 }
 check_if_all_files_uploaded();
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
