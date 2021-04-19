<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    protected $table = "privileges";
    protected $guarded = ['id'];
    public $timestamps = false;
}
