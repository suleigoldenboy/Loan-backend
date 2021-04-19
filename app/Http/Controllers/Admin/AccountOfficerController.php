<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin\AccountOfficer;
use App\Models\HRManagement\Employee;
use App\Models\Admin\Branch;
use Auth;
use Session;
use File;

class AccountOfficerController extends Controller
{

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          try {
             
             $accountOfficer = AccountOfficer::where('user_type','account_officer')->orderBy('id','desc')->get();
             $allBranches =  Branch::orderBy('state', 'ASC')->get();

             return view('admin.account-officer.index', compact('accountOfficer','allBranches'));

         } catch (Exception $e) {
             return back();
         }

    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBranch()
    {
          try {
             
             $accountOfficer = AccountOfficer::where('user_type','recovery')->orderBy('id','desc')->get();
             $allBranches =  Branch::orderBy('state', 'ASC')->get();

             return view('admin.account-officer.index-recovery', compact('accountOfficer','allBranches'));

         } catch (Exception $e) {
             return back();
         }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $allBranches =  Branch::orderBy('state', 'ASC')->get();
        $allEmplooyee = Employee::all();
        $type = 'account_officer';
        return view('admin.account-officer.create', compact('allBranches','allEmplooyee','type'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createRecoveryBranch(Request $request)
    {
        $allBranches =  Branch::orderBy('state', 'ASC')->get();
        $allEmplooyee = Employee::all();
        $type = 'recovery';
        return view('admin.account-officer.create', compact('allBranches','allEmplooyee','type'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
     try {
            $this->validate($request, [
                'employee_id' => 'required',
            ]);

            $request->merge([ 
                'branch' => implode(',', (array) $request->branch)
            ]);

            $accOfficer =  new AccountOfficer();
            $accOfficer->employee_id =  $request->employee_id;
            $accOfficer->branch = $request->branch;
            $accOfficer->user_type = $request->user_type;
            $accOfficer->created_by = Auth::user()->id;
            $accOfficer->save();
                        
            Session::flash('successMessage', "Account Officer save successful");
            
            if($request->user_type == "account_officer"){
                 return redirect('/accountofficers');
            }else if($request->user_type == "recovery"){
                return redirect('/branchconfirmation');
            }else{
                return back();
            }
            
            
        } catch (Exception $e) {
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
             
             $accountOfficer = AccountOfficer::where('id', '=', $request->id)->first();
             $allBranches =  Branch::orderBy('state', 'ASC')->get();
             return view('admin.account-officer.edit', compact('accountOfficer','allBranches'));

         } catch (Exception $e) {
             return back();
         } 
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
    public function update(Request $request)
    {
        try {

            $this->validate($request, [
                //'roleName' => 'required|string|max:199|unique:privileges',
            ]);

            
            $request->merge([ 
                'branch' => implode(',', (array) $request->branch)
            ]);
 
            AccountOfficer::where('employee_id', '=', $request->employee_id)
                   ->update(['branch' => $request->branch]);

           
            Session::flash('successMessage', "Account Officer update successful");
            return redirect('/accountofficers');
           // return back();

            
        } catch (Exception $e) {
            
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            AccountOfficer::where('id', '=', $request->id)->delete();
            Session::flash('successMessage', "Account Officer deleted successful");
            return redirect('/accountofficers');
           // return back();
    }
}