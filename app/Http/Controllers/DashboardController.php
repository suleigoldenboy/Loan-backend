<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Loan\RepaymentController;
use App\Http\Controllers\Controller;
use App\Models\Admin\Branch;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Customer\Customer;
use App\Models\Settings\LoanConfirmationProcess;
use App\Models\Admin\PrivilegesActions;
use App\Models\Loan\Loan_Comment;
use App\Models\Loan\Loan_Repayment;
use App\Models\Admin\CompanyBank;
use App\Http\Helpers\AdminHelper;
use App\Models\Account\AccountsChart;
use App\Models\Account\SubAccountsChart;
use App\Models\Employee\User;
use App\Models\HRManagement\Employee;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    //Test repayment schedule calender
    public function testRepaymentScheduleCal()
    {
         // $loan_id = 25;
        // $loan_amount = 100000;
        // $interest_rate = 13;
        // $duration = 'year';
        // $duration_lenght = 30;
        // $loan_start_date = '2020-01-27';

        //  $result = RepaymentController::repaymentScheduleCalendar($loan_id,$loan_amount,$interest_rate,$duration,$duration_lenght,$loan_start_date);

        //  echo $result;

    }
    //get total disburse amount
    public static function getTotalDisburseLoan()
    {
        $total = 0;
        $result = Loan::where('status','active')->get();

        foreach ($result as $data) {

            $total += $data->disbursed_amount;
        }

        return $total;

    }
    //get total number running laon
    public static function getRunningLoan()
    {
        return count(Loan::where('status','active')->get());
    }
    //get total running laon amount
    public static function getRunningLoanAmount()
    {
        $total = 0;
        $result = Loan::where('status','active')->get();

        foreach ($result as $data) {

            $total += $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
        }

        return $total;
    }
    //get total amount of laon repayment
    public static function getTotalRepayment()
    {
        $total = 0;
        $result = Loan_Repayment::get();

        foreach ($result as $data) {

            $total += $data->amount;
        }

        return $total;
    }
    //get total interest amount
    public static function getTotalInterestAmount()
    {

    }
    //get number of employees
    public static function getTotalOfEmployees()
    {
        return count(Employee::get());
    }
    //get resent loan borrowers
    public static function getRecentBorrowers()
    {
        return Customer::orderBy('id', 'desc')->take(4)->get();
    }

}
