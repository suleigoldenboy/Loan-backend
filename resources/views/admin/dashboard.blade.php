@extends('layouts.admin-app')

@section('content')

    @if(Auth::user()->role_id == 5)
        @include('admin.admin-dashboard')
    @else
        @include('admin.other-dashboard')
    @endif
    
@endsection