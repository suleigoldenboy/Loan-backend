<?php

namespace App\Models\HRManagement;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasRoles, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'other_name', 'username', 'email', 'gender', 'password', 'phone_number', 'religion', 'employee_code', 'marital_status', 'department_id', 'state', 'branch_id', 'designation_id', 'employment_type', 'joined_on', 'leaving_date', 'auditor_id'];
    const password = 'password';
    public function branch()
    {
        return $this->belongsTo('App\Models\Admin\Branch', 'branch_id');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Admin\Department', 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo('App\Models\HRManagement\Designation', 'designation_id');
    }

    public function auditor()
    {
        return $this->belongsTo('App\Models\HRManagement\Employee', 'id');
    }

    public function created_by()
    {
        return $this->where('id', $this->auditor_id)->first();
    }

    public function employee_contact()
    {
        return $this->hasMany('App\Models\HRManagement\EmployeeContact', 'employee_id', 'id');
    }

    public function salary()
    {
        return $this->hasOne('App\Models\HRManagement\EmployeeSalary', 'employee_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->{self::password} = Hash::make($model['password']);
        });
    }

    public static function recoveryOfficer()
    {
        $id = Designation::where('title', 'LIKE', 'Recovery Manager')->id;
        return self::where('designation_id', $id)->first();
    }
}
