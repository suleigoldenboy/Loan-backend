<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = "audit_trails";
    protected $guarded = ['id'];
   //public $timestamps = false;



    public function users()
    {
        return $this->belongsTo('App\Models\Employee\User','user_id','id');
    }

}
