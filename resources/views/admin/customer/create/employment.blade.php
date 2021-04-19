@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('customer/store/employment')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                 @if (session()->get('customer_registration_id'))
                                    <input type="hidden" name="customer_id" value="{{session()->get('customer_registration_id')}}" >
                                 @endif
                                
                                <input type="hidden" name="employment_status" id="employment_status" value="{{$customer ? $customer->employment_status : 'SELF EMPLOYED' }}">

                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                              <!-- Start Employer/Business information-->
                               <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">EMPLOYEE/BUSINESS INFORMATION</h6>
                                            <div class="row" style="background-color:#ebedf2; Padding:7px;">
                                            <div class="col-md-2"></div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="text-info">BVN</label>
                                                        <input type="number" name="bvn" class="form-control" placeholder="BVN" value="{{$customer ? $customer->bvn : '' }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-info">Disbursement Account Name</label>
                                                        <input type="text" name="salary_account_name" class="form-control" placeholder="Account Name" value="{{$customer ? $customer->salary_account_name : '' }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                     <div class="form-group">
                                                        <label class="text-info">Disbursement Bank Name </label>
                                                         <select name="salary_bank_name" class="form-control" required>
                                                            @if ($customer)
                                                                <option value="{{$customer->salary_bank_name}}">{{$customer->salary_bank_name}}</option>
                                                            @endif
                                                            @include('inc.bank-list')
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-info">Account Number</label>
                                                        <input type="number" name="salary_account_number" class="form-control" placeholder="Account Number" value="{{$customer ? $customer->salary_account_number : '' }}" required>
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
                                                                    @if ($customer)
                                            <a class="nav-link {{$customer->employment_status == 'SELF EMPLOYED' ? 'active' : '' }}" id="justify-pills-home-tab" onClick="setEmploymentStatus('SELF EMPLOYED')" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">SELF EMPLOYED</a>
                                                                    @else
                                                                        <a class="nav-link active" id="justify-pills-home-tab" onClick="setEmploymentStatus('SELF EMPLOYED')" data-toggle="pill" href="#justify-pills-home" role="tab" aria-controls="justify-pills-home" aria-selected="true">SELF EMPLOYED</a>
                                                                    @endif
                                                                </li>
                                                                <li class="nav-item">
                                                                    @if ($customer)
                                                                         <a class="nav-link {{$customer->employment_status == 'EMPLOYED' ? 'active' : '' }}" id="justify-pills-profile-tab" data-toggle="pill" onClick="setEmploymentStatus('EMPLOYED')" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">EMPLOYED</a>
                                                                    @else
                                                                        <a class="nav-link" id="justify-pills-profile-tab" data-toggle="pill" onClick="setEmploymentStatus('EMPLOYED')" href="#justify-pills-profile" role="tab" aria-controls="justify-pills-profile" aria-selected="false">EMPLOYED</a>
                                                                    @endif
                                                                </li>
                                                                <li class="nav-item">
                                                                    @if ($customer)
                                                                        <a class="nav-link {{$customer->employment_status == 'RETIRED' ? 'active' : '' }}" id="justify-pills-contact-tab" data-toggle="pill" onClick="setEmploymentStatus('RETIRED')" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">RETIRED</a>
                                                                    @else
                                                                        <a class="nav-link" id="justify-pills-contact-tab" data-toggle="pill" onClick="setEmploymentStatus('RETIRED')" href="#justify-pills-contact" role="tab" aria-controls="justify-pills-contact" aria-selected="false">RETIRED</a>
                                                                    @endif
                                                                </li>
                                                                <li class="nav-item">
                                                                    @if ($customer)
                                                                        <a class="nav-link {{$customer->employment_status == 'STUDENT' ? 'active' : '' }}" id="justify-pills-student-tab" data-toggle="pill" onClick="setEmploymentStatus('STUDENT')" href="#justify-pills-student" role="tab" aria-controls="justify-pills-student" aria-selected="false">STUDENT</a>
                                                                    @else
                                                                        <a class="nav-link" id="justify-pills-student-tab" data-toggle="pill" onClick="setEmploymentStatus('STUDENT')" href="#justify-pills-student" role="tab" aria-controls="justify-pills-student" aria-selected="false">STUDENT</a>
                                                                    @endif
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content" id="justify-pills-tabContent">
                                    <!-- Start Self Employed -->
                                                                 @if ($customer)
                <div class="tab-pane fade {{$customer->employment_status == 'SELF EMPLOYED' ? 'show active' : '' }}" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                                                                 @else
                                                                        <div class="tab-pane fade show active" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                                                                @endif
                                                <div class="row">
                                    <div class="col-sm-6">
                                        
                                    <h4 class="text-danger">Coming Soon!</h4>
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >RC/BN</label>-->
                                                                                <!--    <input type="text" name="rc_bn" class="form-control" placeholder="RC/BN Number" value="{{$customer ? $customer->rc_bn : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label > Address</label>-->
                                                                                <!--    <input type="text" name="business_address" class="form-control" placeholder="Business Address" value="{{$customer ? $customer->business_address : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Number</label>-->
                                                                                <!--    <input type="number" name="business_phone_number" class="form-control" placeholder="Number" value="{{$customer ? $customer->business_phone_number : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Monthly Turn Over</label>-->
                                                                                <!--    <input type="number" name="monthly_turn_over" class="form-control" placeholder="Monthly Turn Over">-->
                                                                                <!--</div>-->
                                                                            </div>
                                <div class="col-sm-6">
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Beneficiary Bank</label>-->
                                                                                <!--    <select name="beneficiary_bank" class="form-control">-->
                                                                                <!--        @if ($customer)-->
                                                                                <!--            <option value="{{$customer->beneficiary_bank}}">{{$customer->beneficiary_bank}}</option>-->
                                                                                <!--        @endif-->
                                                                                <!--        @include('inc.bank-list')-->
                                                                                <!--    </select>-->
                                                                                <!--</div>-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Account Number</label>-->
                                                                                <!--    <input type="number" name="account_number" class="form-control" placeholder="Account Number" value="{{$customer ? $customer->account_number : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Monthly Profit</label>-->
                                                                                <!--    <input type="text" name="monthly_profit" class="form-control" placeholder="Monthly Profit" value="{{$customer ? $customer->monthly_profit : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Date of Inc/Reg</label>-->
                                                                                <!--    <input type="date"  name="date_of_inc_reg" class="form-control" placeholder="Date of Inc/Reg" value="{{$customer ? $customer->date_of_inc_reg : '' }}">-->
                                                                                <!--</div>-->
                                                                            </div>
                                                                    </div>
                                                                </div>
                                            <!-- End Self Employed -->

                                    <!-- Start Employed -->
                                                                  @if ($customer)
                                                                            <div class="tab-pane fade {{$customer->employment_status == 'EMPLOYED' ? 'show active' : '' }}" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                                                                    @else
                                                                            <div class="tab-pane fade" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                                                                    @endif
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label >Monthly Gross Salary</label>
                                                                                <input type="number" name="monthly_gross_salary" class="form-control" placeholder="Monthly Gross Salary" value="{{$customer ? $customer->monthly_gross_salary : '' }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Monthly Net Pay</label>
                                                                                <input type="number" name="monthly_net_pay" class="form-control" placeholder="Monthly Net Pay" value="{{$customer ? $customer->monthly_net_pay : '' }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Pay Day</label>
                                                                                <select name="salary_pay_day" class="form-control" required>
                                                                                    @if ($customer)
                                                                                        <option value="{{$customer->salary_pay_day}}">day {{$customer->salary_pay_day}}</option>
                                                                                    @endif
                                                                                    <option value="">Select</option>
                                                                                    @for ($i = 1; $i < 32; $i++)
                                                                                     <option value="{{$i}}">day {{$i}}</option>
                                                                                    @endfor
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                             {{-- <div class="form-group">
                                                                                <label >Disbursement Bank Name </label>
                                                                                    <select name="salary_bank_name" class="form-control">
                                                                                        @if ($customer)
                                                                                            <option value="{{$customer->salary_bank_name}}">{{$customer->salary_bank_name}}</option>
                                                                                        @endif
                                                                                        @include('inc.bank-list')
                                                                                    </select>
                                                                            </div>
                                                                             <div class="form-group">
                                                                                <label >Account Name</label>
                                                                                <input type="text" name="salary_account_name" class="form-control" placeholder="Account Name" value="{{$customer ? $customer->salary_account_name : '' }}">
                                                                            </div>
                                                                             <div class="form-group">
                                                                                <label >Account Number</label>
                                                                                <input type="number" name="salary_account_number" class="form-control" placeholder="Account Number" value="{{$customer ? $customer->salary_account_number : '' }}">
                                                                            </div> --}}
                                                                             {{-- <div class="form-group">
                                                                                <label >BVN</label>
                                                                                <input type="number" name="bvn" class="form-control" placeholder="BVN" required>
                                                                            </div> --}}
                                                                             <div class="form-group">
                                                                                <label >Employer Phone Number</label>
                                                                                <input type="text" name="employer_phone_number" class="form-control" placeholder="Phone Number" value="{{$customer ? $customer->employer_phone_number : '' }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >Employer Name</label>
                                                                                <input type="text" name="employer_name" class="form-control" placeholder="Employer Name" value="{{$customer ? $customer->employer_name : '' }}">
                                                                            </div>
                                                                             <div class="form-group">
                                                                                <label >Employer Email Address</label>
                                                                                <input type="email" name="employer_email" class="form-control" placeholder="Email Address" value="{{$customer ? $customer->employer_email : '' }}">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label >IPPIS</label>
                                                                                <input type="text" name="iips" class="form-control" placeholder="IPPIS" value="{{$customer ? $customer->iips : '' }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                     <!-- End Employed -->

                                    <!-- Start Retired -->
                                                                @if ($customer)
                                                                        <div class="tab-pane fade {{$customer->employment_status == 'RETIRED' ? 'show active' : '' }}" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                                                                @else
                                                                        <div class="tab-pane fade" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                                                                @endif
                                                                        <div class="row">
                                <div class="col-sm-6">
                                            <h4 class="text-danger">Coming Soon!</h4>                                   <!--<div class="form-group">-->
                                                                                <!--    <label >Retired Date</label>-->
                                                                                <!--    <input type="date" name="retired_end_date" class="form-control" placeholder="StartRetired Date" value="{{$customer ? $customer->retired_end_date : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!-- <div class="form-group">-->
                                                                                <!--    <label >Started Date </label>-->
                                                                                <!--    <input type="date" name="retired_start_date" class="form-control" placeholder="Started Date" value="{{$customer ? $customer->retired_start_date : '' }}">-->
                                                                                <!--</div>-->
                                                                                <!--{{-- <div class="form-group">-->
                                                                                <!--    <label >BVN</label>-->
                                                                                <!--    <input type="number" name="bvn" class="form-control" placeholder="BVN" >-->
                                                                                <!--</div> --}}-->
                                                                                <!--<div class="form-group">-->
                                                                                <!--    <label >Pension Number(Opional)</label>-->
                                                                                <!--    <input type="number" name="pension_number" class="form-control" placeholder="Account Number" value="{{$customer ? $customer->pension_number : '' }}">-->
                                                                                <!--</div>-->
                                                                             </div>
                                                                             <div class="col-sm-6">
                                                                             <!--    <div class="form-group">-->
                                                                             <!--   <label >Name of Organization Retired From</label>-->
                                                                             <!--       <input type="text" name="name_of_institution_retired_from" class="form-control" placeholder="Name of Institution Retired From" value="{{$customer ? $customer->name_of_institution_retired_from : '' }}">-->
                                                                             <!--   </div>-->
                                                                             <!--   <div class="form-group">-->
                                                                             <!--       <label >Pension Paying Organization</label>-->
                                                                             <!--       <input type="number" name="pension_paying_institute" class="form-control" placeholder="Pension Paying Institute" value="{{$customer ? $customer->pension_paying_institute : '' }}">-->
                                                                             <!--   </div>-->
                                                                             <!--   <div class="form-group">-->
                                                                             <!--       <label >Pension Bank</label>-->
                                                                             <!--       <select name="pension_bank" class="form-control">-->
                                                                             <!--           @if ($customer)-->
                                                                             <!--               <option value="{{$customer->pension_bank}}">{{$customer->pension_bank}}</option>-->
                                                                             <!--           @endif-->
                                                                             <!--           @include('inc.bank-list')-->
                                                                             <!--       </select>-->
                                                                             <!--   </div>-->
                                                                             <!--   <div class="form-group">-->
                                                                             <!--       <label >Monnthly Pension Amount</label>-->
                                                                             <!--       <input type="text" name="monnthly_pension_amount" class="form-control" placeholder="monthly pension amount" value="{{$customer ? $customer->monnthly_pension_amount : '' }}">-->
                                                                             <!--   </div>-->
                                                                             <!--</div>-->
                                                                        </div>
                                                                </div>
                                                            <!-- End Retired -->

                                             <!-- Start Student -->
                                                                @if ($customer)
                                                                    <div class="tab-pane fade {{$customer->employment_status == 'STUDENT' ? 'show active' : '' }}" id="justify-pills-student" role="tabpanel" aria-labelledby="justify-pills-student-tab">
                                                                @else
                                                                    <div class="tab-pane fade" id="justify-pills-student" role="tabpanel" aria-labelledby="justify-pills-student-tab">
                                                                @endif
                                                                
                                                                    
                                                <div class="row">
                                                <div class="col-sm-6">
                                              <h4 class="text-danger">Coming Soon!</h4>       
                                                    
                                                    <!--<div class="form-group">-->
                                                    <!--                            <label >Student Name</label>-->
                                                    <!--                            <input type="text" name="student_name" class="form-control" placeholder="Student Name" value="{{$customer ? $customer->student_name : '' }}">-->
                                                    <!--                        </div>-->
                                                    <!--                        <div class="form-group">-->
                                                    <!--                            <label >Current Level</label>-->
                                                    <!--                            <select name="current_level" class="form-control">-->
                                                    <!--                                @if ($customer)-->
                                                    <!--                                    <option value="{{$customer->current_level}}">Level {{$customer->current_level}}</option>-->
                                                    <!--                                @endif-->
                                                    <!--                                <option>Select</option>-->
                                                    <!--                                @for ($i = 1; $i < 11; $i++)-->
                                                    <!--                                    <option value="{{$i}}">Level {{$i}}</option>-->
                                                    <!--                                @endfor-->
                                                    <!--                            </select>-->
                                                    <!--                        </div>-->
                                                    <!--                        <div class="form-group">-->
                                                    <!--                            <label >Parent Full Name</label>-->
                                                    <!--                            <input type="text" name="parent_aneme" class="form-control" placeholder="Parent Full Name" value="{{$customer ? $customer->parent_aneme : '' }}">-->
                                                    <!--                        </div>-->
                                                    <!--                        <div class="form-group">-->
                                                    <!--                            <label>Parents Phone Number</label>-->
                                                    <!--                            <input type="text" name="Parents Phone Number" class="form-control" placeholder="parents_phone_number" value="{{$customer ? $customer->parent_address : '' }}">-->
                                                    <!--                        </div>-->
                                                    <!--                        <div class="form-group">-->
                                                    <!--                            <label>Parent Bank Name</label>-->
                                                    <!--                            <select name="parent_bank_name" class="form-control">-->
                                                    <!--                                    @if ($customer)-->
                                                    <!--                                        <option value="{{$customer->parent_bank_name}}">{{$customer->parent_bank_name}}</option>-->
                                                    <!--                                    @endif-->
                                                    <!--                                    @include('inc.bank-list')-->
                                                    <!--                                </select>-->
                                                    <!--                        </div>-->
                                    </div>
                                    <div class="col-sm-6">
                                      
                                        <!--<div class="form-group">-->
                                        <!--                                        <label >Name of School</label>-->
                                        <!--                                        <input type="text" name="name_of_school" class="form-control" placeholder="Name of School" value="{{$customer ? $customer->name_of_school : '' }}">-->
                                        <!--                                    </div>-->
                                        <!--                                    <div class="form-group">-->
                                        <!--                                        <label >School Address</label>-->
                                        <!--                                        <input type="text" name="school_address" class="form-control" placeholder="School Address" value="{{$customer ? $customer->school_address : '' }}">-->
                                        <!--                                    </div>-->
                                        <!--                                    <div class="form-group">-->
                                        <!--                                        <label >Name of department</label>-->
                                        <!--                                        <input type="text" name="name_of_department" class="form-control" placeholder="Name of department" value="{{$customer ? $customer->name_of_department : '' }}">-->
                                        <!--                                    </div>-->
                                        <!--                                    <div class="form-group">-->
                                        <!--                                        <label>Parent Account Number</label>-->
                                        <!--                                        <input type="number" name="parent_account_number" class="form-control" placeholder="Parent Account Number" value="{{$customer ? $customer->parent_account_number : '' }}">-->
                                        <!--                                    </div>-->
                                        <!--                                    <div class="form-group">-->
                                        <!--                                        <label>Parent Account Name</label>-->
                                        <!--                                        <input type="text" name="parent_account_name" class="form-control" placeholder="Parent Account Name" value="{{$customer ? $customer->parent_account_name : '' }}">-->
                                        <!--                                    </div>-->
                                                                        </div>
                                                                </div>
                                                            <!-- End Student -->
                                                                
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- End Employer/Business information-->


                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing" style="margin-top:10px;">
                                 <a href="{{ url('customer/create') }}" class="mr-2 btn btn-primary  html">Previous</a> 
                                 <button class="mr-2 btn btn-primary  html" style="float:right;" id="save_and_next_btn">Save and Next</button> 
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>



<script>
function setEmploymentStatus(val){
    document.getElementById('employment_status').value = val;
    
    if(val == "EMPLOYED"){
        document.getElementById('save_and_next_btn').style.display = 'block';
    }else{
         document.getElementById('save_and_next_btn').style.display = 'none';
    }

}
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
<!-- END PAGE LEVEL PLUGINS --> 
@endsection
