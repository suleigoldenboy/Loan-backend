@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="layout-px-spacing"> 
     <!-- Start Search Information-->
        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
            <div id="general-info" class="section general-info">
                <div class="info">
                    <h6 class="text-info">View Offer Letter</h6>
                     <form action="" method="GET">
    <div class="row">
               
                     {{csrf_field()}}
                        <div class="col-sm-3">
                            <div class="form-group">
                                 <input type="text" class="form-control mb-4" name="c_name" placeholder="First or Last Name">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button class="mr-2 btn btn-primary  html">Search</button> 
                        </div>
                       
                    
                     </form>
                     </div>
                </div>
            </div>
        </div>
         <!-- End Search Information-->               
                <div class="row layout-spacing layout-top-spacing" id="cancel-row">
                    <div class="col-lg-12">
                        <div class="widget-content searchable-container grid">

                            <div class="row">
                                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-7 filtered-list-search layout-spacing align-self-center">
                                    @if($data)<form class="form-inline my-2 my-lg-0">
                                        <div class="">
                                            <svg xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                           
                                            <input type="text" class="form-control product-search" id="input-search" placeholder="Search Contacts...">
                                          
                                        </div>
                                    </form>
                                     @endif
                                </div>

                                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-5 text-sm-right text-center layout-spacing align-self-center">
                                    <div class="d-flex justify-content-sm-end justify-content-center">
                                        <!--<svg id="btn-add-contact" xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>-->

                                        <div class="switch align-self-center">
                                            <!--<svg xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list view-list active-view"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>-->
                                            <!--<svg xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid view-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>-->
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                                    <div class="add-contact-box">
                                                        <div class="add-contact-content">
                                                            <form id="addContactModalTitle">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input type="text" id="c-name" name="first_name" class="form-control" placeholder="First Name" required>
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-email">
                                                                            <i class="flaticon-mail-26"></i>
                                                                            <input type="text" id="c-email" name="last_name" class="form-control" placeholder="Last Name" required>
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-name">
                                                                            <i class="flaticon-user-11"></i>
                                                                            <input type="text" id="c-name" name="other_name" class="form-control" placeholder="Other Name">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="contact-email">
                                                                            <i class="flaticon-mail-26"></i>
                                                                            <input type="text" id="c-email" class="form-control" placeholder="Email" required>
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="contact-occupation">
                                                                            <i class="flaticon-fill-area"></i>
                                                                            <input type="text" id="c-occupation" class="form-control" placeholder="Occupation">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="contact-phone">
                                                                            <i class="flaticon-telephone"></i>
                                                                            <input type="text" id="c-phone" class="form-control" placeholder="Phone">
                                                                            <span class="validation-text"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="contact-location">
                                                                            <i class="flaticon-location-1"></i>
                                                                            <input type="text" id="c-location" class="form-control" placeholder="Location">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="btn-edit" class="float-left btn">Save</button>

                                                    <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>

                                                    <button id="btn-add" class="btn">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="searchable-items grid">
                                <div class="items items-header-section">
                                    <div class="item-content">
                                        <div class="">
                                            <h4>Name</h4>
                                        </div>
                                        <div class="user-email">
                                            <h4>Branch</h4>
                                        </div>
                                        <div class="user-location">
                                            <h4 style="margin-left: 0;">Phone</h4>
                                        </div>
                                        <div class="user-phone">
                                            <h4 style="margin-left: 3px;">Loan</h4>
                                        </div>
                                        <div class="action-btn">
                                            <svg xmlns="" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2  delete-multiple"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </div>
                                    </div>
                                </div>

                                @foreach ($data as $customer)
                                     <div class="items">
                                    <div class="item-content">
                                        <div class="user-profile">
                                            <div class="n-chk align-self-center text-center">
                                                <label class="new-control new-checkbox checkbox-primary">
                                                  <input type="checkbox" class="new-control-input contact-chkbox">
                                                  <span class="new-control-indicator"></span>
                                                </label>
                                            </div>
                                            <img src="{{ asset('customerfiles/profilepicture')}}/{{$customer->avatar}}" alt="avatar" style="max-width:180px; min-width:180px; min-height:190px; max-height:190px;">
                                            <div class="user-meta-info">
                                                <p class="user-name" style = "font-size:14px; text-transform:capitalize;" data-name="{{$customer->first_name}} {{$customer->other_name}}{{$customer->last_name}}">{{$customer->first_name}} {{$customer->other_name}}{{$customer->last_name}}</p>
                                                <p class="user-work" data-occupation="{{$customer->email}}">{{$customer->email}}</p>
                                            </div>
                                        </div>
                                        <div class="user-email">
                                            <p class="usr-email-addr" data-email="Branch">Branch</p>
                                        </div>
                                        <div class="user-phone">
                                            <p class="usr-ph-no" data-phone="{{$customer->phone_number}}">
                                            <svg xmlns="" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg><span class="icon-name"></span>
                                                {{$customer->phone_number}}</p>
                                        </div>
                                        <div class="user-location">
                                            <b class="text-info">
                                                Number of Loan: {{count($customer->loan)}}
                                            </b>
                                        </div>
                                        <div class="action-btn">
                                            
                                             <div style="width:100%;" id="toggleAccordion">
                                                <div class="card">
                                                   
                                
                                                 <table class="table">
                                                                <thead class="">
                                                                    <tr>
                                                                        <th scope="col"></th>
                                                                        <th class="text-right" scope="col"></th>
                                                                        <th class="text-right" scope="col"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                    @foreach ($customer->loan as $loan) 
                                     @if(checkLetterStatus($loan->id) == "active")
                                                                     <tr>
                                                                        <td>{{$loan->product->name}}</td>
                                        <td class="text-right">
                                     
                                      
                                       <a target="_blank" href="{{url('admin/show/loan/accepted/offer-letter',[$loan->id])}}" class="badge badge-secondary"> View  Letter</a>
                                                                        
                                                                        </td>
                                                                        <td class="text-right">
                                                                           
                                                                        </td>
                                                                    </tr>
                                        @endif
                                                                    @endforeach
                                                                    
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                            </div>
                                                                      
                                           </div>
                                                                    
                                                                    
                                           
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection

