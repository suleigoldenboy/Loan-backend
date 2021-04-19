<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Permissions;
use App\Models\Admin\PrivilegesActions;
use App\Http\Helpers\AdminHelper;
use Auth;
use Session;
use File;

class PrivilegesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          try {
             
             $privileges = Permissions::orderBy('id','desc')->get();

             return view('admin.settings.privilege.index', compact('privileges'));

         } catch (Exception $e) {
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

        $privilegesActions = PrivilegesActions::orderBy('id','ASC')->get();

        return view('admin.settings.privilege.create', compact('privilegesActions'));
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
                'roleName' => 'required|string|max:199|unique:permissions',
            ]);

            $request->merge([ 
                'action_type' => implode(',', (array) $request->action_type)
            ]);

            $user =  new Permissions();
            $user->roleName =  $request->roleName;
            $user->privilege = $request->action_type;
            $user->created_by = Auth::user()->id;
            $user->save();
            
            //Save Audi trail
            AdminHelper::audit_trail('privilege','New privilege created',$user->id);
            
            Session::flash('successMessage', "Role save successful");
            return redirect('admin/privileges');

            
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
             
             $privilege = Permissions::where('id', '=', $request->id)->first();
             $privilegesActions = PrivilegesActions::orderBy('id','ASC')->get();

             return view('admin.settings.privilege.edit', compact('privilege','privilegesActions'));

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
                'action_type' => implode(',', (array) $request->action_type)
            ]);

            
            Permissions::where('id', '=', $request->role_id) //->where('roleName', '=', $request->OldroleName)
                   ->update(['roleName' => $request->OldroleName,
                             'privilege' => $request->action_type]);

            //save to audit trail
            AdminHelper::audit_trail('privilege','privilege updated',$request->role_id);

            Session::flash('successMessage', "Role update successful");
            return back();

            
        } catch (Exception $e) {
            
        }

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
