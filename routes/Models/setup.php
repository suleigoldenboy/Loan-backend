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
Route::group(['prefix' => 'setup'], function () {
    Route::get('banks/', function() {
        $banks = curl()->getAsJson(config('api.paystack.bank_url'), config('api.paystack.header.auth'));
        try{
            insertBanks($banks);
        }catch(Exception $e){
            return appRedirect([], 'home', ['errorMessage', 'Could not setup the banks'], request());
        }
        return view('admin.setup.add-bank-list', ['banks' => $banks]);
    });
});