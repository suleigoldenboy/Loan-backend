<?php

namespace App\Models\Loan;

use App\User\Customer\Customer;
use App\Models\Loan\Loan_Repayment;
use App\User\CustomerLoan\Traits\LoanTrait;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use LoanTrait;
    protected $table = "loans";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function recovery(){
        return $this->hasOne(Loan_Repayment::class, 'loan_id', 'id');
    }
    
    public function paymentTrail(){
        // return $this->hasMany(Loan_Repayment::class, 'loan_id', 'id');
    }
    
    public function customer() 
    {
        return $this->hasOne('App\Models\Customer\Customer', 'id', 'customer_id');
    }
    public function createdBy()
    {
        return $this->hasOne('App\Models\HRManagement\Employee', 'id', 'user_id');
    }
    public function product()
    {
        return $this->hasOne('App\Models\Loan\Product', 'id', 'product_id');
    }
    public function branch()
    { 
        return $this->hasOne('App\Models\Admin\Branch', 'id', 'branch_id');
    }
    public function loan_officer()
    {
        return $this->hasOne('App\Models\HRManagement\Employee', 'id', 'loan_officer_id');
    }
    public function loan_disbursed_by() 
    {
        return $this->hasOne('App\Models\HRManagement\Employee', 'id', 'loan_disbursed_by_id');
    }
    public function loan_disbursed_payment_by() 
    {
        return $this->hasOne('App\Models\HRManagement\Employee', 'id', 'loan_disbursed_payment_by_id');
    }
    public function confirmation_stage()
    {
        return $this->hasOne('App\Models\Settings\LoanConfirmationProcess','process', 'confirmation_status');
    }

    public function cus_gurantors()
    {    
        return $this->hasMany('App\Models\Customer\Customer_guarantors', 'customer_id', 'customer_id')->orderBy('id','DESC');
        
    }
     public function offerLetter()
    { 
        return $this->hasOne('App\Models\Loan\TheLoanOfferLetter', 'loan_id', 'id');
    }

    public function audit_trial()
    {    
        return $this->hasMany('App\Models\AuditTrail', 'action_id','id')->where('type','loan')->orWhere('type','customer')->orderBy('id','DESC');
    }

    public function loan_comments()
    {    
        return $this->hasMany('App\Models\Loan\Loan_Comment', 'loan_id', 'id')->orderBy('id','DESC');
        
    }
    
    public function customer_verification()
    
    {    
        return $this->hasOne('App\Models\Customer\CustomerVerification', 'customer_id', 'customer_id');
        
    }
}
