<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Emmployee Loan Application</title>
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
                  @if(Session::has('successMessage'))
                    <div class="alert alert-success">
                      {{ Session::get('successMessage') }}
                    </div>
                    @endif
                      
                    @if(isset($errors) && count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                      </div>
                    @endif
                    <div class="col-md-12 text-center">
                        <h4 class="" style="text-align: center; text-shadow: 2px 2px 4px #000000;">Employee Loan Application</h4>
                        <div class="row" style="background-color:#FFF;">                
                  <div class="col-md-2"></div>
                <div class="col-md-8">
                       <!-- Start Loan Information-->
                                     <br><br>
                                            <h4 class="text-info" style="text-align: center; font-size:19px;">
                                            GROSS: 
                                                <span class="badge badge-secondary" style="font-size:19px;"> 
                                                    ₦{{number_format($data->gross,2)}}
                                                </span>
                                            </h4>
                                          <h5 class="text-info" style="font-size:19px;">
                                              Name: {{$data->first_name}} {{$data->last_name}}
                                          </h5>
                                          <div class="row"> 
                                           <img alt="avatar" style="width:100px; hieght:100px; float:left;" src="https://ukdiononline.com/public/employeepictures/{{$data->avatar}}" class="rounded" />
                                          </div>
                  <form action="{{url('employee/loan/application')}}" method="POST" id="actionForm" enctype="multipart/form-data" style="padding:20px;">
                      
                       <!--<form action="{{url('employees/loan/application')}}" method="POST" id="actionForm" enctype="multipart/form-data" style="padding:20px;">-->
                                {{csrf_field()}} 
                                
                                <input type="hidden" name="branch_id" value="{{$branch_info->title}}">
                                <input type="hidden" name="first_name" value="{{$data->first_name}}">
                                <input type="hidden" name="last_name" value="{{$data->last_name}}">
                                <input type="hidden" name="other_name" value="">
                                <input type="hidden" name="email" value="{{$data->email}}">
                                
                                <input type="hidden" name="phone_number" value="{{$data->phone_no}}">
                                <input type="hidden" name="address" value="{{$data->present_address}}">
                                <input type="hidden" name="avatar" value="{{$data->avatar}}">
                                <input type="hidden" name="marital_status" value="{{$data->marital_status}}">
                                <input type="hidden" name="religion" value="">
                                <input type="hidden" name="date_of_birth" value="{{$data->date_of_birth}}">
                                <input type="hidden" name="gender" value="{{$data->gender}}">
                                <input type="hidden" name="monthly_gross_salary" value="{{$data->gross}}">
                                <input type="hidden" name="monthly_net_pay" value="{{$data->gross}}">
                                <input type="hidden" name="employee_id" value="{{$data->id}}">
                                
                                <div class="row" style="padding:20px; box-shadow: 3px 3px 10px 0px rgba(0,0,0,0.15);">
                                  <div class="col-md-6">
                                                                        <div class="form-group"> 
                                                                           <div class="form-group">
                                                                            <label style="float:left;">Disburesment Bank Name</label>
                                                                            <input type="hidden" name="" value="" >
                                                                            <input type="text" name="disburesment_bank_name" class="form-control" placeholder="Disburesment Bank Name" value="{{$data->beneficiary_bank}}" readonly  required>
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label style="float:left;">Account Name</label>
                                                                            <input type="text" name="account_name" class="form-control" placeholder="Bank Name" value="{{$data->first_name}} {{$data->last_name}}" readonly required>
                                                                        </div>
                                                                         <div class="form-group">
                                                                            <label style="float:left;">Account Number</label>
                                                                            <input type="number" name="acount_number" class="form-control" placeholder="Account Number" value="{{$data->account_number}}" readonly required>
                                                                        </div>
                                                                        <?php  ?>
                                                                        <div class="form-group">
                                                                                <label style="float:left;">Loan Officer</label>
                                                                                <input type="hidden" name="loan_officer_id" value="{{$loan_officer->id}}" required>
                                                                                <input  class="form-control  basic" value="{{$loan_officer->first_name}} {{$loan_officer->last_name}}"  readonly>
                                                                            </div>
                                                                        
                                                                    </div>
                                            <div class="col-md-6">
                                                                    
                                                                        <div class="form-group"> 
                                                                            <label style="float:left;">Loan Duration</label>
                                                                            <select name="loan_duration" id="loan_duration" onchange="calMaxLoanOffer()" class="form-control" required>
                                                                                <option value="">Select Duration</option>
                                                                                @for ($i = 1; $i < 13; $i++)
                                                                                    <option value="{{$i}}">{{$i}} Months</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label style="float:left;">Loan Amount</label>
                                                                            <input type="number" name="principal" id="principal" onkeyup="calMaxLoanOffer2()" max="" class="form-control" placeholder="Principal Amount" value="" required>
                                                                            <label id="max_loan_msg" class="text-danger"></label>
                                                                        </div>
                                                                             <div class="form-group">
                                                                                <label style="float:left;">Loan Purpose</label>
                                                                                <textarea name="loan_purpose" class="form-control" placeholder="Loan Purpose" required></textarea>
                                                                            </div>
                                                                       
                                                                    </div>
                                  
                               <!-- End Loan Information-->
                               <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                               
                                 <button class="mr-2 btn btn-success" style="float:right;">Submit</button> 
                                   <strong class="text-danger" id="check_btn_error"></strong>
                              </div>
                               
                            
                            </div>
                        </form>
                  
                </div>

            </div>
            
            <input type="hidden" id="net_pay" value="{{$data->gross}}">
            <input type="hidden" id="max_l_amount" value="{{$data->gross}}">
                      
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



<script>

function calMaxLoanOffer(){

  const net = $("#net_pay").val();
  let input = document.getElementById("principal");
  let total = net * 0.4;
  total = total / 1.032;
  const d_total = total * parseInt($("#loan_duration").val());

  console.log('Total:: '+d_total);

  input.setAttribute("max",d_total);
  $("#max_l_amount").val(d_total);
  $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(d_total));

}
function calMaxLoanOffer2(){

  const duration =  parseInt($("#loan_duration").val());
  let l_amount =  parseInt($("#principal").val());
  let m_l_amount =  parseInt($("#max_l_amount").val());

  
  if(duration > 0){
    
    if(l_amount > m_l_amount){
        $("#principal").val('');
        $("#max_loan_msg").html('Maximun Eligible Loan Amount is ₦'+putComma(m_l_amount));
    }else{
        $("#max_loan_msg").html('');
    }

  }else{

      $("#principal").val('');
      $("#max_loan_msg").html('Error... select duration.');
  }

  

}
function putComma(x) {
    //convert to two decimals
    x = x.toFixed(2);
    //put comma
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function countCheck(){

     const num = $("input:checked").length;

     if(parseInt(num) < 2){
         let msg = 'You most select at least two Repayment Instrument';
         $("#check_box_error").html(msg);
         $("#check_btn_error").html(msg);
         $("#next_btn").hide();
     }else{
         $("#check_box_error").html('');
         $("#check_btn_error").html('');
         $("#next_btn").show();
     }
     

}
 //First upload
 var firstUpload = new FileUploadWithPreview('myFirstImage');
 //Second upload
 var secondUpload = new FileUploadWithPreview('mySecondImage');
</script>
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