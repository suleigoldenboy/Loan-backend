<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class CheckLists extends Model
{
    protected $table = "check_lists";
    protected $guarded = ['id'];
    public $timestamps = false;    
}
