<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\User\Customer\Customer;
use App\Http\Controllers\Controller;
use App\Notifications\VerificationNotification;
use App\Http\Requests\Api\Auth\RegistrationRequest;
use App\Http\Controllers\Api\Auth\Traits\ApiAuthTrait;

//use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use ApiAuthTrait;
    public function register(RegistrationRequest $request)
    {
        $userRequest = $this->appendData($request);
        try{
            $user = Customer::create($userRequest);
            $user->phoneVerification()->notify(
                new VerificationNotification($user->getUserToken(
                    $request->phone_number
                ))
            );
        }catch(Exception $err){
            $errorMessage = $err->getMessage();
            return invalidRequest(['errorMessage' => $errorMessage]);
        }
        return jsonResponse(['message' => 'Your Registration was successful']);
    }

}
