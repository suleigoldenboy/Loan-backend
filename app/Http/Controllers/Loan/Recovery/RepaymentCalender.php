<?php

namespace App\Http\Controllers\Loan\Recovery;

use App\HelperFunction\LoanUtil;
use App\Http\Controllers\Controller;
use App\User\CustomerLoan\Loan as CustomerLoan;
use Illuminate\Http\Request;

class RepaymentCalender extends Controller
{
    public function getLoanCalendar(Request $request){
        $loan = CustomerLoan::where('id', $request->uuid)->first();
        return LoanUtil::generateCalendar($loan);
    }
}
