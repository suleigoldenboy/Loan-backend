@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <!-- Start General Information-->
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <h1 class="text-info">Customer Credit Score</h1>
            <div id="general-info" class="section general-info">
             
                
               @if (ltrim(strstr($file, '.'), '.') == "pdf")

                                        <iframe src="{{ asset('customerfiles/files')}}/{{$file}}" style="width:100%;height:700px;"></iframe>
                                                                                                     @else
                                                                                                     <img src="{{ asset('customerfiles/files')}}/{{$file}}" class="img-responsive" style="width:100%;">                                  @endif
            </div>
        </div>
    </div>
</div>
@endsection
