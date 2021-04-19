<!--  make repayment -->
<style>

</style>
<div class="modal fade" id="make-repaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Loan Repayment</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('loan/loan/make/repayment')}}" method="POST" id="actionForm">
                 {{csrf_field()}}
                 <input type="hidden" name="customer_id" value="{{$data->customer->id}}">
                 <input type="hidden" name="loan_id" value="{{$data->id}}">
                 <input type="hidden" id="next_pay_month" name="next_pay_month" value="">
                 <input type="hidden" id="next_amount_to_pay" name="next_amount_to_pay" value="">
                 <input type="hidden"  id="total_balance_to_be_paid" name="total_balance_to_be_paid" value="">
                 <input type="hidden"  name="transaction_type" value="in_house">
                <h4>Payment for <label class="badge badge-secondary" id="text_next_month_payment"></label></h4>
                <div class="form-row mb-4">
                    <div class="col">
                          <b>Next Instalment amount</b>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="amount_to_be_paid_1" onClick="otherPay('hidden')" name="amount_to_be_paid" class="custom-control-input" value="">
                                <label class="custom-control-label" for="amount_to_be_paid_1">₦<b id="text_next_instalment_to_pay_amount"></b></label>
                            </div>
                    </div>
                </div>
                <div class="form-row mb-4" >
                    <div class="col">
                          <b>Full Loan Balance</b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="amount_to_be_paid_2" onClick="otherPay('hidden')" name="amount_to_be_paid" class="custom-control-input" value="">
                                <label class="custom-control-label" for="amount_to_be_paid_2">₦<b id="text_full_balance_to_pay_amount"></b></label>
                            </div>
                    </div>
                </div>
                 <div class="form-row mb-4" >
                    <div class="col">
                          <b>Others</b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="other_payment" onClick="otherPay('visible')" name="amount_to_be_paid" class="custom-control-input" value="other_payment">
                                <label class="custom-control-label" for="other_payment"><b id=""></b></label>
                            </div>
                    </div>
                </div>
                 <div class="form-row mb-4" >
                    <div class="col">
                          <b class="text-secondary">Preliquidation</b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="pre_liquidate_payment" onClick="preliquidationPay('visible')" name="amount_to_be_paid" class="custom-control-input" value="pre_liquidate_payment">
                                <label class="custom-control-label" for="pre_liquidate_payment"><b id=""></b></label>
                            </div>
        <input type="hidden" step="0.01" id="pay_liquidation_amount" name="pay_liquidation_amount" value="">
                            
                    </div>
                </div>
                 <div class="form-row mb-4" id="div_other_amount" style="visibility:hidden">
                    <div class="col">
                        Enter amount
                          <input type="number" step="0.01" id="pay_other_amount" name="other_amount" class="form-control" placeholder="Amount to pay">
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                          Comment 
                          <textarea name="note" class="form-control" placeholder="Comment" required></textarea>
                    </div>

                </div>
                 <div class="form-group col-md-10">
                    <label class="text-info">Payment Bank</label>
                    <select class="form-control" name="payment_bank" required>
                        <option value="">Select Bank</option>
                        <!--@foreach ($banks as $banks)-->
                         <!--{{-- <option value="{{$banks->id}}">{{$banks->name}}</option> --}}-->
                            @foreach ($banks->children as $child)
                                <option value="{{$child->id}}">{{$child->name}}</option>
                            @endforeach
                        <!--@endforeach -->
                    </select>
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

<!-- End make repayment -->


<!--  make repayment balance-->
<div class="modal fade" id="make-repaymentBalanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title text-info" id="exampleModalLabel">Loan Balance Repayment</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('loan/loan/make/balance/repayment')}}" method="POST" id="actionForm">
                 {{csrf_field()}}
                 <input type="hidden" name="customer_id" value="{{$data->customer->id}}">
                 <input type="hidden" name="loan_id" value="{{$data->id}}">
                 <input type="hidden" id="next_pay_month_balance" name="next_pay_month" value="">
                 <input type="hidden" id="balance_pay_amount" name="balance_pay_amount" value="">
                 <input type="hidden" id="current_amount_paid" name="current_amount_paid" value="">
                 <input type="hidden"  name="transaction_type" value="in_house">
                <div class="form-row mb-4" >
                    <div class="col">
                          <b>Balance amount</b>
                            <div class="form-group">
                                <label class="text-danger">₦<b id="text_balance_pay_amount"></b></label>
                            </div>
                    </div>
                </div>
                <div class="form-row mb-4" >
                    <div class="col">
                          <b>UnPaid Balance for <label id="text_pay_month_balance"></label> </b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="amount_to_be_paid_3" onClick="otherPayBalance('hidden')" name="balance_amount_to_be_paid" class="custom-control-input" value="">
                                <label class="custom-control-label" for="amount_to_be_paid_3">₦<b id="text_balance_full_balance_to_pay_amount"></b></label>
                            </div>
                    </div>
                </div>
                <div class="form-row mb-4" >
                    <div class="col">
                          <b>Others</b>
                           <div class="custom-control custom-radio">
                                <input type="radio" id="other_payment_2" onClick="otherPayBalance('visible')" name="balance_amount_to_be_paid" class="custom-control-input" value="other_payment">
                                <label class="custom-control-label" for="other_payment_2"><b id=""></b></label>
                            </div>
                    </div>
                </div>
                <div class="form-row mb-4" id="div_other_amount_balance" style="visibility:hidden">
                    <div class="col">
                        Enter amount
                         <input type="number" step="0.01" id="pay_other_amount_balance" name="other_amount_balance" class="form-control" placeholder="Amount to pay">
                    </div>
                </div>
                 <div class="form-group col-md-10">
                    <label class="text-info">Payment Bank</label>
                    <select class="form-control" name="payment_bank" required>
                        <option value="">Select </option>
                          @foreach ($banks->children as $child)
                                <option value="{{$child->id}}">{{$child->name}}</option>
                            @endforeach
                    </select>
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

<!-- End make repayment balance-->