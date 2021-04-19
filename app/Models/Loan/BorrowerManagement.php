<?php

namespace App\Models\Loan;

use Illuminate\Database\Eloquent\Model;

class BorrowerManagement extends Model
{
    protected $table = "borrower_management";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function employee() 
    {
        return $this->hasOne('App\Models\HRManagement\Employee', 'id', 'loan_officer_id');
    }

    public function loan() 
    {
        return $this->hasOne('App\Models\Loan\Loan', 'id', 'loan_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Loan\Product', 'id', 1);
    }
}
