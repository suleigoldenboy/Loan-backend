<?php

namespace App\Http\Controllers\Customer\RePayment;

use App\Http\Controllers\Controller;
use App\Mail\Customer\MailCardForm;
use App\Models\Customer\Customer;
use App\Models\Loan\Loan;
use App\Models\Loan\TheLoanOfferLetter;
use App\User\Customer\Customer as ApiCustomer;
use App\User\Customer\Repayment\CardInstrument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentInstrumentController extends Controller
{
    public function addCard(Request $request)
    {
        try {
            return view('admin.customer.add_card', ['user' => Customer::where('id', $request->uuid)->first()]);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()], 400);
        }
    }

    public function storeAuthCode(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'reference' => 'required'
        ]);
        $user = Customer::where('id', $request->customer_id)->first();
        try {
            $data = (array)$user->verifyTransaction($request->reference);
            $user->cardInstrument->create($data);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()], 400);
        }
    }

    public function sendCardForm(Request $request)
    {
        try {
            $user = Customer::findOrFail($request->uuid);
            Mail::to($user)->send(new MailCardForm($user));
            $request->session()->flash('success', 'Operation Successful');
            return redirect('/');
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function updateCard(Request $request)
    {
        try {
            $user = ApiCustomer::findByHash($request->uuid);
            return view('admin.customer.card.change', ['user' => $user]);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function showCardForm(Request $request)
    {
        try {
            return view(
                'admin.customer.card.update',
                [
                    'users' => ApiCustomer::all()
                ]
            );
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function verifyTransaction(Request $request)
    {
        try {
            $response =  appRequest('get', str_replace('{id}', $request->transaction_id, config('api.flutter.verify_transaction')), config('api.flutter.secret_key'));
            if ($response->successful()) {
                $data = (array)$response->json();
                $data = $data['data'];
                $user = Customer::where('id', $request->customer_id)->first();
                $user->cardInstrument->create([
                    'reference_code' => $data['flw_ref'],
                    'authorization_code' => $data['card']['token'],
                    'card_type' => $data['card']['type'],
                    'last4' => $data['card']['last_4digits'],
                    'exp_month' => $data['card']['expiry'],
                    'exp_year' => $data['card']['expiry'],
                    'bin' => $data['card']['first_6digits'],
                    'bin' => $data['card']['first_6digits'],
                    'bank' => $data['card']['issuer'],
                    'reusable' => true,
                    'signature' => $data['flw_ref'],
                    'gateway' => 'flutter_wave',
                ]);
                return response()->json(['message' => 'successful']);
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
