<?php

namespace App\User\Loan;

use App\Models\Loan\Loan;
use App\Models\HRManagement\Employee;
use Illuminate\Database\Eloquent\Model;

class LoanManagerRelationship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['loan_id', 'loan_manager_id'];
    protected $table = 'loan_manager__relationships';
    public function loan_manager()
    {
        return $this->belongsToMany(Employee::class, 'loan_manager_id');
    }

    public function loan()
    {
        return $this->belongsToMany(Loan::class, 'loan_id');
    }

    public function customer()
    {
        return $this->loan()->get()->customer();
    }
}
