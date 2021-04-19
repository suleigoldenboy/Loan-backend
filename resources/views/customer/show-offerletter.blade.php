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
<style>
@media print {
  .noPrint{
    display:none;
  }
}
h1{
  color:#f6f6;
}
</style>
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
						<h4 class="">Loan Offer Letter</h4>
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
									
<button class="btn btn-danger mb-2" onclick="window.print();" style="float:right;">Print</button>
									</div>
								</div>
								<div id="collapse-hd-statistics-2" class="collapse show" aria-labelledby="hd-statistics-2" data-parent="#hd-statistics">
									<div class="card-body">
										<div class="col-md-12" style="">
											<?php 
											// repaymentInstrument // // // durationInterest // totalntAmount
									$param_val=$post_data=json_decode($letter->offerLetter->param); 
									$repayment_amount = $param_val->repayment_amount; $total_interest = $param_val->total_interest; 
									
									$deduction = $param_val->deduction; 
									$nex_pay_month = '<b class="text-primary">'.$param_val->nex_pay_month.'</b>'; 
									$last_pay_month = '<b class="text-primary">'.$param_val->last_pay_month.'</b>'; 
									
									$customer_code = '<b class="text-primary">'.'000-'.$letter->customer->id.'</b>'; 
									$customer_address = $letter->customer->address; 
									$loanType = '<b class="text-primary">'.$letter->product->name.' Loan</b>'; 
									$loanPurpose = $letter->loan_purpose; 
									$loanDuration = '<b class="text-primary">'.$letter->loan_duration_length.' Months</b>'; 
									
									$customer_name = '<b class="text-primary">'.strtoupper($letter->customer->first_name.' '.$letter->customer->last_name.' '.$letter->customer->other_name).'</b>'; 
									$appied_loan_amount = $letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal; $dAmount = '<b style="color:#dc3545;">NGN'.number_format($appied_loan_amount - $deduction,2).'</b>'; 
									$principal_plus_accrued_interest = '<b style="color:#dc3545;">NGN'.number_format($repayment_amount,2).'</b>'; 
									$outstanding_principal_plus_outstanding_interest = '';//'<b style="color:#dc3545;">N'.number_format($repayment_amount + $total_interest,2).'</b>';
									$current_date = date('d-m-Y'); $appied_loan_amount = '<b style="color:#dc3545;">N'.number_format($appied_loan_amount,2).'</b>'; 
									$the_letter = str_replace("customer",$customer_name, $letter->product->offer_letter->letter); //Customer Name
									$the_letter = str_replace("LAmount",$appied_loan_amount, $the_letter);//Loan Amount 
									$the_letter = str_replace("crdate",$current_date, $the_letter);//Current date 
									$the_letter = str_replace("fdate",$nex_pay_month, $the_letter);//first payment date 
									$the_letter = str_replace("Payment_Due_Date",$last_pay_month, $the_letter);//Payment Due Date 
									$the_letter = str_replace("custcode",
									$customer_code, $the_letter);
									$the_letter = str_replace("custddress",$customer_address, 
									$the_letter);//Customer Address 
									$the_letter = str_replace("loantype",$loanType, $the_letter); 
									$the_letter = str_replace("loanpurpose",$loanPurpose, $the_letter);//Loan purpose 
									$the_letter = str_replace("loantenor",$loanDuration, $the_letter);//Loan duration 
									$the_letter = str_replace("dAmount",$dAmount, $the_letter);//Disburse amount 
									$the_letter = str_replace("principal_plus_accrued_interest",$principal_plus_accrued_interest, $the_letter);//principal plus accrued interest 
									$the_letter = str_replace("outstanding_principal_plus_outstanding_interest",$outstanding_principal_plus_outstanding_interest, $the_letter);//outstanding principal plus outstanding interest 
									$the_letter = str_replace("ddate","Disbursement Date:".$letter->release_date, $the_letter); $the_letter = str_replace("mdate","Maturity Date:".$letter->maturity_date, $the_letter); $the_letter = str_replace("rate_percent",$letter->interest_rate."%", $the_letter); // 
									$mystring = 'home/cat1/subcat2/'; $first = strtok($the_letter, '/'); ?> {!!nl2br($the_letter)!!}
											<br>
											<br>
											<div class="row">
												<div class="media">
													<div class="media-body">
														<div class="table-responsive">
														<?php $loan_amount=$letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal; 
															$pay_day = $letter->customer->employment->salary_pay_day; 
															if($pay_day < 10){
																 $pay_day='0' .$pay_day; 
															 } 
															$in=date_create($letter->created_at); 
															$out = date_create($in->format('Y-m-'.$pay_day)); 
															$the_release_date = $out->format('Y-m-d'); 
															$the_release_date = $letter->release_date ? $letter->release_date : $letter->offerLetter->loan_start_date;//date('Y-m-d'); 
															$cal_result = App\Http\Controllers\Loan\RepaymentController::repaymentScheduleCalendar($letter->product_id,$letter->id,$loan_amount,$letter->interest_rate,$letter->loan_duration,$letter->loan_duration_length,$the_release_date,$pay_day); $get_result = json_decode($cal_result, true); 
															$total_begining_balance = 0; $total_repayment_amount = 0; 
															$total_penaltie = 0; $total_interest = 0; $total_principal = 0; 
															$balance = 0; $total_balance = 0; 
															$next_pay = false; 
															$total_paid = 0; 
															$total_amount_paid = 0; 
															?>
																<h4 class="text-center">{{trans('general.calendar_title')}}</h4>
																<div class="row">
																	<div class="col-md-6">
																		<?php $insurance=calPercentage($letter->insurance_charge,$loan_amount); $processing = calPercentage($letter->processing_charge,$loan_amount) * $letter->loan_duration_length; $vat = calPercentage(7.5,$processing); $total_deductions = $insurance + $processing + $vat; $get_adjusted_interest = 0; ?></div>
																	<div class="col-md-6"></div>
																</div>
																<div class="table-responsive">
																	<table id="data-table" class="table table-bordered table-condensed table-hover">
																		<thead>
																			<tr style="font-size:12px;">
																				<th></th>
																				<th>Date</th>
																				<th>Begining Balance</th>
																				<th>Repayment Amount</th>
																				<!--<th>Penalty</th>-->
																				<th>Interest</th>
																				<th>Principal</th>
																				<!--<th>Stutus</th>-->
																				<!--<th>Amount Paid</th>-->
																				<th>Ending Balance</th>
																			</tr>
																		</thead>
																		<tbody>@foreach($get_result as $value)
																			<?php 
																			$get_adjusted_interest=str_replace( ',', '', $value[ 'adjusted_interest']); ?>
																			<tr>
																				<td width="5">{{$loop->iteration}}</td>
																				<td> <b>{{$value['date']}}</b>
																					@if (!$next_pay) @if (App\Http\Controllers\Loan\RepaymentController::getNextPayMonth($letter->id,$value['date']))
																					<input type="hidden" id="next_month_payment" value="{{$value['date']}}">
																					<?php $the_next_payment=str_replace( ',', '', $value[ 'next_payment']); ?>
																					<input type="hidden" id="next_instalment_amount" value="{{$the_next_payment}}">
																					<?php $next_pay=true; ?>@endif @else
																					<?php //****** ?>@endif</td>
																				<td><b>₦{{$value['begining_balance']}}</b>
																				</td>
																				<td><b>₦{{$value['repayment_amount']}}</b>
																				</td>
																				<!--<td><b>₦{{$value['penalties']}}</b></td>-->
																				<td><b>₦{{$value['interest']}}</b>
																				</td>
																				<td><b>₦{{$value['principal']}}</b>
																				</td>@if ($value['status'] == true)
																				<!-- <td class="text-success">-->
																				<!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>-->
																				<!--</td>-->@else
																				<!--<td class="text-danger">-->
																				<!--    <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>-->
																				<!--</td>-->@endif
																				<!--<td><b>₦{{$value['amount_paid']}}</b></td>-->
																				<td><b>₦{{$value['balance']}}</b>
																				</td>
																			</tr>
																			<?php 
																			$total_begining_balance += str_replace( ',', '', $value[ 'begining_balance']); 
																			$total_begining_balance += floatval($value[ 'begining_balance']); 
																			$total_repayment_amount +=str_replace( ',', '', $value[ 'repayment_amount']); 
																			$total_penaltie += str_replace( ',', '', $value[ 'penalties']); 
																			$total_interest += str_replace( ',', '', $value[ 'interest']); 
																			$total_principal += str_replace( ',', '', $value[ 'principal']); 
																			$balance += str_replace( ',', '', $value[ 'principal']); 
																			$total_amount_paid += str_replace( ',', '', $value[ 'amount_paid']); 
																			$total_balance += str_replace( ',', '', $value[ 'total_balance']); 
																			?>
																			@endforeach
																			<tr>
																				<td></td>
																				<td><b class="text-danger">Total</b>
																				</td>
																				<td>
																					<!--<b class="text-danger">₦{{number_format($total_begining_balance,2)}}</b>-->
																				</td>
																				<td><b class="text-danger">₦{{number_format($total_repayment_amount,2)}}</b>
																				</td>
																				<!--<td><b class="text-danger">₦{{number_format($total_penaltie,2)}}</b></td>-->
																				<td><b class="text-danger">₦{{number_format($total_interest,2)}}</b>
																				</td>
																				<td><b class="text-danger">₦{{number_format($total_principal,2)}}</b>
																				</td>
																				<!--<td class="text-success"></td>-->
																				<!--<td><b class="text-danger">₦{{number_format($total_amount_paid,2)}}</b></td>-->
																				<!--<td class="text-danger">-->
																				<!--<b>₦{{$balance}}</b>-->
																				<!--    </td>-->
																			</tr>
																		</tbody>
																	</table>
																	<h4 class="text-danger">Total Balance: ₦{{number_format($total_balance+$get_adjusted_interest,2)}}</h4>
																	<input type="hidden" id="full_balance_to_pay_amount" value="{{$total_balance}}">
																</div>
														</div>
													</div>
												</div>
											</div>
											<div class=row>
												<div class=col-md-4>
													<br>Thank you.
													<br>Yours faithfully
													<br>For: UK-Dion
													<br>
													<img src="{{ asset('staff/staffsign')}}/{{getSignature('head_of_loan')}}" title="view image" style="width:20%;">
													<br>Head of Loans
													<br>
												</div>
												<div class=col-md-4>
													<br>
													<br>
													<br>
													<br>
													<img src="{{ asset('staff/staffsign')}}/{{getSignature('complaince_officer')}}" title="view image" style="width:20%;">
													<br>Head, Conpliance</div>
											</div>
											<br>
											<h4 class="text-secondary">Memorandum of Acceptance</h4>
											<br>I, <b class="text-primary">{{strtoupper($letter->customer->first_name.' '.$letter->customer->last_name.' '.$letter->customer->other_name)}}</b> hereby accept the terms and conditions contained in this offer letter for DEFF of <b style="color:#dc3545;">NGN{{number_format($letter->disbursed_amount ? $letter->disbursed_amount : $letter->principal,2)}}</b> dated {{date('d-m-Y')}} of which this is a copy. I have read and understood the statements above and my signature hereunder represents my true and authentic manual signature and is evidence of my agreement to be bound by the terms of this contract between myself and the Lender.
											<br>Signature & Date
											<label>
												<img src="{{ asset('customerfiles/files')}}/{{$letter->customer->employment->sign}}" class="img-responsive" style="width:20%;">{{date('d-m-Y')}}</label>
											<div class="text-center">
												<div class="widget-heading">
												    @if($letter !== null && count($letter->customer->cardInstrument) > 0)
													    <h5 class="text-secondary">Your Payment instrument has been Added Succesfully</h5>
													@endif
												</div>
												@if($letter !== null && count($letter->customer->cardInstrument) == 0 && $letter->product_id != 4)
												    <h5 class="text-secondary">Confirm Your Payment Instrument</h5>
												    <div class="widget-content">
    													<div class="invoice-box">
    														<!--target="_blank"                            -->
    														<div class="inv-action">
    															<!--<a href="{{url('customer/add-card',$letter->customer->id)}}" class="btn btn-secondary mb-4 mr-2" style="background-color:#FFF;">-->
    															<!--     <img src="{{ asset('https://cdn.freebiesupply.com/logos/large/2x/mastercard-4-logo-png-transparent.png')}}" style="width:50px;">-->
    															<!--</a>-->
    															<a href="#" class="btn btn-secondary mb-4 mr-2" style="background-color:#FFF;" data-toggle="modal" data-target="#exampleModalCard">
    																<img src="{{ asset('https://cdn.freebiesupply.com/logos/large/2x/mastercard-4-logo-png-transparent.png')}}" style="width:50px;">
    															</a>
    															<a target="_blank" href="{{url('https://www.remita.net')}}" class="btn btn-secondary mb-4 mr-2" style="background-color:#FFF;">
    																<img src="{{ asset('https://www.remita.net/assets/minimal/images/remita_orange_new_logo.svg')}}" style="width:50px; height:50px;">
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
																				<input class="form-control" value="{{ $letter->customer->email }}" type="email" id="email-address" required readonly/>
																			</div>
																			<div class="form-group">
																				<label style="text-align:left;">Amount</label>
																				<input class="form-control" type="tel" value="50" id="amount" required readonly/>
																			</div>
																			<div class="form-group">
																				<label style="text-align:left;">First Name</label>
																				<input class="form-control" type="text" value="{{ $letter->customer->first_name}}" id="first-name" readonly/>
																			</div>
																			<div class="form-group">
																				<label style="text-align:left;">Last Name</label>
																				<input class="form-control" type="text" value="{{ $letter->customer->last_name}}" id="last-name" readonly/>
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
												@endif
												<br>
												<br>
												<br>
												<!-- Button trigger modal -->
												@if($letter != null && count($letter->customer->cardInstrument) > 0 || $letter->product_id == 4)
												@if($letter->product_id != 4)
													<div class="text-center">
														<button type="button" class="btn btn-success mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">Accept Letter</button>
													</div>
												@endif
												<!-- Start Confirm Modal -->
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
																	<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
																		<line x1="18" y1="6" x2="6" y2="18"></line>
																		<line x1="6" y1="6" x2="18" y2="18"></line>
																	</svg>
																</button>
															</div>
															<form action="{{url('confirm/letter/accepted')}}" method="POST" id="actionForm">{{csrf_field()}}
																<div class="modal-body">
																	<p class="modal-text">
																		<div class="form-group">
																			<label>Refrence Number</label>
																			<input type="text" name="code" placeholder="Refrence Number" class="form-control" required>
																			<input type="hidden" name="customer_id" value="{{$customer_id}}">
																			<input type="hidden" name="loan_id" value="{{$loan_id}}">
																		</div>
																	</p>
																</div>
																<div class="modal-footer">
																	<button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
																	<button type="submit" class="btn btn-primary">Submit</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												<!-- End Confirm Modal -->
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
		<script src="https://checkout.flutterwave.com/v3.js"></script>
		<script type="text/javascript">
			const url = '{{url("store/auth/code")}}'
	        const redirect = '{{ url()->current() }}'
	        const customer_id = '{{$letter->customer->id}}'
	        const paymentForm = document.getElementById('paymentForm');
	       // paymentForm.addEventListener("submit", payWithPaystack, false);
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
		<script>
		  //  const paymentForm = document.getElementById('paymentForm');
	        paymentForm.addEventListener("submit", makePayment, false);
            function makePayment(e) {
                e.preventDefault();
                const currentDate = new Date();
                const timestamp = currentDate.getTime();
                const verify_url = '{{url("verify/transaction")}}'
                const redirectTo = window.location.href
                
                FlutterwaveCheckout({
                    public_key: '{{config("api.flutter.public_key")}}',
                    tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1)+timestamp,
                    amount: 50,
                    currency: "NGN",
                    country: "NG",
                    payment_options: "card",
                    // redirect_url: '',
                    customer: {
                        email: document.getElementById('email-address').value,
                        phone_number: '{{$letter->customer->phone_number}}',
                        name: '{{$letter->customer->first_name}} {{$letter->customer->other_name}} {{$letter->customer->customer}}',
                    },
                    callback: function (data) {
                        const {transaction_id} = data; 
                        swal.queue([{
                            title: 'User Card Added',
                            confirmButtonText: 'Store Authorization Code',
                            text: `The card has been verified and 50 Naira had been deducted from account`,
                            type: 'success',
                            showLoaderOnConfirm: true,
                            preConfirm: function() {
                                return fetch(verify_url, {
                                    method: 'POST',
                                    headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
                                    body: JSON.stringify({ transaction_id, customer_id })
                                })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function(data) {
                                    swal.insertQueueStep('Card Authentication Code Stored')
                                    return window.location = redirectTo
                                })
                                .catch(function() {
                                    swal.insertQueueStep({
                                        type: 'error',
                                        title: 'Something Went Worng'
                                    })
                                })
                            }
                        }])
                    },
                    onclose: function() {
                        // close modal
                    },
                    customizations: {
                        title: "UK-Dion Loan Payment Instrument",
                        description: "Please Enter your Card details for a Debit trial to validate your account and your card",
                        logo: "https://loans.ukdiononline.com/Login_v3/images/loginlogo.png",
                    },
                });
            }
        </script>
</body>
</html>