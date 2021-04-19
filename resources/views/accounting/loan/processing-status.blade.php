@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        
       <div class="widget-content widget-content-area br-6">
                            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                                    <thead>
                                        <tr role="row">
                                        <th>Customer Name</th>
                                        <th>Loan</th>
                                        <th>Amount</th>
                                        <th>Branch</th>
                                        <th>Status</th>
                                        <th>Offer Letter</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                @foreach($datas as $data)
                                
                                @if($data->customer->registration_step_status =="complete")
                                        <tr role="row">
                                            <td class="sorting_{{$data->id}}">
                                    {{$data->customer->first_name}} 
                                    {{$data->customer->other_name}} 
                                    {{$data->customer->last_name}}
                                            </td>
                                            <td>{{$data->product->name}}</td>
                                            <td>₦{{number_format($data->principal,2)}}</td>
                                            <td>
                            {{$data->branch->title}}-{{$data->branch->state}}
                                                </td>
                                            <td>
                                                 @if($data->confirmation_status == "decline")
                                            <span class="badge badge-danger"> 
                                                    Decline
                                                </span>
                                                 @else
                                               
                                            @if($data->confirmation_stage)
                                            
                                               <span class="badge badge-info"> {{$data->confirmation_stage->title}} 
                                               </span>
                                              @else
                                              
                                                @if($data->confirmation_status == "rejected")
                                              <span class="badge badge-danger">
                                                    Rejected
                                              </span>
                                               @else
                                               <span class="badge badge-danger"> 
                                                    Proccessing
                                              </span>
                                               @endif
                                               
                                              @endif
                                                
                                                @endif
                                            </td>
                                            <td>
                                                  @if(checkLetterStatus($data->id))
    
                                                        @if(checkLetterStatus($data->id) == "pending")
                                                             <span class="badge badge-danger"> Pending Approval </span>
                                                        @elseif(checkLetterStatus($data->id) == "active")
                                                             <span class="badge badge-success"> Accepted </span>
                                                        @endif
                                                        
                                                    @else
                    <span class="badge badge-secondary"> Waiting to send </span>
                                                   @endif
                                            </td>
                                            <td>
                                                {{-- <a href="{{url('customer/registration/continue',[$data->id,$data->registration_step_status])}}" class="btn btn-primary mb-4 mr-2 btn-sm">Continue --}}
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        @endforeach
                                      
                                        </tbody>
                                
                                
                                
                                
                                </table>
                                
                            </div>


    </div>
</div>
@endsection
