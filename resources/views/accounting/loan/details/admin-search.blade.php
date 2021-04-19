<div class="row">
                        <!--<div class="col-sm-3">-->
                        <!--    <div class="form-group">-->
                        <!--        <input type="text" class="form-control mb-4" name="loan_id" placeholder="Loan ID">-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="date" class="form-control mb-4" name="from" placeholder="From Date" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="date" class="form-control mb-4" name="to" placeholder="To Date" required>
                            </div>
                        </div> 
                        <!--<div class="col-sm-3">-->
                        <!--    <div class="form-group">-->
                        <!--       <select name="customer_id" class="form-control  basic">-->
                        <!--            <option value="">Select Customer</option>-->
                        <!--            @foreach ($customers as $cus)-->
                        <!--                <option value="{{$cus->id}}">{{$cus->first_name}} {{$cus->last_name}} {{$cus->other_name}}</option>-->
                        <!--            @endforeach-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select name="loan_officer_id" class="form-control  basic">
                                    <option value="">Select Loan Officer</option>
                                    @foreach ($loan_officers as $emp)
                                        <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select name="branch_id" class="form-control  basic">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->state}} - {{$branch->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <!--<div class="col-sm-3">-->
                       <!--     <div class="form-group">-->
                       <!--         <input type="email" class="form-control mb-4" name="email" placeholder="Customer Email">-->
                       <!--     </div>-->
                       <!-- </div>-->
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="selectpicker" name="status" required>
                                    <option value="">Select Status</option>
                                    <!--<option data-content="<span class='badge badge-success'>Running</span>" value="running">Running</option>-->
                                    <option data-content="<span class='badge badge-secondary'>Due Payment</span>" value="due_payment">Due Payment</option>
                                    <option data-content="<span class='badge badge-warning'>InComplete</span>" value="incomplete">InComplete</option>
                                    <option data-content="<span class='badge badge-danger'>Past Due Date</span>" value="past_due_date">Past Due Date</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="mr-2 btn btn-primary  html">Search</button> 
                        </div>
                    </div>