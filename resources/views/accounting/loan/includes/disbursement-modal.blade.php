
<!-- Loan Disbursement modal -->
<div id="disbursementFormModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Disburse Loan</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                         <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="padding: 2em; display: flex;">
                                                            <div class="swal2-header" style="margin-top:-50px; padding-bottom:-2px;">
                                                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <b class="text-warning">Are you sure you want to disburse this loan?</b>
                                                                        <div class="swal2-icon swal2-success" style="display: none;">
                                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                                                            </div><span class="swal2-success-line-tip"></span> 
                                                                            <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div>
                                                                             <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div>
                                                                    <img class="swal2-image" style="display: none;">
                                                                    
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;"></div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    
                                                                     <form action="{{url('loan/loan/disbursement')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}} 
                                                                        <input type="hidden" name="loan_id" value="{{$data->id}}">
                                                                         <input type="hidden" id="repayment_method" name="repayment_method" value="{{$data->product->repayment_method}}">
                                                                        <input type="hidden" id="loan_duration" name="loan_duration" value="{{$data->product->loan_duration}}">
                                                                        <input type="hidden" id="loan_duration_lenght" name="loan_duration_lenght" value="{{$data->product->loan_duration_lenght}}">
                                                                        
                                                                        <div class="form-row mb-12"  style="text-align:left;">
                                                                           <div class="form-group col-md-10">
                                                                                Actual Disbursement Date 
                                                                                <input id="basicFlatpickr" value="2019-09-04" onChange="calMaturityDate()" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly" required>
                                                                            </div>
                                                                            <div class="form-group col-md-10">
                                                                              First Repayment Date: <b class="text-info" id="text_first_repayment_date"></b>
                                                                              <input type="hidden" id="first_repayment_date" name="first_repayment_date" >
                                                                              <br>
                                                                              Maturity Date: <b class="text-danger" id="text_maturity_date"></b>
                                                                              <input type="hidden" id="maturity_date" name="maturity_date" >
                                                                              <br>
                                                                              Applied Amount: ₦{{number_format($data->principal,2)}}
                                                                            </div>
                                                                             <div class="form-group col-md-10">
                                                                                 <label class="text-danger">Disbursed Amount</label>
                                                                                  <input type="number" name="disbursed_amount" value="{{$data->principal}}" class="form-control" placeholder="Disbursed Amount" required>
                                                                             </div> 
                                                                             <div class="form-group col-md-10">
                                                                                 <label class="text-info">Paymeny Bank</label>
                                                                                 <select class="form-control" name="payment_bank" required>
                                                                                        <option value="">Select Bank</option>
                                                                                       @foreach ($banks as $banks)
                                                                                           <option value="{{$banks->id}}">{{$banks->name}}</option>
                                                                                       @endforeach 
                                                                                 </select>
                                                                             </div>
                                                                        </div>
                                                                        <br>
                                                                         <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                   
                                                                        <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes, Disburse!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End Loan Disbursement modal -->

<script>
function calMaturityDate(){
    const strDate =   document.getElementById('basicFlatpickr').value;
    const l_duration =   document.getElementById('loan_duration').value;
    const durationLenght =   parseInt(document.getElementById('loan_duration_lenght').value);

    //var numOfYears = 1;//parseInt($("#registerfor").val());
    let loanMaturity = '';
    //Calculate the first payment date 
    if(l_duration == "month"){
         loanMaturity = getNum_of_Months(strDate,durationLenght); 
    }else if(l_duration == "year"){
         loanMaturity = getNum_of_Years(strDate,durationLenght);  
    }else{
        
    }
        
    $("#text_maturity_date").html(loanMaturity['stringDate']);
     $("#text_maturity").val(loanMaturity['normalDate']);
    
    //Check if the payment circle is monthly, quaterly or annually and return the next payment date
    const paymentCircle = document.getElementById('repayment_method').value;
    let nextPaymentDay = '';
    //Calculate the first payment date
    if(paymentCircle == "weekly"){

    }else if(paymentCircle == "monthly"){
         nextPaymentDay = getNum_of_Months(strDate,1); 
    }else if(paymentCircle == "quarterly"){
         nextPaymentDay = getNum_of_Months(strDate,3);  
    }else if(paymentCircle == "annually"){
         nextPaymentDay = getNum_of_Months(strDate,12);  
    }else{

    }

     $("#text_first_repayment_date").html(nextPaymentDay['stringDate']);
     $("#first_repayment_date").val(nextPaymentDay['normalDate']);

        
}
//Calculate number of months and return the date
function getNum_of_Months(userDate,months) {
   var dt = new Date(userDate);
    dt.setMonth( dt.getMonth() + months); 
    dt.setDate(dt.getDate() -1); 
    var string_Date = 
        dt.toLocaleString("en", { day: "numeric" }) + ' ' +
        dt.toLocaleString("en", { month: "short"  }) + ' ' +
        dt.toLocaleString("en", { year: "numeric"});
    
     var dd = dt.getDate();
     var mm = dt.getMonth() + 1;
     var y = dt.getFullYear();  

     var n_date = dd + "-" + mm + "-" + y;
         
       return {
        "stringDate": string_Date,
        "normalDate": n_date
    };

 }
 //Calculate number of years and return the date
function getNum_of_Years(userDate,year) {
   var dt = new Date(userDate);
    dt.setFullYear( dt.getFullYear() + year); 
    dt.setDate(dt.getDate() -1); 
    var string_Date = 
        dt.toLocaleString("en", { day: "numeric" }) + ' ' +
        dt.toLocaleString("en", { month: "short"  }) + ' ' +
        dt.toLocaleString("en", { year: "numeric"});
    
     var dd = dt.getDate();
     var mm = dt.getMonth() + 1;
     var y = dt.getFullYear();  

     var n_date = dd + "-" + mm + "-" + y;
         
       return {
        "stringDate": string_Date,
        "normalDate": n_date
    };

 }

 
</script>