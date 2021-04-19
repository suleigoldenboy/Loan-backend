<?php

namespace App\User\CustomerLoan;

use App\Models\Loan\Product;
use App\Events\AssignedManager;
use App\Models\Customer\Customer;
use App\Models\Loan\Loan_Repayment;
use App\User\Customer\Customer as ApiCustomer;
use App\User\CustomerLoan\Traits\LoanTrait;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use LoanTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'loan_officer_id', 'customer_request', 'customer_id', 'product_id', 'branch_id', 'release_date', 'maturity_date', 'customer_verification_id', 'interest_start_date', 'first_payment_date', 'loan_disbursed_by_id', 'principal', 'interest_method', 'interest_rate', 'repayment_method', 'files', 'note', 'status', 'confirmation_status', 'special_interest', 'balance','loan_duration', 'loan_duration_length', 'insurance_charge', 'processing_charge', 'status_paid', 'decline', 'decline_reason', 'disburesment_bank_name', 'account_name', 'repayment_instrument', 'acount_number', 'rejection_status','loan_disbursed_payment_by_id',
    ];

    protected $hidden = [
        'customer_request', 'confirmation_status', 'loan_disbursed_by_id', 'note', 'user_id', 'branch_id', 'product_id', 'special_interest', 'interest_method', 'repayment_method', 'files', 'decline_reason', 'loan_disbursed_payment_by_id', 'repayment_instrument', 'disburesment_bank_name', 'account_name', 'acount_number', 'first_payment_date', 'interest_start_date', 'customer_verification_id', 'loan_officer_id'
    ];
    /**
     * Dispatch event base on eloquent event
     */
    protected $dispatchesEvents = [
        // 'created' => AssignedManager::class
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function apiCustomer(){
        return $this->belongsTo(ApiCustomer::class, 'customer_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function loanRepayment(){
        return $this->hasMany(Loan_Repayment::class, 'loan_id', 'id');
    }

}
