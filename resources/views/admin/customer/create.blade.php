@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store')}}" method="POST" id="actionForm" enctype="multipart/form-data">
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
                                                                <input type="file" id="input-file-max-fs" class="dropify" name="avatar" data-default-file="{{ asset('assets/img/user-profile.jpeg') }}" data-max-file-size="2M" />
                                                                <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                            <div class="form-group">
                                                                    <label for="profession">Branch</label>
                                                                     <select name="branch" class="form-control  basic" required>
                                                                        @foreach ($branches as $branch)
                                                                            <option value="{{$branch->id}}">{{$branch->state}} - {{$branch->title}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="row">
                                                                    
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >First Name</label>
                                                                            <input type="text" class="form-control mb-4" name="first_name" placeholder="First Name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Other Name</label>
                                                                            <input type="text" class="form-control mb-4" name="other_name" placeholder="Other Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Mobile Number</label>
                                                                            <input type="text" class="form-control mb-4" name="phone_number" placeholder="Mobile Number" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Gender</label>
                                                                            <select  class="form-control mb-4" name="gender" required>
                                                                                <option value="">Select</option>
                                                                                <option value="Male">Male</option>
                                                                                <option value="Female">Female</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Marital Status</label>
                                                                            <select  class="form-control mb-4" name="marital_status" required>
                                                                                <option value="">Select</option>
                                                                                <option value="Married">Married</option>
                                                                                <option value="Single">Single</option>
                                                                            </select>
                                                                        </div>
                                                                      <div class="form-group">
                                                                            <label for="">Occupation</label>
                                                                            <input type="text" class="form-control mb-4" name="occupation" placeholder="Occupation">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Last Name</label>
                                                                            <input type="text" class="form-control mb-4" name="last_name" placeholder="Last Name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="email" placeholder="Email Address" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="dob-input">Date of Birth</label>
                                                                            <input id="basicFlatpickr" name="date_of_birth" value="2019-09-04" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.." readonly="readonly" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Religion</label>
                                                                            <select  class="form-control mb-4" name="religion" required>
                                                                                <option value="">Select</option>
                                                                                <option value="Christian">Christian</option>
                                                                                <option value="Islam">Islam</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                        <label  class="input_label">ID Card Type</label>
                                                                        <select name="id_card" id="id_card" class="form-control mb-4" required>
                                                                                <option value="">Select</option>
                                                                                <option value="Drivers Licence">Drivers Licence</option>
                                                                                <option value="Voters Card">Voters Card</option>
                                                                                <option value="International Passport">International Passport</option>
                                                                                <option value="National ID Card">National ID Card</option>
                                                                                <option value="Others">Others</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                            <label >ID Card Number</label>
                                                                            <input type="text" class="form-control mb-4" name="id_card_number" placeholder="ID Card Number">
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



                              <!-- Start Employer/Business information-->
                               <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">EMPLOYEE/BUSINESS INFORMATION</h6>
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label >BVN</label>
                                                    <input type="number" name="bvn" class="form-control" placeholder="BVN" required>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                           <ul class="nav nav-pills mb-3 mt-3 nav-fill" id="justify-pills-tab" role="tablist">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active" id="justify-pills-home-tab" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">SELF EMPLOYED</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">EMPLOYED</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="justify-pills-contact-tab" data-toggle="pill" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">RETIRED</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" id="justify-pills-student-tab" data-toggle="pill" href="#justify-pills-student" role="tab" aria-controls="justify-pills-student" aria-selected="false">STUDENT</a>
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content" id="justify-pills-tabContent">
                                                                <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                                                                     <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label >RC/BN</label>
                                                                                    <input type="text" name="rcbn" class="form-control" placeholder="RC/BN Number">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Address</label>
                                                                                    <input type="text" name="address" class="form-control" placeholder="Address">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Number</label>
                                                                                    <input type="number" name="number" class="form-control" placeholder="Number">
                                                                                </div>
                                                                                {{-- <div class="form-group">
                                                                                    <label >BVN</label>
                                                                                    <input type="number" name="bvn" class="form-control" placeholder="BVN" required>
                                                                                </div> --}}
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label >Beneficiary Bank</label>
                                                                                    <input type="text" name="beneficiary_bank" class="form-control" placeholder="Beneficiary Bank">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Account Number</label>
                                                                                    <input type="number" name="account_number" class="form-control" placeholder="Account Number">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Monthly Profit</label>
                                                                                    <input type="text" name="monthly_profit" class="form-control" placeholder="Monthly Profit">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Date of Inc/Reg</label>
                                                                                    <input type="number"  name="date_of_inc" class="form-control" placeholder="Date of Inc/Reg">
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label >Monthly Gross Salary</label>
                                                                                <input type="number" name="monthly_gross_salary" class="form-control" placeholder="Monthly Gross Salary">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Monthly Net Pay</label>
                                                                                <input type="number" name="monthly_net_pay" class="form-control" placeholder="Monthly Net Pay">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Pay Day</label>
                                                                                <input type="number" name="salary_pay_day" class="form-control" placeholder="Pay day">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                             <div class="form-group">
                                                                                <label >Salary Bank Name </label>
                                                                                <input type="text" name="salary_bank_name" class="form-control" placeholder="salary_bank_name">
                                                                            </div>
                                                                             <div class="form-group">
                                                                                <label >Account Name</label>
                                                                                <input type="text" name="salary_account_name" class="form-control" placeholder="Account Name">
                                                                            </div>
                                                                             <div class="form-group">
                                                                                <label >Account Number</label>
                                                                                <input type="number" name="salary_account_number" class="form-control" placeholder="Account Number">
                                                                            </div>
                                                                             {{-- <div class="form-group">
                                                                                <label >BVN</label>
                                                                                <input type="number" name="bvn" class="form-control" placeholder="BVN" required>
                                                                            </div> --}}
                                                                             <div class="form-group">
                                                                                <label >Employer Phone Number</label>
                                                                                <input type="text" name="employer_phone_number" class="form-control" placeholder="Phone Number">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Employer Email Address</label>
                                                                                <input type="email" name="employer_email" class="form-control" placeholder="Email Address">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                 <div class="form-group">
                                                                                    <label >Started Date </label>
                                                                                    <input type="date" name="retired_start_date" class="form-control" placeholder="Started Date">
                                                                                </div>
                                                                                 <div class="form-group">
                                                                                    <label >Retired Date</label>
                                                                                    <input type="date" name="retired_end_date" class="form-control" placeholder="StartRetired Date">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >BVN</label>
                                                                                    <input type="number" name="bvn" class="form-control" placeholder="BVN">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Pension Number(Opional)</label>
                                                                                    <input type="number" name="pension_number" class="form-control" placeholder="Account Number">
                                                                                </div>
                                                                             </div>
                                                                             <div class="col-sm-6">
                                                                                 <div class="form-group">
                                                                                <label >Name of Institution Retired From</label>
                                                                                    <input type="text" name="name_of_institution_retired_from" class="form-control" placeholder="Name of Institution Retired From">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Pension Paying Institute</label>
                                                                                    <input type="number" name="pension_paying_institute" class="form-control" placeholder="Pension Paying Institute">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Pension Bank</label>
                                                                                    <input type="text" name="pension_bank" class="form-control" placeholder="Pension Bank">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label >Monnthly Pension Amount</label>
                                                                                    <input type="text" name="monnthly_pension_amount" class="form-control" placeholder="monthly pension amount">
                                                                                </div>
                                                                             </div>
                                                                        </div>
                                                                </div>
                                                                <div class="tab-pane fade" id="justify-pills-student" role="tabpanel" aria-labelledby="justify-pills-student-tab">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label >Student Name</label>
                                                                                <input type="text" name="student_name" class="form-control" placeholder="Student Name">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Current Level</label>
                                                                                <select name="current_level" class="form-control">
                                                                                    <option>Select</option>
                                                                                    @for ($i = 1; $i < 11; $i++)
                                                                                        <option value="{{$i}}">Level {{$i}}</option>
                                                                                    @endfor
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Parent Full Name</label>
                                                                                <input type="text" name="parent_aneme" class="form-control" placeholder="Parent Full Name">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Parent Address</label>
                                                                                <input type="text" name="parent_address" class="form-control" placeholder="Parent Address">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label >Name of School</label>
                                                                                <input type="text" name="name_of_school" class="form-control" placeholder="Name of School">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >School Address</label>
                                                                                <input type="text" name="school_address" class="form-control" placeholder="School Address">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Name of department</label>
                                                                                <input type="text" name="name_of_department" class="form-control" placeholder="Name of department">
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
                              <!-- End Employer/Business information-->





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
                                                                            <input type="text" class="form-control mb-4" name="g_first_name" placeholder="First Name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >First Name</label>
                                                                            <input type="text" class="form-control mb-4" name="g_last_name" placeholder="Last Name" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Other Name</label>
                                                                            <input type="text" class="form-control mb-4" name="g_other_name" placeholder="Other Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Monthly Income</label>
                                                                            <input type="number" step="0.1" name="monthlyincome" class="form-control" placeholder="Monthly Income" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Age</label>
                                                                            <input type="number" step="0.1" name="payday" class="form-control" placeholder="Age" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Religion</label>
                                                                            <select  class="form-control mb-4" name="g_religion" required>
                                                                                <option value="">Select</option>
                                                                                <option value="Christian">Christian</option>
                                                                                <option value="Islam">Islam</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="g_email" placeholder="Email Address" required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label >Employment Status</label>
                                                                            <input type="email" class="form-control mb-4" name="g_email" placeholder="Email Address" required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label >Email</label>
                                                                            <input type="email" class="form-control mb-4" name="g_email" placeholder="Email Address" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Mobile Number</label>
                                                                            <input type="text" class="form-control mb-4" name="g_phone_number" placeholder="Mobile Number" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="dob-input">Occupation</label>
                                                                             <input type="text" class="form-control mb-4" name="g_occupation" placeholder="Occupation" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Nationality</label>
                                                                            <select  class="form-control mb-4" name="g_nationality" required>
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
                                                                    <label for="profession">Home Address</label>
                                                                    <textarea name="g_home_address" class="form-control" placeholder="Home Address" required></textarea>
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

                                <!-- Start Loan Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Loan Information</h6>
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
                                                                            <input type="text" step="0.1" name="nameofinstitution" class="form-control" placeholder="Disburesment Bank Name" required>
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Account Name</label>
                                                                            <input type="text" step="0.1" name="pensionpaying" class="form-control" placeholder="Bank Name" required>
                                                                        </div>
                                                                    </div>

                                                                     <div class="col-sm-6">
                                                                        <div class="form-group"> 
                                                                           <div class="form-group">
                                                                            <label >Account Number</label>
                                                                            <input type="number" step="0.1" name="acountnumber" class="form-control" placeholder="Account Number" required>
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label >Principal Amount</label>
                                                                            <input type="number" step="0.1" name="pricipalamount" class="form-control" placeholder="Principal Amount" required>
                                                                        </div>
                                                                       
                                                                    </div>

                                                                     <div class="col-sm-6">
                                                                        <div class="form-group"> 
                                                                           <div class="form-group">
                                                                            <label >Repayment Method</label>
                                                                            <input type="number" step="0.1" name="repaymentmethod" class="form-control" placeholder="Repayment Method">
                                                                        </div>
                                                                        </div>
                                                                         
                                                                    </div>

                                                                     <div class="col-sm-6">
                                                                         
                                                                        <div class="form-group">
                                                                            <label >Loan Duration</label>
                                                                            <input type="text" step="0.1" name="loanduarion" class="form-control" placeholder="Loan Duration" required>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                     <div class="col-sm-6">
                                                                        <div class="form-group"> 
                                                                            <label >Product</label>
                                                                             <select name="product_id" class="form-control  basic" required>
                                                                                    @foreach ($products as $product)
                                                                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                                                                    @endforeach
                                                                            </select>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                            <label >Loan Officer</label>
                                                                            <select name="loan_officer_id" class="form-control  basic" required>
                                                                                @foreach ($loan_officers as $emp)
                                                                                    <option value="{{$emp->id}}" title="">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                         </div>
                                                                    

                                                                </div>
                                        </div>




                                                            <div class="form">
                                                                <div class="row">
                                                                   
                                                                        
                                                                    
                                                                    <div class="col-sm-6">
                                                                        





                                                                        <div class="form-group">
                                                                            <label>Loan Purpose</label>
                                                                            <textarea name="loan_purpose" class="form-control" placeholder="Loan Purpose" required></textarea>
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

                               <!-- Start Files Information-->
                             <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Files Upload</h6>
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
                                                                    <div class="col-sm-12">
                                                                         <div id="fuMultipleFile" class="col-lg-12 layout-spacing">
                                                                            <div class="statbox widget box box-shadow">
                                                                               
                                                                                   <div class="row" style="padding-left:7px;">
                                                                                         <div class="form-group">
                                                                                            <label >ID Card</label>
                                                                                            <input type="file" name="id_card" class="form-control">
                                                                                        </div>
                                                                                         <div class="form-group">
                                                                                            <label >Bank Statement</label>
                                                                                            <input type="file" name="bank_statement" class="form-control">
                                                                                        </div>
                                                                                         <div class="form-group">
                                                                                            <label >Utility bill</label>
                                                                                            <input type="file" name="utility_bill" class="form-control">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label >Others</label>
                                                                                            <input type="file" name="other_files" class="form-control">
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
                                        </div>
                                    </div>
                                </div>
                               <!-- End Files Information-->

                              
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                 
                                 
                                {{-- <button class="mr-2 btn btn-primary  html">Submit</button> --}}
                                <a class="mr-2 btn btn-primary  html" data-toggle="modal" data-target="#zoomupModal">Submit</a>
                                    @include('inc.submit-btn-warning')
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
