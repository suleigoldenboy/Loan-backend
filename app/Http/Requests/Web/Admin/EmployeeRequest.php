<?php

namespace App\Http\Requests\Web\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|',
            'last_name' => 'required|',
            'other_name' => 'required|',
            'username' => 'required|unique:employees,username',
            'email' => 'required|unique:employees,email',
            'gender' => 'required|',
            'password' => 'required|',
            'phone_number' => 'required|unique:employees,phone_number',
            'religion' => 'required',
            'employee_code' => 'required',
            'marital_status' => 'required',
            'department_id' => 'required',
            'state_of_origin' => 'required',
            'branch_id' => 'required',
            'designation_id' => 'required',
            'employment_type' => 'required',
            'joined_on' => 'required',
            'leaving_date' => 'required',
            'auditor_id' => 'required',
        ];
    }
}
