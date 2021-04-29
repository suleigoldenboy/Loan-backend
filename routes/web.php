<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('test/email', 'Loan\LoanController@testSendEmail');

Route::group(['middleware' => ['adminlog']], function () {

    //Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('home');

    //route for customer
    Route::post('customer/store', 'Customer\CustomerController@store');


    //route for gurator
    Route::post('gurantor/store', 'Customer\GurantorController@store');
    Route::post('gurantor/delete', 'Customer\GurantorController@destroy');

    //Route::post('product/store', 'Loan\ProductController@store');//*****Testing Route */

    //route for loans
    Route::group(['prefix' => 'loan'], function () {

        //*******routes for product********
        Route::get('product', 'Loan\ProductController@index');
        Route::get('product/create', 'Loan\ProductController@create');
        Route::post('product/store', 'Loan\ProductController@store');
        //Route::get('product/{product}/edit', 'Loan\ProductController@edit');
        Route::get('product/{product}', 'Loan\ProductController@show');
        Route::post('product/{id}/update', 'Loan\ProductController@update');
        //Route::get('product/{id}/delete', 'Accounts\ProductController@delete');


        //*******routes for loan********
        Route::get('loan', 'Loan\LoanController@index');
        Route::get('loan/create', 'Loan\LoanController@create');
        Route::get('loan/view', 'Loan\LoanController@index');
        Route::post('loan/store', 'Loan\LoanController@store');
        Route::get('loan/{product}', 'Loan\LoanController@show');
        Route::post('loan/{id}/update', 'Loan\LoanController@update');
        //Route::get('product/{id}/delete', 'Loan\ProductController@delete');


        //******* routes for loan request ****
        Route::get('loan/show/request', 'Loan\LoanController@loanRequest');
        Route::get('loan/show/request/status', 'Loan\LoanController@loanRequestStatus');
        Route::get('loan/show/offline/rejection', 'Loan\LoanController@offlineRejection');
        Route::get('loan/show/decline', 'Loan\LoanController@loanDecline');
        Route::get('loan/show-request/{id}', 'Loan\LoanController@showLoanRequest');
        Route::get('loan/assign-officer/{id}', 'Loan\LoanController@assignOfficerSelectBranch');

        //Route::get('loan/assign-officer', 'Loan\LoanController@assignOfficerSelectOfficer');

        Route::post('loan/store/assignofficer', 'Loan\LoanController@storeAssingOfficer');

        //route for loan confirmation, disbursement and rejection
        Route::post('loan/confirm', 'Loan\LoanController@confirmLoan');
        Route::post('loan/reject', 'Loan\LoanController@rejectLoan');
        Route::post('loan/decline', 'Loan\LoanController@decline');
        Route::post('loan/approve', 'Loan\LoanController@approveLoan');
        Route::post('loan/changeprincipalamount', 'Loan\LoanController@changePrincipalAmount');

        //route for disbursement
        Route::get('loan/disburse/loan', 'Loan\LoanController@disburseLoan');
        Route::post('loan/disbursement', 'Loan\LoanController@loanDisbursement');
        Route::post('loan/reject/disbursement', 'Loan\LoanController@rejectLoanDisbursement');
        Route::get('loan/disburse/loan/payment', 'Loan\LoanController@disburseLoanPayment');
        Route::post('loan/disburse/all/payment', 'Loan\LoanController@loanDisburseMultiplePay');
        Route::post('loan/disburse/single/payment', 'Loan\LoanController@loanDisburseSinglePay');

        //rout for loan details
        Route::get('loan/showloan-detail/{id}', 'Loan\LoanController@showLoanDetail');




        //route for loan comment
        Route::post('loan/comment/store', 'Loan\LoanController@storeCoemment');
        Route::post('loan/comment/delete', 'Loan\LoanController@destroyComment');

        //route to set confirmation process
        Route::get('confirmation-process', 'Loan\LoanConfirmationProcessController@index');
        Route::get('confirmation-process/create', 'Loan\LoanConfirmationProcessController@create');
        Route::post('store/confirmationproccess', 'Loan\LoanConfirmationProcessController@store');
        Route::get('confirmation-process/{id}', 'Loan\LoanConfirmationProcessController@show');
        Route::post('confirmation-process/update', 'Loan\LoanConfirmationProcessController@update');
        Route::get('confirmation-process/delete/{id}', 'Loan\LoanConfirmationProcessController@destroy');


        //*******routes for loan repayment ********
        Route::post('loan/make/repayment', 'Loan\LoanController@makeRepayment');
    });

    //route for customer
    Route::group(['prefix' => 'customer'], function () {
        //*******routes for product********
        Route::get('view', 'Customer\CustomerController@index');
        Route::get('create', 'Customer\CustomerController@create');
        //Route::post('store', 'Customer\CustomerController@store');

        Route::get('create', 'Customer\CustomerController@create');
        Route::post('store/generationinfo', 'Customer\CustomerController@store');

        Route::get('create/employment', 'Customer\CustomerController@createEmployment');
        Route::post('store/employment', 'Customer\CustomerController@storeEmployment');

        Route::get('create/guarantor', 'Customer\CustomerController@createGuarantor');
        Route::post('store/guarantor', 'Customer\CustomerController@storeGuarantor');

        Route::get('create/loan', 'Customer\CustomerController@createLoan');
        Route::post('store/loan', 'Customer\CustomerController@storeLoan');

        Route::get('create/file', 'Customer\CustomerController@createFile');
        Route::post('store/file', 'Customer\CustomerController@storeFile');

        Route::get('view/in-complete-reg', 'Customer\CustomerController@incompleteReg');
        Route::get('registration/continue/{id}/{type}', 'Customer\CustomerController@completeReg');
        
         /***  Federal Loan Route */
    Route::get('create/federal', 'Loan\FederalLoanController@create');
    Route::post('store/federal', 'Loan\FederalLoanController@store');
    Route::get('create/completed', 'Loan\FederalLoanController@completed');
    Route::get('registration/continue/federal/{id}/{loan_id}/{type}', 'Loan\FederalLoanController@create');
    });

    //route for privileges
    Route::group(['prefix' => 'admin'], function () {
        //privileges
        Route::get('/role', 'Admin\PrivilegesController@index');
        Route::get('/permission', 'Admin\PrivilegesController@indexPermission');
        Route::post('/store/permission', 'Admin\PrivilegesController@storePermission');


        Route::get('/add/role', 'Admin\PrivilegesController@create');
        Route::post('/store/privilege', 'Admin\PrivilegesController@store');
        Route::get('/edit/privilege/{id}', 'Admin\PrivilegesController@show');
        Route::post('/update/privilege', 'Admin\PrivilegesController@update');

        Route::get('/privileges', 'Admin\PrivilegesController@indexPrivileges');
        Route::get('/privileges/action', 'Admin\PrivilegesController@indexAction');
    });

    //route for Offer Letter
    Route::group(['prefix' => 'admin'], function () {
        //privileges
        Route::get('/offer-letter', 'Admin\OfferLetterController@index');
        Route::get('/create/offer-letter', 'Admin\OfferLetterController@create');
        Route::post('/store/offer-letter', 'Admin\OfferLetterController@store');
        Route::get('/edit/offer-letter/{id}', 'Admin\OfferLetterController@edit');
        Route::get('/show/offer-letter/{id}', 'Admin\OfferLetterController@show');
        Route::post('/update/offer-letter', 'Admin\OfferLetterController@update');
    });


    //route for Borrower Management
    Route::group(['prefix' => 'borrower'], function () {
        Route::get('/management', 'Loan\BorrowerManagementController@index');
        Route::get('/create', 'Loan\BorrowerManagementController@create');
        Route::get('/create/next', 'Loan\BorrowerManagementController@createNext');
        Route::post('/store', 'Loan\BorrowerManagementController@store');
        Route::get('/edit/{id}', 'Loan\BorrowerManagementController@show');
        Route::post('/update', 'Loan\BorrowerManagementController@update');
    });

    //route for Accounting
    Route::group(['prefix' => 'account'], function () {

        Route::get('/dashboard', 'Account\AccountsController@index');
        Route::get('/accountslist', 'Account\AccountsController@accountList');
        Route::get('/auto/journal/entry', 'Account\AccountsController@autoJournal');
        Route::get('/create/auto/journal/entry', 'Account\AccountsController@createAutoJournal');
        Route::post('/store/auto/journal/entry', 'Account\AccountsController@storeAutoJournalEntry');
        Route::get('/edit/auto/journalentry/{id}/', 'Account\AccountsController@editAutoJournalEntry');

        Route::post('/chart/store', 'Account\AccountsController@store');
        Route::get('/create/sub/{id}/{type}/{name}', 'Account\AccountsController@create');
        Route::post('/chart/sub/store', 'Account\AccountsController@storeSub');

        //start General ledger reporting
        Route::get('/glreportsettings', 'Account\GeneralLedgerController@glReportSettings');
        Route::get('/create-glreportsettings', 'Account\GeneralLedgerController@createGlReportSettings');
        Route::post('/store-glreportsettings', 'Account\GeneralLedgerController@storeGeneralLegderReportSettings');
        //end General ledger reporting

        Route::get('/general/ledger', 'Account\AccountsController@ledger');
        Route::get('/general/ledger/details', 'Account\AccountsController@ledgerDetails');
        Route::get('/income/report', 'Account\AccountsController@incomeReport');
        Route::get('/expense/report', 'Account\AccountsController@expenseReport');
        Route::get('/disburse/report', 'Account\AccountsController@disburseReport');
        Route::get('/repayment/report', 'Account\AccountsController@repaymentReport');
        Route::get('/repayment-history', 'Account\AccountsController@repaymentHistory');


        // Route::get('/edit/{id}', 'Account\AccountsController@show');
        // Route::post('/update', 'Account\AccountsController@update');

    });

    //route to view and send loan Offer Letter
    Route::group(['prefix' => 'admin'], function () {

        Route::get('/show/loan/offer-letter/{id}', 'Admin\OfferLetterController@loanOfferLetter');

        Route::get('/send/loan/offer-letter/{id}/{customer_id}/{email}', 'Admin\OfferLetterController@sendOfferLetter');

        // Route::get('/show/loan/accepted/offer-letter/{id}', 'Admin\OfferLetterController@showAcceptedLetter');
        // Route::get('/show/loan/accepted/application-form/{id}', 'Admin\OfferLetterController@showAcceptedForm');
    });


    //Route to view an audit trial
    Route::get('/audit/logs/{id}/{type}', 'Admin\AuditTrialController@index');
});

