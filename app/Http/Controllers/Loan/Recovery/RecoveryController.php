<?php

namespace App\Http\Controllers\Loan\Recovery;

use App\Models\Loan\Loan;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;

class RecoveryController extends Controller
{
    public function showHistory(Loan $loan, Request $request){
        $loans =  null;
        $message = null;
        if($request->isMethod('post')){
            if($request->name !== null){
                foreach(explode(' ',$request->name) as $name){
                    $loans = Customer::where('name', 'LIKE', "%$name%")->orWhere('first_name', 'LIKE', "%$name%")->orWhere('last_name', 'LIKE', "%$name%")->first()->loan()->get()->load('customer')->load('recovery');
                    $message  = "Search Result for: {$request->name}";
                }
            }else{
                $loans = Loan::whereBetween('release_date', [$request->start_date, $request->end_date])->get()->load('customer')->load('recovery');
                $message  = "Search Result from: {$request->start_date} to {$request->end_date}";
            }
        }else{
            $loans= $loan->getRunningLoan()->load('customer')->load('recovery');
        }
        return view('admin.loan.recovery.history', ['loans' => $loans, 'message' => $message]);
    }

    public function recoverAmount(Loan $loan, Request $request){
        $loan = $loan->getByHash($request->uuid);
        if($loan->checkLoan()) {
            // Query User Base on their Repayment Instrument
            if(in_array('CARD', explode(',', $loan->getRepaymentInstrument()))) {
                runCardPayment($loan->customer_id, $loan->getAmountDue(), $loan);
            }else{
                null;

            }
            return jsonResponse(['data' => user()]);
        }
    }

    public function recover(Loan $loan, Request $request){
        $loans = $loan->getRunningLoan()->load('customer')->load('recovery');
        return view('admin.loan.recovery.history', ['loans' => $loans]);
    }

}
