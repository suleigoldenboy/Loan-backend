<?php

namespace App\Http\Controllers\Loan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Customer\Customer;
use App\Models\Settings\LoanConfirmationProcess;
use App\Models\Admin\PrivilegesActions;
use App\Models\Loan\Loan_Comment;
use App\Models\Loan\Loan_Repayment;
use App\Models\Admin\CompanyBank;
use App\Http\Helpers\AdminHelper;
use App\Models\Employee\User;
use Auth;
use DB;
use Session;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Loan::all();

        return view('accounting.loan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Product::all();
        $borrowers = Customer::all();
        $loan_officers = User::get();
        return view('accounting.loan.create', compact('data','borrowers','loan_officers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{

            $_loan = new Loan();
            $_loan->user_id = Auth::user()->id;
            $_loan->loan_officer_id = $request->loan_officer_id;
            $_loan->customer_id = $request->customer_id;
            $_loan->product_id = $request->product_id;
            //$_loan->branch_id = $request->branch_id;
            $_loan->release_date = $request->release_date;
            $_loan->maturity_date = $request->maturity_date;
           // $_loan->interest_start_date = $request->interest_start_date;
            $_loan->first_payment_date = $request->first_payment_date;
            $_loan->loan_disbursed_by_id = $request->loan_disbursed_by_id;
            $_loan->principal = $request->principal;
            //$_loan->interest_method = $request->interest_method;
            $_loan->interest_rate = $request->interest_rate;
            $_loan->repayment_method = $request->repayment_method;
            // $_loan->files = $request->files;
            // $_loan->note = $request->note;
            $_loan->status = $request->status;
            $_loan->confirmation_status = 1;
            $_loan->balance = $request->balance;
            $_loan->loan_purpose = $request->loan_purpose;
            $_loan->save();

           AdminHelper::audit_trail('loan','New Loan created',$_loan->id);

            //return response()->json($_loan, 201);

            Session::flash('successMessage', "Loan created successful");
            return back();

        }catch (\Exception $e) {
           return back();
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCoemment(Request $request)
    {

        try{

            $_loan = new Loan_Comment();
            $_loan->user_id = Auth::user()->id;
            $_loan->loan_id = $request->loan_id;
            $_loan->notes = $request->note;
            $_loan->save();

            AdminHelper::audit_trail('loan','New loan comment created',$request->loan_id);

            Session::flash('successMessage', "Comment save successful");
            return back();

        }catch (Exception $e) {
           return back();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display all loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function loanRequest()
    {

        $get_user_process = static::get_myConfirmProcessId();

        $data = Loan::where('confirmation_status', $get_user_process)->orderBy('id','DESC')->get();

        // $data = DB::table('customers')->where('registration_step_status','complete')
        //         ->join('loans','customers.id', '=', 'loans.customer_id')
        //         ->get();


        return view('accounting.loan.processing', compact('data'));
    }

     /**
     * Display all declined loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function loanDecline()
    {

        $data = Loan::where('confirmation_status','decline')->orderBy('id','DESC')->get();


        return view('accounting.loan.decline', compact('data'));
    }

    /**
     * show all loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoanRequest($id)
    {
        try{

            $data = Loan::findOrFail($id);
            $banks  = CompanyBank::get();
            return view('accounting.loan.show-loan-request', compact('data','banks'));

         }catch (Exception $e) {
            return back();
        }
    }
    /**
     * show all loan details.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoanDetail($id)
    {
        try{

            $data = Loan::findOrFail($id);
            return view('accounting.loan.show-loan-details', compact('data'));

         }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyComment(Request $request)
    {
        try{

            Loan_Comment::where('id',$request->loan_id)->delete();
            AdminHelper::audit_trail('loan','Loan comment Deleted',$request->loan_id);

            Session::flash('successMessage', "Loan comment deleted successful");
            return back();
        }catch (Exception $e) {
            return back();
        }
    }

     /**
     * Confirm loan to from one proccess to another
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmLoan(Request $request)
    {

        try{

            $get_next_step = static::check_if_user_is_last_to_confirm_laon();

            Loan::where('id', $request->loan_id)
            ->update(['confirmation_status' => $get_next_step]);

            AdminHelper::audit_trail('loan','Loan confirmed to next process',$request->loan_id);

            Session::flash('successMessage', "Loan confirm successful");
            return redirect('loan/loan/show/request');
            static::check_if_user_is_last_to_confirm_laon();

        }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Reject loan to from one proccess to another
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectLoan(Request $request)
    {
        try{

            $get_user_process = static::get_myConfirmProcessId();
            $get_next_step = $get_user_process-1;

            Loan::where('id', $request->loan_id)
            ->update([
                    'confirmation_status' => $get_next_step,
                    'rejection_status' => 'active']
                 );

            AdminHelper::audit_trail('loan','Loan rejected back to next process ( '.$request->reason.' )',$request->loan_id);

            Session::flash('successMessage', "Loan rejected successful");
            return redirect('loan/loan/show/request');
        }catch (Exception $e) {
            return back();
        }
    }

    /**
     * Reject loan to from one proccess to another
     *
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request)
    {
        try{

            Loan::where('id', $request->loan_id)
            ->update([
                    'confirmation_status' => 'decline',
                    'decline' => 'active',
                    'decline_reason' => $request->reason]
                 );

            AdminHelper::audit_trail('loan','Loan decline process ( '.$request->reason.' )',$request->loan_id);

            Session::flash('successMessage', "Loan decline successful");
            return redirect('loan/loan/show/request');
        }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Reject loan to from one proccess to another
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectLoanDisbursement(Request $request)
    {
        try{

            $get_next_step = LoanConfirmationProcess::max('process');

            Loan::where('id', $request->loan_id)
            ->update([
                    'confirmation_status' => $get_next_step,
                    'status' => 'processing',
                    'rejection_status' => 'active']
                 );

            AdminHelper::audit_trail('loan','Loan disbursement rejected back to next process ( '.$request->reason.' )',$request->loan_id);

            Session::flash('successMessage', "Disbursement rejected successful");
            return  back();
        }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Display a listing loan to disburse.
     *
     * @return \Illuminate\Http\Response
     */
    public function disburseLoan()
    {
        $result = Loan::where('status','approve')->orderBy('id','DESC')->get();;
        return view('accounting.loan.disburse-loan', compact('result'));
    }

     /**
     * Loan Disbursement
     *
     * @return \Illuminate\Http\Response
     */
    public function loanDisbursement(Request $request)
    {

         try{


            foreach($request->loan_disburse as $val){

                $obj = json_decode($val);

                 Loan::where('id', $obj->id)
                    ->update([
                            'confirmation_status' => 'active',
                            'status' => 'active',
                            'release_date' => date('Y-m-d H:i:s'),
                            //'maturity_date' => $request->maturity_date,
                            //'first_payment_date' => $request->first_repayment_date,
                            'disbursed_amount' => $obj->amount,
                            'loan_disbursed_by_id' => Auth::user()->id]);

                            AdminHelper::audit_trail('loan','Loan Disbursement confirmation',$obj->id);
            }

            Session::flash('successMessage', "Disbursement successful");
            return back();//redirect('loan/loan/show/request');
            //static::check_if_user_is_last_to_confirm_laon();

        }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Approve Loan
     *
     * @return \Illuminate\Http\Response
     */
    public function approveLoan(Request $request)
    {

        try{


            Loan::where('id', $request->loan_id)
            ->update(['status' => 'approve',
                      'disbursed_amount' => $request->disbursed_amount]);

            AdminHelper::audit_trail('loan','Loan approved',$request->loan_id);

            Session::flash('successMessage', "Approve successful");
            return redirect('loan/loan/show/request');

        }catch (Exception $e) {
            return back();
        }
    }
     /**
     * Change Principal Amount
     *
     * @return \Illuminate\Http\Response
     */
    public function changePrincipalAmount(Request $request)
    {

        try{

            Loan::where('id', $request->loan_id)
            ->update(['disbursed_amount' => $request->disbursed_amount]);

            AdminHelper::audit_trail('loan','Principal amount change during confirmation',$request->loan_id);

            Session::flash('successMessage', "Principal amount change successful");
            return back();;

        }catch (Exception $e) {
            return back();
        }
    }

    /**
     * Get my confirmation proccess id.
     *
     */
    public static function get_myConfirmProcessId()
    {
        $user_process = LoanConfirmationProcess::where('user_id',Auth::user()->id)->first();

        if($user_process){
            return (int)$user_process->process;
        }else{
            return false;
        }
    }

    /**
     * Check if user is the last to confirm a loan proccess.
     * Return active if the user is the last to confirm, else, increment the proccess by 1 and
     * return the value
     */
    public static function check_if_user_is_last_to_confirm_laon()
    {
        $next_step = 0;
        $max = LoanConfirmationProcess::max('process');
        $get_user_process = static::get_myConfirmProcessId();
        $max = (int)$max;
        if($get_user_process >= $max){
           return 'approve';
        }else{
            $next_step = $get_user_process + 1;
            return $next_step;
        }
    }

    /**
     * Make loan repayment
     *
     * @return \Illuminate\Http\Response
     */
    public function makeRepayment(Request $request)
    {

        try{

            //Check if the payment amount with the lesss or higher than amount to be paid this month

            //get amount to be paid
            //get total balance to be paid


            Loan::where('id', $request->loan_id)
            ->update(['disbursed_amount' => $request->disbursed_amount]);

            AdminHelper::audit_trail('loan','Principal amount change during confirmation',$request->loan_id);

            Session::flash('successMessage', "Principal amount change successful");
            return back();;

        }catch (Exception $e) {
            return back();
        }
    }


}
