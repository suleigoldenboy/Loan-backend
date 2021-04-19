@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/generationinfo')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                  
                              <!-- Start General Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">PERSONAL  INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                 @if ($customer)
        <input type="file" id="input-file-max-fs" class="dropify" name="avatar" data-default-file="{{ asset('customerfiles/profilepicture')}}/{{$customer->avatar}}" data-max-file-size="2M"/>
        <input type="hidden" name="old_avatar" value="{{$customer->avatar}}">
         <input type="file" name="new_avatar">
                                                                 @else
                                                                     <input type="file" id="input-file-max-fs" class="dropify" name="avatar" data-default-file="{{ asset('assets/img/user-profile.jpeg') }}" data-max-file-size="2M" required/>
                                                                 @endif
                                                                <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                            <div class="form-group">
                                                                    <label for="profession">Branch</label> 
                                        @if(can('Branch Registration'))
                                                                        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}" required>
                                                                        <input type="text"  value="{{Auth::user()->branch->title}} {{Auth::user()->branch->state}}" class="form-control  basic" readonly required>
                                                                        
                                                                     @else
                                                                        <select name="branch_id" class="form-control  basic" required>
                                                                            @if ($customer)
                                                                                <option value="{{$customer->branch_id}}">{{$customer->branch->state}} {{$customer->branch->title}}</option>
                                                                            @endif
                                                                             <option value="">Select Branch</option>
                                                                            @foreach ($branches as $branch)
                                                                                <option value="{{$branch->id}}">{{$branch->state}} - {{$branch->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                     @endif
                                                                     
                                                                </div>
                                                                <div class="form-group">
                                                                    <label >Loan Officer</label>
                           @if(can('Branch Registration'))
                                                                        <input type="hidden" name="loan_officer_id" value="{{Auth::user()->id}}" required>
                                                                        <input type="text"  value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" class="form-control  basic" readonly required>
                                                                        
                                                                     @else
                                                                        <select name="loan_officer_id" class="form-control  basic" required>
                                                                        @if ($customer)
                                                                            <option value="{{$customer->loan_officer_id}}">{{$customer->loan_officer->first_name}} {{$customer->loan_officer->last_name}} {{$customer->loan_officer->other_name}}</option>
                                                                        @endif 
                                                                        <option value="">Select Loan Officer</option>
                                                                            @foreach ($loan_officers as $emp)
                                                                                <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                   @endif
                                                                </div>
                                                                <div class="row">
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >First Name</label>
                                                                            <input type="text" class="form-control mb-4" name="first_name" placeholder="First Name" value="{{$customer ? $customer->first_name : old('first_name') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Other Name</label>
                                                                            <input type="text" class="form-control mb-4" name="other_name" placeholder="Other Name" value="{{$customer ? $customer->other_name : old('other_name')  }}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Mobile Number</label>
                                                                            <input type="text" class="form-control mb-4" name="phone_number" placeholder="Mobile Number" value="{{$customer ? $customer->phone_number : old('phone_number') }}" required>
                                                                            @if ($errors->has('phone_number'))
                                                                                <strong class="text-danger">{{ $errors->first('phone_number') }}</strong>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Gender</label>
                                                                            <select  class="form-control mb-4" name="gender" required>
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->gender}}">{{$customer->gender}}</option>
                                                                                @endif
                                                                                <option value="{{ old('gender') ? old('gender') : ''}}">{{ old('gender') ? old('gender') : 'Select'}}</option>
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group" id="div_religion_center_name" style="{{$customer ? '' : 'display:none;' }}">
                                                                            <label id="text_religion_center_name">.</label>
                                                                             <input type="text" class="form-control mb-4" name="religion_center_name" id="religion_center_name" placeholder="" value="{{$customer ? $customer->religion_center_name : old('religion_center_name') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Marital Status</label>
                                                                            <select  class="form-control mb-4" name="marital_status" required>
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->marital_status}}">{{$customer->marital_status}}</option>
                                                                                @endif
                                                                                <option value="{{ old('marital_status') ? old('marital_status') : ''}}">{{ old('marital_status') ? old('marital_status') : 'Select'}}</option>
                                                                                <option value="Married">Married</option>
                                                                                <option value="Single">Single</option>
                                                                            </select>
                                                                        </div>
                                                                      <div class="form-group">
                                                                            <label for="">Occupation</label>
                                                                            <input type="text" class="form-control mb-4" name="occupation" placeholder="Occupation" value="{{$customer ? $customer->occupation : old('occupation')  }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Last Name</label>
                                                                            <input type="text" class="form-control mb-4" name="last_name" placeholder="Last Name" value="{{$customer ? $customer->last_name : old('last_name') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="email" placeholder="Email Address" value="{{$customer ? $customer->email : old('email') }}" required>
                                                                             @if ($errors->has('email'))
                                                                             <span class="text-danger">{{ $errors->first('email') }}</span>
                                                                             @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="dob-input">Date of Birth</label>
                                                                            <input id="basicFlatpickr" name="date_of_birth" onChange="calculateAge()" value="{{$customer ? $customer->date_of_birth : old('date_of_birth') }}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly" required>
                                                                            <strong class="text-danger" id="ageErrorMsg"></strong>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Religion</label>
                                                                            <select  class="form-control mb-4" name="religion" id="religion_add" onChange="setreligionAddress()" required>
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->religion}}">{{$customer->religion}}</option>
                                                                                @endif
                                                                                <option value="{{ old('religion') ? old('religion') : ''}}">{{ old('religion') ? old('religion') : 'Select'}}</option>
                                                                                <option value="Christian">Christian</option>
                                                                                <option value="Islam">Islam</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group" id="div_religion_address" style="{{$customer ? '' : 'display:none;' }}">
                                                                            <label id="text_religion_address">.</label>
                                                                             <input type="text" class="form-control mb-4" name="religion_address" id="religion_address" placeholder="" value="{{$customer ? $customer->religion_address : '' }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <label  class="input_label">ID Card Type</label>
                                                                        <select name="id_card_type" id="id_card_type" class="form-control mb-4" required>
                                                                                @if ($customer)
                                                                                    <option value="{{$customer->id_card_type}}">{{$customer->id_card_type}}</option>
                                                                                @endif
                                                                                <option value="{{ old('id_card_type') ? old('id_card_type') : ''}}">{{ old('id_card_type') ? old('id_card_type') : 'Select'}}</option>
                                                                                <option value="Drivers Licence">Drivers Licence</option>
                                                                                <option value="Voters Card">Voters Card</option>
                                                                                <option value="International Passport">International Passport</option>
                                                                                <option value="National ID Card">National ID Card</option>
                                                                                <option value="Others">Others</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label >ID Card Number</label>
                                                                            <input type="text" class="form-control mb-4" name="id_card_number" placeholder="ID Card Number" value="{{$customer ? $customer->id_card_number : old('id_card_number') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label >Home Address</label>
                                                                            <textarea class="form-control mb-4" name="address" placeholder="Home Address" required>{{$customer ? $customer->address : old('address') }}</textarea>
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
                              <!-- End General Information-->


                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="errorMsg"></div>      
                                 {{-- <a href="{{ url()->previous() }}" class="mr-2 btn btn-primary  html">Previous</a>  --}}
                                 <button class="mr-2 btn btn-primary  html" id="submitBtn" style="float:right;">Save and Next</button> 
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>

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
 function calculateAge(){
    var dbo = document.getElementById("basicFlatpickr").value;
    const getAge = birthDate => Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e+10)

    var checkAge = getAge(dbo);

    if (parseInt(checkAge) < 22) {
      document.getElementById("submitBtn").style.display = 'none';//$('#submitBtn').hid();
      $('#ageErrorMsg').html('<h4 style="color:#F00;">Error...Under Age</h4>');
      $('#errorMsg').html('<h4 style="color:#F00;">Error...Under Age</h4>');
    }else  if (parseInt(checkAge) > 65) {
      document.getElementById("submitBtn").style.display = 'none';//$('#submitBtn').hid();
      $('#ageErrorMsg').html('<h4 style="color:#F00;">Error...Over Age</h4>');
      $('#errorMsg').html('<h4 style="color:#F00;">Error...Over Age</h4>');
    }else{
        $('#ageErrorMsg').html(''); $('#errorMsg').html('');
      document.getElementById("submitBtn").style.display = 'block';//$('#submitBtn').show();
    }
    console.log(getAge(checkAge));

  }
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
