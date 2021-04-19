<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class ChargeManager extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'charge_in_percent', 'description'];
}
