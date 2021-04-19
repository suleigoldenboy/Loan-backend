@extends('layouts.admin-app')
@section('content')
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-two" style="padding:15px;">

                            <div class="widget-heading">
                                <h5 class="">Add Loan Confirmation User</h5>
                            </div>

                            <div class="widget-content">
                           
                                  <form action="{{url('loan/store/confirmationproccess')}}" method="POST">
                                {{csrf_field()}}
                          
                                    <div class="form-row mb-4">
                                        <div class="col">
                                           Title
                                           <input type="text" name="title" class="form-control  basic" placeholder="Title" required>
                                        </div>
                                    </div>
                                    <div class="form-row mb-4">
                                        <div class="col">
                                            Select Employee (Multiple Select)
                                            {{-- <select name="employee_id" class="form-control  basic" required>
                                                @foreach ($data as $emp)
                                                    <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                                                @endforeach
                                            </select> --}}
                                            <style>
                                               .bootstrap-select>.dropdown-toggle {
                                                    width: 200%;
                                                    padding-right: 25px;
                                                    z-index: 1;
                                                }
                                            </style>
                                            <br>
                                            <select style="width: 200%;" name="employee_id[]" class="selectpicker" multiple title="Choose Employee" data-live-search="true"  required>
                                               @foreach ($data as $emp)
                                                    @if (!App\Http\Controllers\Loan\LoanConfirmationProcessController::checkIfEmployeeAdded($emp->id))
                                                        <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                     </div>
                                    <div class="form-row mb-4">
                                    <div class="col">
                                            Confirm Proccess
                                            <select name="process" class="form-control" required>
                                                <option value="">Select</option>
                                                @for ($i = 1; $i < 51; $i++)
                                                      
                                                      @if($i < $max+2)
                                                       <option value="{{$i}}">{{$i}} Proccess</option>
                                                      @endif

                                                @endfor
                                            </select>
                                            @if ($errors->has('process'))
                                                <strong class="text-danger">{{ $errors->first('process') }}</strong>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-row mb-4">
                                        <div class="col">
                                                Description
                                                <textarea name="description" class="form-control" placeholder="Description: example: waiting for Loan Officer Confirmation" required></textarea>
                                            </div>
                                    </div>
                                    <div class="form-row mb-4">
                                                Privileges
                                                <div class="card-body">
                                                    <div class="checkbox checkbox-aqua">
                                                        <input id="offer_letter" type="checkbox" name="action_type[]" value="offer_letter" checked="true">
                                                        <label for="offer_letter">
                                                                Send Offer Letter
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                        <input id="Files" type="checkbox" name="action_type[]" value="Files" checked="true">
                                                        <label for="Files">
                                                                Files
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                        <input id="Guarantors" type="checkbox" name="action_type[]" value="Guarantors" checked="true">
                                                        <label for="Guarantors">
                                                                Guarantors
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                        <input id="Comments" type="checkbox" name="action_type[]" value="Comments" checked="true">
                                                        <label for="Comments">
                                                                Comments
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                        <input id="Repayment_Calender" type="checkbox" name="action_type[]" value="Repayment_Calender" checked="true">
                                                        <label for="Repayment_Calender">
                                                                Repayment Calender
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                        <input id="Audit_Trails" type="checkbox" name="action_type[]" value="Audit_Trails" checked="true">
                                                        <label for="Audit_Trails">
                                                                Audit Trails
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                     <input id="change_amount" type="checkbox" name="action_type[]" value="change_amount">
                                                    <label for="change_amount">
                                                                Change Amount
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                     <input id="confirm_bvn" type="checkbox" name="action_type[]" value="confirm_bvn">
                                                    <label for="confirm_bvn">
                                                                Confirm BVN
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                   <input id="offer_letter" type="checkbox" name="action_type[]" value="offer_letter">
                                                    <label for="offer_letter">
                                                                Offer Letter
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                   <input id="view_credit_score" type="checkbox" name="action_type[]" value="view_credit_score">
                                                    <label for="view_credit_score">
                                                               View Credit Score
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-aqua">
                                                   <input id="upload_credit_score" type="checkbox" name="action_type[]" value="upload_credit_score">
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
