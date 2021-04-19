                                        <div class="card">
                                            <div class="card-header" id="headingTwo3">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#customerEmploymentAccordion" aria-expanded="false" aria-controls="customerEmploymentAccordion">
                                                        <div class="accordion-icon"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                                                        Employment/Business Information  <div class="icons"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div id="customerEmploymentAccordion" class="collapse" aria-labelledby="headingTwo3" data-parent="#iconsAccordion">
                                                <div class="card-body">
                                                    <div class="row">
                                <!-- Start Employer/Business information-->
                               <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
<h6 class="text-danger">Employment Status: {{$data->customer->employment->employment_status}}</h6>
                                            <div class="row">
                                                <div class="col-md-2">
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h4 >BVN: {{$data->customer->employment->bvn}}</h4>
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
                                                                         <a class="nav-link {{strtoupper($data->customer->employment->employment_status) == 'SELF EMPLOYED' ? 'active' : '' }}">SELF EMPLOYED</a>
                                                                   
                                                                </li>
                                                                <li class="nav-item">
                                                                         <a class="nav-link {{strtoupper($data->customer->employment->employment_status) == 'EMPLOYED' ? 'active' : '' }}">EMPLOYED</a>
                                                                   
                                                                </li>
                                                                <li class="nav-item">
                <a class="nav-link {{strtoupper($data->customer->employment->employment_status) == 'RETIRED' ? 'active' : '' }}" >RETIRED</a>
                                                                    
                                                                </li>
                                                                <li class="nav-item">
                                                                        <a class="nav-link {{strtoupper($data->customer->employment->employment_status) == 'STUDENT' ? 'active' : '' }}">STUDENT</a>
                                                                    
                                                                </li>
                                                            </ul>

                                                            <div class="tab-content" id="justify-pills-tabContent">
                                                            <!-- Start Self Employed -->
                                                                         <div class="tab-pane fade {{strtoupper($data->customer->employment->employment_status) == 'SELF EMPLOYED' ? 'show active' : '' }}" id="justify-pills-home" role="tabpanel" aria-labelledby="justify-pills-home-tab">
                                                       
                                                                     <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <p>
                                                                                    <b>RC/BN:</b> {{$data->customer->employment->rc_bn}}
                                                                                </p>
                                                                                <p>
                                                                                    <b> Address:</b>  {{$data->customer->employment->business_address}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Number:</b> {{$data->customer->employment->business_phone_number}}
                                                                                </p>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <p>
                                                                                    <b>Beneficiary Bank:</b> {{$data->customer->employment->beneficiary_bank}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Account Number:</b> {{$data->customer->employment->account_number}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Monthly Profit:</b> {{$data->customer->employment->monthly_profit}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Date of Inc/Reg:</b> {{$data->customer->employment->date_of_inc_reg}}
                                                                                </p>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            <!-- End Self Employed -->

                                                            <!-- Start Employed -->
                                                                            <div class="tab-pane fade {{strtoupper($data->customer->employment->employment_status) == 'EMPLOYED' ? 'show active' : '' }}" id="justify-pills-profile" role="tabpanel" aria-labelledby="justify-pills-profile-tab">
                                                                   
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <p>
                                                                                <b>Monthly Gross Salary:</b> {{$data->customer->employment->monthly_gross_salary}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Monthly Net Pay:</b> {{$data->customer->employment->monthly_net_pay}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Pay Day:</b> {{$data->customer->employment->salary_pay_day}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                             <p>
                                                                                <b>Salary Bank Name:</b> {{$data->customer->employment->salary_bank_name}} 
                                                                            </p>
                                                                             <p>
                                                                                <b>Account Name:</b> {{$data->customer->employment->salary_account_name}}
                                                                            </p>
                                                                             <p>
                                                                                <b>Account Number:</b> {{$data->customer->employment->salary_account_number}}
                                                                            </p>
                                          <p>
                                                                                <b>Employer Name:</b> {{$data->customer->employment->employer_name}}
                                                                            </p>
                                                                             <p>
                                                                                <b>Employer Phone Number:</b> {{$data->customer->employment->employer_phone_number}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Employer Email Address:</b> {{$data->customer->employment->employer_email}}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!-- End Employed -->

                                                            <!-- Start Retired -->
                                                                        <div class="tab-pane fade {{strtoupper($data->customer->employment->employment_status) == 'RETIRED' ? 'show active' : '' }}" id="justify-pills-contact" role="tabpanel" aria-labelledby="justify-pills-contact-tab">
                                                                
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                 <p>
                                                                                    <b>Started Date:</b> {{$data->customer->employment->retired_start_date }}
                                                                                </p>
                                                                                 <p>
                                                                                    <b>Retired Date:</b> {{$data->customer->employment->retired_end_date}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Pension Number:</b> {{$data->customer->employment->pension_number}}
                                                                                </p>
                                                                             </div>
                                                                             <div class="col-sm-6">
                                                                                 <p>
                                                                                <b>Name of Institution Retired From:</b> {{$data->customer->employment->name_of_institution_retired_from}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Pension Paying Institute:</b> {{$data->customer->employment->pension_paying_institute}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Pension Bank:</b> {{$data->customer->employment->pension_bank}}
                                                                                </p>
                                                                                <p>
                                                                                    <b>Monnthly Pension Amount:</b> {{$data->customer->employment->monnthly_pension_amount}}
                                                                                </p>
                                                                             </div>
                                                                        </div>
                                                                </div>
                                                            <!-- End Retired -->

                                                            <!-- Start Student -->
                                                                @if ($data->customer->employment)
                                                                    <div class="tab-pane fade {{strtoupper($data->customer->employment->employment_status) == 'STUDENT' ? 'show active' : '' }}" id="justify-pills-student" role="tabpanel" aria-labelledby="justify-pills-student-tab">
                                                                @else
                                                                    <div class="tab-pane fade" id="justify-pills-student" role="tabpanel" aria-labelledby="justify-pills-student-tab">
                                                                @endif
                                                                
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <p>
                                                                                <b>Student Name:</b> {{$data->customer->employment->student_name}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Current Level:</b> Level {{$data->customer->employment->current_level}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Parent Full Name:</b> {{$data->customer->employment->parent_aneme}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Parent Address:</b> {{$data->customer->employment->parent_address}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <p>
                                                                                <b>Name of School:</b> {{$data->customer->employment->name_of_school}}
                                                                            </p>
                                                                            <p>
                                                                                <b>School Address:</b> {{$data->customer->employment->school_address}}
                                                                            </p>
                                                                            <p>
                                                                                <b>Name of department:</b> {{$data->customer->employment->name_of_department}}
                                                                            </p>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>