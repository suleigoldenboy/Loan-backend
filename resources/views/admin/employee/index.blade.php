@extends('layouts.admin-app')

@section('content')

<div class="panel panel-white">
    <div class="container">
        <div class="row layout-top-spacing mb4">
            <div class="col-lg-12 col-12 layout-spacing">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-link active" href="{{ route('employee.create') }}">Create New Employee</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%; overflow:auto" role="grid" aria-describedby="html5-extension_info">
                <thead>
                    <tr role="row">
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Employee Code</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Department</th>
                        <th>Branch</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr role="row">
                                <td class="sorting_{{$employee->id}}">
                                    {{$loop->iteration}}
                                </td>
                                <td class="sorting_{{$employee->id}}">
                                    {{$employee->first_name}} {{ $employee->other_name }} {{ $employee->last_name}}
                                </td>
                                <td>
                                    {{$employee->employee_code}}
                                </td>
                                <td>
                                    {{ $employee->email }}
                                </td>
                                <td>
                                    {{ $employee->phone_number }}
                                </td>
                                <td>
                                    {{  $employee->department->title }}
                                </td>
                                <td>
                                    {{  $employee->branch->title }}
                                </td>
                                <td>
                                    {{  $employee->designation->title }}
                                </td>
                                <td>
                                    <div class="dropdown custom-dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink6" style="will-change: transform;">
                                            <!--<a class="dropdown-item" href="{{ route('employee.show', hashId($employee->id))}}">View</a>-->
                                            <!--<a class="dropdown-item" href="{{route('employee.edit', hashId($employee->id))}}">Edit</a>-->
                                        </div>
                                    </div>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
