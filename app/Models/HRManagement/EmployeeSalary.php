<?php

namespace App\Models\HRManagement;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gross','employee_id','salary_type','basic_salary','account_number','monthly_target','leave_allowance','other_allowance', 'smart_saver_date','beneficiary_bank','telephone_allowance','percentage_to_achieved','accommodation_allowance','transportation_allowance',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
