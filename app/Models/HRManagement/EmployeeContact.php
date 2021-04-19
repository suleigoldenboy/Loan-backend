<?php

namespace App\Models\HRManagement;

use App\HRManagement\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'father_name','mother_name','local_government','state_of_origin','nationality','state_of_origin','present_address','permanent_address','employee_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
