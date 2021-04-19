@extends('layouts.admin-app')

@section('content')

<div class="panel panel-white">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
       
        <div class="widget-content widget-content-area br-6 layout-spacing" style="margin-top:30px;">
            <div class="card-body text-left layout-spacing">
                <div class="widget-header">
                    <h4>Create New General Ledger Report Settings</h4>
                </div>
            </div>
            
              
        <div class="row">

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="ac_chart">
          
          <div class="col-sm-1">
           
          </div>
            <div class="widget-content widget-content-area">
               <form action="{{url('account/store-glreportsettings')}}" method="POST" id="actionForm">
                                                            {{csrf_field()}}
                                                            
                                                            <div class="form-row mb-4" >
                                                                <div class="col">
                                                                    Action Name 
                                                                  
                                                                      <select name="action_name" class="form-control" required>
                                                                                <option value="">Select Name</option>
                                                                                @if(!checkIfGL_reporting_is_registered('new_customer'))
                                                                                <option value="new_customer">New Customer</option>
                                                                                @endif
                                                                                 @if(!checkIfGL_reporting_is_registered('new_loan'))
                                                                                <option value="new_loan">New Loan</option>
                                                                                @endif
                                                                                 @if(!checkIfGL_reporting_is_registered('disbursement'))
                                                                                <option value="disbursement">Disbursement</option>
                                                                                @endif
                                                                                 @if(!checkIfGL_reporting_is_registered('repayment'))
                                                                                <option value="repayment">Repayment</option>
                                                                                @endif
                                                                        </select>
                                                                </div>
                                                                <div class="col">
     
                                                                </div>
                                                                </div>
                                                                <div class="form-row mb-4">
                                                                    <div class="col">
                                                                       <h4 class="text-secondary">Report List</h4>
                                                                        <dl>
                                                                        </dl>
                                                                        
                                                                    </div>
                                                                    <div class="col">
                                                                    </div>
                                                                </div>
                                                                <div class="form-row mb-4">
                                                                        <div class="col">
                                                                            Action Type
                                                                            <select name="action_type" id="action_type" class="form-control" required>
                                                                                <option value="">Select Type</option>
                                                                                <option value="cr">Credit</option>
                                                                                <option value="dr">Debit</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                           Account
                                                                             <select name="account" id="account_type" class="form-control  basic" required>
                                                                                <option value="">Select Account</option>
                                                                                @foreach($data as $account)
                                                                                    <option value="{{$account->id}}">{{$account->code}} - {{$account->name}}</option>
                                                                                    @if (count($account->children) > 0)
                                                                                         @foreach ($account->children as $child_1)
                                                                                            <option value="{{$child_1->id}}">{{$child_1->code}} - {{$child_1->name}}</option>
                                                                                            @if (count($child_1->children) > 0)
                                                                                                @foreach ($child_1->children as $child_2)
                                                                                                    <option value="{{$child_2->id}}">{{$child_2->code}} - {{$child_2->name}}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                         @endforeach
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col">
                                                                            <br>
                                                                            <a id="btn2" class="btn btn-info btn-sm">Add+</a>
                                                                        </div>
                                                                    </div>
                                                                        

                                                                <input type="submit" name="time" class="btn btn-primary">

                                                            </form>
            </div>
        </div>
      </div>
          
        </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    
  $("#btn2").click(function(){
      let e_type = document.getElementById("action_type");
      let action_type = e_type.options[e_type.selectedIndex].value;
      let action_type_text = e_type.options[e_type.selectedIndex].text;
      action_type_text = action_type_text.toUpperCase();
        
      let acc_t = document.getElementById("account_type");
      let action_val = acc_t.options[acc_t.selectedIndex].value;
      let action_text = acc_t.options[acc_t.selectedIndex].text;
      
      //console.log('::: '+action_type_text+' ::: '+action_text);   
      let stl = '';
      if(action_type =="cr"){
          stl = 'style="color:green;"'
      }else{
          stl = 'style="color:red;"'
      }
      let l_val = action_text.toString().split("-")[0];

    $("dl").append("<li "+stl+"><b>"+action_type_text+"</b> "+action_text+"</li>"+'<input type="hidden" name="action_value[]" value="'+action_type+'/'+action_val+'/'+l_val+'">');
  });
});
</script>
@endsection
