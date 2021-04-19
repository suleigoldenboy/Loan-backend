<?php

namespace App\User\Guarantors;

use Illuminate\Database\Eloquent\Model;
use App\Events\Customer\GuarantorRegistration;

class CustomerGuarantor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'title', 'first_name', 'last_name', 'other_name', 'relationship', 'email', 'phone_number', 'occupation', 'home_address', 'office_address', 'religion', 'nationality', 'state_of_origin', 'local_government',
    ];

    public function customer()
    {
        return $this->belongsTo('App\User\Customer\Customer', 'customer');
    }

    /**
     * Dispatch event base on eloquent event
     */
    protected $dispatchesEvents = [
        'created' => GuarantorRegistration::class
    ];
}
