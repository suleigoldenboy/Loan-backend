<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Model;

class AccountsSummeryDetail extends Model
{
    protected $table = "accounts_summery_details";
    protected $guarded = ['id'];
    public $timestamps = false;
}
