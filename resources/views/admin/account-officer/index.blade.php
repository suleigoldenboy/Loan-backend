@extends('layouts.admin-app')
@section('content')
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three" style="padding:10px;">
                              @if(can('Create Confirmation Process'))
                                <div class="heading-elements text-align-right">
                                    <a href="{{ url('add/accountofficer') }}"
                                    class="btn btn-info btn-sm">Add New Account Officer</a>
                                </div>
                               @endif 
                            <div class="widget-heading"> 
                                <h3 class="text-center text-primary">Account Officers</h3>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="multi-column-ordering_info">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">S/N</div></th>
                                                <th><div class="th-content th-heading">Name</div></th>
                                                <th><div class="th-content th-heading">Branch Control</div></th>
                                                <th><div class="th-content th-heading">Created By</div></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php $count = 1; ?>
                                          @forelse($accountOfficer as $record)
                                            <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{getFullEmployerName($record->employee_id)}}</td>
                                              <td>
                                                  
                                                  <?php $variableAry=explode(",",$record->branch); ?>
                                                  
                                                 @foreach($allBranches as $branch)
                                                   
                                                    @foreach($variableAry as $var)
                                                        @if($branch->id == $var)
                                                             {{$branch->state}}-{{$branch->title}} 
                                                             <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check" style="color: green;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                             
                                                             <br>
                                                        @endif
                                                   @endforeach
                                                   
                                                 @endforeach
                                                 
                                                 
                                              </td>
                                              <td>
                                                {{getFullEmployerName($record->created_by)}}
                                                 <br>
                                                 {{convertDateToString($record->created_at)}}
                                              </td>
                                              <td>
                                                <a href="{{ url('edit/accountofficer/'.$record->id) }}" title="edit" class="badge badge-secondary" >
                                                  <i class="fa fa-pencil"></i> Edit
                                                </a>
                                                 <a href="#" class="badge badge-danger" onClick="setID({{$record->id}});" data-toggle="modal" data-target="#myModaldelete">   
                                                   delete
                                                </a>
                                              </td>
                                            </tr>
                                         @empty
                                            <label class="text-primary">No Record.....</label>
                                        @endforelse
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
  <div>
<div>
      <!-- Modal -->
                                                    <div class="modal fade" id="myModaldelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel"></h4>
                                                                </div>
                                                                 <form  action="{{ url('delete/accountofficer') }}" method="POST">
                        
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" id="the_id" name="id" value="">
                                                                <div class="modal-body">
                                                                    <h3 style="color: #F00;">Are you sure you want to delete?</h3>
                                                                </div>
                                                                <div class="modal-footer">
                                                                  <label id="YesConfirmAccountMessage" style="color: #F00;"></label>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" id="YesConfirmAccount" class="btn btn-success">Yes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
<script>
    function setID(id){
        document.getElementById('the_id').value = id;
    }
</script>
@endsection
