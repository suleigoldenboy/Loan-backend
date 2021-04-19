<?php

use App\User\CustomerLoan\Loan;
use Carbon\Carbon;
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

Route::group(['middleware' => 'auth'], function(){
    //*******routes for product********
    Route::resource('product', 'Loan\ProductController');
});
Route::get('/loan/calendar/{uuid}', 'Loan\Recovery\RepaymentCalender@getLoanCalendar');

Route::get('loan/compare', function(Loan $loans){
    $allRunningLoan = $loans->getMonthlyRepayAbleLoan();
    return $allRunningLoan;
});
