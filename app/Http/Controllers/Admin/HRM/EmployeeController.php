<?php

namespace App\Http\Controllers\Admin\HRM;

use App\Models\Admin\Branch;
use Illuminate\Http\Request;
use App\Models\Admin\Department;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\HRManagement\Employee;
use App\Models\HRManagement\Designation;
use App\Models\HRManagement\EmployeeContact;
use App\Http\Requests\Web\Admin\EmployeeRequest;
use App\Models\HRManagement\EmployeeSalary;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get()->load('department')->load('branch')->load('designation');
        return view('admin.employee.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create', [
            'branches' => Branch::get(),
            'formFields' => employeeFormFields()['formFields'],
            'departments' => Department::get(),
            'employee_code' => generateEmpCode(),
            'designations' => Designation::get(),
            'contactFormFields' => employeeFormFields()['contactFormFields'],
            'salaryFormFields' => employeeFormFields()['salaryFormFields'],
            'banks' => getBanks(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Employee $employees, EmployeeRequest $request)
    {
        try {
            $employee = $employees->create(
                array_merge($request->all(), ['password' => Hash::make($request->password)]));
            EmployeeContact::create(
                array_merge($request->all(), ['employee_id' => $employee->id])
            );
            EmployeeSalary::create(
                array_merge($request->all(), ['employee_id' => $employee->id])
            );
            return appRedirect([], 'employee.index', ['successMessage', message('response.employee.create')], $request);
        } catch (\Throwable $th) {
            $error = $th->getMessage();
            $request->session()->flash('errorMessage', $error.message('response.error500'));
            return redirect()->route('employee.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $employee = getDataFromHash($id, new Employee())
                    ->load('salary')
                    ->load('branch')
                    ->load('department')
                    ->load('designation')
                    ->load('employee_contact');
        return view('admin.employee.show',['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
