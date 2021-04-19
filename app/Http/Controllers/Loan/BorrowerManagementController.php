<?php

namespace App\Http\Controllers\Loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\Loan;
use App\Models\Loan\BorrowerManagement;
use App\Models\HRManagement\Employee; 
use App\Http\Helpers\AdminHelper;
use App\Models\Employee\User;
use Auth;
use DB;
use Session;

class BorrowerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try{

            $borrowers = BorrowerManagement::orderBy('priority','ASC')->get();

            return view('accounting.borrowermanagement.index', compact('borrowers'));
        }catch (Exception $e) {
            return back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        try{

            $loan_officers = Employee::get();
          
            return view('accounting.borrowermanagement.create', compact('loan_officers'));
        }catch (Exception $e) {
            return back();
        }
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNext(Request $request)
    { 
        try{

            $officer = Employee::where('id',$request->loan_officer_id)->first();
            $data = Loan::where('id',$request->loan_id)->first();
            if($data == null){
                Session::flash('errorMessage', "Invalid Loan ID");
                return back();
            }
            
            return view('accounting.borrowermanagement.create-next', compact('officer','data'));
        }catch (Exception $e) {
            return back();
        }
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

            $_loan = new BorrowerManagement();
            $_loan->loan_officer_id = $request->loan_officer_id;
            $_loan->loan_id = $request->loan_id;
            $_loan->priority = $request->priority;
            $_loan->note = $request->note;
            $_loan->user_id = Auth::user()->id;
            $_loan->save();

            AdminHelper::audit_trail('loan','Assign new loan officer to manage the loan',$request->loan_id);
    
            Session::flash('successMessage', "Save successful");
            return redirect('borrower/management');

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
}
