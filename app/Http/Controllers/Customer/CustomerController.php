<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerEmployment;
use App\Models\Admin\Branch;
use App\Models\Loan\Product;
use App\Models\Loan\Loan;
use App\Models\Employee\User;
use App\Models\Customer\Customer_guarantors;
use App\Http\Helpers\AdminHelper;
use App\Models\HRManagement\Employee;
use Auth;
use File;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $data = Customer::orderBy('id','DESC')->get();

            return view('admin.customer.index', compact('data'));

        }catch (Exception $e) {
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function incompleteReg()
    {
        
        try{

            $data = Customer::where('registration_step_status', '!=', 'complete')->orderBy('id','DESC')->get();

            return view('admin.customer.create.in-complete', compact('data'));

        }catch (Exception $e) {
            return back();
        }
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completeReg(Request $request)
    {
        
        try{

            $request->session()->put('customer_registration_id', $request->id);
            
            if($request->type == "general_info"){
                return redirect('customer/create'); 
            }else if($request->type == "employement"){
                return redirect('customer/create/employment');
            }else if($request->type == "guarantor"){
                return redirect('customer/create/guarantor');
            }else if($request->type == "loan"){
                return redirect('customer/create/loan');
            }else if($request->type == "files"){
                return redirect('customer/create/file');
            }
            
            Session::flash('errorMessage', "Proccess not found.....");
            

        }catch (Exception $e) {
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
        try{

            $branches = Branch::get();
            $products = Product::all();
            $loan_officers = Employee::get();
            $customer_exist_id = $request->session()->get('customer_registration_id');
            $customer = Customer::where('id',$customer_exist_id)->first();
           
            return view('admin.customer.create.generalinfo',compact('branches','products','loan_officers','customer'));

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

            //Check if customer exist
            $customer_exist_id = $request->session()->get('customer_registration_id');
            $customer = Customer::where('id',$customer_exist_id)->first();

            if($customer == null){ 
                $this->validate($request, [
                    'email' => 'required|string|email|max:100|unique:customers',
                    'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
                    //'phone_number' => 'required|string|phone_number|max:19|unique:customers',
                ]);
                //Store Customer Information
                $_cus = new Customer();
                $_cus->loan_officer_id = $request->loan_officer_id;
                $_cus->branch_id = $request->branch_id;
                $_cus->first_name = $request->first_name;
                $_cus->last_name = $request->last_name;
                $_cus->other_name = $request->other_name;
                $_cus->username = $request->email;
                $_cus->email = $request->email;
                $_cus->password = '12323';
                $_cus->phone_number = $request->phone_number;
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
                $_cus->id_card_type = $request->id_card_type;
                $_cus->id_card_number = $request->id_card_number;
                $_cus->registration_step_status = 'general_info';
                $_cus->created_by = Auth::user()->id;
                $_cus->save();
                
                $request->session()->put('customer_registration_id', $_cus->id);
                //Save audit trail
                AdminHelper::audit_trail('customer','General information created',$_cus->id);
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
                $_cus->password = '12323';
                $_cus->phone_number = $request->phone_number;
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
                $image_path1 = "customerfiles/profilepicture".$request->old_avatar;  
                 if(File::exists($image_path1)) {
                    File::delete($image_path1);
                }
                $_cus->avatar = $profilpic;
                $_cus->marital_status = $request->marital_status;
                $_cus->religion = $request->religion;
                $_cus->religion_address = $request->religion_address;
                $_cus->religion_center_name = $request->religion_center_name;
                $_cus->date_of_birth = $request->date_of_birth;
                $_cus->gender = $request->gender;
                $_cus->occupation = $request->occupation;
                $_cus->id_card_type = $request->id_card_type;
                $_cus->id_card_number = $request->id_card_number;
                $_cus->created_by = Auth::user()->id;
                $_cus->save();
                
                //Save audit trail
                AdminHelper::audit_trail('customer','General information updated during registration',$_cus->id);
          
            }
          
             Session::flash('successMessage', "General information created successful");
            return redirect('customer/create/employment');

        }catch (Exception $e) {
           return back();
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEmployment(Request $request)
    {
        try{
           
            $customer_exist_id = $request->session()->get('customer_registration_id');
            $customer = CustomerEmployment::where('customer_id',$customer_exist_id)->first();

            return view('admin.customer.create.employment',compact('customer'));

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
    public function storeEmployment(Request $request)
    {

            try{

                //Check if customer employment exist
                $customer_exist_id = $request->session()->get('customer_registration_id');
                $check = CustomerEmployment::where('customer_id',$customer_exist_id)->first();
                
                if($check == null){
                    //Store Customer Information
                    $_cus = new CustomerEmployment();
                    $_cus->customer_id = $request->customer_id;
                    $_cus->bvn = $request->bvn;
                    $_cus->income = $request->income;
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
                    $_cus->parents_phone_number = $request->parents_phone_number;
                    $_cus->parent_bank_name = $request->parent_bank_name;
                    $_cus->parent_account_number = $request->parent_account_number;
                    $_cus->parent_account_name = $request->parent_account_name;

                    $_cus->id_card = $request->id_card;
                    $_cus->bank_statement = $request->bank_statement;
                    $_cus->utility_bill = $request->utility_bill;
                    $_cus->other_files = $request->other_files;
                    $_cus->created_by = Auth::user()->id;
                    $_cus->save();

                    static::updateRegStatus($request->customer_id,'employement');

                    $request->session()->put('customer_employment_registration_id', $_cus->id);
    
                    AdminHelper::audit_trail('customer','Employment information created',$_cus->id);
                }else{
                    //Update Customer Information
                   // $_cus = CustomerEmployment::findOrFail($customer_exist_id);
                    $_cus = CustomerEmployment::where('customer_id',$customer_exist_id)->first();
                    $_cus->bvn = $request->bvn;
                    $_cus->income = $request->income;
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
                    $_cus->parents_phone_number = $request->parents_phone_number;
                    $_cus->parent_bank_name = $request->parent_bank_name;
                    $_cus->parent_account_number = $request->parent_account_number;
                    $_cus->parent_account_name = $request->parent_account_name;

                    $_cus->created_by = Auth::user()->id;
                    $_cus->save();
                    
                    AdminHelper::audit_trail('customer','Employment information updated during registration',$_cus->id);
                
                }
                 Session::flash('successMessage', "Employment information created successful");
                return redirect('customer/create/guarantor');

        }catch (Exception $e) {
           return back();
       }
    
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGuarantor(Request $request)
    {
        try{
            $customer_exist_id = $request->session()->get('customer_registration_id');
            $customer = Customer_guarantors::where('customer_id',$customer_exist_id)->first();

            return view('admin.customer.create.guarantor',compact('customer'));

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
    public function storeGuarantor(Request $request)
    {

            try{
                $customer_exist_id = $request->session()->get('customer_registration_id');
                //Check if customer guarantor exist
                $customer = Customer_guarantors::where('customer_id',$customer_exist_id)->first();
                
                if($customer == null && !empty($request->session()->get('customer_registration_id'))){
                    //Store Customer Guarantor
                    $_cus_g = new Customer_guarantors();
                    $_cus_g->user_id = Auth::user()->id;
                    $_cus_g->customer_id = $request->customer_id;
                    $_cus_g->first_name = $request->first_name;
                    $_cus_g->last_name = $request->last_name;
                    $_cus_g->other_name = $request->other_name;
                    $_cus_g->relationship = $request->relationship;
                    $_cus_g->email = $request->email;
                    $_cus_g->phone_number = $request->phone_number;
                    $_cus_g->employment_status = $request->employment_status;
                    $_cus_g->age = $request->age;
                    $_cus_g->monthly_income = $request->monthly_income;
                    $_cus_g->occupation = $request->occupation;
                    $_cus_g->home_address = $request->home_address;
                    $_cus_g->office_address = $request->office_address;
                    $_cus_g->religion = $request->religion;
                    $_cus_g->religion_address = $request->religion_address;
                    $_cus_g->religion_center_name = $request->religion_center_name;
                    $_cus_g->nationality = $request->nationality;
                    $_cus_g->state_of_origin = $request->state_of_origin;
                    $_cus_g->local_government = $request->local_government;
                    $_cus_g->save();

                    static::updateRegStatus($request->customer_id,'guarantor');

                    $request->session()->put('customer_guarantor_registration_id', $_cus_g->id);
                    
                    AdminHelper::audit_trail('customer','Customer guarantor created',$_cus_g->id);
                }else{
                    //Update Customer guarantor Information
                    Customer_guarantors::where('customer_id',$customer_exist_id)
                            ->update([
                                     'first_name' => $request->first_name,
                                     'last_name' => $request->last_name,
                                     'other_name' => $request->other_name, 
                                     'relationship' => $request->relationship,
                                     'email' => $request->email, 
                                     'phone_number' => $request->phone_number,
                                     'employment_status' => $request->employment_status,
                                     'age' => $request->age,
                                     'monthly_income' => $request->monthly_income,
                                     'occupation' => $request->occupation,
                                     'home_address' => $request->home_address,
                                     'office_address' => $request->office_address,
                                     'religion' => $request->religion,
                                     'religion_address' => $request->religion_address,
                                     'religion_center_name' => $request->religion_center_name,
                                     'nationality' => $request->nationality,
                                     'state_of_origin' => $request->state_of_origin,
                                     'local_government' => $request->local_government
                                    ]);
                                
                                AdminHelper::audit_trail('customer','Customer guarantor updated during registration',$customer_exist_id);
                
                }

                 Session::flash('successMessage', "Customer guarantor created successful");
                return redirect('customer/create/loan');

        }catch (Exception $e) {
           return back();
       }
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createLoan(Request $request)
    {
        try{

            $products = Product::all();
            $customer_exist_id = $request->session()->get('customer_registration_id');
            $customer = Customer::where('id',$customer_exist_id)->first();
            $loan = Loan::where('customer_id',$customer_exist_id)->first();

            if(empty($customer_exist_id)){
                return redirect('customer/create');
            }

            return view('admin.customer.create.loan',compact('branches','products','loan','customer'));

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
    public function storeLoan(Request $request)
    {

            try{

                $customer_exist_id = $request->session()->get('customer_registration_id');
                //Check if customer loan exist
                $customer = Loan::where('customer_id',$customer_exist_id)->first();
                
                $productInfo = Product::where('id',$request->product_id)->first();
                        
                $request->merge([ 
                    'repayment_instrument' => implode(',', (array) $request->repayment_instrument)
                ]);

                if($customer == null && !empty($request->session()->get('customer_registration_id'))){
                    //Store Customer Loan
                    $_loan = new Loan();
                    $_loan->user_id = Auth::user()->id;
                    $_loan->loan_officer_id = $request->loan_officer_id;
                    $_loan->customer_id = $request->customer_id;
                    $_loan->branch_id = $request->branch_id;
                    $_loan->product_id = $request->product_id;
                    $_loan->principal = $request->principal;
                    $_loan->status = $request->status; 

                    $_loan->repayment_method = $productInfo->repayment_method;
                    $_loan->loan_duration = $productInfo->loan_duration;
                    $_loan->loan_duration_lenght = $productInfo->loan_duration_lenght;
                    $_loan->interest_rate = $productInfo->interest_rate;
                    $_loan->repayment_instrument = $request->repayment_instrument; 

                    $_loan->disburesment_bank_name = $request->disburesment_bank_name;
                    $_loan->account_name = $request->account_name;
                    $_loan->acount_number = $request->acount_number;
                    

                    $_loan->confirmation_status = 1;
                    $_loan->loan_purpose = $request->loan_purpose;
                    $_loan->save();

                    static::updateRegStatus($request->customer_id,'loan');

                    $request->session()->put('customer_loan_registration_id', $_loan->id);
                    
                    AdminHelper::audit_trail('customer','Customer Loan created',$_loan->id);
                    AdminHelper::audit_trail('loan','Loan created',$_loan->id);
                }else{
                    //Update Customer loan Information
                    Loan::where('customer_id',$customer_exist_id)
                            ->update([
                                     'loan_officer_id' => $request->loan_officer_id,
                                     'branch_id' => $request->branch_id,
                                     'product_id' => $request->product_id, 
                                     'principal' => $request->principal,
                                     'status' => $request->status,
                                     'repayment_instrument' => $request->repayment_instrument, 
                                     'repayment_method' => $productInfo->repayment_method,
                                     'loan_duration' => $productInfo->loan_duration,
                                     'loan_duration_lenght' => $productInfo->loan_duration_lenght,
                                     'interest_rate' => $productInfo->interest_rate,
                                     'disburesment_bank_name' => $request->disburesment_bank_name,
                                     'account_name' => $request->account_name,
                                     'acount_number' => $request->acount_number,
                                     'loan_purpose' => $request->loan_purpose
                                    ]);
                                
                                AdminHelper::audit_trail('customer','Customer Loan updated during registration',$customer_exist_id);
                                AdminHelper::audit_trail('loan','Loan updated during registration',$customer_exist_id);
                
                }
                 Session::flash('successMessage', "Loan information created successful");
                return redirect('customer/create/file');

        }catch (Exception $e) {
           return back();
       }
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFile(Request $request)
    {
        try{

            $customer_exist_id = $request->session()->get('customer_registration_id');
            
                
            if(empty($customer_exist_id)){
                return redirect('customer/create');
            }

            $employment = CustomerEmployment::where('customer_id',$customer_exist_id)->first();
            return view('admin.customer.create.file', compact('employment'));

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
    public function storeFile(Request $request)
    {
       

            try{

                $customer_exist_id = $request->session()->get('customer_registration_id');
                
                //Check if customer employment exist
                $check = CustomerEmployment::where('customer_id',$customer_exist_id)->first();
               
                if($check == null){
                    Session::flash('successMessage', "Your session has expired......");
                    return redirect('customer/create');
                }else{
                    //Update Customer employemnt files
                    $_cus = CustomerEmployment::where('customer_id',$customer_exist_id)->first();
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
                    $path_old_card = "customerfiles/files/".$request->old_bank_statement;  
                        if(File::exists($path_old_card)) {
                            File::delete($path_old_card);
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

                    $the_cheque = '';
                    if($request->hasFile('cheque')){
                    $the_cheque = time().'utl.'.request()->cheque->getClientOriginalExtension();
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
                    $_cus->save();

                    static::updateRegStatus($request->customer_id,'complete');
    
                    AdminHelper::audit_trail('customer','Employment information updated during registration, files saved',$_cus->id);
                    
                
                }
                $request->session()->forget('customer_registration_id');
                $request->session()->forget('customer_employment_registration_id');
                $request->session()->forget('customer_guarantor_registration_id');
                $request->session()->forget('customer_loan_registration_id');

                 Session::flash('successMessage', "Customer created successful");
                return redirect('customer/create');

        }catch (Exception $e) {
           return back();
       }
    
    }

    public static function updateRegStatus($cus_id,$status)
    {
        Customer::where('id',$cus_id)->update(['registration_step_status' => $status]);
        return true;
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
