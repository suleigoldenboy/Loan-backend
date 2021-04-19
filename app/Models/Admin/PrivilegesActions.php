<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PrivilegesActions extends Model
{
    protected $table = "privileges_actions";
    protected $guarded = ['id'];
    public $timestamps = false;
}
