
<!-- Change amount modal -->
<div id="changeAmounttFormModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>CHANGE APPLIED AMOUNT</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                         <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="padding: 2em; display: flex;">
                                                            <div class="swal2-header" style="margin-top:-50px; padding-bottom:-2px;">
                                                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <b class="text-warning">Are you sure you want to change the principal amount?</b>
                                                                        <div class="swal2-icon swal2-success" style="display: none;">
                                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                                                            </div><span class="swal2-success-line-tip"></span> 
                                                                            <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div>
                                                                             <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div>
                                                                    <img class="swal2-image" style="display: none;">
                                                                    
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;"></div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    
                                                                     <form action="{{url('loan/loan/changeprincipalamount')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}} 
                                                                        <input type="hidden" name="loan_id" value="{{$data->id}}">
                                                                           <div class="form-row mb-12"  style="text-align:left;">
                                                                           
                                                                            <div class="form-group col-md-10">
                                                                              <input type="hidden" id="maturity_date" name="maturity_date" >
                                                                              <br>
                                                                              Applied Amount: ₦{{number_format($data->principal,2)}}
                                                                            </div>
                                                                             <div class="form-group col-md-10">  
                                                                                 <label class="text-danger">Approve Amount</label>
                                                                                  <input type="number" id="change_principal" name="disbursed_amount" value="{{$data->principal}}" onkeyup="calMaxLoanOffer2()" class="form-control" placeholder="Disbursed Amount" required>
                                                                                   <label id="max_loan_msg" class="text-danger"></label>
                                                                                   <input type="hidden" id="net_pay" value="{{$data->customer->employment->monthly_net_pay}}">
                                                                                    <input type="hidden" id="max_l_amount" value="{{$data->customer->employment->monthly_net_pay}}">
                                                                                    <input type="hidden" id="loan_duration" value="{{$data->loan_duration_length}}">
                                                                                     <input type="hidden" id="validate_max" value="{{$data->product->maximum_principal}}" />
                                                                                     <input type="hidden" id="validate_min" value="{{$data->product->minimum_principal}}" />
                                                                                      <input type="hidden" id="principal_max" value="{{$data->principal}}" />
                                                                             </div>
                                                                        </div>
                                                                        <br>
                                                                         <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                   
                                                                        <button type="submit" id="change_amt_btn" class="swal2-confirm btn btn-success" aria-label="">Yes, Change!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Change amount modal -->





<!-- Customer Credit Score modal -->
<div id="customerCreditScoreModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Customer Credit Score</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                         
                                                                  
                                    <div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div
                                    ><div class="swal2-actions" style="display: flex; padding:70px;">
                                                                    
                                    <form action="{{url('loan/loan/customer_credit_score')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                                                        {{csrf_field()}} 
                                    <input type="hidden" name="loan_id" value="{{$data->id}}">
                                             <div class="form-row mb-12"  style="text-align:left;">
                                                                           
                                        <div class="form-group col-md-10">
                                                                              
                                                        </div>
<a href="{{url('loan/loan/show/customer-credit-score',$data->customer_credit_score)}}"  class="badge outline-badge-info" target="_blank">View</a>
                                        
                                                                             <div class="form-group col-md-10">  
                                                        <label class="text-danger">Select File</label>
                        
                                           <input type="file" name="customer_credit_score" class="form-control" required>
                                           
                                                                                
        <input type="hidden" name="loan_id" value="{{$data->id}}" />
    <input type="hidden" name="old_customer_credit_score" value="{{$data->customer_credit_score}}" />
                                                                             </div>
                                                                        </div>
                                                                        <br>
                                                                         <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">cancel!</button>
                                                                   
                                                                        <button type="submit" id="change_amt_btn" class="swal2-confirm btn btn-success" aria-label="">Submit!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Customer Credit Score  modal -->


