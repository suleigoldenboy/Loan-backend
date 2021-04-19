<?php

namespace App\User\Customer\Repayment;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;

class CardInstrument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'reference_code', 'authorization_code', 'card_type', 'last4', 'exp_month', 'exp_year', 'bin', 'bank', 'reusable', 'signature', 'channel', 'gateway'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
