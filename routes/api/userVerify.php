<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function(){
    Route::get('verify/bvn', 'Api\User\Verification@VerifyBvn');
    Route::get('verify/card', 'Api\User\Verification@verifyCard');
    Route::get('verify/account', 'Api\User\Verification@verifyAccount');
});