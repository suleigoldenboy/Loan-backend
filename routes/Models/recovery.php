<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//*******routes for product********
Route::group(['middleware' => 'auth'], function () {
    Route::get('recovery-history', 'Loan\Recovery\RecoveryController@showHistory');
    Route::get('recover/loan/amount/{uuid}', 'Loan\Recovery\RecoveryController@recoverAmount');
    Route::get('recover', 'Loan\Recovery\RecoveryController@recover');
    Route::get('customer/add-card/{uuid}', 'Customer\RePayment\PaymentInstrumentController@addCard');
    Route::post('store/auth/code', 'Customer\RePayment\PaymentInstrumentController@storeAuthCode');
    Route::get('send/card/form/{uuid}', 'Customer\RePayment\PaymentInstrumentController@sendCardForm');
    Route::get('send/card/form', 'Customer\RePayment\PaymentInstrumentController@showCardForm');
});
Route::get('update/card/{uuid}', 'Customer\RePayment\PaymentInstrumentController@updateCard')->name('update.card');
Route::post('verify/transaction', 'Customer\RePayment\PaymentInstrumentController@verifyTransaction')->name('verify.card');
