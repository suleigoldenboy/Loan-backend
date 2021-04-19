<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class ConfirmationProcessByAmountSettings extends Model
{
    protected $table = "confirmation_process_by_amount_settings";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Models\HRManagement\Employee','id', 'user_id');
    }
}
