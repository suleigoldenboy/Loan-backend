<?php

namespace App\Http\Controllers\Loan;

use DB;
use Auth;
use File;
use Hash;
use Session;
use App\Models\Loan\Loan;
use App\Models\Admin\Branch;
use App\Models\Loan\Product;
use Illuminate\Http\Request;
use App\Models\Employee\User;
use App\Http\Helpers\AdminHelper;
use App\Models\Customer\Customer;
use App\Models\Customer\NextOfKin;
use App\Http\Controllers\Controller;
use App\Models\HRManagement\Employee; 
use Illuminate\Support\Facades\Validator;
use App\Models\Customer\CustomerEmployment;
use App\Models\Customer\Customer_guarantors;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class FederalLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        try{
           
            $branches = Branch::get();
            $products = Product::all();
            $loan_officers = Employee::get();
            $customer = array();
            $loan =  array();
            $nextOfKin = array();
            $employment = array();
            if($request->id){ 
                $customer = Customer::where('id',$request->id)->first();
                $loan = Loan::where('id',$request->loan_id)->first();
                $nextOfKin = NextOfKin::where('customer_id',$request->id)->first();
                $employment = CustomerEmployment::where('customer_id',$request->id)->first();
            }
           
            return view('admin.customer.create.federal-loan',compact('branches','products','loan_officers','customer','loan','nextOfKin','employment'));

        }catch (Exception $e) {
            return back();
        }
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completed(Request $request)
    {
        
        try{
            return view('admin.customer.create.completed');

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
            
                \Log::info($request);
            //Check if customer exist
            $customer = Customer::where('id',$request->customer_update_id )->first();
            if($customer == null){ //means first time applicant
                $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|unique:customer|max:100|unique:customers',
                    'phone_number' => 'required|unique:customer|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
                    'iips' => 'required|unique:customer_income_details',
                    'bvn' => 'required|unique:customer_income_details',
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator);
                }else{
                    //Store Customer Information
                    $_cus = new Customer();
                    $_cus->loan_officer_id = $request->loan_officer_id;
                    $_cus->branch_id = $request->branch_id;
                    $_cus->first_name = $request->first_name;
                    $_cus->last_name = $request->last_name;
                    $_cus->other_name = $request->other_name;
                    $_cus->username = $request->email;
                    $_cus->email = $request->email;
                    $_cus->password = Hash::make('secret');
                    $_cus->phone_number = $request->phone_number;
                    $_cus->address = $request->address;
                    $_cus->uuid = random_int(1, 98898);
                    $_cus->bvn_phone_number = $request->phone_number;
                    $_cus->email_verified_at = $request->email_verified_at;
                    $_cus->bvn_verified = 0;
                    $_cus->name_is_verified = $request->name_is_verified;
                    $profilpic = '';
                    if($request->hasFile('avatar')){
                    $profilpic = time().'.'.request()->avatar->getClientOriginalExtension();
                    request()->avatar->move(public_path('customerfiles/profilepicture/'), $profilpic);
                    }
                    $_cus->avatar = $profilpic;
                    $_cus->marital_status = $request->marital_status;
                    $_cus->religion = $request->religion;
                    $_cus->religion_address = $request->religion_address;
                    $_cus->religion_center_name = $request->religion_center_name;
                    $_cus->date_of_birth = $request->date_of_birth;
                    $_cus->gender = $request->gender;
                    $_cus->occupation = $request->occupation;
                    $_cus->state = $request->state;
                    $_cus->lga = $request->lga;
                    $_cus->id_card_type = $request->id_card_type;
                    $_cus->id_card_number = $request->id_card_number;
                    $_cus->registration_step_status = 'general_info';
                    $_cus->status = 'pending';
                    $_cus->created_by = Auth::user()->id;
                    $_cus->save();
                }
                
            }else{
                
                //Update Customer Information
                $_cus = Customer::findOrFail($customer_exist_id);
                $_cus->loan_officer_id = $request->loan_officer_id;
                $_cus->branch_id = $request->branch_id;
                $_cus->first_name = $request->first_name;
                $_cus->last_name = $request->last_name;
                $_cus->other_name = $request->other_name;
                $_cus->username = $request->email;
                $_cus->email = $request->email;
                $_cus->password = Hash::make('secret');;
                $_cus->phone_number = $request->phone_number;
                $_cus->address = $request->address;
                $_cus->uuid = random_int(1, 98898);
                $_cus->bvn_phone_number = $request->phone_number;
                $_cus->email_verified_at = $request->email_verified_at;
                $_cus->bvn_verified = 0;
                $_cus->name_is_verified = $request->name_is_verified;
                $profilpic = '';
                if($request->hasFile('new_avatar')){
                    
                $profilpic = time().'.'.request()->new_avatar->getClientOriginalExtension();
                request()->new_avatar->move(public_path('customerfiles/profilepicture/'), $profilpic);
                    $image_path1 = "customerfiles/profilepicture".$request->old_avatar;  
                    if(File::exists($image_path1)) {
                    File::delete($image_path1);
                }
                $_cus->avatar = $profilpic;
                
                }
                $_cus->marital_status = $request->marital_status;
                $_cus->religion = $request->religion;
                $_cus->religion_address = $request->religion_address;
                $_cus->religion_center_name = $request->religion_center_name;
                $_cus->date_of_birth = $request->date_of_birth;
                $_cus->gender = $request->gender;
                $_cus->occupation = $request->occupation;
                $_cus->state = $request->state;
                $_cus->lga = $request->lga;
                $_cus->id_card_type = $request->id_card_type;
                $_cus->id_card_number = $request->id_card_number;
                $_cus->created_by = Auth::user()->id;
                $_cus->save();
                
                //Save audit trail
                //AdminHelper::audit_trail('customer','General information updated during registration',$_cus->id);
            
            }

            
            $this->storeEmployment($request,$_cus->id);//Store Employement
            $this->storeLoan($request,$_cus->id);//Store Loan
            $this->storeNextOfKin($request,$_cus->id);/// Store next of kin
            
                //Save audit trail
            AdminHelper::audit_trail('customer','New Customer created',$_cus->id);
            
            
                Session::flash('successMessage', "Loan created successful");
            return redirect('customer/create/completed');

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
    public function storeNextOfKin($request,$customer_id)
    {
        try{

            $customer_exist_id = $request->session()->get('customer_registration_id');
            //Check if customer loan exist
            $customer = NextOfKin::where('customer_id',$customer_id)->first();
          
            if($customer == null){
                //Store next of kin
                $_nexofkin = new NextOfKin();
                $_nexofkin->customer_id = $customer_id;
                $_nexofkin->first_name = $request->next_of_kin_first_name;
                $_nexofkin->last_name = $request->next_of_kin_last_name;
                $_nexofkin->phone_number = $request->next_of_kin_phone_number;
                $_nexofkin->relationship = $request->next_of_kin_relationship; 
                $_nexofkin->email = $request->next_of_kin_email;
                $_nexofkin->occupation = $request->next_of_kin_occupation;
                $_nexofkin->address = $request->next_of_kin_address;
                $_nexofkin->save();
            }else{
                //Update next of kin
                NextOfKin::where('customer_id',$customer_id)
                        ->update([
                                 'first_name' => $request->next_of_kin_first_name,
                                 'last_name' => $request->next_of_kin_last_name,
                                 'phone_number' => $request->next_of_kin_phone_number, 
                                 'relationship' => $request->next_of_kin_relationship,
                                 'email' => $request->next_of_kin_email,
                                 'occupation' => $request->next_of_kin_occupation,
                                 'address' => $request->next_of_kin_address
                                ]);
                          
            }
            return true;
                

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
    public function storeEmployment($request,$customer_id)
    {

            try{

                //Check if customer employment exist
                $customer_exist_id = $request->session()->get('customer_registration_id');
                $check = CustomerEmployment::where('customer_id',$customer_exist_id)
                                            //->orWhere('iips',$request->ipps)
                                            ->first();      
                if($check == null){
                    //Store Customer Information
                    $_cus = new CustomerEmployment();
                    $_cus->customer_id = $customer_id;
                    $_cus->bvn = $request->bvn;
                    $_cus->employment_status = $request->employment_status;
                    $_cus->business_name = $request->business_name;
                    $_cus->business_state = $request->business_state;
                    $_cus->business_city = $request->business_city;
                    $_cus->business_lga = $request->business_lga;
                    $_cus->business_address = $request->business_address;
                    $_cus->business_phone_number = $request->business_phone_number;
                    $_cus->rc_bn = $request->rc_bn;
                    $_cus->beneficiary_bank = $request->beneficiary_bank;
                    $_cus->account_name = $request->account_name;
                    $_cus->account_number = $request->account_number;
                    $_cus->monthly_turn_over = $request->monthly_turn_over;
                    $_cus->monthly_profit = $request->monthly_profit;
                    $_cus->date_of_inc_reg = $request->date_of_inc_reg;
                    $_cus->employers_name = $request->employers_name;
                    $_cus->joined_date = $request->joined_date;
                    $_cus->monthly_gross_salary = $request->monthly_gross_salary;
                    $_cus->monthly_net_pay = $request->monthly_net_pay;
                    $_cus->salary_account_number = $request->salary_account_number;
                    $_cus->salary_bank_name = $request->salary_bank_name;
                    $_cus->salary_account_name = $request->salary_account_name;
                    $_cus->salary_pay_day = $request->salary_pay_day;
                    $_cus->employer_phone_number = $request->employer_phone_number;
                    $_cus->employer_name = $request->employer_name;
                    $_cus->employer_email = $request->employer_email;
                    $_cus->name_of_institution_retired_from = $request->name_of_institution_retired_from;
                    $_cus->retired_start_date = $request->retired_start_date;
                    $_cus->retired_end_date = $request->retired_end_date;
                    $_cus->pension_paying_institute = $request->pension_paying_institute;
                    $_cus->pension_number = $request->pension_number;
                    $_cus->monnthly_pension_amount = $request->monnthly_pension_amount;
                    $_cus->pension_bank = $request->pension_bank;
                    $_cus->student_name = $request->student_name;
                    $_cus->school_name = $request->school_name;
                    $_cus->school_address = $request->school_address;
                    $_cus->current_level = $request->current_level;
                    $_cus->name_of_department = $request->name_of_department;
                    $_cus->parent_full_name = $request->parent_full_name;
                    $_cus->parent_address = $request->parent_address;
                    $_cus->iips = $request->iips;
                    $_cus->ministry_mda = $request->ministry_mda;
                    $_cus->employment_department = $request->employment_department;
                    $_cus->parents_phone_number = $request->parents_phone_number;
                    $_cus->parent_bank_name = $request->parent_bank_name;
                    $_cus->parent_account_number = $request->parent_account_number;
                    $_cus->parent_account_name = $request->parent_account_name;
                    $_cus->id_card = $request->id_card;
                    $_cus->bank_statement = $request->bank_statement;
                    $_cus->utility_bill = $request->utility_bill;
                    $_cus->other_files = $request->other_files;
                    $_cus->created_by = Auth::user()->id;

                    $idCard = '';
                    if($request->hasFile('id_card')){ 
                    $idCard = time().'idc.'.request()->id_card->getClientOriginalExtension();
                    request()->id_card->move(public_path('customerfiles/files/'), $idCard);
                    $path_old_card = "customerfiles/files/".$request->old_id_card;  
                        if(File::exists($path_old_card)) {
                            File::delete($path_old_card);
                        }
                    $_cus->id_card = $idCard;
                    }
                    $bankStatement = '';
                    if($request->hasFile('bank_statement')){ 
                    $bankStatement = time().'bnks.'.request()->bank_statement->getClientOriginalExtension();
                    request()->bank_statement->move(public_path('customerfiles/files/'), $bankStatement);
                    $path_old_bank_statement = "customerfiles/files/".$request->old_bank_statement;  
                        if(File::exists($path_old_bank_statement)) {
                            File::delete($path_old_bank_statement);
                        }
                    $_cus->bank_statement = $bankStatement;
                    }
                    $utilityBill = '';
                    if($request->hasFile('utility_bill')){
                    $utilityBill = time().'utl.'.request()->utility_bill->getClientOriginalExtension();
                    request()->utility_bill->move(public_path('customerfiles/files/'), $utilityBill);
                    $path_old_utility_bill = "customerfiles/files/".$request->old_utility_bill;  
                        if(File::exists($path_old_utility_bill)) {
                            File::delete($path_old_utility_bill);
                        }
                    $_cus->utility_bill = $utilityBill;
                    }
                    
                    $the_sign = '';
                    if($request->hasFile('sign')){
                    $the_sign = time().'sign.'.request()->sign->getClientOriginalExtension();
                    request()->sign->move(public_path('customerfiles/files/'), $the_sign);
                    $path_old_sign = "customerfiles/files/".$request->old_sign;  
                        if(File::exists($path_old_sign)) {
                            File::delete($path_old_sign);
                        }
                    $_cus->sign = $the_sign;
                    }
                    

                    $the_cheque = '';
                    if($request->hasFile('cheque')){
                    $the_cheque = time().'chq.'.request()->cheque->getClientOriginalExtension();
                    request()->cheque->move(public_path('customerfiles/files/'), $the_cheque);
                    $path_old_cheque = "customerfiles/files/".$request->old_cheque;  
                        if(File::exists($path_old_cheque)) {
                            File::delete($path_old_cheque);
                        }
                    $_cus->cheque = $the_cheque;
                    }
                    
                    $otherFiles = '';
                    if($request->hasFile('other_files')){
                    $otherFiles = time().'other.'.request()->other_files->getClientOriginalExtension();
                    request()->other_files->move(public_path('customerfiles/files/'), $otherFiles);
                    $path_old_other_files = "customerfiles/files/".$request->old_other_files;  
                        if(File::exists($path_old_other_files)) {
                            File::delete($path_old_other_files);
                        }
                    $_cus->other_files = $otherFiles;
                    }
                    
                    $file_uploads = '';
                    if($request->hasFile('file_uploads')){
                    $file_uploads = time().'other.'.request()->file_uploads->getClientOriginalExtension();
                    request()->file_uploads->move(public_path('customerfiles/files/'), $file_uploads);
                    $path_old_file_uploads = "customerfiles/files/".$request->old_file_uploads;  
                        if(File::exists($path_old_file_uploads)) {
                            File::delete($path_old_file_uploads);
                        }
                    $_cus->file_uploads = $file_uploads;
                    }
                    $_cus->save();
    
                }else{
                    //Update Customer Information
                    $_cus = CustomerEmployment::where('customer_id',$customer_id)->first();
                    $_cus->bvn = $request->bvn;
                    //$_cus->income = $request->income;
                    $_cus->employment_status = $request->employment_status;
                    $_cus->business_name = $request->business_name;
                    $_cus->business_state = $request->business_state;
                    $_cus->business_city = $request->business_city;
                    $_cus->business_lga = $request->business_lga;
                    $_cus->business_address = $request->business_address;
                    $_cus->business_phone_number = $request->business_phone_number;
                    $_cus->rc_bn = $request->rc_bn;
                    $_cus->beneficiary_bank = $request->beneficiary_bank;
                    $_cus->account_name = $request->account_name;
                    $_cus->account_number = $request->account_number;
                    $_cus->monthly_turn_over = $request->monthly_turn_over;
                    $_cus->monthly_profit = $request->monthly_profit;
                    $_cus->date_of_inc_reg = $request->date_of_inc_reg;
                    $_cus->employers_name = $request->employers_name;
                    $_cus->joined_date = $request->joined_date;
                    $_cus->monthly_gross_salary = $request->monthly_gross_salary;
                    $_cus->monthly_net_pay = $request->monthly_net_pay;
                    $_cus->salary_account_number = $request->salary_account_number;
                    $_cus->salary_bank_name = $request->salary_bank_name;
                    $_cus->salary_account_name = $request->salary_account_name;
                    $_cus->salary_pay_day = $request->salary_pay_day;
                    $_cus->employer_phone_number = $request->employer_phone_number;
                    $_cus->employer_name = $request->employer_name;
                    $_cus->employer_email = $request->employer_email;
                    $_cus->name_of_institution_retired_from = $request->name_of_institution_retired_from;
                    $_cus->retired_start_date = $request->retired_start_date;
                    $_cus->retired_end_date = $request->retired_end_date;
                    $_cus->pension_paying_institute = $request->pension_paying_institute;
                    $_cus->pension_number = $request->pension_number;
                    $_cus->monnthly_pension_amount = $request->monnthly_pension_amount;
                    $_cus->pension_bank = $request->pension_bank; 
                    $_cus->student_name = $request->student_name;
                    $_cus->school_name = $request->school_name;
                    $_cus->school_address = $request->school_address;
                    $_cus->current_level = $request->current_level;
                    $_cus->name_of_department = $request->name_of_department;
                    $_cus->parent_full_name = $request->parent_full_name;
                    $_cus->parent_address = $request->parent_address;
                    $_cus->iips = $request->iips;
                    $_cus->ministry_mda = $request->ministry_mda;
                    $_cus->employment_department = $request->employment_department;
                    $_cus->parents_phone_number = $request->parents_phone_number;
                    $_cus->parent_bank_name = $request->parent_bank_name;
                    $_cus->parent_account_number = $request->parent_account_number;
                    $_cus->parent_account_name = $request->parent_account_name;
                    $_cus->created_by = Auth::user()->id;

                    $idCard = '';
                if($request->hasFile('id_card')){ 
                $idCard = time().'idc.'.request()->id_card->getClientOriginalExtension();
                request()->id_card->move(public_path('customerfiles/files/'), $idCard);
                $path_old_card = "customerfiles/files/".$request->old_id_card;  
                    if(File::exists($path_old_card)) {
                        File::delete($path_old_card);
                    }
                 $_cus->id_card = $idCard;
                }
                $bankStatement = '';
                if($request->hasFile('bank_statement')){ 
                $bankStatement = time().'bnks.'.request()->bank_statement->getClientOriginalExtension();
                request()->bank_statement->move(public_path('customerfiles/files/'), $bankStatement);
                $path_old_bank_statement = "customerfiles/files/".$request->old_bank_statement;  
                    if(File::exists($path_old_bank_statement)) {
                        File::delete($path_old_bank_statement);
                    }
                 $_cus->bank_statement = $bankStatement;
                }
                $utilityBill = '';
                if($request->hasFile('utility_bill')){
                $utilityBill = time().'utl.'.request()->utility_bill->getClientOriginalExtension();
                request()->utility_bill->move(public_path('customerfiles/files/'), $utilityBill);
                $path_old_utility_bill = "customerfiles/files/".$request->old_utility_bill;  
                    if(File::exists($path_old_utility_bill)) {
                        File::delete($path_old_utility_bill);
                    }
                 $_cus->utility_bill = $utilityBill;
                }
                
                $the_sign = '';
                if($request->hasFile('sign')){
                $the_sign = time().'sign.'.request()->sign->getClientOriginalExtension();
                request()->sign->move(public_path('customerfiles/files/'), $the_sign);
                $path_old_sign = "customerfiles/files/".$request->old_sign;  
                    if(File::exists($path_old_sign)) {
                        File::delete($path_old_sign);
                    }
                 $_cus->sign = $the_sign;
                }
                

                $the_cheque = '';
                if($request->hasFile('cheque')){
                $the_cheque = time().'chq.'.request()->cheque->getClientOriginalExtension();
                request()->cheque->move(public_path('customerfiles/files/'), $the_cheque);
                $path_old_cheque = "customerfiles/files/".$request->old_cheque;  
                    if(File::exists($path_old_cheque)) {
                        File::delete($path_old_cheque);
                    }
                 $_cus->cheque = $the_cheque;
                }
                
                $otherFiles = '';
                if($request->hasFile('other_files')){
                $otherFiles = time().'other.'.request()->other_files->getClientOriginalExtension();
                request()->other_files->move(public_path('customerfiles/files/'), $otherFiles);
                $path_old_other_files = "customerfiles/files/".$request->old_other_files;  
                    if(File::exists($path_old_other_files)) {
                        File::delete($path_old_other_files);
                    }
                 $_cus->other_files = $otherFiles;
                }
                
                $file_uploads = '';
                if($request->hasFile('file_uploads')){
                $file_uploads = time().'other.'.request()->file_uploads->getClientOriginalExtension();
                request()->file_uploads->move(public_path('customerfiles/files/'), $file_uploads);
                $path_old_file_uploads = "customerfiles/files/".$request->old_file_uploads;  
                    if(File::exists($path_old_file_uploads)) {
                        File::delete($path_old_file_uploads);
                    }
                 $_cus->file_uploads = $file_uploads;
                }
                    $_cus->save();

                }
                return true;

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
    public function storeLoan($request,$customer_id)
    {

            try{

                $customer_exist_id = $request->session()->get('customer_registration_id');
                //Check if customer loan exist
                $customer = Loan::where('customer_id',$customer_id)->first();
                $productInfo = Product::where('id',$request->product_id)->first();
                
                if($customer == null){
                    //Store Customer Loan
                    $_loan = new Loan();
                    $_loan->user_id = Auth::user()->id;
                    $_loan->loan_officer_id = $request->loan_officer_id;
                    $_loan->customer_id = $customer_id;
                    $_loan->branch_id = $request->branch_id;
                    $_loan->product_id = $request->product_id;
                    $_loan->principal = $request->principal;
                    $_loan->status = "processing"; 
                    $_loan->repayment_method = $productInfo->repayment_method;
                    $_loan->loan_duration = 'month';
                    $_loan->loan_duration_length = $request->loan_duration;
                    $_loan->interest_rate = $productInfo->interest_rate;
                    $_loan->insurance_charge = $productInfo->insurance_charge;
                    $_loan->processing_charge = $productInfo->processing_charge;
                    $_loan->repayment_instrument = $request->repayment_instrument; 
                    $_loan->disburesment_bank_name = $request->disburesment_bank_name;
                    $_loan->account_name = $request->account_name;
                    $_loan->acount_number = $request->acount_number;
                    $_loan->registration_status = true;
                    $_loan->confirmation_status = 3;
                    $_loan->loan_purpose = $request->loan_purpose;
                    $_loan->collateral = $request->collateral;
                    $_loan->save();
                }else{
                    //Update Customer loan Information
                    Loan::where('customer_id',$customer_id)
                            ->update([
                                     'loan_officer_id' => $request->loan_officer_id,
                                     'branch_id' => $request->branch_id,
                                     'product_id' => $request->product_id, 
                                     'principal' => $request->principal,
                                     'status' => $request->status,
                                     'repayment_instrument' => $request->repayment_instrument, 
                                     'repayment_method' => $productInfo->repayment_method,
                                     'loan_duration' => 'month',
                                     'registration_status' => true,
                                     'loan_duration_length' => $request->loan_duration,
                                     //'interest_rate' => $productInfo->interest_rate,
                                     'insurance_charge' => $productInfo->insurance_charge,
                                     'processing_charge' => $productInfo->processing_charge,
                                     'disburesment_bank_name' => $request->disburesment_bank_name,
                                     'account_name' => $request->account_name,
                                     'acount_number' => $request->acount_number,
                                     'loan_purpose' => $request->loan_purpose,
                                     'collateral' => $request->collateral
                                    ]);
                              
                }
                return true;
            

        }catch (Exception $e) {
           return back();
       }
    
    }

    public function storeFiles($request,$customer_id)
    {
        try {
            

                
                //$_cus->save();

        } catch (\Throwable $th) {
           return 0;
        }
    }
}
