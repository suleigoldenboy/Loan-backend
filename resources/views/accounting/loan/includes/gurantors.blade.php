<div class="tab-pane fade" id="gurantors-details" role="tabpanel" aria-labelledby="gurantors-details-tab">
    <div class="media">
        <div class="media-body">
            <div class="text-right">
                <button type="button" class="btn btn-primary mb-2 mr-2" data-toggle="modal" data-target="#exampleModal">
                                         Add Gurantor
                </button>
            </div>
            <div class="box box-success">
                    <div class="table-responsive">
                                    <table id="data-table" class="table table-bordered table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th>Full Name</th>
                                            <th>Occupation</th>
                                            <th>Relationship</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                         @foreach ($data->cus_gurantors as $gran)
                                             <tr>
                                                <td>{{$gran->first_name}} {{$gran->last_name}}</td>
                                                <td>{{$gran->occupation}}</td>
                                                <td>{{$gran->relationship}}</td>
                                                <td>{{$gran->phone_number}}</td>
                                                <td>{{$gran->email}}</td>
                                                <td class="text-center">
                                                        <ul class="table-controls">
                                                            <!--<a href="javascript:void(0);" onclick="setG_DeleteId({{$gran->id}})" data-toggle="modal" data-target="#zoomupModal" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">-->
                                                            <!--<svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>-->
                                                            <!--<line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>-->
                                                            <!--</a>-->
                                                        </ul>
                                                    </td>
                                             </tr>
                                         @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                </div>                                   
        </div>
    </div>
</div>

<!--  Add  Gurantor -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="text-transform: uppercase;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Guarantor</h5>
            </div>
            <div class="modal-body">
                <form action="{{url('gurantor/store')}}" method="POST" id="actionForm">
                 {{csrf_field()}}
                 <input type="hidden" name="customer_id" value="{{$data->customer->id}}">
                 <input type="hidden" name="loan_id" value="{{$data->id}}">
                <div class="form-row mb-4" >
                    <div class="col">
                         First Name
                         <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="col">
                         Last Name
                         <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>
                 <div class="form-row mb-4">
                    <div class="col">
                        Other Name
                         <input type="text" name="other_name" class="form-control" placeholder="Other Name">
                    </div>
                    <div class="col">
                         Relationship
                         @include('inc.relationship')
                    </div>
                </div>

                <div class="form-row mb-4">
                    <div class="col">
                        Email
                         <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col">
                        Mobile Number
                         <input type="text" name="phone_number" class="form-control" placeholder="Mobile Number" required>
                    </div>
                </div>
                <div class="form-row mb-4">
                    <div class="col">
                        Occupation
                         <input type="text" name="occupation" class="form-control" placeholder="Occupation" required>
                    </div>
                    <div class="col">
                        Home Address
                        <textarea name="home_address" class="form-control" placeholder="Home Address" required></textarea>
                    </div>
                </div>
                
<input type="submit" name="time" class="btn btn-primary">

            </form>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                
            </div>
        </div>
    </div>
</div>

<!-- End Add Gurantor -->

<!-- delete  Gurantor -->
<div id="zoomupModal" class="modal animated zoomInUp custo-zoomInUp" role="dialog" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    </div>
                                                    <div class="modal-body">
                                                         <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="padding: 2em; display: flex;">
                                                            <div class="swal2-header">
                                                                <ul class="swal2-progresssteps" style="display: none;">
                                                                    </ul>
                                                                        <div class="swal2-icon swal2-error" style="display: none;">
                                                                            <span class="swal2-x-mark">
                                                                                <span class="swal2-x-mark-line-left">
                                                                            </span>
                                                                            <span class="swal2-x-mark-line-right"></span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-question" style="display: none;">
                                                                            <span class="swal2-icon-text">?</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;">
                                                                            <span class="swal2-icon-text">!</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-info" style="display: none;">
                                                                            <span class="swal2-icon-text">i</span>
                                                                        </div>
                                                                        <div class="swal2-icon swal2-success" style="display: none;">
                                                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                                                                            </div><span class="swal2-success-line-tip"></span> 
                                                                            <span class="swal2-success-line-long"></span><div class="swal2-success-ring"></div>
                                                                             <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                                                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div>
                                                                    <img class="swal2-image" style="display: none;">
                                                                    <h2 class="swal2-title" id="swal2-title">Are you sure?</h2><button type="button" class="swal2-close" style="display: none;">×</button>
                                                                    </div>
                                                                    <div class="swal2-content"><div id="swal2-content" style="display: block;">You won't be able to revert this!</div><input class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label for="swal2-checkbox" class="swal2-checkbox" style="display: none;"><input type="checkbox"></label><textarea class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validationerror" id="swal2-validationerror" style="display: none;"></div></div><div class="swal2-actions" style="display: flex;">
                                                                    <button type="button" class="swal2-cancel btn btn-danger mr-3" aria-label="" style="display: inline-block;" data-dismiss="modal">No, cancel!</button>
                                                                    
                                                                     <form action="{{url('gurantor/delete')}}" method="POST" id="actionForm">
                                                                        {{csrf_field()}}
                                                                         <input type="hidden" name="loan_id" value="{{$data->id}}">
                                                                        <input type="hidden" name="gurantor_id" id="gurantor_id" value="">
                                                                        <button type="submit" class="swal2-confirm btn btn-success" aria-label="">Yes, delete it!</button></div><div class="swal2-footer" style="display: none;"></div></div>
                                                                     </form>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
        <!-- End delete Gurantor -->
<script>
function setG_DeleteId(id){
    document.getElementById('gurantor_id').value = id;
}
</script>
