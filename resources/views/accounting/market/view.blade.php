@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="layout-px-spacing"> 
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div id="general-info" class="section general-info">
                <div class="info">
                    <h6 class="text-info">Customer Search</h6>
                    <form action="{{url('prospect/view')}}" method="POST">
                     {{csrf_field()}}
                      @include('admin.customer.prospect-search')
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="searchable-items list">
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
                @forelse($prospects as $user)
                    <div class="items">
                        <div class="item-content">
                            <div class="user-profile">
                                <div class="n-chk align-self-center text-center">
                                    <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input contact-chkbox">
                                    <span class="new-control-indicator"></span>
                                    </label>
                                </div>
                                <img src="{{ asset('customerfiles/profilepicture')}}/{{$user->customer->avatar}}" alt="avatar">
                                <div class="user-meta-info">
                                    <p class="user-name" data-name="{{$user->customer->first_name}}  {{$user->customer->other_name}}  {{ $user->customer->last_name }}">
                                        {{$user->customer->first_name}}  {{$user->customer->other_name}}  {{ $user->customer->last_name }}
                                    </p>
                                    
                                </div>
                            </div>
                            <div class="user-email">
                                <p class="info-title">Email: </p>
                                <p class="usr-email-addr" data-email="{{$user->customer->email}}">{{$user->customer->email}}</p>
                            </div>
                            <div class="user-phone">
                                <p class="info-title">Phone: </p>
                                <p class="usr-ph-no" data-phone="{{$user->customer->phone_number}}">{{$user->customer->phone_number}}</p>
                            </div>
                            <div class="action-btn">
                                @if(isset($user->customer->loan))
                                    @if(in_array($user->customer->loan()->latest()->first()->confirmation_status, $confirmationArray))
                                        <span class="text-info"> This Loan is Processing</span> 
                                    @endif
                                    @if(!in_array($user->customer->loan()->latest()->first()->confirmation_status, $confirmationArray) &&  $user->customer->loan()->latest()->first()->confirmation_status == 'active')
                                        <span  class="text-success"> Loan Processed Completely, disbursment will be within 24 Hours</span> 
                                    @endif
                                    
                                @endif
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