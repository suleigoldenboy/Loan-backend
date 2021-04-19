@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/loan')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @if (session()->get('customer_registration_id'))
                                    <input type="hidden" name="customer_id" value="{{session()->get('customer_registration_id')}}" >
                                    <input type="hidden" name="branch_id" value="{{$customer->branch_id}}">
                                 @endif
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                
                                     <!-- Start Loan Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Loan Information</h6>
                                            <h4 class="text-info" style="text-align:center;">
                                            NET: 
                                                <span class="badge badge-info" style="font-size:19px;"> 
                                                    ₦{{number_format($customer->employment->monthly_net_pay,2)}}
                                                </span>
                                            </h4>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">


                                                            <div class="row">
                                                                     <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group"> 
                                                                           <div class="form-group">
                                                                            <label >Disburesment Bank Name</label>
                                                                            <input type="hidden" name="" value="" >
                                                                            <input type="text" name="disburesment_bank_name" class="form-control" placeholder="Disburesment Bank Name" value="{{ $customer->employment->salary_bank_name }}" readonly  required>
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Account Name</label>
                                                                            <input type="text" name="account_name" class="form-control" placeholder="Bank Name" value="{{ $customer->employment->salary_account_name }}" readonly required>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label >Account Number</label>
                                                                            <input type="number" name="acount_number" class="form-control" placeholder="Account Number" value="{{ $customer->employment->salary_account_number }}" readonly required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label >Loan Officer</label>
                                                                                <input type="hidden" name="loan_officer_id" value="{{$customer->loan_officer->id}}" required>
                                                                                <input  class="form-control  basic" value="{{$customer->loan_officer->first_name}} {{$customer->loan_officer->last_name}} {{$customer->loan_officer->other_name}}"  readonly>
                                                                            </div>
                                                                    </div>

                                                                     <div class="col-sm-6">
                                                                     <div class="form-group"> 
                                                                            <label >Product</label>
                                                                             <select name="product_id" id="product_id" class="form-control  basic" required>
                                                                                @if ($loan)
                                                                                    <option value="{{$loan->product_id}}">{{$loan->product->name}}</option>
                                                                                @endif
                                                                                <option value="">Select Product</option>
                                                                                    @foreach ($products as $product)
                                                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                                                    @endforeach
                                                                            </select>
                                                                            
                                                                             @foreach ($products as $product)
                                                                                     <input type="hidden" id="validate_max{{$product->id}}" value="{{$product->maximum_principal}}" />
                                                                                     <input type="hidden" id="validate_min{{$product->id}}" value="{{$product->minimum_principal}}" />
                                                                             @endforeach
                                                                        </div>
                                                                        <div class="form-group"> 
                                                                            <label >Loan Duration</label>
                                                                            <select name="loan_duration" id="loan_duration" onchange="calMaxLoanOffer()" class="form-control" required>
                                                                                
                                               @if ($loan)
                                                                            <option value="{{$loan->loan_duration_length}}">{{$loan->loan_duration_length}} Months</option>
                                        @else
                                        <option value="">Select Duration</option>
                                        @endif
                                                                                
                                                                                @for ($i = 1; $i < 13; $i++)
                                                                                    <option value="{{$i}}">{{$i}} Months</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Loan Amount</label>
                                                                            <input type="number" name="principal" id="principal" onkeyup="calMaxLoanOffer2()" max="" class="form-control" placeholder="Principal Amount" value="{{$loan ? $loan->principal : '' }}" required>
                                                                            <label id="max_loan_msg" class="text-danger"></label>
                                                                        </div>
                                                                             <div class="form-group">
                                                                                <label>Loan Purpose</label>
                                                                                <textarea name="loan_purpose" class="form-control" placeholder="Loan Purpose" required>{{$loan ? $loan->loan_purpose : '' }}</textarea>
                                                                            </div>
                                                                       
                                                                    </div>

                                                                     <div class="col-sm-6">
                                                                        
                                                                        <div class="form-group"> 
                                                                            <label >Repayment Instrument</label>
                                                                              @include('inc.repayment-instrument')
                                                                              <strong class="text-danger" id="check_box_error"></strong>
                                                                        </div>
                                                                        
                                                                        
                                                                    </div>
                                                                   
                                                                    

                                                                </div>
                                                               </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <!-- End Loan Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                 <a href="{{ url('customer/create/guarantor') }}" class="mr-2 btn btn-primary  html">Previous</a> 
                                 
                                  @if ($loan)
                                                                               <button class="mr-2 btn btn-primary  html" style="float:right;">Save and Next</button>
                                        @else
                                          <button class="mr-2 btn btn-primary  html" style="display:none;" id="next_btn" style="float:right;">Save and Next</button>
                                        @endif
                                        
                               
                                   <strong class="text-danger" id="check_btn_error"></strong>
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>
            
            <input type="hidden" id="net_pay" value="{{$customer->employment->monthly_net_pay}}">
            <input type="hidden" id="max_l_amount" value="{{$customer->employment->monthly_net_pay}}">



