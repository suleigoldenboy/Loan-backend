<?php

namespace App\User\ContactDetails;

use Illuminate\Database\Eloquent\Model;
use App\User\ContactDetails\Traits\ContactTraits;

class CustomerContactDetails extends Model
{
    use ContactTraits;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'home_address',
        'other_phone_number',
        'office_phone_number',
        'state_of_origin',
        'local_government',
        'nationality',
    ];

}
