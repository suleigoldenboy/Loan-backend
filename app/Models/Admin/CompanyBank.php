<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CompanyBank extends Model
{
    protected $table = "company_banks";
    protected $guarded = ['id'];
    public $timestamps = false;
}
