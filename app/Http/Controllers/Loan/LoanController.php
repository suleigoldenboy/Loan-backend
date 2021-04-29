<?php

namespace App\Http\Controllers\Loan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin\Branch;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerEmployment;
use App\Models\Settings\LoanConfirmationProcess; 
use App\Models\Settings\ConfirmationProcessByAmountSettings;
use App\Models\Settings\CheckLists;
use App\Models\Admin\PrivilegesActions;
use App\Models\Loan\Loan_Comment;
use App\Models\Loan\Loan_Repayment;
use App\Models\Loan\Loan_Repayment_History;
use App\Models\Admin\CompanyBank;
use App\Http\Helpers\AdminHelper;
use App\Models\Account\AccountsChart;
use App\Models\Account\SubAccountsChart;
use App\Models\Employee\User;
use App\Models\HRManagement\Employee; 
use App\Mail\ApprovedLoan;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Loan\RepaymentController;
use Auth;
use DB;
use File;
use Session;

class LoanController extends Controller
{
    protected $searchable = ['customer_id', 'c_name', 'branch_id', 'product_id'];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Loan $loan)
    {
        
       //Check if reques
       if (count($request->all())) {
            $loan = $loan->newQuery()->where('status','active');

            // Search by loan ID
            if ($request->loan_id) {
                $loan->where('id', $request->loan_id);
            }
            // Search by customer name
            if ($request->customer_id) {
                $loan->where('customer_id', $request->customer_id);
            }
            // Search by loan officer
            if ($request->loan_officer_id) {
                $loan->where('loan_officer_id', $request->loan_officer_id);
            }
            // Search by branch
            if ($request->branch_id) {
                $loan->where('branch_id', $request->branch_id);
            }
            // Search by email
            // if ($request->has('email')) { 
            //     $loan->where('email', $request->email);
            // }
            // Search by customer phone number
            //  if ($request->has('phone_number')) { 
            //     $loan->where('phone_number', $request->phone_number);
            //  }
            // Search by customer code
            // if ($request->has('customer_code')) {
            //     $loan->where('customer_code', $request->customer_code);
            // }
            // Search by status
            if ($request->status) {
                $loan->where('status', $request->status);
            }
            // Get the results and return them.
            $data =  $loan->get();
       }else{
            $data = array();
       }
      

        
       if($request->from || $request->to){
           $data = Loan::where('status','active')->get();
       }
        //$data = Loan::where('confirmation_status','active')->get();
        $branches = Branch::get();
        // $products = Product::all();
        $loan_officers = Employee::get();
        $customers = Customer::get();

        return view('accounting.loan.index', compact('data','branches','loan_officers','customers'));
    }
  public function testSendEmail()
    {   

    
           $data = array( 'subject' => "Approve Loan",
                          'email' => "eco9ja@gmail.com",
                          'name' => "Gospel",
                          'phone_number' => "0809837264",
                          'password' => "1234567",
                          'loan_id' => "0009",
                          'date' => date('d-m-Y'),
                      );
                      
     
        Mail::to($data['email'])->send(new ApprovedLoan($data));
        echo "sent!";
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
        $loan_officers = Employee::get();
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
            $product_info =  static::getProductContent($request->product_id);
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
            $_loan->interest_rate = $product_info->interest_rate;//$request->interest_rate;
            $_loan->insurance_charge = $product_info->insurance_charge;
            $_loan->processing_charge = $product_info->processing_charge;
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

        }catch (Exception $e) {
           return back();
       }
    }
    public static function getProductContent($id)
    {
        return Product::where('id',$id)->first();
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
        
        if(Auth::user()->id == 1){
              $data = Loan::whereNull('status_paid')
                    ->orderBy('id','DESC')->get();

        }else{
   
         
         if($get_user_process){
             
             //Check if user to confirm base on branch
             $confirm_values = getAllBranchToConfirm(Auth::user()->id);
             
             if($confirm_values){

                   
                    if(is_array($confirm_values)){ 
                         $data = Loan::whereIn('branch_id',$confirm_values)
                                            ->where('customer_request',"=",1)
                                            //->where('offer_letter',"!=",'waiting_to_send')
                                            ->where('confirmation_status', $get_user_process)->orderBy('id',"DESC")->get();
                         
                    }else{
                    
                    $data = Loan::where('branch_id','=',$confirm_values);
                    
                    }
                 
        }else{
                 $data = Loan::where('confirmation_status', $get_user_process)
                   // ->where('confirmation_status', '!=', 'decline')
                    ->whereNull('status_paid')
                    // ->where('status', '!=', 'approve')
                    // ->where('status', '!=', 'active')
                    ->orderBy('id','DESC')->get();
             }
            
         }else{
                 $confirm_values = getAllBranchToConfirm(Auth::user()->id);
              
                if(is_array($confirm_values)){ 
                   
                     $data = Loan::whereIn('branch_id',$confirm_values)->orderBy('id', 'DESC')->get();
                      
                }else{
                
                $data  = Loan::where('branch_id','=',$confirm_values)->orderBy('id', 'DESC')->get();
                
                }
               
         }

        }
       
      
        return view('accounting.loan.processing', compact('data','get_user_process'));
    }
    /**
     * Display all loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendOfferletter()
    {
        
        if(Auth::user()->id == 1){
              $data = Loan::whereNull('status_paid')
                     ->where('offer_letter','waiting_to_send')
                     ->orderBy('id','DESC')->get();

        }else{

        $get_user_process = static::get_myConfirmProcessId();
         
         if($get_user_process){
            $data = Loan::where('confirmation_status', $get_user_process)
                          ->where('offer_letter','waiting_to_send')->orderBy('id',"DESC")->get();

          }

        }
       
        return view('accounting.loan.send-offer-letter', compact('data'));
    }
     /**
     * Display all loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function allLoanRequest(Request $request)
    {
        
        $get_user_process = $request->id;
       //
        $data = Loan::where('confirmation_status', $get_user_process)
                    //->whereNull('status_paid')
                    ->orderBy('id','DESC')->get();
    
        return view('accounting.loan.processing', compact('data'));
    }
    /**
     * Display all loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function loanRequestStatus()
    {
                  $datas = Loan::whereNull('status')
                    ->orderBy('id','DESC')->get();

       
        return view('accounting.loan.processing-status', compact('datas'));
    }
     /**
     * show all loan request.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoanRequest($id)
    {
        try{
            $get_user_process = static::get_myConfirmProcessId();
            
            $data = Loan::findOrFail($id);
            $banks  = CompanyBank::get();

            $confirm_process = LoanConfirmationProcess::orderBy('title','DESC')->get();
            $confirm_process = $confirm_process->unique('process');
            $getCheckLists  = CheckLists::where('process',$get_user_process)->get();
            return view('accounting.loan.show-loan-request', compact('data','banks','confirm_process','getCheckLists'));

         }catch (Exception $e) {
            return back();
        }
    }
     /**
     * assign loan officer select branch
     *
     * @return \Illuminate\Http\Response
     */
    public function assignOfficerSelectBranch($id)
    {
        try{

            $data = Loan::findOrFail($id);
            $branches = Branch::get();
            return view('accounting.loan.assign-officer-select-branch', compact('data','branches'));

         }catch (Exception $e) {
            return back();
        }
    }
     /**
     * send online confirm address
     *
     * @return \Illuminate\Http\Response
     */
    public function onlineConfirmAddress($id)
    {
        
            CustomerEmployment::where('customer_id', $id)
            ->update(['online_address_confirm_status' => 1]);
    
            Session::flash('successMessage', "Request sent successful");
            
            return back();
            
    }
     /**
     * send oonline confirm files
     *
     * @return \Illuminate\Http\Response
     */
    public function onlineConfirmFiles($id)
    {
        
            CustomerEmployment::where('customer_id', $id)
            ->update(['online_file_confirm_status' => 1]);
    
            Session::flash('successMessage', "Request sent successful");
            
            return back();
            
    }
     /**
     * show online confirm address
     *
     * @return \Illuminate\Http\Response
     */
    public function showOnlineConfirmAddress()
    { 
        try{
            $data  = CustomerEmployment::where('online_address_confirm_status','=',1)->get();
          
            return view('accounting.loan.confirm-online-address', compact('data'));
            
         }catch (Exception $e) {
            return back();
        }
    }
     /**
     * show online confirm files
     *
     * @return \Illuminate\Http\Response
     */
    public function showOnlineConfirmFiles()
    {
        try{
           
            $data  = CustomerEmployment::where('online_file_confirm_status','=',1)->get();
            return view('accounting.loan.confirm-online-files', compact('data'));

         }catch (Exception $e) {
            return back();
        }
    }
     /**
     * confirm oonline customer address
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmOnlineConfirmAddress(Request $request)
    {
         $home_img = '';
        if($request->hasFile('home_img')){ 
            
            $home_img = time().'bnks.'.request()->home_img->getClientOriginalExtension();
            
            request()->home_img->move(public_path('customerfiles/files/'), $home_img);
            $path_old_card = "customerfiles/files/".$request->old_home_img;  
            if(File::exists($path_old_card)) {
                File::delete($path_old_card);
            }
             CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['address_picture' => $home_img]);
        }
        
         $home_img_2 = '';
        if($request->hasFile('home_img_2')){ 
            $home_img_2 = time().'bnks.'.request()->home_img_2->getClientOriginalExtension();
            request()->home_img_2->move(public_path('customerfiles/files/'), $home_img_2);
            $path_old_card = "customerfiles/files/".$request->old_home_img_2;  
            if(File::exists($path_old_card)) {
                File::delete($path_old_card);
            }
            
             CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['address_picture_2' => $home_img_2]);

        }
        
       
            CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['address_comment' => $request->address_comment,
                      'online_address_confirm_status' => 'confirmed',
                      'online_address_confirm_by' => Auth::user()->id,
                      'online_address_confirm_date' => date('Y-m-d H:i:s')]);
    
            Session::flash('successMessage', "Confirmation Successful");
            
            return redirect('/loan/loan/show/request/confirm/address');
            
    }
     /**
     * show to confirm customer files
     *
     * @return \Illuminate\Http\Response
     */
    public function showToconfirmFiles($id)
    {
        
            $data = CustomerEmployment::where('customer_id', $id)->first();
    
            return view('accounting.loan.confirm-online-files-create', compact('data'));
            
    }
     /**
     * confirm oonline customer address
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmOnlineConfirmFiles(Request $request)
    {
        
        $profilpic = '';
        if($request->hasFile('avatar')){
            $profilpic = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('customerfiles/profilepicture/'), $profilpic);
            
             $path_old_avatar= "customerfiles/profilepicture/".$request->old_avatar;  
             if(File::exists($path_old_avatar)) {
                    File::delete($path_old_avatar);
             }
             
            Customer::where('id', $request->customer_id)
            ->update(['avatar' => $profilpic]);
        }
        
        
        
        $bankStatement = '';
        if($request->hasFile('bank_statement')){ 
            $bankStatement = time().'bnks.'.request()->bank_statement->getClientOriginalExtension();
            request()->bank_statement->move(public_path('customerfiles/files/'), $bankStatement);
            $path_old_card = "customerfiles/files/".$request->old_bank_statement;  
            if(File::exists($path_old_card)) {
                File::delete($path_old_card);
            }
            
            
             CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['bank_statement' => $bankStatement]);
       
        }
        
    
             Session::flash('successMessage', "Uplaod Successful");
            
            return back();
            
    }
     /**
     * confirm oonline customer address
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmOnlineConfirmFilesFinal(Request $request)
    {
        
        $profilpic = '';
        if($request->hasFile('avatar')){
            $profilpic = time().'.'.request()->avatar->getClientOriginalExtension();
            request()->avatar->move(public_path('customerfiles/profilepicture/'), $profilpic);
            
             $path_old_avatar= "customerfiles/profilepicture/".$request->old_avatar;  
             if(File::exists($path_old_avatar)) {
                    File::delete($path_old_avatar);
             }
             
            Customer::where('id', $request->customer_id)
            ->update(['avatar' => $profilpic]);
        }
        
        
        
        $bankStatement = '';
        if($request->hasFile('bank_statement')){ 
            $bankStatement = time().'bnks.'.request()->bank_statement->getClientOriginalExtension();
            request()->bank_statement->move(public_path('customerfiles/files/'), $bankStatement);
            $path_old_card = "customerfiles/files/".$request->old_bank_statement;  
            if(File::exists($path_old_card)) {
                File::delete($path_old_card);
            }
            
            
             CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['bank_statement' => $bankStatement]);
       
        }
        
        $home_img = '';
        if($request->hasFile('home_img')){ 
            $home_img = time().'bnks.'.request()->home_img->getClientOriginalExtension();
            request()->home_img->move(public_path('customerfiles/files/'), $home_img);
            $path_old_card = "customerfiles/files/".$request->old_home_img;  
            if(File::exists($path_old_card)) {
                File::delete($path_old_card);
            }
             CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['address_picture' => $home_img]);
        }
         $home_img_2 = '';
        if($request->hasFile('home_img_2')){ 
            $home_img_2 = time().'bnks.'.request()->home_img_2->getClientOriginalExtension();
            request()->home_img_2->move(public_path('customerfiles/files/'), $home_img_2);
            $path_old_card = "customerfiles/files/".$request->old_home_img_2;  
            if(File::exists($path_old_card)) {
                File::delete($path_old_card);
            }
            
             CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['address_picture_2' => $home_img_2]);

        }
           
            CustomerEmployment::where('customer_id', $request->customer_id)
            ->update(['address_comment' => $request->address_comment,
                      'online_file_confirm_status' => 'confirmed',
                      'online_file_confirm_by' => Auth::user()->id,
                      'online_file_confirm_date' => date('Y-m-d H:i:s')]);
    
            Session::flash('successMessage', "Confirmation Successful");
            
            return redirect('/loan/loan/show/request/confirm/files');
            
    }
     /**
     * assign loan officer select officer
     *
     * @return \Illuminate\Http\Response
     */
    public function assignOfficerSelectOfficer(Request $request)
    {
        try{
            dd(999);
            $laon_id = $request->id;
            $loan_officers = Employee::where('branch_id',$request->branch_id)->get();
            return view('accounting.loan.assign-officer-select-officer', compact('laon_id','loan_officers'));

         }catch (Exception $e) {
            return back();
        }
    }
     /**
     * save new loan officer 
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAssingOfficer(Request $request)
    {
        try{

            $laon_id = $request->id;
            $loan_officers = Employee::where('branch_id',$request->branch_id)->get();
            return view('accounting.loan.assing-fficer-selectofficer', compact('laon_id','loan_officers'));

         }catch (Exception $e) {
            return back();
        }
    }
     /**
     * Display all offline rejection.
     *
     * @return \Illuminate\Http\Response
     */
    public function offlineRejection()
    {
          
        $data = Loan::where('loan_officer_id', Auth::user()->id)
                     ->where('confirmation_status','rejected')
                     ->orderBy('id','DESC')->get();

       
        return view('accounting.loan.rejected-list', compact('data'));
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
     * show all loan details.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoanDetail($id)
    {
        try{

            $data = Loan::findOrFail($id);
            $banks  = SubAccountsChart::where('name','RePayment')->get();
            //$banks = DB::table('sub_accounts_charts')->where('name','RePayment')->get();
            return view('accounting.loan.show-loan-details', compact('data','banks'));

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
            
            $offer_letter = '';
            $status = 'processing';
            //check if is risk to confirmation
            if($get_next_step == 5 && $request->isOffer_letter_accepted == "false"){
                       
                $next_process_by_amt = static::getNextProcessByAmount($request->checkAmount,$get_next_step);
                $get_next_step = $next_process_by_amt;
                $offer_letter = 'pending';

            }else if($get_next_step == 5 && $request->isOffer_letter_accepted == "true"){ //Check If Offer letter is accepted
                    
                $get_next_step = "approve";
                $offer_letter = 'active';
                $status = 'approve';
            }else if($get_next_step == 5 && $request->product_id == 3){//Check if the Product is Staff Loan
                $get_next_step = "approve";
                $offer_letter = 'active';
                $status = 'approve';
            }else{
                if($get_next_step != 4){
                    $get_next_step = 4;
                    $offer_letter = 'waiting_to_send';
                }
                
            }
            // dd($request->loan_id);
            // dd($get_next_step.' ****'.$request->checkAmount.' ____ '.$request->isOffer_letter_accepted.' :: '.$offer_letter.' :::'.$status.' Product: '.$request->product_id);
            Loan::where('id', $request->loan_id)
                        ->update(['confirmation_status' => $get_next_step,
                                  'status' => $status,
                                  'offer_letter' => $offer_letter]
                                );

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

           /**OLD LOGIC $get_user_process = static::get_myConfirmProcessId();
              $get_next_step = $get_user_process-1;
            **/
            $get_next_step = $request->process;
            if($get_next_step == 2){
                $get_next_step = "rejected";
            }
            Loan::where('id', $request->loan_id)
            ->update([
                    'confirmation_status' => $request->process,
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
        $result = Loan::where('status','approve')->orderBy('id','DESC')->get();
        //$accounts = AccountsChart::orderBy('id','DESC')->get();
        $accounts  = SubAccountsChart::where('name','Disbursement')->get();
        //$accounts = DB::table('sub_accounts_charts')->where('name','Disbursement')->get();

        return view('accounting.loan.disburse-loan', compact('result','accounts'));
    }
    /**
     * Display a listing loan to disburse.
     *
     * @return \Illuminate\Http\Response
     */
    public function disburseLoanPayment(Request $request) 
    {
        try {

            $from_date = date('Y-m-d', strtotime($request->from));
            $to_date = date('Y-m-d', strtotime($request->to));
            $result = array();
            if ($request->from && $request->to) {
               
                if($request->status == "paid"){
                    $result = Loan::whereBetween('release_date', array($from_date,$to_date))
                        ->where('status_paid','=','paid')
                        ->orderBy('release_date', 'DESC')->get();
                }else{
                    $result = Loan::whereBetween('release_date', array($from_date,$to_date))
                            ->whereNull('status_paid')
                            ->orWhere('status_paid','!=','paid')
                            ->orderBy('release_date', 'DESC')->get();
                }
                 
                   
            }else if (!$request->to && $request->from) {
                   
                if($request->status == "paid"){
                    $result = Loan::where('release_date',$from_date)
                    //->orWhere('release_date', 'like', '%' . $from_date . '%')
                            ->where('status_paid','=','paid')
                            ->orderBy('release_date', 'DESC')->get();
                           
                }else{
                    $result = Loan::where('release_date',$from_date)
                    //->orWhere('release_date', 'like', '%' . $from_date . '%')
                                ->whereNull('status_paid')
                                ->orWhere('status_paid','!=','paid')
                                ->orderBy('release_date', 'DESC')->get();
                }
            
            } 
            
            // $result = Loan::whereNull('status_paid')
            //                     ->orWhere('status_paid','!=','paid')->get();

            return view('accounting.loan.disburse-payment', compact('result'));

        } catch (\Throwable $th) {
            return back();
        }
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
                            'maturity_date' => $obj->maturity_date,
                            //'first_payment_date' => $request->first_repayment_date,
                            'disbursed_amount' => $obj->amount,
                            'loan_disbursed_by_id' => Auth::user()->id]);
                            
                            
                            //Update customer status to active in customer table
                            Customer::where('id',$obj->customer_id)->update(['status' => 'active']);

                            static::emailDisbursement($obj->customer_id);
                
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
     * Send Disbursement Email
     *
     * @return \Illuminate\Http\Response
     */
    public function emailDisbursement($id)
    {
        
        $customer = Customer::where('id', $id)->first();

        $data = array( 'subject' => "Approve Loan",
        'email' => $customer->email,
        'name' => $customer->first_name,
        'phone_number' => $customer->phone_number,
        'password' => "1234567",
        'loan_id' => "000".$id,
        'date' => date('d-m-Y'),
        );

        Mail::to($customer->email)->send(new ApprovedLoan($data));
    
        return true;

    }
    /**
     * Loan Disbursement multiple payment
     *
     * @return \Illuminate\Http\Response
     */
    public function loanDisburseMultiplePay(Request $request)
    {
      
        try{

            foreach($request->loan_disburse as $val){

                $obj = json_decode($val);

                 Loan::where('id', $obj->id)
                    ->update([
                            'status_paid' => 'paid',
                            'loan_disbursed_payment_by_id' => Auth::user()->id]);
                
                            AdminHelper::audit_trail('loan','Loan Disbursement Payment confirmation',$obj->id);
            }
            
            Session::flash('successMessage', "Payment successful");
            return back();

        }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Loan Disbursement single payment
     *
     * @return \Illuminate\Http\Response
     */
    public function loanDisburseSinglePay(Request $request)
    {
      
        try{

            Loan::where('id', $request->loan_id)
                    ->update([
                            'status_paid' => 'paid',
                            'loan_disbursed_payment_by_id' => Auth::user()->id]);
                
                            AdminHelper::audit_trail('loan','Loan Disbursement Payment confirmation',$request->loan_id);
            Session::flash('successMessage', "Payment successful");
            return back();

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
                      'confirmation_status' => 'approve',
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
     * Customer Credit Score
     *
     * @return \Illuminate\Http\Response
     */
    public function customerCreditScore(Request $request)
    {
      
        try{
            

            $ccScore = '';
            if($request->hasFile('customer_credit_score')){ 
               $ccScore = time().'idc.'.request()->customer_credit_score->getClientOriginalExtension();
                    request()->customer_credit_score->move(public_path('customerfiles/files/'), $ccScore);
             $path_old_card = "customerfiles/files/".$request->old_customer_credit_score;  
                        if(File::exists($path_old_card)) {
                            File::delete($path_old_card);
                        }
            
              Loan::where('id', $request->loan_id)
            ->update(['customer_credit_score' => $ccScore]);
            }
            
    
            Session::flash('successMessage', "Save successful");
            return back();;

        }catch (Exception $e) {
            return back();
        }
    }
   
    /**
     * Show Customer Credit Score
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreditScore(Request $request)
    {
      
        try{
            
             $file =  $request->file;
             return view('accounting.loan.customer-credit-score', compact('file'));

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
    function getNextProcessByAmount($amount,$get_next_step)
    {
    
        $data = ConfirmationProcessByAmountSettings::get();
        foreach ($data as $rec) {
           
            if (intval($rec->min) <= intval($amount) && intval($amount) <= intval($rec->max)){
                return $rec->process;
            }
        }

         return $get_next_step;
    
    }

    /**
     * Make loan repayment
     *
     * @return \Illuminate\Http\Response
     */
    public function makeRepayment(Request $request)
    {
      
        try{

            $in_complete_payment = 0;//false
            $balance = 0;
            $amount_to_be_paid = 0;
            $complete_payment_status = '';
            $liquidation_type = null;
            if($request->amount_to_be_paid == "other_payment" || $request->amount_to_be_paid == 'pre_liquidate_payment'){
                
                $amount_to_be_paid = $request->other_amount;
            }else{
                $amount_to_be_paid = $request->amount_to_be_paid;
            }
            //check if pre liqiuidation
            if($request->amount_to_be_paid == 'pre_liquidate_payment'){
                
                //$this->loan_pre_liquidate($request->loan_id);
                $complete_payment_status = 'true';
                $liquidation_type = 'pre';
            }
            //Check if the payment amount is lesss then the amount to be paid
            if(intval($amount_to_be_paid) < intval($request->next_amount_to_pay)){
                //Session::flash('errorMessage', "The amount to be paid con NOT be less than the next payment amount.");
                //return back();
                $in_complete_payment = 1; //true
                $balance = $request->next_amount_to_pay - $amount_to_be_paid;
                $balance = bcadd(0,$balance,2);
            //Check if the payment amount is more than the amount to be paid
            }else if(intval($amount_to_be_paid) > intval($request->next_amount_to_pay)){
                
              
                //$the_total_paid = $request->total_balance + $amount_to_be_paid;
                $balance = $request->total_balance_to_be_paid - $amount_to_be_paid;
                $balance = bcadd(0,$balance,2);
                
                //Check if complete payment 
                if($balance < 1){
                    
                    $complete_payment_status = 'true';
                    $liquidation_type = 'full';
                    //Liquidate loan account
                    Loan::where('id', $request->loan_id)
                    ->update(['status' => 'fully_paid']);
                }
                
           
            
            }
          
           //Check if record exist
           $check = Loan_Repayment::where('loan_id',$request->loan_id)
                                    ->where('date_paid',$request->next_pay_month)
                                    ->where('in_complete_payment',1)->first();
            if(!$check){
                $l_pay = new Loan_Repayment(); 
                $l_pay->loan_id = $request->loan_id;
                $l_pay->user_id = Auth::user()->id;
                $l_pay->transaction_type = $request->transaction_type;
                $l_pay->payment_bank = $request->payment_bank;
                $l_pay->amount = $amount_to_be_paid;
                $l_pay->date_paid = $request->next_pay_month;
                $l_pay->balance = $balance;
                $l_pay->in_complete_payment = $in_complete_payment;
                $l_pay->notes = $request->note; 
                $l_pay->complete_payment_status = $complete_payment_status;
                $l_pay->liquidation_type = $liquidation_type;
                $l_pay->confirmation_status = 1;
                $l_pay->save();
            }
            
            
            
            $l_pay_history = new Loan_Repayment_History(); 
            $l_pay_history->loan_id = $request->loan_id;
            $l_pay_history->customer_id = $request->customer_id;
            $l_pay_history->user_id = Auth::user()->id;
            $l_pay_history->transaction_type = 'cm';
            $l_pay_history->payment_bank = $request->payment_bank;
            $l_pay_history->amount = $amount_to_be_paid;
            $l_pay_history->date_paid = $request->next_pay_month;
            $l_pay_history->balance = $balance;
            $l_pay_history->in_complete_payment = $in_complete_payment;
            $l_pay_history->notes = $request->note;
            $l_pay_history->complete_payment_status = $complete_payment_status;
            $l_pay_history->confirmation_status = 1;
            $l_pay_history->save();

            AdminHelper::audit_trail('loan','Loan repayment for the month of '.$request->next_pay_date.'.',$request->loan_id);
    
            Session::flash('successMessage', "Loan repayment successful");
            return back();

        }catch (Exception $e) {
            return back();
        }
    }
    /**
     * Do loan pre liquidation
     *
     * @return \Illuminate\Http\Response
     */
    public function loan_pre_liquidate($loan_id)
    {
        $data  = Loan::where('id',$loan_id)->first();
        $loan_amount = $data->disbursed_amount ? $data->disbursed_amount : $data->principal;
        $pay_day = $data->customer->employment->salary_pay_day;
         if($pay_day < 10){
            $pay_day = '0'.$pay_day;
        }
        $in = date_create($data->created_at);
        $out = date_create($in->format('Y-m-'.$pay_day));
        $the_release_date = $data->release_date ? $data->release_date : date('Y-m-d');
        $cal_result = RepaymentController::repaymentScheduleCalendar($data->id,$loan_amount,$data->interest_rate,$data->loan_duration,$data->loan_duration_length,$the_release_date,$pay_day);
        $get_result = json_decode($cal_result, true);
        foreach($get_result as $value){
            if($value['status'] == true && $value['in_complete_payment'] != true){
                echo $value['date'].' : paid <br>';
            }else{
                echo $value['date'].' : not paid <br>';
            }
        }

    }
    
    /**
     * Make loan repayment
     *
     * @return \Illuminate\Http\Response
     */
    public function makeBalanceRepayment(Request $request)
    {
      
        try{

            $in_complete_payment = 0;//false
            $balance = 0;
            $amount_to_be_paid = 0;
            $complete_payment_status = '';
            $amount_to_be_paid = intval($request->current_amount_paid) + intval($request->balance_amount_to_be_paid);
  
            if($request->balance_amount_to_be_paid == "other_payment"){
                
                $amount_to_be_paid = $request->other_amount_balance;
            }else{
                $amount_to_be_paid = $request->balance_amount_to_be_paid;
            }
            //Check if the payment amount is lesss then the amount to be paid
            if(intval($amount_to_be_paid) < intval($request->balance_pay_amount)){


                $in_complete_payment = 1; //true
                $balance = $request->balance_pay_amount - $amount_to_be_paid;
                $balance = bcadd(0,$balance,2);
            //Check if the payment amount is more than the amount to be paid
            }else if(intval($amount_to_be_paid) > intval($request->balance_pay_amount)){
                
                
                $balance = $request->balance_pay_amount - $amount_to_be_paid;
                $balance = bcadd(0,$balance,2);
                
                //Check if complete payment
                if($balance < 1){
                    $complete_payment_status = 'true';
                    
                    //Liquidate loan account
                    Loan::where('id', $request->loan_id)
                    ->update(['status' => 'fully_paid']);
                }
            }
            
             $amount_to_be_paid_2 =  $amount_to_be_paid + $request->current_amount_paid;
            if($amount_to_be_paid >= $amount_to_be_paid_2){
                $in_complete_payment = 0;
            }
            
            //dd($amount_to_be_paid_2);
            
            // if($in_complete_payment){
            //     dd('Y '.$amount_to_be_paid.' BB: '.$amount_to_be_paid_2);
            // }else{
            //     dd('Nooo '.$amount_to_be_paid.' BB: '.$balance);
            // }
           
            
              Loan_Repayment::where('loan_id',$request->loan_id)->where('date_paid',date('Y-m-d', strtotime($request->next_pay_month)))
                          ->update([
                              'transaction_type' => $request->transaction_type,
                              'amount' => $amount_to_be_paid_2,
                              'balance' => $balance,
                              'in_complete_payment' => $in_complete_payment,
                              //'complete_payment_status' => $complete_payment_status,
                              ]);
                              
            $l_pay_history = new Loan_Repayment_History(); 
            $l_pay_history->loan_id = $request->loan_id;
            $l_pay_history->customer_id = $request->customer_id;
            $l_pay_history->user_id = Auth::user()->id;
            $l_pay_history->transaction_type = 'bl';
            $l_pay_history->payment_bank = $request->payment_bank;
            $l_pay_history->amount = $amount_to_be_paid_2;
            $l_pay_history->date_paid = $request->next_pay_month;
            $l_pay_history->balance = $balance;
            $l_pay_history->in_complete_payment = $in_complete_payment;
            $l_pay_history->notes = $request->note;
            $l_pay_history->complete_payment_status = $complete_payment_status;
            $l_pay_history->confirmation_status = 1;
            $l_pay_history->save();

            AdminHelper::audit_trail('loan','Loan Balance repayment for the month of '.$request->next_pay_month_balance.'.',$request->loan_id);
    
            Session::flash('successMessage', "Loan repayment successful");
            return back();

        }catch (Exception $e) {
            return back();
        }
    }
    
    public function marketIndex(Request $request){
        $confirmationArray  = [1,2,3,4,5]; 
        $prospects = [];
        if($request->isMethod('post')){
            if(isset($request->customer_id)){
                $prospects = Loan::where('customer_id', $request->customer_id)->where('loan_officer_id', auth()->user()->id)->get();
            }else{
                $user = Customer::where('other_name', 'LIKE', "%$request->c_name")->orWhere('first_name', 'LIKE', "%$$request->c_name")->orWhere('last_name', 'LIKE', "%$$request->c_name")->first();
                if($user !== null){
                    $prospects = Loan::where('customer_id', $user->id)->where('loan_officer_id', auth()->user()->id)->get();
                }
                Session::flash('errorMessage', "User is not found");
                return back();
            }
        }else{
            $prospects = Loan::where('loan_officer_id', auth()->user()->id)->get();
        }
        return view('accounting.market.view', compact('prospects', 'confirmationArray'));
    }
    
    public function runningLoan(Request $request){
        $loans = []; $query = []; $dateRange = [];
        if($request->isMethod('post')){
            foreach($request->all() as $field => $value ){
                if($request->filled($field) && collect($this->searchable)->contains($field) && strtotime($value) === false){
                    $query[$field] = $value;
                }
                if(strtotime($value) !== false){
                    array_push($dateRange,  $value);
                }
            }
            if(empty($dateRange)) {
                $loans = Loan::where($query)->where('status','active')->get();
            } 
            else{
                $loans =  Loan::where($query)->where('status','active')->whereBetween('created_at', $dateRange)->get();
            }
            if(empty($query) && !empty($dateRange)){
                $loans =  Loan::where('status','active')->whereBetween('created_at', $dateRange)->get();
            }
        }else{
            $loans = Loan::where('status','active')->get();
        }
        $branches = \DB::table('branches')->get();
        $products = \DB::table('products')->get();
        return view('accounting.market.index',compact('loans', 'branches', 'products'));
    }
    
    public function runningProductLoan(Request $request){
        // dd(gettype($request->product), $request->product);
        if($request->product == 'online-request'){
            $loans = Loan::where('status','active')->where('customer_request',1)->orderBy('id','desc')->get();    
        }else{
            $loans = Loan::where('status','active')->where('product_id',$request->product)->orderBy('id','desc')->get();
        }
        $branches = \DB::table('branches')->get();
        $products = \DB::table('products')->get();
        return view('accounting.market.index',compact('loans', 'branches', 'products'));
    }
    
}
