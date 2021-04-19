@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">
    <div class="container">
        <div class="container">
            <div class="row layout-top-spacing mb4">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-link btn-outline-success" href="{{route('designation.index')}}">Designation List</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Add Designation</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form action="{{ route('designation.store') }}" method="POST">
                                {{csrf_field()}}
                                <div class="widget-content widget-content-area mb-4">
                                    <div class="form-row mb-4">
                                        <div class="col">
                                            Designation Title
                                            <input type="text" class="form-control" name="title" placeholder="Loan Director" required />
                                        </div>
                                        <div class="col">
                                            Designation Description
                                            <input type="text" step="0.1" name="description" class="form-control" placeholder="JD is to direct loan affairs" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Save New Designation
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
