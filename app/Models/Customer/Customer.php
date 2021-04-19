<?php

namespace App\Models\Customer;

use App\User\Customer\Repayment\CardInstrument;
use App\User\Customer\Traits\Customer as CustomerTrait;
use App\User\Customer\Traits\CustomerFunction;
use Illuminate\Database\Eloquent\Model;
// use
class Customer extends Model
{
    use CustomerTrait, CustomerFunction;
    protected $table = "customers";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function branch()
    {
        return $this->hasOne('App\Models\Admin\Branch', 'id', 'branch_id');
    }
    public function loan_officer()
    {
        return $this->hasOne('App\Models\Employee\User', 'id', 'loan_officer_id');
    }
    public function employment()
    {
        return $this->hasOne('App\Models\Customer\CustomerEmployment', 'customer_id', 'id');
    }
    public function loan()
    {
        return $this->hasMany('App\Models\Loan\Loan', 'customer_id','id');
    }
    public function cardInstrument(){
        return $this->hasMany(CardInstrument::class);
    }
}
