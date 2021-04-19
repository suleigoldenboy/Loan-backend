<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
    protected $table = "customer_next_of_kin";
    protected $guarded = ['id'];
    public $timestamps = false;
}
