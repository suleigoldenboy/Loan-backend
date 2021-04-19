@extends('layouts.admin-app')

@section('content')

<div class="panel panel-white">
   
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
       
        <div class="widget-content widget-content-area br-6 layout-spacing" style="margin-top:30px;">
            <div class="card-body text-left layout-spacing">
                <div class="widget-header">
                    <h4>General Ledger Report Settings</h4>
                </div>
            </div>
             <div class="card-body text-right layout-spacing">
             <a type="button" class="btn btn-warning mb-2 mr-2" href="{{url('account/create-glreportsettings')}}">
                Create
            </a>
         </div>
                                  
              
        <div class="row">

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="ac_chart">
          
          <div class="col-sm-1">
           
          </div>
            <div class="widget-content widget-content-area">
                <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                    <thead style="font-size:9px;">
                        <tr>
                            <th width="90">S/N</th>
                            <th width="90">Action Name</th>
                            <th>Reporting</th>
                            <th>Created By</th>
                        </tr>
                    </thead>
                     @if($data)
                        @foreach ($data as $rec)
                            <tr>
                            <td width="90">{{$loop->iteration}}</td>
                            <td width="90">{{$rec->action_name}}</td>
                            <td>
                            <?php $get_result = json_decode($rec->actions, true); ?>
                             @foreach($get_result as $value) 
                              
                                <b>
                                    @if ($value['action_type'] == "cr")
                                        <label class="text-success">Credit</label>
                                    @elseif ($value['action_type'] == "dr")
                                        <label class="text-danger">Debit</label>
                                    @endif
                                    {{$value['code']}}-
                                    {{get_chart_of_account_name($value['id'])}}
                                   
                                </b><br>
                            @endforeach
                           
                            </td>
                            <td>
                            {{$rec->user->first_name}}
                            {{$rec->user->last_name}}
                            <br>
                            {{convertDateToStringWithTime($rec->created_at)}}
                            </td>
                        </tr>
                        @endforeach
                     @endif
                    <tbody>
               
                </table>
            </div>
        </div>
      </div>
          
        </div>

        </div>
    </div>
</div>
@endsection
