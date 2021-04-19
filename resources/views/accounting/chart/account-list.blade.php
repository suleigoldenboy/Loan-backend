@extends('layouts.admin-app')

@section('content')
<style>
#changecl:hover{
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3;
}
</style>
<div class="panel panel-white">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="card-body text-right layout-spacing">
            <a type="button" class="btn btn-warning mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
                Create
            </a>
         </div>
                                    <!-- Start Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create New Primary Account</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                     <form action="{{url('account/chart/store')}}" method="POST" id="actionForm">
                                                            {{csrf_field()}}
                                                            
                                                            <div class="form-row mb-4" >
                                                                <div class="col">
                                                                    Account Type
                                                                    <select name="type" id="type" class="form-control" onChange="genCode()" required>
                                                                        <option value="">Select Type</option>
                                                                        <option value="asset">Asset</option>
                                                                        <option value="equity">Equity</option>
                                                                        <option value="expense">Expense</option>
                                                                        <option value="income">Income</option>
                                                                        <option value="liability">Liability</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col">
                                                                        GL Code
                                                                        <input type="text" name="code" id="code" value="" class="form-control" placeholder="GL Code" readonly required>
                                                                            @if ($errors->has('code'))
                                                                                <span class="help-block">
                                                                                    <strong class="text-danger">{{ $errors->first('code') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                            <input type="hidden" id="primary_code" value="00{{count($data)+2}}00">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-row mb-4">
                                                                        <div class="col">
                                                                            Name
                                                                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                                                                            @if ($errors->has('name'))
                                                                                <span class="help-block">
                                                                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col">
                                                                            Opening Balance
                                                                            <input type="number" name="opening_balance" class="form-control" placeholder="Opening Balance" value="0" readonly required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row mb-4">
                                                                        <div class="col">
                                                                            Transaction Type
                                                                             <select name="transaction_type" class="form-control" required>
                                                                                <option value="">Select Type</option>
                                                                                <option value="cr">Credit</option>
                                                                                <option value="dr">Debit</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                       
                                                                        
                                                                <input type="submit" name="time" class="btn btn-primary">

                                            </form>
                                                    </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    {{-- <button type="button" class="btn btn-primary">Save</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- End Modal -->








        <div class="widget-content widget-content-area br-6">
            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                <thead>
                    <tr role="row">
                    <th>Name</th>
                    <th>Type</th>
                    <th>Opening Balance</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $account)
                        <tr role="row">
                                <td class="sorting_{{$account->id}}">
                               
                                    <div class="widget-content widget-content-area">
                                     @if (count($account->children) > 0)
                                            <ul class="file-tree">
                                            <li class="file-tree-folder">
                                           
                                                <b class="text-secondary">{{$account->code}}</b>-{{$account->name}}
                                                <a id="changecl" href="{{url('account/create/sub',[$account->id,'primary',$account->name])}}" class="btn btn-default btn-sm" style="padding: 1px;">
                                                    <svg xmlns="#" title="Add Sub Account" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg><span class="icon-name"> </span>
                                                </a>
                                                <ul>
                                                  @foreach ($account->children as $child_1)
                                                        @if (count($child_1->children) > 0)
                                                            <li class="file-tree-folder">
                                                                  <b class="text-secondary">{{$child_1->code}}</b>-{{$child_1->name}}

                                                                  {{-- {{trans('general.currency_symbol')}}
                                                                  <b class="text-danger">{{number_format($child_1->opening_balance,2)}}</b> --}}

                                                                    <a id="changecl" href="{{url('account/create/sub',[$child_1->id,'sub',$child_1->name])}}" class="btn btn-default btn-sm" style="padding: 1px;">
                                                                        <svg xmlns="#" title="Add Sub Account" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg><span class="icon-name"> </span>
                                                                    </a>
                                                                    <ul>
                                                                    @foreach ($child_1->children as $child_2)
                                                                        <li>
                                                                             <b class="text-secondary">{{$child_2->code}}</b>-{{$child_2->name}}
                                                                             
                                                                             <b class="text-danger">{{trans('general.currency_symbol')}}{{App\Http\Controllers\Account\AccountsController::getAccountBalance($child_2->id,$child_2->code,$child_2->transaction_type)}}</b> 
                                                                        </li>
                                                                    @endforeach
                                                                    </ul>
                                                                </li>
                                                        @else
                                                            <li>
                                                            <b class="text-secondary">{{$child_1->code}}</b>-{{$child_1->name}} 
                                                              <b class="text-danger">{{trans('general.currency_symbol')}}{{App\Http\Controllers\Account\AccountsController::getAccountBalance($child_1->id,$child_1->code,$child_1->transaction_type)}}</b>
                                                            <a id="changecl" href="{{url('account/create/sub',[$child_1->id,'sub',$child_1->name])}}" class="btn btn-default btn-sm" style="padding: 1px;">
                                                                <svg xmlns="#" title="Add Sub Account" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg><span class="icon-name"> </span>
                                                            </a>
                                                        </li>
                                                        @endif
                                                  @endforeach
                                                    
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                     @else
                                       <b class="text-default">{{$account->code}}</b>-{{$account->name}}
                                        <a id="changecl" href="{{url('account/create/sub',[$account->id,'primary',$account->name])}}" class="btn btn-default btn-sm" style="padding: 1px;">
                                            <svg xmlns="#" title="Add Sub Account" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg><span class="icon-name"> </span>
                                        </a>
                                     @endif
                                    
                                    </div>
                                </td>
                                <td class="text-primary" style="text-transform: uppercase;">{{$account->type}}</td>
                                <td>
                                
                                <b class="text-danger">
                                    {{trans('general.currency_symbol')}}
                                    {{number_format(App\Http\Controllers\Account\AccountsController::getPrimaryAccountBalance($account->id),2)}}
                                </b>
                               
                                </td>
                                <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function genCode(){
    const d_type = document.getElementById("type").value;
    const d_code = document.getElementById("primary_code").value;
    const new_code = d_type.charAt(0)+''+ d_type.charAt(1)+''+d_code;
    document.getElementById("code").value = new_code.toUpperCase();

    //str.();
}
</script>
@endsection
