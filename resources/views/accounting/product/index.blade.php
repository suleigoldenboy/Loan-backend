@extends('layouts.admin-app')

@section('content')

<div class="panel panel-white">
    <div class="container">
        <div class="row layout-top-spacing mb4">
            <div class="col-lg-12 col-12 layout-spacing">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-link active" href="{{ route('product.create') }}">Create New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                <thead>
                    <tr role="row">
                    <th>Name</th>
                    <th>Status</th>
                    <th>Interest Rate</th>
                    <th>Min Principal</th>
                    <th>Max Principal</th>
                    <th>Duration</th>
                    <th>Repayment Type</th>
                    <th>Interest Methodology</th>
                    <th>Late Repayment Penalty Amoun</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key)
                        <tr role="row">
                                <td class="sorting_{{$key->id}}">{{$key->name}}</td>
                                <td>@if($key->status == 1) Active @else In-Active @endif</td>
                                <td>{{$key->interest_rate}}%</td>
                                <td>{{trans('general.currency_symbol')}}{{number_format($key->minimum_principal,2)}}</td>
                                <td>{{trans('general.currency_symbol')}}{{number_format($key->maximum_principal,2)}}</td>
                                <td>{{$key->loan_duration_length}}-{{$key->loan_duration}}</td>
                                <td>{{$key->repayment_method}}</td>
                                <td>{{ Str::replaceArray('_',[' '], $key->interest_method)}}</td>
                                <td>{{$key->late_repayment_penalty_amount}}%</td>
                                <td>
                                    <div class="dropdown custom-dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink6" style="will-change: transform;">
                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
