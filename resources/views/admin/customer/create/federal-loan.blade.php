@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/federal')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                  
                              <!-- Start General Information-->
                              @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                        <h3 class="text-secondary" style="text-align:center;">CREATE FEDERAL LOAN</h3>
                                     
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
                                                               
                                                                 <input type="hidden" name="customer_update_id" value="{{$customer ? $customer->id : 000 }}" required>
                                                               
                                                            <div class="form-group">
                                                                    <!-- <label for="profession">Branch</label>  -->
                                        @if(can('Branch Registration'))
                                                                        <input type="hidden" name="branch_id" value="{{Auth::user()->branch_id}}" required>
                                                                        
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
                           
                                                                    <input type="hidden" name="loan_officer_id" value="{{Auth::user()->id}}" required>
                                                                        <input type="text"  value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" class="form-control" readonly required>
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
                                                                            <label class="dob-input">Date of Birth</label>
                                                                            <input id="basicFlatpickr" name="date_of_birth" onChange="calculateAge()" value="{{$customer ? $customer->date_of_birth : old('date_of_birth') }}" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly" required>
                                                                            <strong class="text-danger" id="ageErrorMsg"></strong>
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
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- End General Information-->

                                 <!-- Start contact Information-->
                                 <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">CONTACT  INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                          
                                                                <div class="row">
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Mobile Number</label>
                                                                            <input type="text" class="form-control mb-4" name="phone_number" placeholder="Mobile Number" value="{{$customer ? $customer->phone_number : old('phone_number') }}" required>
                                                                            @if ($errors->has('phone_number'))
                                                                                <strong class="text-danger">{{ $errors->first('phone_number') }}</strong>
                                                                            @endif
                                                                    </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="email" placeholder="Email Address" value="{{$customer ? $customer->email : old('email') }}" required>
                                                                             @if ($errors->has('email'))
                                                                             <span class="text-danger">{{ $errors->first('email') }}</span>
                                                                             @endif
                                                                        </div>
                                                                    </div>
                                                                <div class="col-sm-12">
                                                                    @include('inc.all_state_lga')
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
                              <!-- End contact Information-->
                              <!-- Start next of kin Information-->
                              <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="margin-top:20px;">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">NEXT OF KIN  INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                          
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                      <div class="form-group">
                                                                            <label >First Name</label>
                                                                            <input type="text" class="form-control mb-4" name="next_of_kin_first_name" placeholder="First Name" value="{{$nextOfKin ? $nextOfKin->first_name : old('next_of_kin_first_name') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Mobile Number</label>
                                                                            <input type="text" class="form-control mb-4" name="next_of_kin_phone_number" placeholder="Mobile Number" value="{{$nextOfKin ? $nextOfKin->phone_number : old('next_of_kin_phone_number') }}" required>
                                                                            @if ($errors->has('next_of_kin_phone_number'))
                                                                                <strong class="text-danger">{{ $errors->first('next_of_kin_phone_number') }}</strong>
                                                                            @endif
                                                                       </div>
                                                                       <div class="form-group">
                                                                            <label >Relationship</label>
                                                                            <input type="text" class="form-control mb-4" name="next_of_kin_relationship" placeholder="Relationship" value="{{$nextOfKin ? $nextOfKin->relationship : old('next_of_kin_relationship') }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                            <label >Last Name</label>
                                                                            <input type="text" class="form-control mb-4" name="next_of_kin_last_name" placeholder="Last Name" value="{{$nextOfKin ? $nextOfKin->last_name : old('next_of_kin_last_name') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="next_of_kin_email" placeholder="Email Address" value="{{$nextOfKin ? $nextOfKin->email : old('next_of_kin_email') }}" required>
                                                                             @if ($errors->has('next_of_kin_email'))
                                                                             <span class="text-danger">{{ $errors->first('next_of_kin_email') }}</span>
                                                                             @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Occupation</label>
                                                                            <input type="text" class="form-control mb-4" name="next_of_kin_occupation" placeholder="Occupation" value="{{$nextOfKin ? $nextOfKin->occupation : old('next_of_kin_occupation')  }}">
                                                                        </div>
                                                                    </div>
                                                               
                                                                <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label >Home Address</label>
                                                                            <textarea class="form-control mb-4" name="next_of_kin_address" placeholder="Home Address" required>{{$nextOfKin ? $nextOfKin->address : old('next_of_kin_address') }}</textarea>
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
                              <!-- End next of kin Information-->
                                <!-- Start Employement Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="margin-top:20px;">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">EMPLOYMENT INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                          
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                      <div class="form-group">
                                                                            <label >IPPIS NUMBER</label>
                                                                            <input type="text" class="form-control mb-4" name="iips" placeholder="IPPIS NUMBER" value="{{$employment ? $employment->iips : old('iips') }}"  required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Ministry/MDA</label>
                                                                            <select name="ministry_mda" class="form-control basic" required>
                                                                                @if($employment)
                                                                                <option value="{{$employment->ministry_mda}}">{{$employment->ministry_mda}}</option>
                                                                                @endif
                                                                            @include('inc.ministry-list')
                                                                            </select>
                                                                       </div>
                                                                       
                                                                       
                                                                       <!--<div class="form-group">-->
                                                                       <!--      <label>Other Ministry</label>-->
                                                                       <!--    <input type="text" class="form-control basic" name="ministry_mda" placeholder="Enter ministry not in list">-->
                                                                       <!--</div>-->
                                                                          
                                                                      
                                                                        <!--addition end-->
                                                                       
                                                                       <div class="form-group">
                                                                            <label >Department</label>
                                                                            <input type="text" class="form-control mb-4" name="employment_department" placeholder="Department" value="{{$employment ? $employment->employment_department : old('department') }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                            <label >NET INCOME</label>
                                                                            <input type="number" class="form-control mb-4" name="monthly_net_pay" placeholder="NET INCOME" step="0.1" value="{{$employment ? $employment->monthly_net_pay : old('monthly_net_pay') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label >Pay Day</label>
                                                                                <select name="salary_pay_day" class="form-control" required>
                                                                                    @if ($employment)
                                                                                        <option value="{{$employment->salary_pay_day}}">day {{$employment->salary_pay_day}}</option>
                                                                                    @endif
                                                                                    <option value="">Select</option>
                                                                                    @for ($i = 1; $i < 32; $i++)
                                                                                     <option value="{{$i}}">day {{$i}}</option>
                                                                                    @endfor
                                                                                </select>
                                                                            </div>
                                                                        <div class="form-group">
                                                                            <label for="">Employement Date</label>
                                                                            <input type="date" class="form-control mb-4" name="joined_date" required>
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
                              <!-- End Employement Information-->
                                
                                 <!-- Start Loan Information-->
                                 <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="margin-top:20px;">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">LOAN INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                          
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Disburesment Bank Name</label>
                                                                            <select name="disburesment_bank_name" class="form-control  basic" required>
                                                                            @if($loan && $loan->loans_with_other_banks)
                                                                                <option value="{{$loan->disburesment_bank_name}}">{{$loan->disburesment_bank_name}}</option>
                                                                            @endif
                                                                            @include('inc.bank-list')
                                                                            </select>
                                                                            
                                                                           <!--<br> <label >Other Bank</label>-->
                                                                           <!--<input type="text" class="form-control basic" name="disburesment_bank_name" placeholder="Enter bank not in list">-->
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Account Name</label>
                                                                            <input type="text" name="salary_account_name" class="form-control" value="{{$employment ? $employment->salary_account_name : old('salary_account_name') }}"  placeholder="Bank Name" required>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label >Account Number</label>
                                                                            <input type="number" name="salary_account_number" class="form-control" value="{{$employment ? $employment->salary_account_number : old('salary_account_name') }}"  placeholder="Account Number" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >BVN</label>
                                                                            <input type="number" name="bvn" class="form-control" placeholder="BVN"  value="{{$employment ? $employment->bvn : old('bvn') }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <!-- <label >Collateral</label>
                                                                            <input type="text" name="collateral" class="form-control" placeholder="Collateral"> -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group"> 
                                                                            <label >Product</label>
                                                                             <select name="product_id" id="product_id" class="form-control" required>
                                                                               
                                                                                    @foreach ($products as $product)
                                                                                        @if($product->id == 4)
                                                                                         <option value="{{$product->id}}">{{$product->name}}</option>
                                                                                        @endif
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
                                                                                 <option value="{{$loan ? $loan->loan_duration_length : '' }}">{{$loan ? $loan->loan_duration_length : "Select Duration" }}</option>
                                                                                @for ($i = 6; $i < 19; $i++)
                                                                                    <option value="{{$i}}">{{$i}} Months</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Loan Amount</label>
                                                                            <input type="number" name="principal" id="principal" onkeyup="calMaxLoanOffer2()" max="" value="{{$loan ? $loan->principal : old('principal') }}" class="form-control" placeholder="Principal Amount" required>
                                                                            <label id="max_loan_msg" class="text-danger"></label>
                                                                        </div>
                                                                        <div class="form-group"> 
                                                                            <label >Loans with other Banks?</label>
                                                                             <select name="loans_with_other_banks" class="form-control  basic" required>
                                                                            @if($loan && $loan->loans_with_other_banks)
                                                                                <option value="{{$loan->loans_with_other_banks}}">{{$loan->loans_with_other_banks}}</option>
                                                                            @endif
                                                                             <option value="">Select</option>
                                                                             <option value="YES">YES</option>
                                                                             <option value="NO">NO</option>
                                                                             
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>Loan Purpose</label>
                                                                                <textarea name="loan_purpose" class="form-control" placeholder="Loan Purpose" required>{{$loan ? $loan->loan_purpose : old('loan_purpose') }}</textarea>
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
                                   <!-- Start File Upload -->
                               <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="margin-top:20px;">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">File Uploads</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                          
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                                            <label >File Uploads <b class="text-danger" style="font-size:22px;">*</b></label>
                                                                                                @if ($employment)
                                                                                                <input type="file" name="file_uploads" class="form-control-file" >
                                                                                                @else
                                                                                                <input type="file" name="file_uploads"  class="form-control-file" required>
                                                                                                @endif
                                                                                                @if ($employment)
                                                                                                    <input type="hidden" name="old_file_uploads" value="{{$employment->file_uploads}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($employment->file_uploads, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_file_uploads">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->file_uploads}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_file_uploads">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_file_uploads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->file_uploads}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            
                                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                                            <label >Others</label>
                                                                                            <input type="file" name="other_files" class="form-control-file">
                                                                                                @if ($employment)
                                                                                                    <input type="hidden" name="old_other_files" value="{{$employment->other_files}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($employment->other_files, '.'), '.') == "pdf")

                                                                                                        <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_other_files">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$employment->other_files}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_other_files">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_other_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$employment->other_files}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                            
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
                              <!-- End File Upload-->
                                
                                


                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="margin-top:20px;">
                                    <div id="errorMsg"></div>      
                                 <button type="submit" class="mr-2 btn btn-primary  html" id="submitBtn" style="float:right;">Submit</button> 
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>

var ss = $(".basic").select2({
    tags: true,
});

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
