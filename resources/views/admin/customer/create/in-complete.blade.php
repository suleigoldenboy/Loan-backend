@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        
       <div class="widget-content widget-content-area br-6">
           <h4 class="text-info">Saved Application</h4>
                            <table id="" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                                    <thead>
                                        <tr role="row">
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                @foreach($data as $customer)
                                        <tr role="row">
                                            <td class="sorting_{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}} {{$customer->other_name}}</td>
                                            <td><span class="badge badge-info"> {{$customer->registration_step_status}} </span></td>
                                            <td><a href="{{url('customer/registration/continue',[$customer->id,$customer->registration_step_status])}}" class="btn btn-primary mb-4 mr-2 btn-sm">Continue</td>
                                        </tr>
                                        @endforeach
                                      
                                        </tbody>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                </table>
                                
                            </div>


    </div>
</div>
@endsection
