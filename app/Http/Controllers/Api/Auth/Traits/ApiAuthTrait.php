<?php

namespace  App\Http\Controllers\Api\Auth\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
/**
 * Contain all auth the function
 */
trait ApiAuthTrait
{
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return jsonResponse([
            "error" => "invalid_credentials",
            "message" => "Please check your login details and try again."
        ], 405);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse($user)
    {
        return jsonResponse([
            'user' => collect($user)->put('token', $user->createToken(config('api.name'))->plainTextToken)->put('hasGuarantor', $user->hasGuarantor())->put('auth_step', 'PIN'),
        ],200);
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin($user, $request){
        return (Hash::check($request->password, $user->password)) ? true : false;

    }

    protected function invalidOtpToken(){
        return jsonResponse([
            "error" => "invalid_credentials",
            "message" => "The token you supplied is not correct"
        ], 405);
    }

    protected function sendOtpResponse($token){
        return jsonResponse([
            // 'user' => request()->user(),
            'token' => $token->accessToken
        ], 200);
    }

    protected function appendData(Object $data):Array{
        $ora = array_merge($data->all(), [
            'name'  => $data->first_name. ' '. $data->other_name . ' '. $data->last_name,
            'uuid' => generateUuid(),
            'password' => Hash::make($data['password']),
        ]);
        return $ora;
    }
}
