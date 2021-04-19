<?php

namespace App\User\IncomeDetails;

use Illuminate\Database\Eloquent\Model;

class CustomerIncomeDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id','income','employment_status','occupation','business_name','employers_name','coworker_name','coworker_phone_number','business_state','business_city','business_lga','business_address','joined_date',
    ];

    public function customer()
    {
        return $this->belongsTo('App\User\Customer\Customer', 'customer_id');
    }
}
