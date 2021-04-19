<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Loan\Loan_Repayment;
use App\Models\Customer\Customer;
use App\Http\Helpers\AdminHelper;
use App\Models\HRManagement\Employee; 
use App\Models\Account\AccountsChart;
use App\Models\Account\SubAccountsChart;
use App\Models\Account\AccountsSummeryDetail;
use Auth;
use DB;
use Session;
use File;
use Validator;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        try {
           
            return view('accounting.chart.dashboard');

        } catch (\Throwable $th) {
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountList()
    {
        try {
           
            $data = AccountsChart::orderBy('id','DESC')->get();
        
            return view('accounting.chart.account-list', compact('data'));

        } catch (Exception $th) {
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
        try {
           
            $account_id = $request->id;
            $account_name = $request->name;
            $sub_account_type = $request->type;
            $gl_code = static::getSubAccGlCode();
        
            return view('accounting.chart.create-sub', compact('sub_account_type','account_id','account_name','gl_code'));

        } catch (Exception $th) {
            return back();
        }
    }
    /**
     * Get sub account LG Code
     *
     * @param  int  $id
     * return SUN(int) 
     */
    public static function getSubAccGlCode()
    {
        $result = SubAccountsChart::get();

        return count($result);
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
                 'code' => 'required|string|max:100|unique:accounts_charts,code',
                 'name' => 'required|string|max:100|unique:accounts_charts,name',
             ]);

             $comAcc = new AccountsChart;
             $comAcc->code = $request->code;
             $comAcc->name = $request->name;
             $comAcc->type = $request->type;
             $comAcc->transaction_type = $request->transaction_type;
             $comAcc->opening_balance = $request->opening_balance;
             $comAcc->created_by = Auth::user()->id;
             $comAcc->save();
 
             AdminHelper::audit_trail('account_chart','New Account created',$comAcc->id);
 
             Session::flash('successMessage', "Account created successful");
             return back();
 
         } catch (Exception $e) {
           return back();
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSub(Request $request)
    {
        try {
          
            // $this->validate($request, [
            //     // 'code' => 'request|string|code|max:100|unique:sub_accounts_charts',
            //      //'name' => 'request|string|max:30|unique:sub_accounts_charts',
            //  ]);

             $comAcc = new SubAccountsChart;
             $comAcc->primary_account_id = $request->account_id;
             $comAcc->sub_account_type = $request->sub_account_type;
             $comAcc->code = $request->code;
             $comAcc->name = $request->name;
             $comAcc->transaction_type = $request->transaction_type;
             $comAcc->opening_balance = $request->opening_balance;
             $comAcc->created_by = Auth::user()->id;
             $comAcc->save();
 
             AdminHelper::audit_trail('sub_account_chart','New Account created',$comAcc->id);
 
             Session::flash('successMessage', "Account created successful");
             return redirect('account/accountslist');
 
         } catch (Exception $e) {
           
           return back();
         }
    }

    public static function account_balance($account_id='')
    {

      try {
          
        $row = SubAccountsChart::findOrFail($account_id);
        $ac_row = AccountsSummeryDetail::select(DB::raw('account_id, SUM(debit) as dr, SUM(credit) as cr'))->where('account_id', $account_id)->groupBy('account_id')->first();

        if($row->balance_type == 'cr'){
          return $row->opening_balance + $ac_row['cr'] - $ac_row['dr'];
        }else{
          return $row->opening_balance + $ac_row['dr'] - $ac_row['cr'];
        }
        
      } catch (Exception $e) {
        
      }
    }

    /**
     * Get account balance.
     *
     * @param  int  $id
     * return amount (int)
     */
    public static function getAccountBalance($id,$code,$type)
    {
        $result = AccountsSummeryDetail::where('account_id',$id)->where('code',$code)->get();

        $total = 0;
        foreach($result as $data){

            if($type == "cr"){
                $total += $data->credit_amount;
            }else if($type == "dr"){
                $total += $data->debit_amount;
            }
        }

        if($type == "cr"){
            return number_format($total,2);
        }else if($type == "dr"){
            return '-'.number_format($total,2);;
        }

        
    }
    /**
     * Get sub account balance.
     *
     * @param  int  $id
     * return amount (int)
     */
    public static function getSubAccountBalance($id,$code,$type)
    {
        
        $result = AccountsSummeryDetail::where('account_id',$id)->where('code',$code)->get();

        $total = 0;
        foreach($result as $data){

            if($type == "cr"){
                $total += $data->credit_amount;
            }else if($type == "dr"){
                $total += $data->debit_amount;
            }
        }

        return $total;
        

        
    }
    /**
     * Get primary account balance.
     *
     * @param  int  $id
     * return amount (int)
     */
    public static function getPrimaryAccountBalance($id)
    {
        
        $result = SubAccountsChart::where('primary_account_id',$id)->where('sub_account_type','primary')->get();

        $total = 0;
        foreach($result as $data){

            $total += static::getSubAccountBalance($data->id,$data->code,$data->transaction_type);

            $sub_result = SubAccountsChart::where('primary_account_id',$data->id)->where('sub_account_type','sub')->get();

            foreach($sub_result as $sub_data){

                $total += static::getSubAccountBalance($sub_data->id,$sub_data->code,$sub_data->transaction_type);
    
            }
        }

        return $total;
        

        
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ledger(Request $request)
    {
        
        try {

            $primaryAccs =  AccountsChart::get();

            $fromDate = $request->to;
            $toDate = $request->from;
            $accountType = "";
            $transactions_type = 'all';
            $tranRec = array();
            
            return view('accounting.chart.ledger', compact('accountType','transactions_type','fromDate','toDate','tranRec','primaryAccs'));


        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ledgerDetails(Request $request)
    { 
        
        try {

            $accountType = strtok($request->account, '/');
            $account_id = substr($request->account, strpos($request->account, "/") + 1); 
            
             $tranRec = array();
             if ($accountType == "allAccount") {

                $tranRec =  AccountsChart::get();

             }else if ($accountType == "primary") {

                $tranRec =  AccountsChart::where('id', '=', $account_id)->first();


            }else if ($accountType == "sub") {

                $tranRec =  SubAccountsChart::where('id', '=', $account_id)->first();

            }else{
               
                return back(); 
            }

            $primaryAccs =  AccountsChart::get();
            $fromDate = $request->to;
            $toDate = $request->from;
            $transactions_type = 'all';
           
            return view('accounting.chart.ledger-details', compact('accountType','transactions_type','fromDate','toDate','tranRec','primaryAccs'));

        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function incomeReport(Request $request)
    {
        
        try {

            $primaryAccs =  AccountsChart::where('transaction_type','cr')->get();

            $fromDate = $request->to;
            $toDate = $request->from;
            $accountType = "";
            $transactions_type = 'cr';
            $tranRec = array();
            
            return view('accounting.chart.ledger', compact('accountType','transactions_type','fromDate','toDate','tranRec','primaryAccs'));


        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expenseReport(Request $request)
    {
        
        try {

            $primaryAccs =  AccountsChart::where('transaction_type','dr')->get();

            $fromDate = $request->to;
            $toDate = $request->from;
            $accountType = "";
            $transactions_type = 'dr';
            $tranRec = array();
            
            return view('accounting.chart.ledger', compact('accountType','transactions_type','fromDate','toDate','tranRec','primaryAccs'));


        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function disburseReport(Request $request)
    {
        
        try {

            $data = array();
            $_to = date('Y-m-d', strtotime($request->to));
            $_from = date('Y-m-d', strtotime($request->from));

            if($request->from && !$request->to){ 

                $data = Loan::where('release_date',$_from)
                             ->orderBy('release_date','desc')->get();
                            

            }else if($request->to && $request->from){

                $data = Loan::where('release_date', '>=', $_from)
                             ->where('release_date', '<=', $_to)
                             ->orderBy('release_date','desc')->get();

                
            }else{
                 
                $data = Loan::where('confirmation_status','active')->get();
            }
                
            return view('accounting.chart.disburse-report', compact('data'));


        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function repaymentReport(Request $request)
    {
        
        try {

            $data = array();
            $_to = date('Y-m-d', strtotime($request->to));
            $_from = date('Y-m-d', strtotime($request->from));

            if($request->from && $request->to){ 

                $data = Loan_Repayment::where('date_paid',$_from)
                             ->orderBy('date_paid','desc')->get();
                             

            }else if($request->to && !$request->from){

                $data = Loan_Repayment::where('date_paid', '>=', $_from)
                             ->where('date_paid', '<=', $_to)
                             ->orderBy('date_paid','desc')->get();
                
            }else{

                $data = Loan_Repayment::orderBy('date_paid','desc')->get();
            }

            
            return view('accounting.chart.repayment-report', compact('data'));


        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
    
     //Get Account Name
     public static function getAccountName($id)
     {
         $accountRec =  SubAccountsChart::where('id','=',$id)->first();
         
        
         return $accountRec->name;
     }
     //Get Account Transaction History
     public static function getAccTransHistory($id,$code,$fromDate,$toDate)
     {
 
         
   
    $result = AccountsSummeryDetail::where('account_id',$id)
                            ->where('code',$code)
                            ->where('transaction_date', '>=', $fromDate)
                            ->where('transaction_date', '<=', $toDate)
                            ->orderBy('transaction_date', 'ASC')->get();
   
        
         return $result;
     }
 
     //Credit Account
     public static function getCurrentAccountBalance($id,$toDate)
     {
        
         $result =  AccountsSummeryDetail::orderBy('created_at','desc')
                      ->Where('account_id', '=', $id)
                      ->where('transaction_date', '<', $toDate)->get();
         $balance = 0;
 
         foreach ($result as $value) {
             $balance = $value->credit_amount;
         }
 
 
         return $balance;
     }
 
     public static $curren_Balance;
 
     public static function setAddBalance($type,$curren_Balance,$amt) {
 
     $total = 0;
      
      $total = $curren_Balance + $amt;
 
       static::$curren_Balance = $total;
     }
 
     public static function getAddBalance() {
 
       return static::$curren_Balance;
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
