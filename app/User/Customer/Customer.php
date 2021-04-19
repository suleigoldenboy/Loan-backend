<?php

namespace App\User\Customer;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\User\Customer\Traits\Customer as CustomerRelationshipTrait;
use App\User\Customer\Traits\CustomerFunction;
use Illuminate\Auth\Events\Registered;

// use Illuminate\Auth\Events\CustomerRegistration;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, /*,*/ HasApiTokens, CustomerRelationshipTrait, CustomerFunction;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name','other_name',
        'username', 'email', 'password','branch_id',
        'phone_number', 'uuid', 'bvn_phone_number',
        'email_verified_at', 'bvn_verified', 'name_is_verified',
        'avatar', 'marital_status', 'religion',
        'date_of_birth', 'registration_step_status'
    ];
    /**
     * Dispatch event base on eloquent event
     */
    protected $dispatchesEvents = [
        'created' => Registered::class
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->phone;
    }
}
