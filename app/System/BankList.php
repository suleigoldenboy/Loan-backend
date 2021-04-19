<?php

namespace App\System;

use Illuminate\Database\Eloquent\Model;

class BankList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['bank_name', 'bank_code', 'long_code'];
}
