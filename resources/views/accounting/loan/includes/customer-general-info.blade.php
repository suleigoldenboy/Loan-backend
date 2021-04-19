                                        <div class="card">
                                            <div class="card-header" id="headingOne3">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed" data-toggle="collapse" data-target="#CustomerGeneralInfoAccordion" aria-expanded="true" aria-controls="CustomerGeneralInfoAccordion">
                                                        <div class="accordion-icon"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                                                        Customer Information  <div class="icons"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                    </div>
                                                </section>
                                            </div>

                                            <div id="CustomerGeneralInfoAccordion" class="collapse" aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="col-sm-7 align-self-center">
                                                                <p class="inv-customer-name"><b>First Name:</b> 
                                                                        {{$data->customer->first_name}} 
                                                                </p>
                                                                <p class="inv-customer-name"><b>Other Name:</b>
                                                                        {{$data->customer->other_name}} 
                                                                </p>
                                                                <p class="inv-customer-name"><b>Last Name:</b>
                                                                        {{$data->customer->last_name}}
                                                                </p>
                                                                <p class="inv-customer-name"><b>Gender:</b>
                                                                        {{$data->customer->gender}}
                                                                </p>
                                                                <p class="inv-customer-name"><b>Marital Status:</b>
                                                                        {{$data->customer->marital_status}}
                                                                </p>
                                                                 <p class="inv-customer-name"><b>Occupation:</b>
                                                                    {{$data->customer->occupation}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p class="inv-customer-name"><b>Email:</b>
                                                                {{$data->customer->email}}
                                                            </p>
                                                             <p class="inv-customer-name"><b>Phone Number:</b>
                                                                {{$data->customer->phone_number}}
                                                            </p>
                                                             <p class="inv-customer-name"><b>Date of Birth:</b>
                                                                {{$data->customer->date_of_birth}}
                                                            </p>
                                                             <p class="inv-customer-name"><b>Home Address:</b>
                                                                {{$data->customer->address}}
                                                            </p>
                                                             <p class="inv-customer-name"><b>Religion:</b>
                                                                {{$data->customer->religion}}
                                                            </p>
                                                            <p class="inv-customer-name"><b>ID Card Type:</b>
                                                                {{$data->customer->id_card_type}}
                                                            </p>
                                                            <p class="inv-customer-name"><b>ID Card Number:</b>
                                                                {{$data->customer->id_card_number}}
                                                            </p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        @if($data->customer->nextOfKin)
                                                         <b class="text-info">Next Of Kin Information</b>
                                                         <div class="col-sm-7 align-self-center">
                                                                <p class="inv-customer-name"><b>First Name:</b> 
                                                                        {{$data->customer->nextOfKin->first_name}} 
                                                                </p>
                                                                <p class="inv-customer-name"><b>Last Name:</b>
                                                                        {{$data->customer->nextOfKin->last_name}} 
                                                                </p>
                                                                <p class="inv-customer-name"><b>Relationship:</b>
                                                                        {{$data->customer->nextOfKin->relationship}}
                                                                </p>
                                                                <p class="inv-customer-name"><b>Phone Number:</b>
                                                                        {{$data->customer->nextOfKin->phone_number}}
                                                                </p>
                                                                <p class="inv-customer-name"><b>Email:</b>
                                                                        {{$data->customer->nextOfKin->email}}
                                                                </p>
                                                                 <p class="inv-customer-name"><b>Occupation:</b>
                                                                    {{$data->customer->nextOfKin->occupation}}
                                                                </p>
                                                                <p class="inv-customer-name"><b>Address:</b>
                                                                    {{$data->customer->nextOfKin->address}}
                                                                </p>
                                                            </div>
                                                         @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>