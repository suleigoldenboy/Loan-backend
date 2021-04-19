@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        
        <!--START Disburse DIV -->
         
         <div id="tableCheckbox" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Customer Contact</h4>
                                             <form action="" method="GET">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    
                                                
                                                <div class="col-sm-3">
                                                        <div class="form-group">
                                                        <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select Type</option>
                                    <option value="all">All</option>
                                    <option value="mobile">Mobile Number</option>
                                    <option value="email">Email</option>
                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <br><br>
                                                        <button class="mr-2 btn btn-primary  html">Search</button> 
                                                    </div>
                                                </div>
                                                </form>
                                                
                                        
                                        </div>                       
                                    </div>
                                </div>
                        <form method="POST" action="{{ URL('loan/loan/disburse/all/payment') }}" id="form_sample_1" class="form-horizontal"  enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        
                        <div class="widget-content widget-content-area br-6">
                                            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                                                <thead>
                                                <tr>
                                                    <th class="checkbox-column">
                    <label class="new-control new-checkbox checkbox-danger" style="height: 18px; margin: 0 auto;" title="Check All">
                    <input type="checkbox" class="new-control-input todochkbox" id="todoAll" checked="true">
                                                            <span class="new-control-indicator"></span>
                                                        </label>
                                                    </th>
                                        @if(Request::get('status') == "mobile" || Request::get('status') == "all")
                                            <th width="100"><b>Mobile</b></th>
                                        @endif
                                        
                                     @if(Request::get('status') == "email" || Request::get('status') == "all")
                                            <th width="100"><b>Email</b></th>
                                         @endif
                                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
@if(Request::get('status') == "mobile" || Request::get('status') == "email" || Request::get('status') == "all")    
                                               @foreach($data as $cus)
                                                <tr>
                                                     <td width="100">
        <label class="new-control new-checkbox checkbox-primary" style="height: 18px; margin: 0 auto;">
                                                            
                <input type="checkbox" id="account_disburse_{{$cus->id}}"class="new-control-input todochkbox" checked="true">
                                                            <span class="new-control-indicator"></span>
                                                        </label>
                                                </td>
                                         @if(Request::get('status') == "mobile" || Request::get('status') == "all")
                                                    <td width="100">{{$cus->phone_number}}</td>
                                        @endif
                                        
                                         @if(Request::get('status') == "email" || Request::get('status') == "all")
                                                    <td width="100">{{$cus->email}}</td>
                                        @endif
                                                    
                                                </tr>
                                               @endforeach
                                             
                                             @endif
                                            </tbody>
                                           
                                        </table>
                                
                            </div>
                                    
                                   


                                    </form>

                                   
                                </div>
                            </div>
                        </div>
         
        <!-- END Disburse DIV -->



    </div>
</div>


    </div>
</div>
@endsection
