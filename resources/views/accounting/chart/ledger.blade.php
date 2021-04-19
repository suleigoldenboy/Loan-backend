@extends('layouts.admin-app')

@section('content')
<div class="widget-content widget-content-area text-center split-buttons">
                                    <p class="mb-2"> <b>Reports</b></p>

                                    <a href="{{url('account/general/ledger')}}" class="btn btn-primary mb-4 mr-3 btn-lg">General Ledger</a>
                                    <a href="{{url('account/income/report')}}" class="btn btn-primary mb-4 mr-3 btn-lg">Income</a>
                                    <a href="{{url('account/expense/report')}}" class="btn btn-primary mb-4 mr-3 btn-lg">Expenses</a>
                                    <a href="{{url('account/disburse/report')}}" class="btn btn-primary mb-4 mr-2 btn-lg">Disbursement</a>
                                    
                                    <a href="{{url('account/repayment/report')}}" class="btn btn-primary mb-4 mr-3 btn-lg">Repayment</a>
                                </div>

<div class="panel panel-white">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
       
        <div class="widget-content widget-content-area br-6 layout-spacing" style="margin-top:30px;">
            <div class="card-body text-left layout-spacing">
                <div class="widget-header">
                    <h4>LEDGER</h4>
            </div>
            </div>
               <form action="{{url('account/general/ledger/details')}}" method="GET" id="actionForm">
                                                            {{csrf_field()}}
                                                           
                                                            <div class="form-row mb-4" >
                                                                <div class="col">
                                                                    From
                                                                    <input type="date" name="from" class="form-control"  required>
                                                                </div>
                                                                <div class="col">
                                                                       To
                                                                        <input type="date" name="to" class="form-control" required>
                                                                </div>
                                                                <div class="col">
                                                                       Account
                                                                        <select name="account" class="form-control  basic" required>
                                                                            <option value="">Select Account</option>
                                                                           
                                                                             <option value="allAccount/allAccount">All Account</option>
                                                                               
                                                                                @foreach($primaryAccs as $accRec)
                                                                                <option value="primary/{{$accRec->id}}" style="background-color: blue; color: #FFF;">{{$accRec->name}}</option>
                                                                                   
                                                                                  @if ($transactions_type == "all")

                                                                                         @foreach($accRec->children as $subacc)
                                                                                             <option value="sub/{{$subacc->id}}">{{$subacc->name}}</option>
                                                                                         @endforeach

                                                                                    @elseif ($transactions_type == "cr")

                                                                                         @foreach($accRec->childrenCr as $subacc)
                                                                                             <option value="sub/{{$subacc->id}}">{{$subacc->name}}</option>
                                                                                         @endforeach

                                                                                    @elseif ($transactions_type == "dr")

                                                                                         @foreach($accRec->childrenDr as $subacc)
                                                                                             <option value="sub/{{$subacc->id}}">{{$subacc->name}}</option>
                                                                                         @endforeach
                                                                                        
                                                                                    @endif
                                                                                   

                                                                                @endforeach  
                                                                        </select> 
                                                                 </div>
                                                                 <div class="col">
                                                                        <br>
                                                                       <input type="submit" value="Search" class="btn btn-primary">
                                                                </div>
                                                                    
                                                            </div>

                                                         </form>
        </div>
    </div>
</div>
@endsection
