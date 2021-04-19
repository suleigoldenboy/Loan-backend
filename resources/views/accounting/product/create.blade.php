@extends('layouts.admin-app')

@section('content')
<div class="container mt-5">
    <div class="row" style="margin-top:20px;">
        <div class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Add Product</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <form action="{{ route('product.store') }}" method="POST">
                    {{csrf_field()}}
                        <div class="widget-content widget-content-area mb-4">
                            <div class="form-row mb-4">
                                <div class="col">
                                    Loan Product Name
                                    <input type="text" class="form-control" name="name" placeholder="Product Name" required />
                                </div>
                                <div class="col">
                                    Monthly Interest Rate
                                    <input type="number" step="0.0001" name="interest_rate" class="form-control" placeholder="Interest Rate" required>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col">
                                    Minimum Loan Amount
                                    <input type="number" step="0.0001" name="minimum_principal" class="form-control" placeholder="Minimum Loan Amount" required>
                                </div>
                                <div class="col">
                                    Maximum Loan Amount
                                    <input type="number" step="0.0001" name="maximum_principal" class="form-control" placeholder="Maximum Loan Amount" required>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area mb-4">
                            <div class="form-row mb-4">
                                <div class="col">
                                    Processing Fee (%)
                                    <input type="number" step="0.0001" name="processing_charge" class="form-control" placeholder="processing charge " required />
                                    <span class="text-helper">The percent charge for processing a loan</span>
                                </div>
                                <div class="col">
                                    Insurance Fee (%)
                                    <input type="number" step="0.0001" name="insurance_charge" class="form-control" placeholder="insurance charge " required />
                                    <span class="text-helper">The percent charge for Insuring a loan</span>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col">
                                    Duration
                                    <select name="loan_duration" class="form-control" required>
                                        <option value="">Select Duration</option>
                                        <option value="month">Month(s)</option>
                                        <option value="year">Year(s)</option>
                                    </select>
                                </div>
                                    <div class="col">
                                        Duration Length
                                        <input type="number" name="loan_duration_length" value="1" class="form-control" required />
                                        <span class="helper-text">1 , 2... 12 For Months, 1, 2, ... for Years</span>
                                    </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area mb-4">
                            <div class="form-row mb-4">
                                <div class="col">
                                    Repayment Schedule
                                    <select name="repayment_method" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="annually">Annually</option>
                                    </select>
                                </div>
                                <div class="col">
                                    Interest Method
                                    <select name="interest_method" class="form-control" required>
                                        <option value="flat_rate">Flat Rate</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mb-4">
                                <div class="col">
                                    Monthly Penal Charge (%)
                                    <input type="number" step="0.0001" name="late_repayment_penalty_amount" value="0" class="form-control" placeholder="Charges" required />
                                </div>
                                <div class="col">
                                    Penalty Effect Day(s)
                                    <input type="number" step="0.0001" name="after_maturity_date_penalty_amount" value="0" class="form-control" placeholder="Charges" required />
                                    <span class="helper-text">Number of days before a loan accuire charge</span>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area mb-4">
                            <div class="form-row mb-4">
                                <div class="col">
                                    Penal Charge For Early Liquidation(%)
                                    <input type="number" step="0.0001" name="early_repayment_charge" value="0" class="form-control" placeholder="Charges" required />
                                    <span class="helper-text">Percentage charge for Early Liquidation</span>
                                </div>
                                <div class="col">
                                    Status<br><br>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value={{ Auth::user()->id }} name="user_id" />
                        <button type="submit" class="btn btn-primary">Save Loan Product</button>
                    </form>
            </div>
            </div>
        </div>
    </div>


</div>
@endsection
@section('script')
    @include('accounting.product.widget.alert')
@endsection
