@extends('layouts.admin-app')
@section('stylesheet')
<style>
    .hide{
        display: none;
    }
</style>
@endsection
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <!--START Disburse DIV -->
        <div id="tableCheckbox" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>e-Payment Recovery Instrument</h4>
                        </div>
                    </div>
                    <div class="container pull-right">
                        <form method="post" action={{ url('/recovery-history') }}>
                            {{ csrf_field() }}
                            <div class="row pl-2 mb-2">
                                <input class="form-control col-md-3 ml-2" name="start_date" type="date" placeholder="From X Date" />
                                <input class="form-control col-md-3 ml-2" name="end_date" type="date" placeholder="From Y Date" />
                                <input class="form-control col-md-4 ml-2" name="name" type="search" placeholder="Search By Customer's Name" />
                            </div>
                            <button class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if($message !== null && isset($message))
                        <h5>
                            {{ $message }}
                        </h5>
                    @endif
                    <div class="table-responsive">
                        <form method="POST" action="{{ URL('recover') }}" id="form_sample_1" class="form-horizontal">
                        {{ csrf_field() }}
                        <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                            <thead>
                                <tr>
                                    <th class="checkbox-column">
                                        <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;" title="Check All">
                                            <input type="checkbox" onClick="" class="new-control-input todochkbox" id="todoAll">
                                            <span class="new-control-indicator"></span>
                                        </label>
                                    </th>
                                    <th class="">S/N</th>
                                    <th class="">Loan ID</th>
                                    <th class="">Amount Paid</th>
                                    <th class="">Loan Amount</th>
                                    <th class="">Customer Name</th>
                                    <th class="">Due Amount</th>
                                    <th class="">Paid Date</th>
                                    <th class="">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($loans as $loan)
                                @if(!$loan->checkLoan())
                                    <tr>
                                        <td>
                                            <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;" title="Check All">
                                            <input type="checkbox" class="new-control-input todochkbox" id="todoAll" >
                                            <span class="new-control-indicator"></span>
                                        </label>
                                        </td>
                                        <td>
                                            {{ $loop->iteration}}
                                        </td>
                                        <td>
                                            000-{{ $loan->id }}
                                        </td>
                                        <td>
                                            @if ($loan->recovery != null)
                                                {{format_number($loan->recovery()->get()->sum('amount'))}}
                                            @else
                                                Yet to Re-Pay
                                            @endif
                                        </td>
                                        <td>
                                             @if($loan->disbursed_amount != null)
                                            {{ format_number($loan->disbursed_amount) }}
                                            @else
                                             Not  Disbursed
                                            @endif
                                        </td>
                                        <td>
                                            {{$loan->customer->first_name}}
                                            {{$loan->customer->last_name}}
                                            {{$loan->customer->other_name}}
                                        </td>
                                        <td>
                                                {{ format_number($loan->getAmountDue()) }}
                                        </td>
                                        <td>
                                            @if ($loan->recovery != null)
                                                {{$loan->recovery()->latest()->first()->date_paid}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($loan->recovery != null)
                                            {{$loan->recovery->status}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$loan->checkLoan())
                                            <a class="mr-2 submit-button btn btn-primary btn-sm" href="" data-id="{{hashId($loan->id)}}">
                                                Query User
                                            </a>
                                            @endif
                                        </td>
                                    <tr>
                                @endif
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    </form>
                </div>
                <div class="widget-footer query-button hide widget-content-area">
                    <button type="submit" class="btn btn-primary btn-sm">Query Selected User</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('input[type=checkbox]').change(function(){
            if($(this).is(':checked')) {
                $('.query-button').removeClass('hide')
            } else {
                $('.query-button').addClass('hide')
            }
        });
        $('.submit-button').on('click',  function(e) {
            e.preventDefault();
            const uuid = $(this).data('id');
            const ipAPI = "{{ url('recover/loan/amount')}}"+'/'+uuid
            console.log(ipAPI)
            swal.queue([{
                title: 'Monthly Repayment',
                confirmButtonText: 'Confirm Debit Query',
                text: `You about to Query this user for the Monthly Loan Repaymnet amount`,
                type: 'warning',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                preConfirm: function() {
                return fetch(ipAPI)
                    .then(function (response) { 
                        return response.json();
                    })
                    .then(function(data) {
                        console.log(data[0].message)
                        return swal.insertQueueStep(data[0].message)
                    })
                    .catch(function(err) {
                        console.log(err)
                    swal.insertQueueStep({
                        type: 'error',
                        title: 'Something Went Wrong'
                    })
                    })
                }
            }])
        })
    </script>
@endsection