@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        
       <div class="widget-content widget-content-area br-6">
                            <table id="html5-extension" class="table table-hover non-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="html5-extension_info">
                                    <thead>
                                        <tr role="row">
                                        <th>Customer Name</th>
                                        <th>Card Type</th>
                                        <th>Getway</th>
                                        <th>First 6</th>
                                        <th>Last 4</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                       @foreach($datas as $data)
                                
                                       <tr role="row">
                                        <td>{{getFullCustomerName($data->customer_id)}}</td>
                                        <td>{{$data->card_type}}</td>
                                        <td>{{$data->gateway}}</td>
                                        <td>{{$data->bin}}</td>
                                        <td>{{$data->last4}}</td>
                                       </tr>
                                      @endforeach
                                      
                                   </tbody>
                                
                                </table>
                                
                            </div>


    </div>
</div>
@endsection
