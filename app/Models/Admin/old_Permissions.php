<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = "user_permissions";
    protected $guarded = ['id'];
    public $timestamps = false;


    public function logs()
    {
         return $this->hasMany('App\Models\AuditTrail','action_id','id')->where('type', 'privilege');
    }
}
