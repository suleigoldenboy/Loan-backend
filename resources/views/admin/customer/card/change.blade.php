<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<title>Card Update Form</title>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
	<link href="{{ asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!--  BEGIN CUSTOM STYLE FILE  -->
	<link href="{{ asset('assets/css/pages/helpdesk.css')}}" rel="stylesheet" type="text/css" />
	<!--  END CUSTOM STYLE FILE  -->
	<script src="{{ asset('plugins/sweetalerts/promise-polyfill.js') }}"></script>
	<link href="{{ asset('plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
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
			<a class="navbar-brand" href="#"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto"></ul>
			</div>
		</nav>
		<div class="helpdesk layout-spacing">
			<div class="hd-header-wrapper">
				<div class="row">
					<div class="col-md-12 text-center">
						<h4 class="">Update Your Card Details</h4>
						@if(Session('errorMessage'))
						<h4 class="text-danger" style="text-align:center; background-color:#FFF;">{{Session('errorMessage')}}</h4>
						@endif</div>
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
											<div class="row">
												<div class="media">
													<div class="media-body">
														<div class="table-responsive">
															<h4 class="text-center">Click the Icon below to update your Card Details </h4>
															<div class="row">
																<div class="col-md-6"></div>
																<div class="col-md-6"></div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="text-center">
												<div class="widget-heading">
													<h5 class="text-secondary">Change Your Payment Instrument</h5>
												</div>
												<div class="widget-content">
													<div class="invoice-box">
														<!--target="_blank"                            -->
														<div class="inv-action">
															<a href="#" class="btn btn-secondary mb-4 mr-2" style="background-color:#FFF;" data-toggle="modal" data-target="#exampleModalCard">
																<img src="{{ asset('https://cdn.freebiesupply.com/logos/large/2x/mastercard-4-logo-png-transparent.png')}}" style="width:50px;">
															</a>
														</div>
													</div>
													<!-- card Modal -->
													<div class="modal fade" id="exampleModalCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="text-danger">Add Payment Card The Card will be charge 50 Naira</h4>
																	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
																			<line x1="18" y1="6" x2="6" y2="18"></line>
																			<line x1="6" y1="6" x2="18" y2="18"></line>
																		</svg>
																	</button>
																</div>
																<form class="form" id="paymentForm">
																	<div class="modal-body">
																		<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
																			<div class="form-group">Email Address
																				<input class="form-control" value="{{ $user->email }}" type="email" id="email-address" required readonly/>
																			</div>
																			<div class="form-group">
																				<label style="text-align:left;">Amount</label>
																				<input class="form-control" type="tel" value="50" id="amount" required readonly/>
																			</div>
																			<div class="form-group">
																				<label style="text-align:left;">First Name</label>
																				<input class="form-control" type="text" value="{{ $user->first_name}}" id="first-name" readonly/>
																			</div>
																			<div class="form-group">
																				<label style="text-align:left;">Last Name</label>
																				<input class="form-control" type="text" value="{{ $user->last_name}}" id="last-name" readonly/>
																			</div>
																		</div>
																	</div>
																	<div class="modal-footer">
																		<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
																		<button type="submit" class="btn btn-submit btn-success btn-lg">Pay</button>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<!-- End card Modal -->
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
	<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
	<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
	<script src="{{ asset('assets/js/app.js')}}"></script>
	<script src="https://js.paystack.co/v1/inline.js"></script>
	<script type="text/javascript">
		const url = '{{url("store/auth/code")}}'
		        const redirect = '{{ url()->current() }}'
		        const customer_id = '{{$user->id}}'
		        const paymentForm = document.getElementById('paymentForm');
		        paymentForm.addEventListener("submit", payWithPaystack, false);
		        function payWithPaystack(e) {
		          e.preventDefault();
		          let handler = PaystackPop.setup({
		            key: '{{config('api.paystack.public_key')}}', // Replace with your public key
		            email: document.getElementById('email-address').value,
		            amount: document.getElementById('amount').value * 100,
		            currency: 'NGN',
		            ref: ''+Math.floor((Math.random() * 1000000000) + 1),
		            // label: "Optional string that replaces customer email"
		            onClose: function(){
		              swal('Transaction was not completed, window closed.');
		            },
		            callback: function(response){
		                var reference = response.reference;
		                swal.queue([{
		                    title: 'User Card Added',
		                    confirmButtonText: 'Continue',
		                    text: `The card has been verified and 50 Naira had been deducted from account`,
		                    type: 'success',
		                    showLoaderOnConfirm: true,
		                    preConfirm: function() {
		                    return fetch(url, {
		                        method: 'POST',
		                        headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
		                        body: JSON.stringify({ reference, customer_id })
		                    })
		                        .then(function (response) {
		                            return response.json();
		                        })
		                        .then(function(data) {
		                            swal.insertQueueStep('Card Authentication Code Stored')
		                            return location.reload()
		                        })
		                        .catch(function() {
		                        swal.insertQueueStep({
		                            type: 'error',
		                            title: 'Something Went Worng'
		                        })
		                        })
		                    }
		                }])
		            }
		          });
		          handler.openIframe();
		        }
	</script>
</body>

</html>
