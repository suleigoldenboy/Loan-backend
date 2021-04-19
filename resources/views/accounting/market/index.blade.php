@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="layout-px-spacing"> 
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div id="general-info" class="section general-info">
                <div class="info">
                    <h6 class="text-info">Customer Search</h6>
                    <form action="{{url('loan/active')}}" method="POST">
                     {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control mb-4" name="customer_id" placeholder="Customer Code">
                                </div>
                            </div>
                            <!--<div class="col-sm-3">-->
                            <!--    <div class="form-group">-->
                            <!--         <input type="text" class="form-control mb-4" name="c_name" placeholder="First or Last Name">-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control mb-4" name="branch_id">
                                        <option value="">Select A Branch</option>
                                        @foreach($branches as $branch)
                                            <option value={{$branch->id}} >{{$branch->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                     <select class="form-control mb-4" name="product_id">
                                        <option value="">Select A Prouct</option>
                                        @foreach($products as $product)
                                            <option value={{$product->id}} >{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="date" class="form-control mb-4" name="date_start" placeholder="Date Start">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="date" class="form-control mb-4" name="date_end" placeholder="Date End">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button class="mr-2 btn btn-primary  html">Search</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="widget-content searchable-container list">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                    <form class="form-inline my-2 my-lg-0">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            <input wire:model="search"  type="text" class="form-control product-search" id="input-search" placeholder="Search By Prospect Name...">
                        </div>
                    </form>
                </div>

                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                    <div class="d-flex justify-content-sm-end justify-content-center">
                        
                        <div class="switch align-self-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list active-view"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid active-view"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="searchable-items grid">
                <div class="items items-header-section">
                    <div class="item-content">
                        <div class="">
                            <div class="n-chk align-self-center text-center">
                                <label class="new-control new-checkbox checkbox-primary">
                                <input type="checkbox" class="new-control-input" id="contact-check-all">
                                <span class="new-control-indicator"></span>
                                </label>
                            </div>
                            <h4>Name</h4>
                        </div>
                        <div class="user-email">
                            <h4>Email</h4>
                        </div>
                        <div class="user-phone">
                            <h4 style="margin-left: 3px;">Phone</h4>
                        </div>
                        <div class="action-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </div>
                    </div>
                </div>
                @forelse($loans as $loan)
                    <div class="items">
                        <div class="item-content">
                            <div class="user-profile">
                                <div class="n-chk align-self-center text-center">
                                    <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input contact-chkbox">
                                    <span class="new-control-indicator"></span>
                                    </label>
                                </div>
                                <img style="width:60%; height:50%" src="{{ asset('customerfiles/profilepicture')}}/{{$loan->customer->avatar}}" alt="avatar" />
                                <div class="user-meta-info">
                                    <p class="user-name" data-name="{{$loan->customer->first_name}}  {{$loan->customer->other_name}}  {{ $loan->customer->last_name }}">
                                        {{$loan->customer->first_name}}  {{$loan->customer->other_name}}  {{ $loan->customer->last_name }}
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="user-email">
                                <p class="info-title">Email: </p>
                                <p class="usr-email-addr" data-email="{{$loan->customer->email}}">{{$loan->customer->email}}</p>
                            </div>
                            <div class="user-phone">
                                <p class="info-title">Phone: </p>
                                <p class="usr-ph-no" data-phone="{{$loan->customer->phone_number}}">{{$loan->customer->phone_number}}</p>
                            </div>
                            <div class="action-btn">
                                
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="items">
                        <div class="item-content" style="flex-direction: column;">
                            <div class="user-profile">
                                <div class="user-meta-info">
                                    <p class="user-name text-center">You have No Prospect Yet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
    </div>
</div>
@endsection