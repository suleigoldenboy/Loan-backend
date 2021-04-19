@extends('layouts.admin-app')
@section('content')
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three" style="padding:10px;">
                              @if(can('Create Confirmation Process'))
                                <div class="heading-elements text-align-right">
                                    <a href="{{ url('loan/confirmation-process/create') }}"
                                    class="btn btn-info btn-sm">Add New Process</a>
                                </div>
                               @endif 
                            <div class="widget-heading"> 
                                <h4 class="text-center">Loan Confirmation Process</h4>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="multi-column-ordering_info">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">Name</div></th>
                                                <th><div class="th-content th-heading">Proccess</div></th>
                                                <th><div class="th-content th-heading">Title</div></th>
                                                <th><div class="th-content th-heading">Amount</div></th>
                                                <!--<th><div class="th-content th-heading">Description</div></th>-->
                                                {{-- <th><div class="th-content">Department/Branch</div></th> --}}
                                                <th><div class="th-content">Privileges</div></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @foreach ($proccesses as $user)
                                             <tr>
                                                <td>
                                                 @if($user->user)
                                                  {{$user->user->first_name}}
                                                  {{$user->user->last_name}}
                                                  {{$user->user->other_name}}
                                                @endif
                                                </td>
                                                <td class="text-center"><span class="badge badge-info">{{$user->process}}</span></td>
                                                <td>{{$user->title}}</td>
                                                <td>
                                                    {{get_confirmation_by_amount_settings($user->process)}}
                                                </td>
                                                <!--<td>{{$user->name}}</td>-->
                                                {{-- <td></td> --}}
                                                <td>
                                                
                                                <?php

                                                $variableAry=explode(",",$user->privilege); 
                                                foreach($variableAry as $var){

                                                echo '<span class="badge badge-danger" style="margin-top:4px;">'.$var.'</span>&nbsp;&nbsp;';

                                                }

                                                ?>
                                                
                                                
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                                         @if(can('Update Confirmation Process'))
                                                            <a class="dropdown-item text-info" href="{{url('loan/confirmation-process',$user->id)}}">Edit</a>
                                                        @endif
                                                        @if(can('Delete Confirmation Process'))
                                                            <a class="dropdown-item text-warning" href="{{url('loan/confirmation-process/delete',$user->id)}}">Delete</a>
                                                        @endif
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
                    </div>
  <div>
<div>
@endsection
