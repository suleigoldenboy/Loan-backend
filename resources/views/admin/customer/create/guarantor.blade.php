@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/guarantor')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 @if (session()->get('customer_registration_id'))
                                    <input type="hidden" name="customer_id" value="{{session()->get('customer_registration_id')}}" >
                                 @endif
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                

                              <!-- Start GUARANTOR Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">GUARANTOR'S INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                            <!-- <div class="form-group">
                                                                    <label for="profession">Relationship</label>
                                                                    @include('inc.relationship')
                                                                </div> -->
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group"> 
                                                                            <label >First Name</label>
                                                                            <input type="text" class="form-control mb-4" name="first_name" placeholder="First Name" value="{{$customer ? $customer->first_name : '' }}"  >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Last Name</label>
                                                                            <input type="text" class="form-control mb-4" name="last_name" placeholder="Last Name" value="{{$customer ? $customer->last_name : '' }}"  >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Other Name</label>
                                                                            <input type="text" class="form-control mb-4" name="other_name" placeholder="Other Name" value="{{$customer ? $customer->other_name : '' }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Monthly Income</label>
                                                                            <input type="number"  name="monthly_income" class="form-control" placeholder="Monthly Income" value="{{$customer ? $customer->monthly_income : '' }}" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Age</label>
                                                                            <input type="number" name="age" id="set_age" onkeypress="checkAge();" onkeyup="checkAge();" onblur="checkAge();" class="form-control" placeholder="Age" value="{{$customer ? $customer->age : '' }}" >
                                                                            <strong class="text-danger" id="set_age_error"></strong>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Religion</label>
                                                                            <select  class="form-control mb-4" name="religion" id="religion_add" onChange="setreligionAddress()" >
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->religion}}">{{$customer->religion}}</option>
                                                                                @endif
                                                                                <option value="">Select</option>
                                                                                <option value="Christian">Christian</option>
                                                                                <option value="Islam">Islam</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group" id="div_religion_address" style="{{$customer ? '' : 'display:none;' }}">
                                                                            <label id="text_religion_address">.</label>
                                                                             <input type="text" class="form-control mb-4" name="religion_address" id="religion_address" placeholder="" value="{{$customer ? $customer->religion_address : '' }}" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="email" placeholder="Email Address" value="{{$customer ? $customer->email : '' }}" >
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label >Employment Status</label>
                                                                            <select class="form-control mb-4" name="employment_status" >
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->employment_status}}">{{$customer->employment_status}}</option>
                                                                                @endif
                                                                                <option value="">Select Status</option>
                                                                                <option value="Worker">Worker</option>
                                                                                <option value="Employee">Employee</option>
                                                                                <option value="Self-employed">Self-employed</option>
                                                                                <option value="Retired">Retired</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label >Home Address</label>
                                                                             <textarea name="home_address" class="form-control" placeholder="Home Address" >{{$customer ? $customer->home_address : '' }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Mobile Number</label>
                                                                            <input type="text" class="form-control mb-4" name="phone_number" placeholder="Mobile Number" value="{{$customer ? $customer->phone_number : '' }}" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="dob-input">Occupation</label>
                                                                             <input type="text" class="form-control mb-4" name="occupation" placeholder="Occupation" value="{{$customer ? $customer->occupation : '' }}" >
                                                                        </div>
                                                                        <div class="form-group" id="div_religion_center_name" style="{{$customer ? '' : 'display:none;' }}">
                                                                            <label id="text_religion_center_name">.</label>
                                                                             <input type="text" class="form-control mb-4" name="religion_center_name" id="religion_center_name" placeholder="" value="{{$customer ? $customer->religion_center_name : old('religion_center_name') }}" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Nationality</label>
                                                                            <select  class="form-control mb-4" name="nationality" >
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->nationality}}">{{$customer->nationality}}</option>
                                                                                @endif
                                                                                <option value="">Select</option>
                                                                                @include('inc.country')
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                        <div class="form-group"> 
                                                                          
                                                                        </div>
                                                                        
                                                                    </div>

                                                                <div class="form-group">
                                                                    {{-- <label for="profession">Home Address</label>
                                                                    <textarea name="home_address" class="form-control" placeholder="Home Address" ></textarea> --}}
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- End Guarantor Information-->


                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                 <a href="{{ url('customer/create/employment') }}" class="mr-2 btn btn-primary  html">Previous</a> 
                                 <div class="mr-2 btn btn-primary  html"  id="set_age_error" style="display:none;"></div>
                                 <button class="mr-2 btn btn-primary  html" id="nextBtn" style="float:right;">Save and Next</button> 
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>
function checkAge(){
    const age = document.getElementById('set_age').value;// $("#set_age").val();
    
    if(parseInt(age) > 65){
         $("#set_age_error").html('Error over Age....');
          $("#set_age").val();
          $("#set_age_error").show();
           $("#nextBtn_error").html('Error over Age....');
          $("#nextBtn").hide();
          
    }else{
        $("#set_age_error").html('');
        $("#set_age_error").hide();
        $("#set_age_error").html('');
        $("#nextBtn").show();
    }
}
function setreligionAddress(){
    const type = $("#religion_add").val();

    if(type == "Christian"){
        $("#text_religion_center_name").html('Name of Church');
        $("#text_religion_address").html('Church Address');
    }else if(type == "Islam"){ 
        $("#text_religion_center_name").html('Name of Mosque');
        $("#text_religion_address").html('Mosque Address');

        //document.getElementById("religion_address").placeholder = "Mosque Address";
        //$("#religion_address").attr("placeholder", "Mosque Address").blur();
    }
    $("#div_religion_center_name").show();
    $("#div_religion_address").show();

}
if($customer){
    setreligionAddress();
}
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
