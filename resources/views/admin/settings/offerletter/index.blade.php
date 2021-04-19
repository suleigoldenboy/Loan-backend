@extends('layouts.admin-app')
@section('content')
<?php

function get_words($sentence, $count = 10) {
  preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
  return $matches[0];
}

?>
 <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="widget widget-table-three">
                             <div class="heading-elements text-align-right">
                                <a href="{{ url('admin/create/offer-letter') }}"
                                class="btn btn-info btn-sm">Create New Letter</a>
                            </div>
                            <div class="widget-heading">
                                <h5 class=""></h5>
                            </div>

                            <div class="widget-content">
                                <div class="table-responsive">
                                    <table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="multi-column-ordering_info">
                                        <thead>
                                            <tr>
                                                <th><div class="th-content">Product Name</div></th>
                                                <th><div class="th-content th-heading">Letter</div></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @foreach ($data as $letter)
                                             <tr>
                                                <td>@if(gettype($letter->product) == 'object'){{$letter->product->name}}@else NO Name for this Product @endif</td>
                                                <td>
                                    {{get_words($letter->letter, $count = 10)}}
            <a class="dropdown-item text-info" href="{{url('admin/show/offer-letter',$letter->id)}}">Full View</a>
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1" style="will-change: transform;">
                                                            <a class="dropdown-item text-info" href="{{url('admin/edit/offer-letter',$letter->id)}}">Edit</a>
                                                            {{-- <a class="dropdown-item text-warning" href="{{url('loan/confirmation-process/delete',$letter->id)}}">Delete</a> --}}
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
