<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Manage Emmployee Loan</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/pages/helpdesk.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->  
    
 
    <link href="{{ asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    
    
    <link rel="stylesheet" type="text/css" href="https://loans.ukdiononline.com/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="https://loans.ukdiononline.com/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="https://loans.ukdiononline.com/plugins/table/datatable/dt-global_style.css">
  <link href="https://loans.ukdiononline.com/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="https://loans.ukdiononline.com/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <link href="https://loans.ukdiononline.com/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="https://loans.ukdiononline.com/assets/css/forms/theme-checkbox-radio.css">
    <link href="https://loans.ukdiononline.com/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="https://loans.ukdiononline.com/assets/css/apps/contacts.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://loans.ukdiononline.com/plugins/dropify/dropify.min.css">
    <link href="https://loans.ukdiononline.com/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />

    <link href="https://loans.ukdiononline.com/plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />

    <link href="https://loans.ukdiononline.com/assets/css/components/timeline/custom-timeline.css" rel="stylesheet" type="text/css" />
    <link href="https://loans.ukdiononline.com/assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
    <link href="https://loans.ukdiononline.com/assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" />
    <link href="https://loans.ukdiononline.com/assets/css/elements/custom-tree_view.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="https://loans.ukdiononline.com/plugins/bootstrap-select/bootstrap-select.min.css">


 <link href="https://loans.ukdiononline.com/plugins/fullcalendar/fullcalendar.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css" />
    <link href="https://loans.ukdiononline.com/plugins/fullcalendar/custom-fullcalendar.advance.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="helpdesk container">
        <nav class="navbar navbar-expand navbar-light">
            <a class="navbar-brand" href="#">
               
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    
                </ul>
            </div>
        </nav>

        <div class="helpdesk layout-spacing">

            <div class="hd-header-wrapper">
                <div class="row">        
                 
                    <div class="col-md-12 text-center">
                        <h4 class="" style="text-align: center; text-shadow: 2px 2px 4px #000000;">Manage Employee Loan</h4>
                         <div class="row" style="padding:20px; width:100%; background-color:#f1f2f3;">
                          <form action="" method="GET">
                                {{csrf_field()}}
                               <div class="row">
                                    <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-primary">Branch</label>
                                        <select name="branch_id" class="form-control">
                                            <option value="">Select Branch</option>
                                            <option value="all">All Branch</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->state}} - {{$branch->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                     <div class="form-group">
                                         <label class="text-primary">Date</label>
                                        <input type="date" class="form-control" name="search_date" style="border: none; border-radius: 4px; padding: 20px 16px; color: #0e1726; height: 20px;">
                                    </div>
                                    </div>
                                    <div class="col-sm-2">
                                     <div class="form-group">
                                         <label class="text-primary">Search</label><br>
                                        <button class="mr-2 btn btn-primary  html">Search</button> 
                                    </div>
                                    </div>
                                    
                                    
                                   @if(Request::get('search_date'))
                                   <br>
                                    <p class="text-primary" style="text-align:center;">Search result for {{Request::get('search_date')}} in {{getBranchName(Request::get('branch_id'))}}</p>
                                   @endif
                               </div>
                          </form>
                          
                         
                        </div>
                        <div class="row" style="background-color:#FFF; margin-top:40px;"> 
                            <?php $progress = 0; ?>
                            <!--START REQUEST DIV -->
                             @forelse ($data as $req)
                             
                             <?php
                             
                                 $loan_amount = $req->disbursed_amount ? $req->disbursed_amount : $req->principal;
                                 $pay_day = $req->customer->employment->salary_pay_day;
                                 if($pay_day < 10){
                                     $pay_day = '0'.$pay_day;
                                 }
                                 
                                 //check if salary pay date is not 07
                                 if($pay_day != "07"){
                                     $pay_day = "07";
                                 }
                                 
                               
                                 $in = date_create($req->created_at);
                                
                                 $out = date_create($in->format('Y-m-'.$pay_day));
                               
                                 //$the_release_date = $out->format('Y-m-d');
                                  $the_release_date = $req->release_date ? $req->release_date : date('Y-m-d');
                                     
                                  $search_loan_repayment = App\Http\Controllers\Loan\RepaymentController::searchPayDate(Request::get('search_date'),$req->id,$loan_amount,$req->interest_rate,$req->loan_duration,$req->loan_duration_length,$the_release_date,$pay_day);
                                
                                ?>
                               @if($search_loan_repayment)
                               <?php
                                //Get first and last payment date
                                 $cal_result = App\Http\Controllers\Loan\RepaymentController::getFirstAndLastPaymentDate($req->id,$loan_amount,$req->interest_rate,$req->loan_duration,$req->loan_duration_length,$the_release_date,$pay_day);
                               ?>
                                <div class="col-md-6 layout-top-spacing">
                                   
                                    <div class="card component-card_8" style="background-color: #c2d5ff;">
                                                   
                                    
                                            <div class="card-body">
                                                
                                                <div class="progress-order">
                                                    <div class="progress-order-header">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-6 col-12">
                                                                <h6></h6>
                                                            </div>
                                                            <div class="col-md-6 pl-0 col-sm-6 col-12 text-center">
                                                              
                                                                <h4 style="font-size:17px; text-align:center;" class="text-info">
                                                                        {{$req->customer['first_name']}} 
                                                                        {{$req->customer['other_name']}} 
                                                                        {{$req->customer['last_name']}}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                        
                                                    <div class="progress-order-body">
                                                        <div class="row mt-4">
                                                            <div class="col-md-12">
                                                            <h6 class="text-center">{{$req->borrower_id}}</h6>
                                                                <p style="font-size:14px; text-align:left;">
                                                                    <b>Product:</b> <label class="text-warning">
                                                                    {{$req->product['name']}}</label>
                                                                    <br>
                                                                    <b>@if(request()->id > 3 ) Approve @else Loan @endif Amount:</b> <label class="text-warning">
                                                                        @if(request()->id > 3 ) @if($req->disbursed_amount != null )  ₦{{number_format($req->disbursed_amount,2)}} @else ₦{{number_format($req->principal,2)}} @endif @else  ₦{{number_format($req->principal,2)}} @endif  
                                                                     </label>
                                                                    <br>
                                                                    <b>Branch:</b>  {{$req->branch['state']}} - {{$req->branch['title']}}
                                                                    <br>
                                                                    <b>Created By:</b> 
                                                                        {{$req->customer['first_name']}} 
                                                                        {{$req->customer['other_name']}} 
                                                                        {{$req->customer['last_name']}}
                                                                    <br>
                                                                    <b>Created Date:</b>    {{$req->created_at}}
                                                                    <br>
                                                                    
                                                                    <b>Pay Start Date: <label class="badge badge-secondary">{{$cal_result['first_date']}}</label> </b>
                                                                    <b>Pay End Date: <label class="badge badge-danger">{{$cal_result['last_date']}}</label> </b>
                                                                    <br><br>
                                                                    <b class="text-danger" style="font-size:17px; background-color:#FFF; padding:4px; border-radius:3px;">
                                                                       Loan Repayment Amount: <label style="font-size:17px;" class="badge badge-danger">₦{{$search_loan_repayment}}</label> </b>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12 text-right">
                                                                <a href="{{url('employee/loan/show',$req->id)}}" class="badge badge-success" style="float:right;">View</a>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                        
                                            </div>
                                        </div>
                                 </div>
                               @endif
                             
                            @empty
                            <div class="col-md-12 layout-top-spacing">
                                <div class="card component-card_8">
                                        <div class="card-body">
                                            <p class="text-info">You don't have any information...</p>
                                        </div>
                                </div>
                            </div>
                            @endforelse
                            <!-- END REQUEST DIV -->

</div>
                        </div>
           
                      
                    </div>
                </div>
            </div>

          

        </div>
    </div>

    <div id="miniFooterWrapper" class="">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="position-relative">
                        <div class="arrow text-center">
                            <p class="">Up</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-left text-center copyright align-self-center">
                            <p class="mt-md-0 mt-4 mb-0">{{date('Y')}} &copy; <a target="_blank" href="#">UK-DION</a>.</p>
                        </div>
                        <div class="col-xl-5 mx-auto col-lg-6 col-md-6 site-content-inner text-md-right text-center align-self-center">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/pages/helpdesk.js')}}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
</body>


</html>