<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Loan Offer Letter</title>
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
                    <div class="col-md-12 text-center">
                        <p class="">Download and Upload Loan Offer Letter and Application Form</p>
                        
                        @if(Session('errorMessage'))
                                     <h4 class="text-danger" style="text-align:center; background-color:#FFF;">{{Session('errorMessage')}}</h4>
                
                                 @endif
                    </div>
                </div>
            </div>

            <div class="hd-tab-section" style="margin-top:-90px;">
                <div class="row">
                    <div class="col-md-12 mb-5 mt-5">

                        <div class="accordion" id="hd-statistics">
                        
                          <div class="card">
                            <div class="card-header" id="hd-statistics-2">
                              <div class="mb-0">
                                <div class=" collapsed" data-toggle="collapse" role="navigation" data-target="#collapse-hd-statistics-2" aria-expanded="true" aria-controls="collapse-hd-statistics-2">
                                   <img src="{{ asset('https://ukdiononline.com/assets/images/maxer.jpg')}}" class="img-responsive">
                                </div>
                              </div>
                            </div>
                            <div id="collapse-hd-statistics-2" class="collapse show" aria-labelledby="hd-statistics-2" data-parent="#hd-statistics">
                              <div class="card-body">
                                
    
     <div class="col-md-12" style="">
        
        <div class="col-md-6" style="">
            Hello {{$letter->customer->first_name}},
            
            <br><br>
            Kindly downloan your offer letter and your application form. 
            
            Read through the offer letter and your application form, Sing and upload them back to us (Uk-Dion).
            
        </div>
        <a href="{{url('customer/download/loan/offer-letter',$letter->id)}}" class="btn btn-primary mb-2 mr-2">
            Download Offer Letter
            <svg> ... </svg>
        </a>
         <a href="{{url('customer/download/application-form',$letter->id)}}" class="btn btn-secondary mb-2 mr-2">
             Download Application Form
            <svg> ... </svg>
        </a>

            
            <br><br><br><br><br><br><br><br><br><br>
             <!-- Button trigger modal -->
                                    <div class="text-center">
                                        <button type="button" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
                                         Upload Offer Letter and Application Form
                                        </button>
                                    </div>

                                    


                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                         @if(Session('errorMessage'))
                                     <h4 class="text-danger" style="text-akign:center;">{{Session('errorMessage')}}</h4>
                
                                 @endif
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                             <form action="{{url('confirm/letter/accepted')}}" method="POST" id="actionForm" enctype="multipart/form-data">
                                {{csrf_field()}}
                                                <div class="modal-body">
                                                    <p class="modal-text">
                                                        <div class="form-group">
                                                          <label >Offer Letter</label>
                                                          <input type="file" name="offer_letter" placeholder="Offer Letter" class="form-control" required>
                                                       </div>
                                                        <div class="form-group">
                                                          <label >Application Form</label>
                                                          <input type="file" name="application_form" placeholder="Application Form" class="form-control" required>
                                                       </div>
                                                       @if($letter->offerLetter)
                                                            <input type="hidden" name="offer_letter" value="{{$letter->offerLetter->img_offer_letter}}">
                                                            <input type="hidden" name="application_form" value="{{$letter->offerLetter->img_application_form }}"> 
                                                     @else
                                                        <input type="hidden" name="offer_letter" value="">
                                                        <input type="hidden" name="application_form" value=""> 
                                                     @endif
                                                     
                                                      <input type="hidden" name="customer_id" value="{{$customer_id}}">
                                                     <input type="hidden" name="loan_id" value="{{$loan_id}}"> 
                                                
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- End Modal -->
       

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