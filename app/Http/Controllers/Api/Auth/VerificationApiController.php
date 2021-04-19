<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User\Customer\Customer;
use App\Http\Controllers\Controller;

class VerificationApiController extends Controller
{
    public function verify(Request $request)
    {
        $user = Customer::findOrFail($request->id);
        if ($user->hasVerifiedEmail()) {
            return response()->json("User already have verified email!", 422);
        }
        $user->email_verified_at = Carbon::now();
        $user->save();
        return response()->json("Email verified!");
    }

    public function resendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        # code...
    }
}
#08038718987
//bankstatement@renmoney.com
