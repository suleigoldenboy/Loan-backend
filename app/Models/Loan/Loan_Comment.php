<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class Loan_Comment extends Model
{
    protected $table = "loan_comments";
    protected $guarded = ['id'];
    public $timestamps = false;
}
