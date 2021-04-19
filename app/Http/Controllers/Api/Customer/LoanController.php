<?php

namespace App\Http\Controllers\Api\Customer;

use App\HelperFunction\LoanUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\LoanRequest;
use App\Models\Loan\Product;
use App\User\CustomerLoan\Loan;
use App\User\Verification\CustomerVerification;

class LoanController extends Controller
{
    public function checkRequestAmount(Request $request)
    {
        $request->validate([
            'income' => 'required|numeric',
            'duration' => 'required'
        ]);
        $creditWorthy = ((($request->income * 0.4)/1.032) * $request->duration);
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
        try {
            $loan = Loan::create($this->appendData($request));
            return jsonResponse(['data'=> $loan, 'message' => 'Loan Requested Submitted Successfully']);
        } catch (\Throwable $th) {
            return invalidRequest($th->getMessage());
        }
    }

    public function userLoanList(Request $request){
        return jsonResponse(['data' => user()->loan->get()]);
    }

    public function userLoan(Request $request, $id){
        $loan = user()->loan->where('id', $id)->first();
        return jsonResponse(['data' => ['calendar' => LoanUtil::generateCalendar($loan), 'details' => $loan]]);
    }

    private function appendData($request){
        $product = new Product();
        $product = $product->find($request->product_id);
        $document = CustomerVerification::where('customer_id', $request->user()->id)->latest()->first();
        return array_merge([
            'customer_request' => true,
            'customer_id' => $request->user()->id,
            'branch_id' => $request->user()->branch_id,
            'confirmation_status' => 1,
            'status' => 'processing',
            'customer_verification_id' => (!empty($document)) ? $document->id : null ,
            'interest_rate' => $product->interest_rate,
            'insurance_charge' => $product->insurance_charge,
            'processing_charge' => $product->processing_charge,
        ], $request->all());
    }
}
