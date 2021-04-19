<?php

namespace App\User\Auth;

use Illuminate\Database\Eloquent\Model;

class VerificationToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id', 'token', 'validated_at', 'validated'];

    public function customer()
    {
        return $this->belongsTo('App\User\Customer\Customer', 'customer_id');
    }

    public function getUserByToken(Int $token):object
    {
        return $this->where('token', $token)->first()->customer;
    }
}
