<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\LoanRequest;
use App\User\CustomerLoan\Loan;

class LoanController extends Controller
{
    public function checkRequestAmount(Request $request)
    {
        $request->validate([
            'income' => 'required|numeric',
        ]);
        $creditWorthy = ($request->income * collect(config('loan'))->where('amount', '<=', $request->income)->last()['percentile'] * (int)12);
        return jsonResponse([
            'amount' => format_number($creditWorthy)
        ]);
    }

    /**
     * @param LoanRequest $request
     * @return Object
     */
    public function requestLoan(LoanRequest $request):object
    {
        Loan::create($this->appendData($request));
        return jsonResponse(['message' => 'Loan Requested Submitted Successfully']);
    }

    public function userLoanList(Request $request){
        return user()->loan->take(10)->get();
    }

    private function appendData($request){
        return array_merge([
            'customer_request' => true,
            'customer_id' => $request->user()->id,
            'branch_id' => $request->user()->branch_id,
        ], $request->all());
    }
}
