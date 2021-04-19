on
<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="{{url('home')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" style="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linrecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
            </li>
            
              @if(can('View Customer'))
            <li class="menu">
                <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>C.R.M</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                    @if(can('View Customer'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('customer/view')}}"> View </a>
                    </li>
                    @endif
                    @if(can('Create Customer'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('customer/create')}}"> <b class="text-info">Create Other Loan</b></a>
                    </li>
                    <li>
                        <a style="color:{{$_color}}" href="{{url('customer/create/federal')}}"> <b class="text-secondary">Create Federal Loan</b></a>
                    </li>
                    <li>
                        <a style="color:{{$_color}}" href="{{url('prospect/view')}}">View Prospect</a>
                    </li>
                   
                    @if(can('View Customer Contact'))
                    <li>
                        <a class="text-danger" href="{{url('customer/show/contact')}}">Customer Contact</a>
                    </li>
                    @endif
                     <li>
                         <a style="color:{{$_color}}" style="color:{{$_color}}" class="text-danger" href="{{url('loan/loan/show/offline/rejection')}}"> Offline Loan Rejection </a>
                    </li>
                    @endif
                      @if(can('Online Request'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('loan/loan/show/request')}}"> Online Request</a>
                    </li>
                    @endif
                     @if(can('Online File Confirm'))
                        <li>
                            <a class="text-info" href="{{url('loan/loan/show/request/confirm/files')}}"> Online File Confirm</a>
                        </li>
                    @endif
                    @if(can('Online Address Confirm')) 
                        <li>
                            <a class="text-info" href="{{url('loan/loan/show/request/confirm/address')}}"> Online Address Confirm</a>
                        </li>
                    @endif
                    
                     @if(can('Incomplete Registration'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('customer/view/in-complete-reg')}}"> Saved Reg </a>
                    </li>
                     @endif
                </ul>
            </li>
            @endif
            
                @if(can('View Loan'))
                    <li class="menu">
                        <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="the_color">
                                <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <span>Loans</span>
                            </div>
                            <div>
                                <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
                            <!-- @if(can('View Loan'))-->
                            <!-- <li>-->
                            <!--    <a style="color:{{$_color}}" href="{{url('loan/loan/view')}}"> View </a>-->
                            <!--</li>-->
                            <!--@endif--> 
                            @if(can('Create Loan'))
                             <li>
                                <a style="color:{{$_color}}" href="{{url('loan/loan/create')}}"> Create </a>
                            </li>
                            @endif
                            @if(can('View Loan Request'))
                            <li>
                                <a style="color:{{$_color}}" href="{{url('loan/loan/show/request')}}"> Loan Request </a>
                            </li>
                             @endif
                             @if(can('Send Offer Letter'))
                            <li>
                                <a style="color:{{$_color}}" class="text-info" href="{{url('loan/loan/send/offerletter')}}"> Send Offer Letter </a>
                            </li>
                             @endif
                             @if(can('View Loan Request Status'))
                                <li>
                                    <a style="color:{{$_color}}" href="{{url('loan/show/request/status')}}"> Loan Status</a>
                                </li>
                             @endif
                              <!--@if(can('Offline Rejection'))-->
                            
                            <!--@endif-->
                             @if(can('View Loan Decline'))
                             <li>
                                <a style="color:{{$_color}}" style="color:{{$_color}}" class="text-danger" href="{{url('loan/loan/show/decline')}}"> Declined Loans </a>
                            </li>
                            @endif
                        </ul>
                </li>
              @endif
            
           @if(can('View Employee'))
            <li class="menu">
                    <a href="#hrm" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="the_color">
                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
                            <span>HR Management</span>
                        </div>
                        <div>
                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="hrm" data-parent="#accordionExample">
                        @if(can('View Employee'))
                        <li>
                            <a style="color:{{$_color}}" href="{{route('employee.index')}}"> Employees </a>
                        </li>
                        @endif
                        @if(can('View Branch'))
                        <li>
                            <a style="color:{{$_color}}" href="{{route('branch.index')}}"> Branch Management</a>
                        </li>
                         @endif
                         @if(can('View Designation'))
                        <li>
                            <a style="color:{{$_color}}" href="{{route('designation.index')}}"> Designation Management</a>
                        </li>
                        @endif
                         @if(can('View Department'))
                        <li>
                            <a style="color:{{$_color}}" href="{{route('department.index')}}"> Department Management</a>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
           @if(can('View Disbursement'))
            <li class="menu">
                <a href="#disbursement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <span>Exchequer Tool</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="disbursement" data-parent="#accordionExample">
                    @if(can('Disburse Loan'))
                    <li>
                        <a style="color:{{$_color}}" style="color:{{$_color}}" href="{{url('loan/loan/disburse/loan')}}"> Exchequer One </a>
                    </li>
                    @endif
                    @if(can('Disburse Payment'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('loan/loan/disburse/loan/payment')}}"> Exchequer Two </a>
                    </li>
                    @endif
                    @if(can('View Offer Letter'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('admin/loan/viewofferletter')}}"> View Offer Letter </a>
                    </li>
                    @endif
                    @if(can('Disburse Loan History'))
                    {{-- <li>
                        <a style="color:{{$_color}}" href="#"> History </a>
                    </li> --}}
                    @endif
                </ul>
            </li>
            @endif
            @if(can('Recovery Tool'))
            <!-- <li class="menu">-->
            <!--    <a href="{{url('loan/loan/view')}}" aria-expanded="false" class="dropdown-toggle">-->
            <!--        <div class="the_color">-->
            <!--          <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>-->
            <!--            <span>Recovery Tool</span>-->
            <!--        </div>-->
                
            <!--    </a>-->
            <!--</li>-->
            <li class="menu">
                <a href="#recoverytool" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                        <span>Recovery Tool</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="recoverytool" data-parent="#accordionExample">
                    <li>
                        <a style="color:{{$_color}}" href="{{url('loan/loan/view')}}">Recovery Search</a>
                    </li>
                    <li>
                       <a style="color:{{$_color}}" href="{{url('account/disburse/report')}}">Disbursment Tool</a>
                    </li>

                    
                </ul>
            </li>
            @endif
              @if(can('Manage Epayment'))
             <li class="menu">
                <a href="#managepay" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        <span>ePayment</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="managepay" data-parent="#accordionExample">
                    <li>
                        <a style="color:{{$_color}}" href="{{url('recovery-history')}}">Card/Remiter</a>
                    </li>
                    <!--<li>-->
                    <!--   <a style="color:{{$_color}}" href="{{url('loan/category/watchful')}}">Past payments</a>-->
                    <!--</li>-->

                    
                </ul>
            </li>
            @endif
             @if(can('Manage Recovery'))
             <li class="menu">
                <a href="#recovery" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        <span>Recovery Class</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="recovery" data-parent="#accordionExample">
                    <li>
                        <a style="color:{{$_color}}" href="{{url('loan/category/performing')}}">Performing</a>
                    </li>
                     <li>
                        <a style="color:{{$_color}}" href="{{url('loan/category/watchful')}}">Pass & Watch</a>
                    </li>
                    
                     <li>
                        <a style="color:{{$_color}}" href="{{url('loan/category/substandard')}}">Substandard</a>
                    </li>
                    
                     <li>
                        <a style="color:{{$_color}}" href="{{url('loan/category/doubtful')}}">Doubtful</a>
                    </li>
                    
                     <li>
                        <a style="color:{{$_color}}" href="{{url('loan/category/lost')}}">Lost</a>
                    </li>
                    
                </ul>
            </li>
            @endif
            @if(can('View Product'))
            <li class="menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>Product</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    @if(can('View Product'))
                    <li>
                        <a style="color:{{$_color}}" href="{{route('product.index')}}"> View </a>
                    </li>
                    @endif
                    @if(can('Create Product'))
                    <li>
                        <a style="color:{{$_color}}" href="{{route('product.create')}}"> Create </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
          
            @if(can('View Borrower Management'))
             <li class="menu">
                <a href="#borrower_management" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                        
                        <span>Borrower Management</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="borrower_management" data-parent="#accordionExample">
                    @if(can('View Borrower Management'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('borrower/management')}}"> View </a>
                    </li>
                    @endif
                    @if(can('Create Borrower Management'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('borrower/create')}}"> Create </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(can('View Account'))
             <li class="menu">
                <a href="#account" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                         <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                        <span>Accounting</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="account" data-parent="#accordionExample">
                    <li>
                        <a style="color:{{$_color}}" href="{{url('account/dashboard')}}">Dashboard</a>
                    </li>
                     @if(can('View Account'))
                     <li>
                        <a style="color:{{$_color}}" href="{{url('account/accountslist')}}">Account List</a>
                    </li>
                    @endif 
                     <li>
                        <a style="color:{{$_color}}" href="{{url('account/glreportsettings')}}">GL Report Settings</a>
                    </li>
                    <li>
                        <a style="color:{{$_color}}" href="#">Balance Sheet</a>
                    </li>
                     {{-- <li>
                        <a style="color:{{$_color}}" href="{{url('account/journal')}}">Journal Entry</a>
                    </li> --}}
                </ul>
            </li>
            @endif

            @if(can('View Account Report'))
             <li class="menu">
                <a href="#accountreport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                         <svg xmlns="#" style="color:#FFF;" class="badge badge-secondary" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                          <span>Reports</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="accountreport" data-parent="#accordionExample">
                   @if(can('View Ledger'))
                   <li>
                        <a style="color:{{$_color}}" href="{{url('account/general/ledger')}}">General Ledger</a>
                    </li>
                    @endif
                    @if(can('View Income Report'))
                     <li>
                        <a style="color:{{$_color}}" href="{{url('account/income/report')}}">Income Report</a>
                    </li>
                    @endif
                    @if(can('View Expense Report'))
                     <li>
                        <a style="color:{{$_color}}" href="{{url('account/expense/report')}}">Expense Report</a>
                    </li>
                    @endif
                    @if(can('View Disburse Report'))
                     <li>
                        <a style="color:{{$_color}}" href="{{url('account/disburse/report')}}">Disburse Report</a>
                    </li>
                    @endif
                     @if(can('Manage RepaymentHistory'))
                     <li>
                        <a style="color:{{$_color}}" href="{{url('account/repayment-history')}}">
                           <b style="padding-right:7px;" class="badge badge-secondary">Statement of Account</b> 
                        </a>
                    </li>
                    @endif 
                    @if(can('View Repayment Report'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('account/repayment/report')}}">Repayment Report</a>
                    </li>
                    @endif
                    
                </ul>
            </li>
            @endif

            @if(can('Manage Role'))
            <li class="menu">
                <a href="#manage_role" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        <span>Manage Role</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="manage_role" data-parent="#accordionExample">
                    <li>
                        <a style="color:{{$_color}}" href="{{url('admin/role')}}">Manage Role</a>
                    </li>
                     <li>
                        <a style="color:{{$_color}}" href="{{url('admin/permission')}}">Permission</a>
                    </li>
                    {{-- <li>
                        <a style="color:{{$_color}}" href="{{url('admin/privileges/action')}}">Permission Actions</a>
                    </li> --}}
                </ul>
            </li>
            @endif
     

            @if(can('View Settings'))
            <li class="menu">
                <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="the_color">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                        <span>Settings</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">
                    <li>
                        <a style="color:{{$_color}}" href="{{url('loan/confirmation-process')}}">Confirmation Proccess</a>
                    </li>
                     @if(can('Manage Account Officer'))
                    <li>
                        <a style="color:{{$_color}}" href="{{url('accountofficers')}}"><b class="text-secondary">Account Officer</b></a>
                    </li>
                    <li>
                        <a style="color:{{$_color}}" href="{{url('branchconfirmation')}}"><b class="text-secondary">Manage Recovery Staff</b></a>
                    </li>
                    @endif
                     <li>
                        <a style="color:{{$_color}}" href="{{url('admin/offer-letter')}}">Offer Letter</a>
                    </li>
                     <li>
                        <a style="color:{{$_color}}" href="{{url('admin/signature')}}">Staff Signature</a>
                    </li>
                    
                    
                    {{-- <li>
                        <a style="color:{{$_color}}" href="{{url('admin/role')}}">Manage Role</a>
                    </li>
                     <li>
                        <a style="color:{{$_color}}" href="{{url('admin/permission')}}">Permission</a>
                    </li>
                    <li>
                        <a style="color:{{$_color}}" href="{{url('admin/privileges/action')}}">Permission Actions</a>
                    </li> --}}
                </ul>
            </li>
            @endif

            {{-- <li class="menu">
                <a href="fonticons.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        <span>Font Icons</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="widgets.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                        <span>Widgets</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="table_basic.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                        <span>Tables</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#datatables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <span>DataTables</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                    <li>
                        <a href="table_dt_basic.html"> Basic </a>
                    </li>
                    <li>
                        <a href="table_dt_basic-dark.html"> Dark </a>
                    </li>
                    <li>
                        <a href="table_dt_ordering_sorting.html"> Order Sorting </a>
                    </li>
                    <li>
                        <a href="table_dt_multi-column_ordering.html"> Multi-Column </a>
                    </li>
                    <li>
                        <a href="table_dt_multiple_tables.html"> Multiple Tables</a>
                    </li>
                    <li>
                        <a href="table_dt_alternative_pagination.html"> Alt. Pagination</a>
                    </li>
                    <li>
                        <a href="table_dt_custom.html"> Custom </a>
                    </li>
                    <li>
                        <a href="table_dt_range_search.html"> Range Search </a>
                    </li>
                    <li>
                        <a href="table_dt_html5.html"> HTML5 Export </a>
                    </li>
                    <li>
                        <a href="table_dt_live_dom_ordering.html"> Live DOM ordering </a>
                    </li>
                    <li>
                        <a href="table_dt_miscellaneous.html"> Miscellaneous </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#forms" data-toggle="collapse" data-active="true" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                        <span>Forms</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled show" id="forms" data-parent="#accordionExample">
                    <li>
                        <a href="form_bootstrap_basic.html"> Basic </a>
                    </li>
                    <li>
                        <a href="form_input_group_basic.html"> Input Group </a>
                    </li>
                    <li>
                        <a href="form_layouts.html"> Layouts </a>
                    </li>
                    <li class="active">
                        <a href="form_validation.html"> Validation </a>
                    </li>
                    <li>
                        <a href="form_input_mask.html"> Input Mask </a>
                    </li>
                    <li>
                        <a href="form_bootstrap_select.html"> Bootstrap Select </a>
                    </li>
                    <li>
                        <a href="form_select2.html"> Select2 </a>
                    </li>
                    <li>
                        <a href="form_bootstrap_touchspin.html"> TouchSpin </a>
                    </li>
                    <li>
                        <a href="form_maxlength.html"> Maxlength </a>
                    </li>
                    <li>
                        <a href="form_checkbox_radio.html"> Checkbox &amp; Radio </a>
                    </li>
                    <li>
                        <a href="form_switches.html"> Switches </a>
                    </li>
                    <li>
                        <a href="form_wizard.html"> Wizards </a>
                    </li>
                    <li>
                        <a href="form_fileupload.html"> File Upload </a>
                    </li>
                    <li>
                        <a href="form_quill.html"> Quill Editor </a>
                    </li>
                    <li>
                        <a href="form_markdown.html"> Markdown Editor </a>
                    </li>
                    <li>
                        <a href="form_date_range_picker.html"> Date &amp; Range Picker </a>
                    </li>
                    <li>
                        <a href="form_clipboard.html"> Clipboard </a>
                    </li>
                    <li>
                        <a href="form_typeahead.html"> Typeahead </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                        <span>Pages</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="pages" data-parent="#accordionExample">
                    <li>
                        <a href="pages_helpdesk.html"> Helpdesk </a>
                    </li>
                    <li>
                        <a href="pages_contact_us.html"> Contact Form </a>
                    </li>
                    <li>
                        <a href="pages_faq.html"> FAQ </a>
                    </li>
                    <li>
                        <a href="pages_faq2.html"> FAQ 2 </a>
                    </li>
                    <li>
                        <a href="pages_privacy.html"> Privacy Policy </a>
                    </li>
                    <li>
                        <a href="pages_coming_soon.html"> Coming Soon </a>
                    </li>
                    <li>
                        <a href="#pages-error" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Error <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                        <ul class="collapse list-unstyled sub-submenu" id="pages-error" data-parent="#pages">
                            <li>
                                <a href="pages_error404.html"> 404 </a>
                            </li>
                            <li>
                                <a href="pages_error500.html"> 500 </a>
                            </li>
                            <li>
                                <a href="pages_error503.html"> 503 </a>
                            </li>
                            <li>
                                <a href="pages_maintenence.html"> Maintanence </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="#authentication" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <span>Authentication</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="authentication" data-parent="#accordionExample">
                    <li>
                        <a href="auth_login_boxed.html"> Login Boxed </a>
                    </li>
                    <li>
                        <a href="auth_register_boxed.html"> Register Boxed </a>
                    </li>
                    <li>
                        <a href="auth_lockscreen_boxed.html"> Unlock Boxed </a>
                    </li>
                    <li>
                        <a href="auth_pass_recovery_boxed.html"> Recover ID Boxed </a>
                    </li>
                    <li>
                        <a href="auth_login.html"> Login Cover </a>
                    </li>
                    <li>
                        <a href="auth_register.html"> Register Cover </a>
                    </li>
                    <li>
                        <a href="auth_lockscreen.html"> Unlock Cover </a>
                    </li>
                    <li>
                        <a href="auth_pass_recovery.html"> Recover ID Cover </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="dragndrop_dragula.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                        <span>Drag and Drop</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="map_jvector.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                        <span>Maps</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="charts_apex.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                        <span>Charts</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#starter-kit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
                        <span>Starter Kit</span>
                    </div>
                    <div>
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="starter-kit" data-parent="#accordionExample">
                    <li>
                        <a href="starter_kit_blank_page.html"> Blank Page </a>
                    </li>
                    <li>
                        <a href="starter_kit_breadcrumbs.html"> Breadcrumbs </a>
                    </li>
                    <li>
                        <a href="starter_kit_boxed.html"> Boxed </a>
                    </li>
                    <li>
                        <a href="starter_kit_alt_menu.html"> Alternate Menu </a>
                    </li>
                </ul>
            </li>
            <li class="menu">
                <a href="https://designreset.com/cork/documentation/index.html" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        <span>Documentation</span>
                    </div>
                </a>
            </li>
             --}}
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->