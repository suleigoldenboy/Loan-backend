@extends('layouts.admin-app')
@section('content')
<div class="widget-content widget-content-area text-center split-buttons">
                                    <p class="mb-2"> <b>Loan Classification</b></p>

                                    <a href="{{url('loan/category/performing')}}" class="btn btn-success mb-4 mr-3 btn-lg">Performing</a>
                                    <a href="{{url('loan/category/watchful')}}" class="btn btn-primary mb-4 mr-3 btn-lg">Pass & Watch</a>
                                    <a href="{{url('loan/category/substandard')}}" class="btn btn-info mb-4 mr-3 btn-lg">Substandard</a>
                                    <a href="{{url('loan/category/doubtful')}}" class="btn btn-warning mb-4 mr-2 btn-lg">Doubtful</a>
                                    <a href="{{url('loan/category/lost')}}" class="btn btn-danger mb-4 mr-3 btn-lg">Lost</a>
                                     
                                </div>

<div class="col-md-12">
    <div class="row layout-top-spacing">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="btn-group">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{ $name }} Category </h4>
                            </div>
                        </div>
                    </div>
                    <div class="container pull-right">
                        <form method="post" action={{ url()->current()}} >
                        {{csrf_field()}}
                            <div class="row pl-2 mb-2">
                                <input class="form-control col-md-4 ml-2" name="start_date" type="date" placeholder="From X Date" />
                                <input class="form-control col-md-4 ml-2" name="end_date" type="date" placeholder="From Y Date" />
                            </div>
                            <button class="btn btn-primary">Search</button>
                        </form>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th> Borrower </th>
                                <th> Phone No.</th>
                                <th> Home Address</th>
                                <th> Place Of Work</th>
                                <th> Office Address</th>
                                <th> Employer's Phone No.</th>
                                <th> Loan Amount </th>
                                <th> Due Amount </th>
                                <!--<th> % Provision</th>-->
                                <!--<th> Amount Of Provision</th>-->
                                <th> Age</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loans as $key => $loan)
                                <tr class="odd gradeX">
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{ $loan->customer->first_name }} {{ $loan->customer->last_name }}
                                    </td>
                                    <td>
                                        {{ $loan->customer->phone_number }} 
                                    </td>
                                    <td>
                                        No Address Collected 
                                    </td>
                                    <td>
                                        {{ $loan->customer->employment()->first()->employer_name }} 
                                    </td>
                                    <td>
                                        {{ $loan->customer->employment()->first()->business_address }} 
                                    </td>
                                    <td>
                                        {{ $loan->customer->employment()->first()->employer_phone_number }} 
                                    </td>
                                    <td>
                                        {{ $loan->disbursed_amount }}
                                    </td>
                                    <td>
                                        @php 
                                            $duration = ($loan->loan_duration == 'year') ? ( $loan->loan_duration_length * 12) : $loan->loan_duration_length;
                                        @endphp
                                        {{ format_number( $loan->principal/$duration )  }}
                                    </td>
                                    <!--<td>-->
                                    <!--    {{ $percentage }}-->
                                    <!--</td>-->
                                    <!--<td>-->
                                    <!--    {{ format_number($loan->principal/$duration * ($percentage/100)) }}-->
                                    <!--</td>-->
                                    <td>
                                        {{ Carbon\Carbon::parse($loan->release_date)->diffInDays(now()) }}
                                    </td>
                                </tr>
                            @empty
                            
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