<script>

function calMaxLoanOffer(){

  const pro_id = $("#product_id").val();
  
  const net = $("#net_pay").val();
  let input = document.getElementById("principal");
  
  if(!pro_id){
      $("#max_loan_msg").html('Error....select a product');
      $("#principal").val('');
      return true;
  }
  const p_max = $("#validate_max"+pro_id).val();
  const p_min = $("#validate_min"+pro_id).val();
  

    let A = net * 0.4;
    let B = A * parseInt($("#loan_duration").val());
    let C = 0.032 * parseInt($("#loan_duration").val());
    let D = C + 1;
    let E = B / D;
    let d_total = E;
    
//   console.log('Amount :: '+d_total);
// console.log('Max :: '+p_max);
//   console.log('Min :: '+p_min);
  
    
//   let total = net * 0.4;
//   total = total / 1.032;
//   const d_total = total * parseInt($("#loan_duration").val());

  if(parseInt(d_total) > parseInt(p_max)){
      d_total = parseInt(p_max);
     
      console.log('YESSSSSS');
  }

  //console.log('Total:: '+d_total);

  input.setAttribute("max",d_total);
  input.setAttribute("min",p_min);
  $("#max_l_amount").val(d_total);
  $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(d_total));

}
function calMaxLoanOffer2(){

  const duration =  parseInt($("#loan_duration").val());
  let l_amount =  parseInt($("#principal").val());
  let m_l_amount =  parseInt($("#max_l_amount").val());

  
  if(duration > 0){
    
    if(l_amount > m_l_amount){
        $("#principal").val('');
        $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(m_l_amount));
    }else{
        $("#max_loan_msg").html('');
    }

  }else{

      $("#principal").val('');
      $("#max_loan_msg").html('Error... select duration.');
  }

  

}
function putComma(x) {
    //convert to two decimals
    x = x.toFixed(2);
    //put comma
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function countCheck(){

     const num = $("input:checked").length;
    
    var cboxes = document.getElementsByName('repayment_instrument[]');
    var len = cboxes.length;
    var card_validate = 0;
    for (var i=0; i<len; i++) {
        if(cboxes[i].checked && cboxes[i].value == "Card" || cboxes[i].value == "Direct Debit Remitter"){
            card_validate = 1;
        }
 
    }
    
    console.log('::: '+card_validate);
     if(!card_validate){
         let msg = 'You most select Card  or Direct Debit Remitter';
         $("#check_box_error").html(msg);
         $("#check_btn_error").html(msg);
         $("#next_btn").hide();
         return false;
     }else if(parseInt(num) < 2){
         let msg = 'You most select at least two Repayment Instrument';
         $("#check_box_error").html(msg);
         $("#check_btn_error").html(msg);
         $("#next_btn").hide();
     }else{
         $("#check_box_error").html('');
         $("#check_btn_error").html('');
         $("#next_btn").show();
     }
     

}
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
