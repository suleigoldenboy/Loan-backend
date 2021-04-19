<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class LoanConfirmationProcess extends Model
{
    protected $table = "loan_confirmation_processes";
    protected $guarded = ['id'];
    public $timestamps = false;


    public function user()
    {
        return $this->hasOne('App\Models\HRManagement\Employee','id', 'user_id');
    }
}
