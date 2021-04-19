@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                 
                                    
                         

                                    <div class="row">
                                        <div class="col-md-12">
                                        <h2 class="text-info center">
                                            Permission<br>
                                             @if ($errors->has('name'))
                                                <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                                <br>
                                            @endif
                                            <a class="btn btn-primary" data-toggle="modal" data-target="#addPermissionModal">Create New Permission</a>
                                            </h2>
                                        </div>          
                                        <div class="statbox widget box box-shadow layout-top-spacing">
                                        <div class="card-box">
                                            
                                            <div class="card-body">
                                            <div class="card-body">
                                            @foreach($permission as $pre)

                                                <div class="btn btn-outline-primary mb-2 layout-top-spacing">
                                                        <?php $check_val = strtolower($pre->name); ?>
                                                       @if(strpos($check_val, 'delete') !== false)
                                                            <label class="new-control new-checkbox checkbox-danger">
                                                        @elseif(strpos($check_val, 'create') !== false)
                                                            <label class="new-control new-checkbox checkbox-success">
                                                         @elseif(strpos($check_val, 'update') !== false)
                                                            <label class="new-control new-checkbox checkbox-success">
                                                        @elseif(strpos($check_val, 'view') !== false)
                                                            <label class="new-control new-checkbox checkbox-info">
                                                        @else
                                                            <label class="new-control new-checkbox checkbox-primary">
                                                        @endif
                                                      <input class="new-control-input"  id="{{$pre->id}}" type="checkbox" name="permissions[]" value="{{$pre->id}}">
                                                    <span class="new-control-indicator"></span>&nbsp;&nbsp;{{$pre->name}}
                                                    </label>
                                                </div>
                                                
                                            @endforeach

                                         </div>  
                                        </div>
                                        </div>
                                    </div>
                                    
                                    
                                    </div>
                                    

                                           
                                </div>
                            </div>
                        </div>
    </div>
</div>


<!--  Add  Permission -->
<div class="modal fade" id="addPermissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Permission</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/store/permission')}}" method="POST" id="actionForm">
                 {{csrf_field()}}
                <div class="form-row mb-4" >
                    <div class="col">
                         Permission Name
                         <input type="text" name="name" class="form-control" placeholder="Permission Name" required>
                    </div>
                </div>
<input type="submit" name="time" class="btn btn-primary">

            </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                
            </div>
        </div>
    </div>
</div>

<!-- End Add Permission -->
@endsection
