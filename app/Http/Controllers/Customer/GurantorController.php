<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer\Customer_guarantors;
use App\Http\Helpers\AdminHelper;
use Session;
use Auth;

class GurantorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

            $_cus_g = new Customer_guarantors();
            $_cus_g->user_id = Auth::user()->id;
            $_cus_g->customer_id = $request->customer_id;
            $_cus_g->first_name = $request->first_name;
            $_cus_g->last_name = $request->last_name;
            $_cus_g->other_name = $request->other_name;
            $_cus_g->relationship = $request->relationship;
            $_cus_g->email = $request->email;
            $_cus_g->phone_number = $request->phone_number;
            $_cus_g->occupation = $request->occupation;
            $_cus_g->home_address = $request->home_address;
            $_cus_g->office_address = $request->office_address;
            $_cus_g->religion = $request->religion;
            $_cus_g->nationality = $request->nationality;
            $_cus_g->state_of_origin = $request->state_of_origin;
            $_cus_g->local_government = $request->local_government;
            $_cus_g->save();

            AdminHelper::audit_trail('loan','New guarantor created',$request->loan_id);
    
            Session::flash('successMessage', "Gurantor save successful");
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
    public function destroy(Request $request)
    {
        try{

            Customer_guarantors::where('id',$request->gurantor_id)->delete();
            AdminHelper::audit_trail('loan','Guarantor Deleted',$request->loan_id);
    
            Session::flash('successMessage', "Guarantor deleted successful");
            return back();
        }catch (Exception $e) {
            return back();
        }
    }
}
