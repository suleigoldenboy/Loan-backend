@extends('layouts.admin-app')

@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
         <div class="row layout-spacing">
                     <!-- start profile-->
                         @include('accounting.loan.details.profile-content')
                    <!-- end profile-->
                    <!-- start loan details-->
                        @include('accounting.loan.details.loandetails-content')
                    <!-- end loan details-->
       
        </div>
    </div>
</div>
@endsection
