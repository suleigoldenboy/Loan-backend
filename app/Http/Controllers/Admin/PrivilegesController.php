<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Permissions;
use App\Models\Admin\Privileges;
use App\Models\Admin\PrivilegesActions;
use App\Http\Helpers\AdminHelper;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;
use Auth;
use Session;
use File;
use DB;

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
             
             $privileges = Role::orderBy('id','desc')->get();

             return view('admin.settings.privilege.index', compact('privileges'));

         } catch (Exception $e) {
             return back();
         }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPermission()
    {
        try {
             
            $permission = Permission::orderBy('name','DESC')->get();

             return view('admin.settings.privilege.index-permission', compact('permission'));

         } catch (Exception $e) {
             return back();
         }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPrivileges()
    {
          try {
             
             $privileges = Privileges::orderBy('id','desc')->get();

             return view('admin.settings.privilege.index-privileges', compact('privileges'));

         } catch (Exception $e) {
             return back();
         }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAction()
    {
          try {
             
            $privilegesActions = PrivilegesActions::orderBy('id','ASC')->get();

             return view('admin.settings.privilege.index-privilege-action', compact('privilegesActions'));

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
        $permission = Permission::orderBy('name','DESC')->get();
        

        return view('admin.settings.privilege.create', compact('privilegesActions','permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        
     try {

            $this->validate($request, [
                'name' => 'required|string|max:199|unique:permissions',
            ]);
           
            Permission::create(['name' => $request->name]);
             
            //Save Audi trail  
            //AdminHelper::audit_trail('permission','New permission created',$user->id);
            
            Session::flash('successMessage', "Permission save successful");
            return back();//redirect('admin/add/role');

            
        } catch (Exception $e) {
            
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
        
     try {
            $this->validate($request, [
                'name' => 'required|string|max:199|unique:roles',
            ]);

            // $request->merge([ 
            //     'action_type' => implode(',', (array) $request->action_type)
            // ]);

            // $user =  new Permissions();
            // $user->roleName =  $request->roleName;
            // $user->privilege = $request->action_type;
            // $user->created_by = Auth::user()->id;
            // $user->save();

           

            $role = new Role();
            $role->name = $request->name;
            $role->save();
            
            foreach($request->permissions as $check) {
        
                $permission = Permission::findById($check);
                $role->givePermissionTo($permission);
            }

           
            //Save Audi trail
            //AdminHelper::audit_trail('role','New privilege created',$user->id);
            
            Session::flash('successMessage', "Role save successful");
            return redirect('admin//role');

            
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
             
             $privilege = Role::where('id', '=', $request->id)->first();
             $privilegesActions = PrivilegesActions::orderBy('id','ASC')->get();
             $permission = Permission::orderBy('name','DESC')->get();

             return view('admin.settings.privilege.edit', compact('privilege','privilegesActions','permission'));

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

            // $this->validate($request, [
            //     //'roleName' => 'required|string|max:199|unique:privileges',
            // ]);

            
            // $request->merge([ 
            //     'action_type' => implode(',', (array) $request->action_type)
            // ]);

            
            // Permissions::where('id', '=', $request->role_id) //->where('roleName', '=', $request->OldroleName)
            //        ->update(['roleName' => $request->OldroleName,
            //                  'privilege' => $request->action_type]);

            $role = Role::findById($request->role_id);
            DB::table('role_has_permissions')->where('role_id',$request->role_id)->delete();

            foreach($request->permissions as $check) {
            
                $permission = Permission::findById($check);
                $role->givePermissionTo($permission);
            }


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
