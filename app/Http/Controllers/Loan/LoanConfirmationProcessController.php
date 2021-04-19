<?php

namespace App\Http\Controllers\Loan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\LoanConfirmationProcess;
use App\Http\Helpers\AdminHelper;
use App\Models\Employee\User;
use Auth;
use Session;

class LoanConfirmationProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $data = User::get();
            $proccesses = LoanConfirmationProcess::orderBy('process','ASC')->get();

            return view('admin.settings.loan.confirmation-proccess', compact('data','proccesses'));
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

            $data = User::get();
            $max = LoanConfirmationProcess::max('process');
            return view('admin.settings.loan.create-confirmation-proccess', compact('data','max'));
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

            $this->validate($request, [
                'process' => 'required|unique:loan_confirmation_processes',
                ]);

            $request->merge([ 
                'action_type' => implode(',', (array) $request->action_type)
            ]);

            $user =  new LoanConfirmationProcess();
            $user->user_id =  $request->employee_id;
            $user->name =  $request->description;
            $user->process =  $request->process;
            $user->privilege = $request->action_type;
            $user->created_by_id = Auth::user()->id;
            $user->save();
                        
            Session::flash('successMessage', "Save successful");
            return redirect('/loan/set/confirmationproccess');

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
        try{

            $dataInfo = LoanConfirmationProcess::findOrFail($id);
            $data = User::get();

            return view('admin.settings.loan.show-confirmation-proccess', compact('data','dataInfo'));
        }catch (Exception $e) {
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
        try{

            $request->merge([ 
                'action_type' => implode(',', (array) $request->action_type)
            ]);

            LoanConfirmationProcess::where('id',$request->update_id)
                ->update([
                    'name' => $request->description,
                    //'process' => $request->process,
                    'privilege' => $request->action_type
                ]);
          
                Session::flash('successMessage', "Update successful");
                return redirect('/loan/confirmation-process');

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
    public function destroy(Request $request)
    {
        try{

            LoanConfirmationProcess::where('id',$request->id)->delete();
            Session::flash('successMessage', "Delete successful");
            return redirect('/loan/confirmation-process');

        }catch (Exception $e) {
            return back();
        }
    }
}
