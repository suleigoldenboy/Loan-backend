@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <!-- Start General Information-->
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div id="general-info" class="section general-info">
                <div class="info">
                    <h6 class="text-info">Recovery Loan Search</h6>
                    <form action="" method="GET">
                     {{csrf_field()}}
                     @if(can('Admin Loan Search'))
                        @include('accounting.loan.details.admin-search')
                    @endif
                    @if(can('Branch Loan Search'))
                        @include('accounting.loan.details.branch-search')
                    @endif
                    
                    </form>
                    <h4 class="text-secondary">
                        @if(Request::get('from') && Request::get('to'))
                        
                        Search result for 
                            @if(Request::get('status') =="due_payment")
                            <b class="text-danger">DUE PAYMENT</b>
                            @elseif(Request::get('status') =="incomplete")
                            <b class="text-danger">INCOMPLETE</b>
                            @elseif(Request::get('status') =="past_due_date")
                            <b class="text-danger">PAST DUE DATE</b>
                            @endif
                         from {{convertDateToString(Request::get('from'))}} To {{convertDateToString(Request::get('to'))}}
                        @endif
                    </h4> 
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="widget-content widget-content-area">
                    <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%; overflow:auto;" role="grid" aria-describedby="html5-extension_info">
                        <thead style="font-size:9px;">
                            <tr>
                                <th width="3">S/N</th>
                                <th>  Name </th>
                                <th>  Email </th>
                                <th>  Mobile</th>
                                <th>  Address</th>
                                <th> Com Name</th>
                                <th> Com Address</th>
                                <!--<th> Employer's Phone No.</th>-->
                                <th> Loan Amt </th>
                                <th> Due Amt </th>
                                <th> Duration</th>
                                <th> Due Date</th>
                                <th> L Officer</th>
                                <th> Age</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $loop_count = 1; $total_repayment_amount = 0;?>
                             @forelse($data as  $loan)

                                <?php
                                    $loan_amount = $loan->disbursed_amount ? $loan->disbursed_amount : $loan->principal;
                                    $pay_day = $loan->customer->employment->salary_pay_day;
                                    if($pay_day < 10){
                                        $pay_day = '0'.$pay_day;
                                    }
                                    $in = date_create($loan->created_at);
                                    $out = date_create($in->format('Y-m-'.$pay_day));
                                
                                    //$the_release_date = $out->format('Y-m-d');
                                    $the_release_date = $loan->release_date ? $loan->release_date : date('Y-m-d');
                                    $search_start_date = Request::get('from');
                                    $search_end_date = Request::get('to');
                                    $search_status = Request::get('status');
                                    $get_result = App\Http\Controllers\Loan\RepaymentController::searchRepaymentScheduleCalendar($search_start_date,$search_end_date,$search_status,$loan->id,$loan_amount,$loan->interest_rate,$loan->loan_duration,$loan->loan_duration_length,$the_release_date,$pay_day);
                                    
                                ?>
                                 @if ($get_result)

                                     @foreach($get_result as $value) 
                                        @if(Carbon\Carbon::parse($value['date'])->diffInDays(now()) > 4)
                                         <tr class="">
                                         @else
                                          <tr class="odd gradeX">
                                          @endif
                                            <td>{{$loop_count}}</td>
                                            <td>
                                                {{ $loan->customer->first_name }} {{ $loan->customer->last_name }}
                                            </td>
                                            <td>
            {{ str_replace(['@', '@'], ["\r\n@", "@\r\n"], $loan->customer->email) }}
                                            </td>
                                            <td>
                                                {{ $loan->customer->phone_number }} 
                                            </td>
                                            <td>
                                                {{ $loan->customer->address }}
                                            </td>
                                            <td>{{$loan->customer->employment->employer_name}}</td>
                                            <td>
                                                {{ str_replace("@", " ", $loan->customer->employment->employer_email) }}{{$loan->customer->employment->employer_email}}
                                                </td>
                                            <td>₦{{ $loan->disbursed_amount }}</td>
                                    <td><b class="text-danger">₦{{$value['repayment_amount']}}</b>
                                        <?php $total_repayment_amount += str_replace( ',', '', $value['repayment_amount']); ?>
                                        
                                        
                                    </td>
                                            <td> {{ $loan->loan_duration_length }} Months</td>
                                            <td>{{$value['date']}}</td>
                                            <td>
                                                {{$loan->loan_officer->first_name}} {{$loan->loan_officer->last_name}} {{$loan->loan_officer->other_name}}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($value['date'])->diffInDays(now()) }}
                                            </td>
                                        </tr>
                                         <?php $loop_count += 1; ?>
                                    @endforeach
                                  
                                 @endif
                               
                            @empty
                            
                            @endforelse
                           
                        </tbody>
                         <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>TOTAL</td>
                                 <td><b class="text-danger">₦{{number_format($total_repayment_amount,2)}}</b></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                            </tr>
                    </table>
                </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
