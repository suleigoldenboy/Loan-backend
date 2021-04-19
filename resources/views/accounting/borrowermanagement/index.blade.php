@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        
        <!--START Disburse DIV -->
         
         <div id="tableCheckbox" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Borrower Management</h4>
                                        </div>                       
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                    
                                        <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                            <thead>
                                                <tr>
                                                    <th class="">Emp Name</th>
                                                    <th class="">Product</th>
                                                    <th class="">Loan Amount</th>
                                                    <th class="">Disburse Date</th>
                                                    <th class="">Maturity Date</th>
                                                    <th class="">Priority</th>
                                                    <th>Note</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($borrowers as $data)
                                                <tr>
                                                 <td>
                                                 {{$data->employee->first_name}}
                                                 {{$data->employee->last_name}}
                                                 </td>
                                                 <td>{{adminGetLoanProduct(1)->name}}</td>
                                                 <td>product_id</td>
                                                 <td>{{convertDateToString($data->loan->release_date)}}</td>
                                                 <td></td>
                                                 <td>
                                                    @if ($data->priority == "Law")
                                                        <span class="badge badge-primary"> {{$data->priority}} </span>
                                                    @elseif($data->priority == "Medium")
                                                         <span class="badge badge-warning"> {{$data->priority}} </span>
                                                    @else
                                                         <span class="badge badge-danger"> {{$data->priority}} </span>
                                                    @endif
                                                   
                                                   
                                                   </td>
                                                 <td>{{$data->note}}</td>
                                                 <td>
                                                     <a class="nav-link list-actions text-info" href="{{url('loan/loan/showloan-detail',$data->loan->id)}}"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> view</a>
                                                 </td>
                                                </tr>
                                            @endforeach
                                             
                                            </tbody>
                                        </table>
                                    </div>


                                   
                                </div>
                            </div>
                        </div>
         
        <!-- END Disburse DIV -->

    </div>
</div>

@endsection