Route::get('/confirm/my/letter', 'UserOfferLetterController@confirmLetter');
Route::post('/confirm/letter/accepted', 'UserOfferLetterController@storeConfirmLetter');
Route::get('/customer/download/loan/offer-letter/{id}', 'UserOfferLetterController@downloadOfferLetter');
Route::get('/customer/download/application-form/{id}', 'UserOfferLetterController@downloadApplicationForm');
Route::get('/offer/accepted/completed', 'UserOfferLetterController@offerCompleted');



Route::get('/rate', function () {
    $salaryDate = Carbon::parse('2020-11-9');
    $start = Carbon::parse('2020-11-19');
    if ($salaryDate > $start && Carbon::parse('2020-11-19')->diffInDays('2020-11-9') < 15) {
        return Carbon::parse('2020-11-19')->diffInDays('2020-11-9');
    }
});
Route::get('/loan-date', function () {

    if (Carbon::now()->month(6) > Carbon::now()->month(7)) {
        return true;
    }
    $payDay = 19;
    $created_date = '2020-11-1';
    $payDate = nextPayDay($payDay, $created_date);
    return getStartDate($payDate, $created_date);
});

function nextPayDay($payDay, $created_date)
{
    $payDateForSameMonth = Carbon::parse($created_date)->day($payDay);
    $created_date = Carbon::parse($created_date);
    if ($payDateForSameMonth <= $created_date) {
        return $created_date->addMonth()->day($payDay)->format('Y-m-d');
    }
    return $payDateForSameMonth->format('Y-m-d');
}

function getStartDate($payDate, $created_date)
{
    var_dump($payDate, $created_date);
    if ($payDate < $created_date) {
        if (Carbon::parse($created_date)->diffInDays($payDate) < 15) {
            return Carbon::parse($created_date)->addMonth()->format('Y-m-d');
        } else {
            return Carbon::parse($created_date)->format('Y-m-d');
        }
    } else {
        if (Carbon::parse($created_date)->diffInDays($payDate) > 15) {
            return Carbon::parse($created_date)->format('Y-m-d');
        } else {
            return Carbon::parse($created_date)->addMonth()->format('Y-m-d');
        }
    }
}

Route::get('transactions/flutter', function () {
    $query = (request()->get('customer_fullname') !== null) ? request()->getQueryString() : 'page=' . request()->get('page');
    $url =  'https://api.flutterwave.com/v3/transactions?' . $query;
    // dd($url);
    $response = appRequest('get',  $url, 'FLWSECK-8974c2ee3f2cd771a540437819656a9e-X');
    if ($response->successful()) {
        return view('report.transaction.flutter', ['transactions' => $response->json()]);
    }
    return false;
});
