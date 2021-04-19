@extends('layouts.admin-app')
@section('content')
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
                 @if(Session('successMessage'))
                              <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons" style="color: #FFF;">X</i>
                              </button>
                              <span>
                                <label>{{Session('successMessage')}} </label></span>
                            </div>
                         @endif
                         @if(Session('errorMessage'))
                              <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons" style="color: #FFF;">X</i>
                              </button>
                              <span>
                                <label>{{Session('errorMessage')}} </label></span>
                            </div>
                         @endif
                         
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three" style="padding:10px;">
                              @if(can('Create Confirmation Process'))
                                <div class="heading-elements text-align-right">
                                    <a href="{{ url('accountofficers') }}"
                                    class="btn btn-info btn-sm">View Account Officers</a>
                                </div>
                               @endif 
                            <div class="widget-heading"> 
                                <h3 class="text-center text-primary">Edit Account Officer</h3>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <div class="row">
                                  <div class="col-md-2">
                                    
                                  </div>
                                  <div class="col-md-6">
                                 
                                    <form method="POST" action="{{ URL('update/accountofficer') }}">
                                        {{ csrf_field() }}
                                    <div class="row">
                                      <div class="col-md-10 form-group">
                                        <label class="input_label">Account Office Name*</label>
                                         <input type="hidden" name="employee_id" value="{{$accountOfficer->employee_id}}">
                                         <input type="type" value="{{getFullEmployerName($accountOfficer->employee_id)}}" class="form-control1"  readonly required>
                                      </div>
                                      <div class="row">
                                        <label class="input_label" style="width: 100%;">Select Branch Control*</label>
                                      </div>
                                      <div class="row" style="padding: 25px;">
                                        @foreach($allBranches as $branch)
                
                                         @if(str_contains($accountOfficer->branch, $branch->id))  
                                            <div class="col-md-6">
                                              <input id="branch_{{$branch->id}}" type="checkbox" name="branch[]" value="{{$branch->id}}" checked="true">
                                                <label for="branch_{{$branch->id}}">
                                                           {{$branch->state}}-{{$branch->title}}
                                              </label>
                                          </div>
                                         @else
                                           <div class="col-md-6">
                                              <input id="branch_{{$branch->id}}" type="checkbox" name="branch[]" value="{{$branch->id}}">
                                                <label for="branch_{{$branch->id}}">
                                                           {{$branch->state}}-{{$branch->title}}
                                              </label>
                                          </div>
                                         @endif
                                        
                                      @endforeach
                                      </div>
                                      <div class="row">
                                        <button type="submit" class="btn btn-success btn-block new-btn">
                                            Update
                                        </button>
                                      </div>
                                  </div>
                                </div>
                                                        
                              </form>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
  <div>
<div>
@endsection
