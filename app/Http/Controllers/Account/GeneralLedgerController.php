<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Loan\Loan_Repayment;
use App\Models\Loan\Loan_Repayment_History;
use App\Models\Admin\Branch;
use App\Models\Customer\Customer;
use App\Http\Helpers\AdminHelper;
use App\Models\HRManagement\Employee; 
use App\Models\Account\AccountsChart;
use App\Models\Account\SubAccountsChart;
use App\Models\Account\AccountsSummeryDetail;
use App\Models\Account\GeneralLedgerReportSettings;
use Auth;
use DB;
use Session;
use File;
use Validator;

class GeneralLedgerController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function glReportSettings()
    {
        
        try {
            
            $data = GeneralLedgerReportSettings::orderBy('id','DESC')->get();
            return view('accounting.chart.gl-report-settings', compact('data'));

        } catch (\Throwable $th) {
            return back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGlReportSettings()
    {
        
        try {

            $data = AccountsChart::orderBy('id','DESC')->get();
            return view('accounting.chart.create-gl-report-settings',compact('data'));
           

        } catch (\Throwable $th) {
            return back();
        }
    }
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGeneralLegderReportSettings(Request $request)
    {
        try {
          
            $this->validate($request, [
                'action_name' => 'required|string|max:100',
             ]);
            $_result_data = array();
            foreach($request->action_value as $v ) {
                $_result_data[] = array(
                    "action_type"=> explode("/", $v)[0],
                    "id"=> explode("/", $v)[1], 
                    "code"=> explode("/", $v)[2],
                );
            }
           
            $action_type = json_encode($_result_data);
           
             $comLedger = new GeneralLedgerReportSettings;
             $comLedger->user_id = Auth::user()->id;
             $comLedger->action_name = $request->action_name;
             $comLedger->actions = $action_type;
             $comLedger->save();
 
             AdminHelper::audit_trail('ledger','New General Ledger Report Settings created',$comLedger->id);
 
             Session::flash('successMessage', "Created successful");
             return back();
 
         } catch (Exception $e) {
           return back();
         }
    }
}
