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
        $result = Loan::where('confirmation_status','active')->get();
        
        foreach ($result as $data) {
            $set_disburse_Amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
            $total_charge = calPercentageAndDeduction($data->loan_duration_length,$data->insurance_charge,$data->processing_charge,$set_disburse_Amount,7.5);
            $d_amount = $set_disburse_Amount-$total_charge;
            $total += $d_amount;
        }

        return $total;

    }
    //get total number running laon
    public static function getRunningLoan()
    {
        $id = \DB::table('products')->where('name', 'DEFF')->first()->id;
        return count(Loan::where('status','active')->where('product_id',$id)->get());
    }
    
    public static function getTotalRunningLoan(){
        return [
            'total_loan_count' => Loan::where('status','active')->get()->count(),
            'total_loan' => Loan::where('status','active')->get(),
            'total_e_request' => Loan::where('customer_request', 1)->where('status','active')->get()->count(),
            'total_e_request_amount' => Loan::where('customer_request', 1)->where('status','active')->get(),
        ];
    }
    
    //get total running laon amount
    public static function getRunningLoanAmount()
    {
        $total = 0;
        $id = \DB::table('products')->where('name', 'DEFF')->first()->id;
        $result = Loan::where('status','active')->where('product_id',$id)->get();
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
     //get total federal running laon amount
     public static function getRunningFederalLoanAmount()
     {
         $total = 0;
         $id = \DB::table('products')->where('name', 'Federal')->first()->id;
         $result = Loan::where('status','active')->where('product_id',$id)->get();
         foreach ($result as $data) {
             $total += $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
         }
         return $total;
     }
     //get total number running federal laon
    public static function getRunningFederalLoan()
    {
        $id = \DB::table('products')->where('name', 'Federal')->first()->id;
        return count(Loan::where('status','active')->where('product_id',$id)->get());
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
        return Loan::where('status','active')->orderBy('id', 'desc')->take(4)->get();
    }
    public static function riskLoan($id)
    {
        return Loan::where('confirmation_status', $id)->get();
    }
    public static function exCheckerOne()
    {
        return Loan::where('status','approve')->orderBy('id','DESC')->get();
    }
    public static function exCheckerTwo()
    {
        return Loan::where([['confirmation_status', 'active'], ['status','active'] ])->whereNull('status_paid')->orWhere('status_paid','!=','paid')->orderBy('release_date', 'DESC')->get();
    }
    public static function declineLoan(){
        return Loan::where('confirmation_status','decline')->orderBy('id','DESC')->get();
    }
    
    public static function getStaffRunningLoan(){
        $id = \DB::table('products')->where('name', 'UKD-Staff Loan')->first()->id;
        return $requestLoan = Loan::where('product_id', $id)->where('status','active')->get();
        
    }
}
