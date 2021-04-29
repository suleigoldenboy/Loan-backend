@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <form action="{{ url('transactions/flutter') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="hidden" name="page" value="1">
                        <input type="search" class="form-control" placeholder="Customer Name" name="customer_fullname" aria-label="Customer Name" aria-describedby="button-addon2" />
                        <input type="hidden" name="currency" value="NGN">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row m-3">
                        {{-- gadget_freaks --}}
                        @if($transactions['meta']['page_info']['current_page'] > 1)
                            <a
                                href="{{url('transactions/flutter?page=')}}{{$transactions['meta']['page_info']['current_page']  - 1}}"
                                class="btn btn-info pull-left"
                                >
                                Go to Previous Page
                            </a>
                        @endif
                        @if ($transactions['meta']['page_info']['current_page'] <= $transactions['meta']['page_info']['total_pages'])
                            <a
                                href="{{url('transactions/flutter?page=')}}{{$transactions['meta']['page_info']['current_page']  + 1}}"
                                class="btn btn-info pull-right" style="margin-left: 72%"
                                >
                                Go to Next Page
                            </a>
                        @endif
                    </div>
                </div>
                <div class="table-responsive mx-3">
                    <table class="table table-hover table-bordered table-striped">
                        <thead class="thead-dark">
                            <th>
                                Customer's Name
                            </th>
                            <th>
                                Customer's Email
                            </th>
                            <th>
                                Customer's Phone Number
                            </th>
                            <th>
                                Trasaction Details
                            </th>
                            <th>
                                Trasaction Date
                            </th>
                        </thead>
                        <tbody>
                            @foreach($transactions['data'] as $transaction)
                                <tr>
                                    <td>{{$transaction['customer']['name']}}</td>
                                    <td>{{$transaction['customer']['email']}}</td>
                                    <td>{{$transaction['customer']['phone_number']}}</td>
                                    <td>
                                        <p><code>Transaction Info: {{$transaction['processor_response']}}</code></p>
                                        <p><code>Transaction Status: {{$transaction['status']}}</code></p>
                                        <p><code>Amount Settled: {{$transaction['amount_settled']}}</code></p>
                                    </td>
                                    <td>{{Carbon\Carbon::parse($transaction['created_at'])->format('Y-M-d')}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
