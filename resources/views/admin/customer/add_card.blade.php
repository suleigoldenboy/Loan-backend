@extends('layouts.admin-app')
@section('content')
<div id="content" class="main-content">
    <div class="container">
        <div class="container">
            <div class="row">
                <div id="card_1" class="col-lg-12 layout-spacing layout-top-spacing">
                    <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Add Payment Card The Card will be charge 50 Naira</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <div class="card component-card_1">
                                    <div class="card-body">
                                        <form class="form" id="paymentForm">
                                            <div class="form-row mb-4 ">
                                                <div class="form-group col-md-12">
                                                    <label for="email">Email Address</label>
                                                    <input class="form-control" value="{{ $user->email }}" type="email" id="email-address" required readonly/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="amount">Amount</label>
                                                <input class="form-control" type="tel" value="50" id="amount" required readonly/>
                                            </div>
                                            <div class="form-group">
                                                <label for="first-name">First Name</label>
                                                <input class="form-control" type="text" value="{{ $user->first_name}}" id="first-name" readonly/>
                                            </div>
                                            <div class="form-group">
                                                <label for="last-name">Last Name</label>
                                                <input class="form-control" type="text" value="{{ $user->last_name}}" id="last-name" readonly/>
                                            </div>
                                            <div class="form-submit">
                                                <button type="submit" class="btn btn-submit btn-success btn-lg" > Pay </button>
                                            </div>
                                        </form>
                                        <!--<form>-->
                                        <!--    <script src="https://checkout.flutterwave.com/v3.js"></script>-->
                                        <!--    <button type="button" onClick="makePayment()">Pay Now</button>-->
                                        <!--</form>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
    const url = '{{url("store/auth/code")}}'
    const redirect = '{{url("customer/create")}}'
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
                confirmButtonText: 'Store Authorization Code',
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
                        return window.location = redirect
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
  function makePayment() {
    const currentDate = new Date();
    const timestamp = currentDate.getTime();
    FlutterwaveCheckout({
        public_key: "FLWPUBK_TEST-SANDBOXDEMOKEY-X",
        tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1)+timestamp,
        amount: 50,
        currency: "NGN",
        country: "NG",
        payment_options: "card",
        redirect_url: '{{url("store/auth/code")}}',
        customer: {
            email: document.getElementById('email-address').value,
            phone_number: '{{$user->phone_number}}',
            name: '{{$user->first_name}} {{$user->other_name}} {{$user->other_name}}',
        },
        callback: function (data) {
            console.log(data);
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
@endsection