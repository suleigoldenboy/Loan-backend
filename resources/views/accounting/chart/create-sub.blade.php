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
       
        <div class="widget-content widget-content-area br-6 layout-spacing" style="margin-top:30px;">
            <div class="card-body text-center layout-spacing">
                <div class="widget-header">
                    <h4>Creat Sub Account</h4>
            </div>
            </div>
               <form action="{{url('account/chart/sub/store')}}" method="POST" id="actionForm">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="account_id" value="{{$account_id}}">
                                                            <input type="hidden" name="sub_account_type" value="{{$sub_account_type}}">
                                                            
                                                            <div class="form-row mb-4" >
                                                                <div class="col">
                                                                    Primary Account
                                                                    <input type="text" value="{{$account_name}}" class="form-control" placeholder="GL Code" readonly required>
                                                                </div>
                                                                <div class="col">
                                                                        GL Code
                                                                        <input type="text" name="code" value="{{$gl_code}}" class="form-control" placeholder="GL Code" readonly required>
                                                                            @if ($errors->has('code'))
                                                                                <span class="help-block">
                                                                                    <strong class="text-danger">{{ $errors->first('code') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-row mb-4">
                                                                        <div class="col">
                                                                            Account Name
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
                                                                            Transaction Account
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
    </div>
</div>
@endsection
