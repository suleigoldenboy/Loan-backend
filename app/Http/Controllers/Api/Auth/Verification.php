<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User\Customer\Customer;
use Illuminate\Http\Request;

class Verification extends Controller
{
    public function phoneVerification(Request $request):object
    {
        $request->validate([
            'token' => 'required',
            'phone_number' => 'required'
        ]);
        $user = Customer::where('phone_number', $request->phone_number)->first();
        $foundToken = $user->verification->token;
        if($foundToken == $request->token){
            $user->validateToken();
            return jsonResponse(['message' => 'Verification is Successful']);
        }
        return jsonResponse(['message' => 'invalid verification code'], 400);
    }
}
