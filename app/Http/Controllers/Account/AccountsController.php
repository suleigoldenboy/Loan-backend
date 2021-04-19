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
           
            $result = '';
            if($request->type == "primary"){
                $result = AccountsChart::where('id',$request->id)->first();
            }else if($request->type == "sub"){
                $result = SubAccountsChart::where('id',$request->id)->first();
            }else{
                return back();
            }
            
            $account_id = $request->id;
            $account_name = $request->name;
            $sub_account_type = $request->type;
            $gl_code = $result->code.static::getSubAccGlCode($request->id,$request->type);
        

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
    public static function getSubAccGlCode($id,$type)
    {
        
        $result = SubAccountsChart::where('primary_account_id',$id)
                                   ->where('sub_account_type',$type)->get();
     
        $count = count($result);
        if(count($result) < 1){
            
            return count($result).'1';
        }
        if(count($result) < 10){
            $count ++;
            return '00'.$count;
        }

        return count($result)+1;
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
     /**
     * Store a newly created customer Account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCustomerAccount($customer_id,$customer_name)
    {
        try {
           
            
           if (SubAccountsChart::where('customer_id','=',$customer_id)->exists()) {
           
                $customer = SubAccountsChart::where('customer_id','=',$customer_id)->first();
                return $customer->id;
            }else{

                $pri_account_id = 88;
                $result = SubAccountsChart::where('id',$pri_account_id)->first();
                $sub_account_type = 'sub';//sub account
                $gl_code = $result->code.static::getSubAccGlCode($pri_account_id,$sub_account_type);
            
                $comAcc = new SubAccountsChart;
                $comAcc->primary_account_id = $pri_account_id;
                $comAcc->sub_account_type = $sub_account_type; 
                $comAcc->code = $gl_code;
                $comAcc->name = $customer_name.' ('.$customer_id.') ';
                $comAcc->transaction_type =  'dr'; //Debit
                $comAcc->opening_balance = 0;
                $comAcc->created_by = Auth::user()->id;
                $comAcc->customer_id = $customer_id;
                $comAcc->save();

                AdminHelper::audit_trail('sub_account_chart','New Account created',$comAcc->id);
                return $comAcc->id;
            }
 
         } catch (Exception $e) {
           
           return back();
         }
    }

     /**
     * Store a newly created loan Account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCustomerSubLoanAccount($product,$loan_id,$customer_id,$customer_name)
    {
        try {
           
            
           if (SubAccountsChart::where('loan_id','=',$loan_id)->exists()) {
           
                $customer = SubAccountsChart::where('loan_id','=',$loan_id)->first();
                return $customer->id;
            }else{

                $pri_account_id = 0;
                if($product == 2){ //Deff Loan
                    $pri_account_id = 38;
                }else if($product == 3){//Staff Loan
                    $pri_account_id = 40;
                }
                $result = SubAccountsChart::where('id',$pri_account_id)->first();
                $sub_account_type = 'sub';//sub account 
                $gl_code = $result->code.static::getSubAccGlCode($pri_account_id,$sub_account_type);
            
                $comAcc = new SubAccountsChart;
                $comAcc->primary_account_id = $pri_account_id;
                $comAcc->sub_account_type = $sub_account_type; 
                $comAcc->code = $gl_code;
                $comAcc->name = $customer_name.' ('.$customer_id.') ';
                $comAcc->transaction_type =  'dr'; //Debit
                $comAcc->opening_balance = 0;
                $comAcc->created_by = Auth::user()->id;
                $comAcc->loan_id = $loan_id;
                $comAcc->save();

                AdminHelper::audit_trail('sub_account_chart','New Account created',$comAcc->id);
                return $comAcc->id;
            }
 
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

  public function genAccountForAllCustomers()
    {
       
        $all_customers = Customer::get();

        foreach ($all_customers as $cus) {
            
            //Create customer chart of account
            $customer_name = $cus->first_name.' '.$cus->last_name.' '.$cus->other_name;
            static::storeCustomerAccount($cus->id,$customer_name);

            $cus_loans = Loan::where('customer_id', $cus->id)->get();
            foreach ($cus_loans as $loan) {
          
                //create customer loan chart of account
                static::storeCustomerSubLoanAccount($loan->product_id,$loan->id,$cus->id,$customer_name);
            }
            

        }
        
        dd('Completed.....');
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
           
             $date_rang = '';
             //Check if reques
       if (count($request->all())) {
            
            //Search by customer name
            
                $result_data_loan = Customer::where('first_name', 'LIKE', "%$request->c_name%")
                        ->orWhere('last_name', 'LIKE', "%$request->c_name%")
                        ->orWhere('other_name', 'LIKE', "%$request->c_name%")->get();
            
            
            // Get the results and return them.
                $data_loan = array();
                foreach($result_data_loan as $val){
                    $data_loan[] = $val->id;
                }
                
             }else{
              $data_loan = array();
            }
            //dd($data_loan);
            
            
             
            
            //Check date search rang
            $data = array();
            $_to = date('Y-m-d', strtotime($request->to));
            $_from = date('Y-m-d', strtotime($request->from));
           

            if($request->from && $request->to){ 
                
                if(count($data_loan) > 0){
                     
                    
                     $data = Loan_Repayment::where('date_paid', '>=', $_from)
                             //->where('date_paid', '<=', $_to)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'From '.convertDateToString($_from).' to '.convertDateToString($_to);
                       
                }else{
                    
                  
                     $data = Loan_Repayment::
                             where('date_paid', '>=', $_from)
                             ->where('date_paid', '<=', $_to)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'From '.convertDateToString($_from).' to '.convertDateToString($_to);
                        
                            
                }
                
                           

            }else if(!$request->to && $request->from){
                
                if(count($data_loan) > 0){
                    $data = Loan_Repayment::whereIn('customer_id',$data_loan)
                             ->where('date_paid',$_from)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'on '.convertDateToString($_from);
                             
                }else{
                     $data = Loan_Repayment::where('date_paid',$_from)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'on '.convertDateToString($_from);
                            
                }
            
            }else if(!$request->to && !$request->from){  
               if(count($data_loan) > 0){
                   $data = Loan_Repayment::whereIn('customer_id',$data_loan)->get();
               }
                 
            }else{

                //$data = Loan_Repayment::orderBy('date_paid','desc')->get();
            }
            
           
            
           
             $branches = '';//Branch::get();
            // $products = Product::all();
            $loan_officers = '';//Employee::get();
            $customers = '';//Customer::get();
            
            return view('accounting.chart.repayment-report', compact('data','branches','loan_officers','customers','date_rang'));


        } catch (ModelNotFoundException $e) {
           
           return back(); 
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function repaymentHistory(Request $request)
    {
        
        try {
           
             $date_rang = '';
             //Check if reques
       if (count($request->all())) {
            
            //Search by customer name
            
                $result_data_loan = Customer::where('first_name', 'LIKE', "%$request->c_name%")
                        ->orWhere('last_name', 'LIKE', "%$request->c_name%")
                        ->orWhere('other_name', 'LIKE', "%$request->c_name%")->get();
            
            
            // Get the results and return them.
                $data_loan = array();
                foreach($result_data_loan as $val){
                    $data_loan[] = $val->id;
                }
                
             }else{
              $data_loan = array();
            }
            //dd($data_loan);
            
            
             
            
            //Check date search rang
            $data = array();
            $_to = date('Y-m-d', strtotime($request->to));
            $_from = date('Y-m-d', strtotime($request->from));
           

            if($request->from && $request->to){ 
                
                if(count($data_loan) > 0){
                     
                    
                     $data = Loan_Repayment_History::whereIn('customer_id',$data_loan)
                             ->where('date_paid', '>=', $_from)
                             ->where('date_paid', '<=', $_to)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'From '.convertDateToString($_from).' to '.convertDateToString($_to);
                }else{
                    
                  
                     $data = Loan_Repayment_History::
                             where('date_paid', '>=', $_from)
                             ->where('date_paid', '<=', $_to)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'From '.convertDateToString($_from).' to '.convertDateToString($_to);
                            
                }
                
                           

            }else if(!$request->to && $request->from){
                
                if(count($data_loan) > 0){
                    $data = Loan_Repayment_History::whereIn('customer_id',$data_loan)
                             ->where('date_paid',$_from)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'on '.convertDateToString($_from);
                }else{
                     $data = Loan_Repayment_History::where('date_paid',$_from)
                             ->orderBy('date_paid','desc')->get();
                             $date_rang = 'on '.convertDateToString($_from);
                }
            
            }else if(!$request->to && !$request->from){  
               if(count($data_loan) > 0){
                   $data = Loan_Repayment_History::whereIn('customer_id',$data_loan)->get();
               }
                 
            }else{

                //$data = Loan_Repayment_History::orderBy('date_paid','desc')->get();
            }
            
           
            
           
             $branches = '';//Branch::get();
            // $products = Product::all();
            $loan_officers = '';//Employee::get();
            $customers = '';//Customer::get();
            
            return view('accounting.chart.repayment-report-history', compact('data','branches','loan_officers','customers','date_rang'));


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
