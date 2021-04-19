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

                           <div class="row">
                                 <div class="col-md-12">
                                  <div class="modal-body" style="background-color:#FFF;">
                                     <p class="modal-text">
                                     {!!nl2br($letter->letter)!!}
                                     </p>
                                  </div>
                                 </div>
                           </div>
                        </div>
                    </div>
  <div>
<div>
@endsection
