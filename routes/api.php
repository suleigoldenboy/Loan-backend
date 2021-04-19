<?php

use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('/auth')->group(function(){
    Route::post('login/', 'Api\Auth\LoginController@login');
    Route::post('verify/phone', 'Api\Auth\Verification@phoneVerification');
    Route::post('register/', 'Api\Auth\RegisterController@register');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/user')->group(function(){
        Route::post('verify/bvn', 'Api\User\Verification@VerifyBvn');
        Route::post('verify/card', 'Api\User\Verification@VerifyCard');
        Route::post('verify/account', 'Api\User\Verification@VerifyAccount');
        Route::post('/request-loan', 'Api\Customer\LoanController@requestLoan');
        Route::post('update-info', 'Api\User\UserManagement@updateUserProfile');
        Route::apiResource('guarantor', 'Api\Customer\GuarantorController');
        Route::get('loan/history', 'Api\Customer\LoanController@userLoanList');
        Route::get('loan/{uuid}', 'Api\Customer\LoanController@userLoan');
        Route::post('upload/documents', 'Api\Customer\FileManager@addFile');
        Route::post('/employment-details', 'Api\Customer\UserProfile@employmentDetails');
        Route::post('customer-info', 'Api\Customer\UserProfile@customerInformation');
        Route::post('customer-sign', 'Api\Customer\FileManager@uploadSignature');
        Route::get('/loan/calendar/{uuid}', 'Loan\Recovery\RepaymentCalender@getLoanCalendar');
        Route::get('/income', 'Api\Customer\UserProfile@getUserIncome');
        Route::get('/documents', 'Api\Customer\FileManager@getUserFile');
    });
});

Route::post('/loan/worthy', 'Api\Customer\LoanController@checkRequestAmount');
Route::get('/branches', 'Api\Customer\UtilityController@getBranch');
Route::get('/banks', 'Api\Customer\UtilityController@getBankList');
Route::get('/products', 'Api\Customer\UtilityController@getProducts');

Route::prefix('email/')->group(function (){
    Route::get('verify/{id}', 'Api\Auth\VerificationApiController@verify')->name('verification.verify');
    Route::get('resend/', 'Api\Auth\VerificationApiController@resendEmail')->name('verification.resend');
});


Route::get('/', function(){

    $from = '2019-01-01';
    $to = '2020-04-01';
    $period = CarbonPeriod::create($from, '1 month', $to);

    foreach ($period as $dt) {
            echo $dt->format("Y-m") . "<br>\n";
    }
});
