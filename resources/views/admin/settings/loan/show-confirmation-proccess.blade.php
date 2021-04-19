@extends('layouts.admin-app')
@section('content')
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two" style="padding:15px;">

                            <div class="widget-heading">
                                <h5 class="">Edit Loan Confirmation User</h5>
                            </div>

                            <div class="widget-content">
                                  <form action="{{url('loan/confirmation-process/update')}}" method="POST">
                                {{csrf_field()}}
                                <input type="hidden" name="update_id" value="{{$dataInfo->id}}">
                                    <div class="form-row mb-4">
                                        <div class="col">
                                           Title
                                           <input type="text" name="title" class="form-control  basic" value="{{$dataInfo->title}}" placeholder="Title" readonly required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col">
                                            Employee Name
            <!--<input class="form-control  basic" value="" readonly required>-->
            
               <select name="employee_id" class="form-control  basic" required>
                   <option value="{{$dataInfo->user->id}}">{{$dataInfo->user->first_name}} {{$dataInfo->user->last_name}} {{$dataInfo->user->other_name}}</option>
                                                @foreach ($data as $emp)
                        <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                                                @endforeach
                                            </select> 
            
                                        </div>
                                    <div class="col">
                                            Confirm Proccess 
                                            <input class="form-control  basic" value="{{$dataInfo->process}}" readonly required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row mb-4">
                                        <div class="col">
                                                Description
                                                <textarea name="description" class="form-control" placeholder="Description: example: waiting for Loan Officer Confirmation" required>{{$dataInfo->name}}</textarea>
                                            </div>
                                    </div>
                                    <div class="form-row mb-4">
                                                Privileges
                                                <div class="card-body">
                                                    <div class="checkbox checkbox-aqua">
                                                        @if(strstr($dataInfo->privilege, "offer_letter"))
                                                         <input id="offer_letter" type="checkbox" name="action_type[]" value="offer_letter" checked="true">
                                                        @else
                                                         <input id="offer_letter" type="checkbox" name="action_type[]" value="offer_letter">
                                                        @endif
                                                        <label for="offer_letter">
                                                                Send Offer Letter
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                         @if(strstr($dataInfo->privilege, "Account_Details"))
                                                                <input id="Account_Details" type="checkbox" name="action_type[]" value="Account_Details" checked="true">
                                                         @else
                                                                <input id="Account_Details" type="checkbox" name="action_type[]" value="Account_Details">
                                                         @endif
                                                        
                                                        <label for="Account_Details">
                                                                Account Details 
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                        @if(strstr($dataInfo->privilege, "Files"))
                                                            <input id="Files" type="checkbox" name="action_type[]" value="Files" checked="true">
                                                         @else
                                                            <input id="Files" type="checkbox" name="action_type[]" value="Files">
                                                         @endif
                                                        <label for="Files">
                                                                Files
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                     @if(strstr($dataInfo->privilege, "Guarantors"))
                                                        <input id="Guarantors" type="checkbox" name="action_type[]" value="Guarantors" checked="true">
                                                    @else
                                                        <input id="Guarantors" type="checkbox" name="action_type[]" value="Guarantors">
                                                    @endif
                                                    <label for="Guarantors">
                                                                Guarantors
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "Comments"))
                                                        <input id="Comments" type="checkbox" name="action_type[]" value="Comments" checked="true">
                                                    @else
                                                        <input id="Comments" type="checkbox" name="action_type[]" value="Comments">
                                                    @endif
                                                    <label for="Comments">
                                                                Comments
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "Repayment_Calender"))
                                                        <input id="Repayment_Calender" type="checkbox" name="action_type[]" value="Repayment_Calender" checked="true">
                                                    @else
                                                        <input id="Repayment_Calender" type="checkbox" name="action_type[]" value="Repayment_Calender">
                                                    @endif
                                                    <label for="Repayment_Calender">
                                                                Repayment Calender
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "Audit_Trails"))
                                                        <input id="Audit_Trails" type="checkbox" name="action_type[]" value="Audit_Trails" checked="true">
                                                    @else
                                                        <input id="Audit_Trails" type="checkbox" name="action_type[]" value="Audit_Trails">
                                                    @endif
                                                    <label for="Audit_Trails">
                                                                Audit Trails
                                                        </label>
                                                    </div>

                                                    <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "change_amount"))
                                                        <input id="change_amount" type="checkbox" name="action_type[]" value="change_amount" checked="true">
                                                    @else
                                                        <input id="change_amount" type="checkbox" name="action_type[]" value="change_amount">
                                                    @endif
                                                    <label for="change_amount">
                                                                Change Amount
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "confirm_bvn"))
                                                        <input id="confirm_bvn" type="checkbox" name="action_type[]" value="confirm_bvn" checked="true">
                                                    @else
                                                        <input id="confirm_bvn" type="checkbox" name="action_type[]" value="confirm_bvn">
                                                    @endif
                                                    <label for="confirm_bvn">
                                                                Confirm BVN
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "offer_letter"))
                                                        <input id="offer_letter" type="checkbox" name="action_type[]" value="offer_letter" checked="true">
                                                    @else
                                                        <input id="offer_letter" type="checkbox" name="action_type[]" value="offer_letter">
                                                    @endif
                                                    <label for="offer_letter">
                                                                Offer Letter
                                                    </label>
                                                    </div>
                                                     <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "view_credit_score"))
                                                        <input id="view_credit_score" type="checkbox" name="action_type[]" value="view_credit_score" checked="true">
                                                    @else
                                                        <input id="view_credit_score" type="checkbox" name="action_type[]" value="view_credit_score">
                                                    @endif
                                                    <label for="view_credit_score">
                                                                View Credit Score
                                                        </label>
                                                    </div>
                                                     <div class="checkbox checkbox-aqua">
                                                    @if(strstr($dataInfo->privilege, "upload_credit_score"))
                                                        <input id="upload_credit_score" type="checkbox" name="action_type[]" value="upload_credit_score" checked="true">
                                                    @else
                                                        <input id="upload_credit_score" type="checkbox" name="action_type[]" value="upload_credit_score">
                                                    @endif
                                                    <label for="upload_credit_score">
                                                                Upload Credit Score
                                                        </label>
                                                    </div>
                                                    
                                            </div>
                                            
                                        </div>
                                
                                        <input type="submit" name="time" class="btn btn-primary">
                                
                                
                                </form>
                            </div>
                        </div>
                    </div>
                    
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
  <div>
<div>
@endsection
