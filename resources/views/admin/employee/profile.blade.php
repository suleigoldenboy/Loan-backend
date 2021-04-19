@extends('layouts.admin-app')

@section('content')
 <!--  BEGIN CONTENT AREA  -->
        <div  class="main-content">
            <div class="row layout-px-spacing">

                <div class="row layout-spacing">

                    <!-- Content -->
                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">Profile</h3>
                                  
                                </div>
                                <div class="text-center user-info">
                                    <img src="{{ asset('assets/img/profile-3.jpg')}}" alt="avatar">
                                    <p class="">
                                        {{Auth::user()->first_name}} 
                                        {{Auth::user()->last_name}} 
                                        {{Auth::user()->other_name}}
                                    </p>
                                </div>
                                <div class="user-info-list">

                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> {{Auth::user()->department->title}} 
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                               <span class="badge badge-secondary"> {{Auth::user()->designation->title}} </span>
                                            </li>
                                            
                                            <li class="contacts-block__item">
                                                <a href="#"><svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{Auth::user()->email}}</a>
                                            </li>
                                            <br>
                                            <li class="contacts-block__item">
                                                <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> {{Auth::user()->phone_number}}
                                            </li>
                                            
                                        </ul>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="education layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Education</h3>
                                <div class="timeline-alter">
                                    <!--<div class="item-timeline">-->
                                    <!--    <div class="t-meta-date">-->
                                    <!--        <p class="">04 Mar 2009</p>-->
                                    <!--    </div>-->
                                    <!--    <div class="t-dot">-->
                                    <!--    </div>-->
                                    <!--    <div class="t-text">-->
                                    <!--        <p>Royal Collage of Art</p>-->
                                    <!--        <p>Designer Illustrator</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="item-timeline">-->
                                    <!--    <div class="t-meta-date">-->
                                    <!--        <p class="">25 Apr 2014</p>-->
                                    <!--    </div>-->
                                    <!--    <div class="t-dot">-->
                                    <!--    </div>-->
                                    <!--    <div class="t-text">-->
                                    <!--        <p>Massachusetts Institute of Technology (MIT)</p>-->
                                    <!--        <p>Designer Illustrator</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="item-timeline">-->
                                    <!--    <div class="t-meta-date">-->
                                    <!--        <p class="">04 Apr 2018</p>-->
                                    <!--    </div>-->
                                    <!--    <div class="t-dot">-->
                                    <!--    </div>-->
                                    <!--    <div class="t-text">-->
                                    <!--        <p>School of Art Institute of Chicago (SAIC)</p>-->
                                    <!--        <p>Designer Illustrator</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>

                        <div class="work-experience layout-spacing ">
                            
                            <div class="widget-content widget-content-area">

                                <h3 class="">Work Experience</h3>
                                
                                <div class="timeline-alter">
                                
                                    <!--<div class="item-timeline">-->
                                    <!--    <div class="t-meta-date">-->
                                    <!--        <p class="">04 Mar 2009</p>-->
                                    <!--    </div>-->
                                    <!--    <div class="t-dot">-->
                                    <!--    </div>-->
                                    <!--    <div class="t-text">-->
                                    <!--        <p>Netfilx Inc.</p>-->
                                    <!--        <p>Designer Illustrator</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="item-timeline">-->
                                    <!--    <div class="t-meta-date">-->
                                    <!--        <p class="">25 Apr 2014</p>-->
                                    <!--    </div>-->
                                    <!--    <div class="t-dot">-->
                                    <!--    </div>-->
                                    <!--    <div class="t-text">-->
                                    <!--        <p>Google Inc.</p>-->
                                    <!--        <p>Designer Illustrator</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="item-timeline">-->
                                    <!--    <div class="t-meta-date">-->
                                    <!--        <p class="">04 Apr 2018</p>-->
                                    <!--    </div>-->
                                    <!--    <div class="t-dot">-->
                                    <!--    </div>-->
                                    <!--    <div class="t-text">-->
                                    <!--        <p>Design Reset Inc.</p>-->
                                    <!--        <p>Designer Illustrator</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                     

                        <div class="bio layout-spacing " style="min-width:100%;">
                            <div class="widget-content widget-content-area" style="min-width:100%;">
                                
                               

                                  <h3 class="">Personal Detail</h3>
                                   
                                   <div class="row">
                                       <div class="col-md-6">
                                           <h4>Contact Detail</h4>
                                       </div>
                                       <div class="col-md-6">
                                           <h4>Login Detail</h4>
                                           <p>User Name: {{Auth::user()->email}}</p>
                                           <p>Password: **************</p>
                                        <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
                                          Update Password
                                        </button>
                                        
                                           <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                   
    <form action="{{url('update/my/password')}}" method="POST" id="actionForm">
            {{csrf_field()}}
           
                 <div class="form-row mb-4">
                    <div class="col">
                         Password *
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col">
                         Confirm-Password *
                        <input type="password" name="confirm_password" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                
       
            
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                            
            </form>
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
        <!--  END CONTENT AREA  --
@endsection
