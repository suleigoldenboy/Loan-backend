<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;

class Customer_guarantors extends Model
{
    protected $table = "customer_guarantors";
    protected $guarded = ['id'];
    public $timestamps = false;
}
