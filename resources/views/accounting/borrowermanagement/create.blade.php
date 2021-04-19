@extends('layouts.admin-app')
@section('content')
<div class="container">

        <div class="row" style="margin-top:20px;">
            
            <div class="col-lg-12 col-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Create New Borrower</h4>
                            </div>
                        </div>
                </div>
                                    
        <div class="widget-content widget-content-area">
            <form action="{{url('borrower/create/next')}}" method="GET" id="actionForm">
            {{csrf_field()}}
            <div class="form-row mb-4">
                    <div class="col">
                        Loan Officer
                         <select name="loan_officer_id" class="form-control  basic" required>
                            @foreach ($loan_officers as $emp)
                                <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}} {{$emp->other_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                         Loan ID
                        <input type="number" name="loan_id" class="form-control  basic" placeholder="Loan ID" required>
                    </div>
                </div>
                 
            <button class="btn btn-primary">Next</button>

            </form>
            </div>
            </div>
        </div>
    </div>
        
  
</div>

@endsection
