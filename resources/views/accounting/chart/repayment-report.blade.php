@extends('layouts.admin-app')

@section('content')

<div class="panel panel-white">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
       
        <div class="widget-content widget-content-area br-6 layout-spacing" style="margin-top:30px;">
            <div class="card-body text-left layout-spacing">
                <div class="widget-header">
                    <h4 class="text-info">Repayment Report</h4>
            </div>
            </div>
               <form action="" method="GET" id="actionForm">
                {{csrf_field()}}
                <div class="row">
                        <!--<div class="col-sm-3">-->
                        <!--    <div class="form-group">-->
                        <!--        <input type="text" class="form-control mb-4" name="loan_id" placeholder="Loan ID">-->
                        <!--    </div>-->
                        <!--</div>-->
                         <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control mb-4" name="c_name" placeholder="Customer First, Last or other Name">
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <input type="date" name="from" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <input type="date" name="to" class="form-control">
                        </div>
                        <!--<div class="col-sm-3">-->
                        <!--    <div class="form-group">-->
                        <!--        <select class="selectpicker" name="status">-->
                        <!--            <option value="">Select Status</option>-->
                        <!--            <option data-content="<span class='badge badge-success'>Complete</span>" value="0">Complete</option>-->
                        <!--            <option data-content="<span class='badge badge-danger'>In-Complete</span>" value="1">In-Complete</option>-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-sm-3">
                            <input type="submit" value="Search" class="btn btn-primary">
                        </div>
                    </div>                                       
            </form>
        <div class="row">

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="ac_chart">
          
          <div class="reports-breads">
            <h4 class="text-info"> 
            <!--Repayment Report From -->
            <span class="filter-txt-highligh">
              <?php  
                    $d_fromDate = new \DateTime(Request::Get('from'));
                    $get_fromDate =  $d_fromDate->format('D M d, Y');

                    $d_toDate = new \DateTime(Request::Get('to'));
                    $get_toDate =  $d_toDate->format('D M d, Y');
                    
                ?>
                Search result
                 @if(Request::get('c_name'))
                    for {{Request::get('c_name')}}
                 @endif
                
                 
             

              {{ $date_rang}} 

             
            
             
             </span>
            
          </h4>
          </div>

          <div class="col-sm-1">
           
          </div>

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="table-responsive mb-4 mt-4">
                 <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                <thead>
                  <tr>
                    <th width="90">S/N</th>
                    <th>Customer Name</th>
                    <th>Payment Date</th>
                    <th>Transaction Type</th>
                    <th>Amount</th>
                    <th>Balance Status</th>
                    <th>Description</th>
                    <th>Paid By</th>
                    <th></th>
                  </tr>
                  </thead>
               <?php $total = 0; $t_balance = 0; $count_me = 51; ?>
              @if($data)
              
              @foreach ($data as $rec)
                
                <?php
                    $d_amount = $rec->amount;
                    $d_balnce = $rec->balance;
                    $total += $rec->amount; 
                   
                ?>
                  <tr>
                    <td width="90">
                        {{$loop->iteration}}
                        </td>
                    <td>
                        @if($rec->customer_id)
                            {{getFullCustomerName($rec->customer_id)}}
                        @else
                            {{getFullCustomerNameWithLoanID($rec->loan_id)}}
                        @endif
                    </td>
                    <td>{{$rec->date_paid}}</td>
                    <td>
                        @if ($rec->transaction_type == "in_house")
                                <span class="badge badge-primary"> In House </span>
                        @elseif($rec->transaction_type == "Medium")
                            <span class="badge badge-warning"> {{$rec->transaction_type}} </span>
                        @else
                            <span class="badge badge-danger"> {{$rec->transaction_type}} </span>
                        @endif
                    </td>
                     <td>₦{{number_format($d_amount,2)}}</td>
                      <td>
                       @if($rec->in_complete_payment == 1)
                            <span class="badge badge-danger"> ₦{{$d_balnce}} </span>
                            <?php  $t_balance = $rec->balance; ?>
                       @else
                            <span class="badge badge-success"> Complete </span>
                       @endif
                    </td>
                    <td>{{$rec->notes}}</td>
                    <td>
                        @if($rec->repaymentBy)
                        {{$rec->repaymentBy->first_name}}
                        {{$rec->repaymentBy->last_name}}
                        @endif
                    </td>
                    <td>
                        <a class="nav-link list-actions text-info" href="{{url('loan/loan/showloan-detail',$rec->loan_id)}}"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> view</a>
                    </td>
              </tr>
              <?php $count_me += 1; ?>
              @endforeach
             @endif
             <thead>
               <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td width="90"><h4 class="text-info">TOTAL</h4></td>
                    <td><h4 class="text-info">₦{{number_format($total,2)}}</h4></td>
                    <td><h4 class="text-danger">₦{{number_format($t_balance,2)}}</h4></td>
                    <td></td>
                    <td></td>
                    <td></td>
              </tr>
              </thead>
            </table>
           </div>
            </div>
        </div>

        </div>
      </div>
          
        </div>

        </div>
    </div>
</div>
@endsection
