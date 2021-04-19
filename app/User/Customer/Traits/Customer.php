<?php
/**
 * This Traits Link the Customer Models to it Relating Models
 */
namespace App\User\Customer\Traits;

use App\Models\Customer\CustomerEmployment;
use App\User\Verification\CustomerVerification;

trait Customer
{
    public function verification(){
        return $this->hasOne('App\User\Auth\VerificationToken');
    }

    public function incomeDetails()
    {
        return $this->hasMany('App\User\IncomeDetails\CustomerIncomeDetails');
    }

    public function loan()
    {
        return $this->hasMany('App\User\CustomerLoan\Loan');
    }

    public function guarantors()
    {
        return $this->hasMany('App\User\Guarantors\CustomerGuarantor');
    }

    public function bankDetails(){
        return $this->hasMany('App\User\BankDetails\CustomerBankDetails');
    }

    public function contactDetails(){
        return $this->hasMany('App\User\ContactDetails\CustomerContactDetails');
    }

    public function employment()
    {
        return $this->hasMany(CustomerEmployment::class, 'customer_id', 'id');
    }

    public function customerVerification(){
        return $this->hasMany(CustomerVerification::class, 'customer_id', 'id');
    }

    public function latestCustomerVerification(){
        return $this->hasOne(CustomerVerification::class)->latest();
    }
    public function sendApiEmailVerificationNotification(){

    }
}
