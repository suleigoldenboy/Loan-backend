<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class Loan_Repayment extends Model
{
    protected $table = "loan_repayments";
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    //  */
    // protected $fillable = ['loan_id'];
}
