<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\Traits\ApiAuthTrait;
use App\Http\Controllers\Controller;
use App\User\Customer\Customer;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use ApiAuthTrait;

    public function login(Request $request){
        $request->validate([
            'phone_number' => 'required|exists:customers,phone_number',
            'password' => 'required|min:4'
        ], [
            'phone_number.exists' => 'Your credentials are not correct, please check it and try again'
        ]);
        $user =  Customer::getUserBy('phone_number', $request->phone_number);
        if($this->attemptLogin($user, $request)){
            return $this->sendLoginResponse($user);
        }
        return $this->sendFailedLoginResponse($request);
    }
}
