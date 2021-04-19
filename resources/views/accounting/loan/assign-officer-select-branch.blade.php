@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">                
                    <br>
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                    <form action="{{url('loan/loan/assignofficer')}}" method="GET" id="actionForm">
                               
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                  
                              <!-- Start General Information-->
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="text-info">Select Branch</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                            <div class="form-group">
                                                                    <label for="profession">Branch</label> 
                                                                    
                                                                        <select name="branch_id" class="form-control  basic" required>
                                                                            
                                                                             <option value="">Select Branch</option>
                                                                            @foreach ($branches as $branch)
                                                                                <option value="{{$branch->id}}">{{$branch->state}} - {{$branch->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                   
                                                                </div>
                                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              <!-- End General Information-->


                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div id="errorMsg"></div>      
                                
                                 <button class="mr-2 btn btn-primary  html" id="submitBtn" style="float:right;">Next</button> 
                                   
                              </div>
                            
                            </div>
                        </div>
                        </form>
                    </div>

                  
                </div>

            </div>

@endsection
