<?php

namespace App\User\BankDetails;

use Illuminate\Database\Eloquent\Model;

class CustomerBankDetails extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id','bank_list_id','bank_account_name','bank_account_number','is_verified_bank_account',];

    public function customer()
    {
        return $this->belongsTo('App\User\Customer');
    }
}
