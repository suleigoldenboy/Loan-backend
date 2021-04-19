<?php

namespace App\User\Verification;

use Illuminate\Database\Eloquent\Model;

class CustomerVerification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'given_id_card', 'given_bank_statement', 'given_utility_bill', 'given_others', 'id_card_type', 'id_card_issued', 'id_card_expire', 'bvn', 'documents'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'documents' => 'json',
    ];

    public function customer()
    {
        return $this->belongsTo('App\User\Customer\Customer', 'customer_id');
    }

}
