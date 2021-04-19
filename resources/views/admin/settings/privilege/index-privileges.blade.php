@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                  <div class="heading-elements text-align-right">
                                            <a href="{{ url('admin/add/privilege') }}"
                                              class="btn btn-info btn-sm">Add New Role</a>
                                        </div>
                                    <div class="row">
                                    <div class="btn-group">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>User Permission</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-4">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @if($privileges)
                                                    @foreach($privileges as $pre)
                                                    <tr class="odd gradeX">
                                                    <td><h4>{{ $pre->name }}</h4></td>
                                                    <td>
                                                    {{-- @if(strstr(Auth::user()->privileges, "roleprivilege_VIEW")) --}}
                                                      <a href="{{ url('admin/edit/privilege/'.$pre->id) }}" title="edit" class="btn btn-primary btn-xs">
                                                        <i class="fa fa-pencil"></i> Edit
                                                      </a>
                                                    </td>
                                                    </tr>
                                                      @endforeach

                                                      
                                                  @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    

                                </div>
                            </div>
                        </div>
    </div>
</div>
@endsection
