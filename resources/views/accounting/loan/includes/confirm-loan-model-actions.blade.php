
<!-- Confirm loan modal -->
<div id="confirmLoanModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
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
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure you want to confirm this loan?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                    
                                                                     <form action="{{url('loan/loan/confirm')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="loan_id" value="{{$data->id}}">
                                                                        <input type="hidden" name="product_id" value="{{$data->product_id}}">
                                                                         @if(checkLetterStatus($data->id) == "pending")
                                                                            <input type="hidden" name="isOffer_letter_accepted" value="false">
                                                                         @elseif(checkLetterStatus($data->id) == "active")
                                                                            <input type="hidden" name="isOffer_letter_accepted" value="true">
                                                                         @else
                                                                         <input type="hidden" name="isOffer_letter_accepted" value="false">
                                                                         @endif
                                                                         <?php $check_amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal; ?>
                                                                         <input type="hidden" name="checkAmount" value="{{$check_amount}}">
                                                                        <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes,, confirm!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Confirm loan modal -->


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
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure you want to reject this loan?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    <style type="text/css">
                                                                            .green option{
                                                                                background-color:#0F0;
                                                                            }

                                                                            .blue option{
                                                                                background-color:#00F;
                                                                            }
                                                                        </style>
                                                                     <form action="{{url('loan/loan/reject')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="loan_id" value="{{$data->id}}">
                                                                            <div class="form-row mb-12">
                                                                            Reject Back to Who?
                                                                             <select name="process" class="form-control" required>
                                                                                <option value="">Select Process</option>
                                                                                <option value="2"><b>Reject back to Account Officer</b></option>
                                                                                 @foreach($confirm_process as $val)
                                                                                    <option value="{{$val->process}}">Reject back to {{$val->title}}</option>
                                                                                 @endforeach
                                                                             </select>
                                                                            </div>
                                                                       
                                                                            <div class="form-row mb-12">
                                                                               Reason For Rejection
                                                                                <textarea name="reason" class="form-control" placeholder="Reason for rejection" required></textarea>
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



<!-- Reject Decline modal -->
<div id="declineModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
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
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure you want to decline this loan?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    
                                                                     <form action="{{url('loan/loan/decline')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                                        <input type="hidden" name="loan_id" value="{{$data->id}}">
                                                                        <div class="form-row mb-12">
                                                                            <div class="col">
                                                                               Reason For Decline
                                                                                <textarea name="reason" class="form-control" placeholder="Reason for rejection" required></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                         <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                   
                                                                        <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes, Decline!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Decline loan modal -->