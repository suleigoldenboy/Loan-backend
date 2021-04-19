<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CheckPermission extends Model
{
    protected $table = "permissions";
    protected $guarded = ['id'];
    public $timestamps = false;
}
