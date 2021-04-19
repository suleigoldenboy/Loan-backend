@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        
        <!--START Disburse DIV -->
         
         <div id="tableCheckbox" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Loan Disbursement Payment</h4>
                                             <form action="" method="GET">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>From</label>
                                                            <input type="date" class="form-control mb-4" name="from">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>To</label>
                                                            <input type="date" class="form-control mb-4" name="to">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select class="selectpicker" name="status">
                                                                <option value="">Select Status</option>
                                                                <option data-content="<span class='badge badge-danger'>UnPaid Loan</span>" value="unpaid">UnPaid Loan</option>
                                                                <option data-content="<span class='badge badge-success'>Paid Loan</span>" value="paid">Paid Loan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <br><br>
                                                        <button class="mr-2 btn btn-primary  html">Search</button> 
                                                    </div>
                                                </div>
                                                </form>
                                                
                                                @if(Request::Get('from') || Request::Get('to'))
                                                    <h4 class="text-info">Search result from {{convertDateToString(Request::Get('from'))}} to {{convertDateToString(Request::Get('to'))}}</h4>
                                                @endif
                                        </div>                       
                                    </div>
                                </div>
                        <form method="POST" action="{{ URL('loan/loan/disburse/all/payment') }}" id="form_sample_1" class="form-horizontal"  enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        
                        <div class="widget-content widget-content-area br-6">
                                            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="checkbox-column">
                                                        <label class="new-control new-checkbox checkbox-danger" style="height: 18px; margin: 0 auto;" title="Check All">
                                                            <input type="checkbox" onClick="resetDisbursementAmount()" class="new-control-input todochkbox" id="todoAll" checked="true">
                                                            <span class="new-control-indicator"></span>
                                                        </label>
                                                    </th>
                                                    <th width="200"><b>Name</b></th>
                                                    <th width="200"><b>Bank</b></th>
                                                    <th width="200"><b>Account No</b></th> 
                                                    <th width="200"><b>Disbursed Amount</b></th>
                                                    <th width="200"><b>Narration</b></th>
                                             @if(Request::get('status'))
                                            <th class="">Disburse Date</th>
                                            @endif
                                                    <th width="200"><b>Paid By</b></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php 
                                                    $total_Applied_Amount =0;
                                                    $total_Approve_Amount =0;
                                                    $total_Disburse_Amount =0;
                                                    $_Disburse_Amount = 0;
                                                 ?>
                                                @foreach ($result as $data)
                                                <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                 <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                            <?php 
                                                                //$l_maturity_date = caLoanMaturityDate(date('Y-m-d'),$data->loan_duration,$data->loan_duration_length);
                                                                $_amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
                                                                $disburseVal = array('id' => $data->id,'amount' => $_amount); 
                                                                $disburse_value =  json_encode($disburseVal);
                                                                
                                                                $set_disburse_Amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
                                    $total_charge = calPercentageAndDeduction($data->loan_duration_length,$data->insurance_charge,$data->processing_charge,$set_disburse_Amount,7.5);
                                                                $_Disburse_Amount = $set_disburse_Amount-$total_charge;
                                                             ?>
                                                             <input type="checkbox" name="loan_disburse[]" id="account_disburse_{{$data->id}}" value="{{$disburse_value}}" onClick="calDisburseAmount({{$data->id}},{{$data->principal}},{{$data->disbursed_amount ? $data->disbursed_amount : $data->principal}},{{$_Disburse_Amount}})"  class="new-control-input todochkbox" checked="true">
                                                            <span class="new-control-indicator"></span>
                                                        </label>
                                                </td>
                                                <td style="text-align:left;">{{$data->customer->first_name}} {{$data->customer->other_name}}{{$data->customer->last_name}}
                                                </td>
                                                <td width="300" style="text-align:left;">{{$data->customer->employment->salary_bank_name}}</td>
                                                <td style="text-align:left;"><label style="font-size:8px; color:#FFF;">'</label>
                                                    {{$data->customer->employment->salary_account_number}}</td>
                                                {{-- <td>{{$data->customer->employment->salary_account_name}}</td> --}}
                                                {{-- <td>{{$data->release_date}}</td> --}}
                                                <td style="text-align:left;">
                                                    ₦{{number_format($_Disburse_Amount,2)}}</td>
                                                <td width="200"><b>Facility</b></td>
                                                @if(Request::get('status'))
                                                 <td>
                                                    <b class="text-danger" id="text_maturity_date">
                                                    {{$data->release_date}}
                                                    </b>
                                                    </td>
                                                @endif
                                                <td width="200" style="text-align:left;">
                                                    @if ($data->loan_disbursed_payment_by)
{{$data->loan_disbursed_payment_by->first_name}} {{$data->loan_disbursed_payment_by->last_name}}
                                                    @endif
                                                </td>
                                                <td class="text-center" style="text-align:center;">
                                               
                                                  @if ($data->status_paid == "paid" || Request::get('status') == "paid")
                                                      
                                                  <span class="badge badge-success">Paid</span>
                                                  @else
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                                            {{-- <a class="dropdown-item text-info" href="#">Disburse <svg xmlns="#g" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 text-success"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a> --}}
                                                             <a class="dropdown-item text-info" href="{{url('loan/loan/show-request',$data->id)}}">view Account</a>
                                                            <a class="dropdown-item text-danger" onClick="setPayId({{$data->id}})"  data-toggle="modal" data-target="#payLoanModal">Pay</a>
                                                            <a class="dropdown-item text-warning" onClick="setRejectId({{$data->id}})"  data-toggle="modal" data-target="#rejectLoanModal">Reject</a>
                                                        </div>
                                                    </div>
                                                 @endif
                                                </td>
                                                <?php 
                                                    $total_Applied_Amount += $data->principal;
                                                    $total_Approve_Amount += $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
                                                    $total_Disburse_Amount += $_Disburse_Amount;//$data->disbursed_amount ? $data->disbursed_amount : $data->principal;
                                                    //$insurance = calPercentage($data->insurance_charge,$total_Disburse_Amount);
                                                    //$processing = calPercentage($data->processing_charge,$total_Disburse_Amount);
                                                    //$total_charge = $insurance + $processing;
                                                    //$total_Disburse_Amount = $total_Disburse_Amount - $total_charge;
                                                 ?>
                                                </tr>
                                            @endforeach
                                             
                                            </tbody>
                                            <tr>
                                                
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    {{-- <h4>₦<b id="text_total_appied_amount">{{number_format($total_Applied_Amount,2)}}</b></h4> --}}
                                                    <input type="hidden" id="default_total_appied_amount" value="0">
                                                    <input type="hidden" id="reset_default_total_appied_amount" value="{{$total_Applied_Amount}}">
                                                
                                                </td>
                                                <td>
                                                <h4><b>TOTAL</b></h4>
                                                    {{-- <h4>₦<b id="text_total_approved_amount">{{number_format($total_Approve_Amount,2)}}</b></h4> --}}
                                                    <input type="hidden" id="default_total_approved_amount" value="0">
                                                    <input type="hidden" id="reset_default_total_approved_amount" value="{{$total_Approve_Amount}}">
                                                </td>
                                                <td>
                                                <h4>₦<b id="text_total_disburse_amount">{{number_format($total_Disburse_Amount,2)}}</b></h4>
                                                    {{-- <h4>₦<b id="text_total_disburse_amount">{{number_format($total_Disburse_Amount,2)}}</b></h4> --}}
                                                    <input type="hidden" id="default_total_disburse_amount" value="0">
                                                    <input type="hidden" id="reset_default_total_disburse_amount" value="{{$total_Disburse_Amount}}">
                                                </td>
                                                <td></td>
                                                <td></td>
                                             </tr>
                                        </table>
                                
                            </div>
                                    
                                    <div class="col-lg-12 text-align-right">
                                        @if(count($result) > 0)
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#submitModalBtn">Submit</a>
                                        @else
                                         <b class="text-info">No record found......</b>
                                        @endif
                                    </div>


                                    <!-- submit modal -->
<div id="submitModalBtn" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    </div>
                                                    <div class="modal-body">
                                                         <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="padding: 2em; display: flex;">
                                                            <div class="swal2-header">
                                                                <ul class="swal2-progresssteps" style="display: none;">
                                                                    </ul>
                                                                        <div class="swal2-icon swal2-error" style="display: none;">
                                                                            <span class="swal2-x-mark">
                                                                                <span class="swal2-x-mark-line-left">
                                                                            </span>
                                                                            <span class="swal2-x-mark-line-right"></span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-question" style="display: none;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                            <span class="swal2-icon-text">!</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-info" style="display: none;">
                                                                            <span class="swal2-icon-text">i</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-success" style="display: none;">
                                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                                                            </div><span class="swal2-success-line-tip"></span> 
                                                                            <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div>
                                                                             <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div> 
                                                                    <img class="swal2-image" style="display: none;">
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!
                                                                    <div class="row">
                                                                        {{-- <select name="bank" class="form-control" required>
                                                                            <option value="">Select Bank</option>
                                                                        @foreach ($accounts  as $bank)
                                                                             @foreach ($bank->children as $child)
                                                                                <option value="{{$child->id}}">{{$child->name}}</option>
                                                                            @endforeach
                                                                        @endforeach
                                                                     </select> --}}
                                                                     </div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                     
                                                                     </div>
                                                                    <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                    
                                                                    <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes, submit!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                    
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End submit modal -->


                                    </form>

                                   
                                </div>
                            </div>
                        </div>
         
        <!-- END Disburse DIV -->


<!-- Reject loan modal -->
<div id="payLoanModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    </div>
                                                    <div class="modal-body">
                                                         <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="padding: 2em; display: flex;">
                                                            <div class="swal2-header">
                                                                <ul class="swal2-progresssteps" style="display: none;">
                                                                    </ul>
                                                                        <div class="swal2-icon swal2-error" style="display: none;">
                                                                            <span class="swal2-x-mark">
                                                                                <span class="swal2-x-mark-line-left">
                                                                            </span>
                                                                            <span class="swal2-x-mark-line-right"></span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-question" style="display: none;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-info" style="display: none;">
                                                                            <span class="swal2-icon-text">i</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-success" style="display: none;">
                                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                                                            </div><span class="swal2-success-line-tip"></span> 
                                                                            <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div>
                                                                             <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div>
                                                                    <img class="swal2-image" style="display: none;">
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure you want confirm this payment ?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    
                                                                     <form action="{{url('loan/loan/disburse/single/payment')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" id="set_pay_loan_disburse_id"  name="loan_id" value="">
                                                                        <input type="hidden" name="disburse_reject" value="">
                                                                        <div class="form-row mb-12">
                                                                            {{-- <div class="col">
                                                                               Reason For Rejection
                                                                                <textarea name="reason" class="form-control" placeholder="Reason for rejection" required></textarea>
                                                                            </div> --}}
                                                                        </div>
                                                                        <br>
                                                                         <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                   
                                                                        <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes, Pay!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Reject loan modal -->

    </div>
</div>


<!-- Reject loan modal -->
<div id="rejectLoanModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    </div>
                                                    <div class="modal-body">
                                                         <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="padding: 2em; display: flex;">
                                                            <div class="swal2-header">
                                                                <ul class="swal2-progresssteps" style="display: none;">
                                                                    </ul>
                                                                        <div class="swal2-icon swal2-error" style="display: none;">
                                                                            <span class="swal2-x-mark">
                                                                                <span class="swal2-x-mark-line-left">
                                                                            </span>
                                                                            <span class="swal2-x-mark-line-right"></span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-question" style="display: none;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-info" style="display: none;">
                                                                            <span class="swal2-icon-text">i</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-success" style="display: none;">
                                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                                                            </div><span class="swal2-success-line-tip"></span> 
                                                                            <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div>
                                                                             <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div>
                                                                    <img class="swal2-image" style="display: none;">
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure you want to reject this loan disbursement?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    
                                                                     <form action="{{url('loan/loan/reject/disbursement')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" id="set_reject_loan_disburse_id"  name="loan_id" value="">
                                                                        <input type="hidden" name="disburse_reject" value="">
                                                                        <div class="form-row mb-12">
                                                                            <div class="col">
                                                                               Reason For Rejection
                                                                                <textarea name="reason" class="form-control" placeholder="Reason for rejection" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                         <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                   
                                                                        <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes, Reject!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Reject loan modal -->

    </div>
</div>

<script>
function setPayId(id){
     $("#set_pay_loan_disburse_id").val(id)
    
}
function setRejectId(id){
     $("#set_reject_loan_disburse_id").val(id)
    
}
function calDisburseAmount(id,applied_amt,approve_amt,disbursed_amt){
    
  //console.log(':: '+id+' Appliad: '+applied_amt+' Approve: '+approve_amt+' Disburse: '+disbursed_amt);
  
  const add_default_total_applied = parseFloat($("#default_total_appied_amount").val());
  const add_default_total_approved = parseFloat($("#default_total_approved_amount").val());
  const add_default_total_disburse = parseFloat($("#default_total_disburse_amount").val());
  
  const default_total_applied = parseFloat($("#reset_default_total_appied_amount").val());
  const default_total_approved = parseFloat($("#reset_default_total_approved_amount").val());
  const default_total_disburse = parseFloat($("#reset_default_total_disburse_amount").val());
  
  let total_applied = 0;
  let total_approve = 0;
  let total_disburse = 0;
  
 
  if (document.getElementById('account_disburse_'+id).checked) {

     total_applied = applied_amt + add_default_total_applied;
     total_approve = approve_amt + add_default_total_approved;
     total_disburse = disbursed_amt + add_default_total_disburse;

 }else{

     if(add_default_total_applied > 0){
         total_applied = add_default_total_applied - applied_amt;
     }else{
         total_applied = default_total_applied - applied_amt;
     }
     if(add_default_total_approved > 0){
         total_approve = add_default_total_approved - approve_amt;
     }else{
         total_approve = default_total_approved - approve_amt;
     }
      if(add_default_total_disburse > 0){
          total_disburse = add_default_total_disburse - disbursed_amt;
     }else{
         total_disburse = default_total_disburse - disbursed_amt;
     }
     
     
     
  }
 
   $("#text_total_appied_amount").html(putComma(total_applied));
   $("#text_total_approved_amount").html(putComma(total_approve));
   $("#text_total_disburse_amount").html(putComma(total_disburse));
   $("#default_total_appied_amount").val(total_applied);
   $("#default_total_approved_amount").val(total_approve);
   $("#default_total_disburse_amount").val(total_disburse);
}

function resetDisbursementAmount(){
    
  const default_total_applied = parseFloat($("#reset_default_total_appied_amount").val());
  const default_total_approved = parseFloat($("#reset_default_total_approved_amount").val());
  const default_total_disburse = parseFloat($("#reset_default_total_disburse_amount").val());
  let total_applied = 0, total_approve = 0, total_disburse = 0;
  
  
  if (document.getElementById('todoAll').checked) {
        
        total_applied = default_total_applied;
        total_approve = default_total_approved;
        total_disburse = default_total_disburse;

  }else{

     total_applied = 0;
     total_approve = 0;
     total_disburse = 0;
     $("#default_total_appied_amount").val(0);
     $("#default_total_approved_amount").val(0);
     $("#default_total_disburse_amount").val(0);

  }

   $("#text_total_appied_amount").html(putComma(total_applied));
   $("#text_total_approved_amount").html(putComma(total_approve));
   $("#text_total_disburse_amount").html(putComma(total_disburse));

}
function putComma(x) {
    //convert to two decimals
    x = x.toFixed(2);
    //put comma
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
</script>
@endsection
