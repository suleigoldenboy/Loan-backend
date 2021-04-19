@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three">
                             <div class="heading-elements text-align-right">
                                <a href="#" data-toggle="modal" data-target="#create-newModal"
                                class="btn btn-info btn-sm">Create New Signature</a>
                            </div>
                            <div class="widget-heading">
                                <h5 class=""></h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="multi-column-ordering_info">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">Name</div></th>
                                                <th><div class="th-content th-heading">Sign</div></th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @foreach ($data as $sign)
                                             <tr>
                                                <td><b>{{strtoupper($sign->name)}}</b></td>
                                                <td>
                                                    <img src="{{ asset('staff/staffsign')}}/{{$sign->sign}}" title="view image" style="width:120px; hieght:120px;">
                                                </td>
                                                <td class="text-center">
                        <a href="#" data-toggle="modal" data-target="#update-newModal_{{$sign->id}}" class="badge badge-primary"> Update </a>
                                                </td>
                         
                                            </tr>
                                            
                                               
<!--  make modal-->
<div class="modal fade" id="update-newModal_{{$sign->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Update {{strtoupper($sign->name)}} Signature</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/update/signature')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                 {{csrf_field()}}
                
                 <div class="form-group col-md-10">
                    <label class="text-info">Name</label>
                    <input class="form-control" name="name" value="{{strtoupper($sign->name)}}" readonly required>
                     <input type="hidden" name="id" value="{{$sign->id}}" required>
                     <input type="hidden" name="old_sign" value="{{$sign->sign}}" required>
                </div>
                <div class="form-row mb-4" >
                    <div class="col">
                        <b>Signature</b>
                         <input type="file" name="sign" class="form-control" required>
                    </div>
                </div>
                <input type="submit" name="time" class="btn btn-primary">

            </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                
            </div>
        </div>
    </div>
</div>

<!-- End modal-->
 @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
  <div>
<div>
    
    
<!--  make modal-->
<div class="modal fade" id="create-newModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Create New Signature</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/store/signature')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                 {{csrf_field()}}
                
                 <div class="form-group col-md-10">
                    <label class="text-info">Name</label>
                    <select class="form-control" name="name" required>
                        <option value="">Select</option>
                        <option value="account_officer">Account Officer</option>
                        <option value="complaince_officer">Complaince Officer</option>
                        <option value="head_of_loan">Head Of Loan</option>
                        <option value="md">MD</option>
                    </select>
                </div>
                <div class="form-row mb-4" >
                    <div class="col">
                        <b>Signature</b>
                         <input type="file" name="sign" class="form-control" required>
                    </div>
                </div>
                <input type="submit" name="time" class="btn btn-primary">

            </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                
            </div>
        </div>
    </div>
</div>

<!-- End modal-->
@endsection
