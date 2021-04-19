<div class="row">
    <div class="col-md-4">
        
         @if ($data->customer_request == 1)
            <h4>ID Card</h4>
            {{$data->customer_verification->id_cards}}
         @endif
        <h4>ID Card</h4>
                                                                                    @if ($data->customer->employment)
                                                                                <div class="post-gallery-img">
                                                                                             @if (ltrim(strstr($data->customer->employment->id_card, '.'), '.') == "pdf")

                                                                                                        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_id_card">Open File</button>-->
                                                                            
                                        <a class="btn btn-primary" target="_blank" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->id_card}}">Open File</a>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->id_card}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_id_card">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_id_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                     @if (ltrim(strstr($data->customer->employment->id_card, '.'), '.') == "pdf")
                                     <embed src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->id_card}}" type="application/pdf"   height="300px" width="100%" class="responsive">                                                          <!--<iframe src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->id_card}}" style="width:100%;height:700px;"></iframe>-->
                                                                                                                      @else
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->id_card}}" class="img-responsive" style="width:100%;">
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
    </div>
     <div class="col-md-4">
        <h4>Sign</h4>
                                                                                 @if ($data->customer->employment)
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($data->customer->employment->sign, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_sign">Open File</button>

                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->sign}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_sign">
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_sign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                @if (ltrim(strstr($data->customer->employment->sign, '.'), '.') == "pdf")
                                                                                                                     
                                                                                                                      <iframe src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->sign}}" style="width:100%;height:700px;"></iframe>
                                                                                                                      @else
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->sign}}" class="img-responsive" style="width:100%;">
                                                                                                                  @endif
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
    </div>
    <div class="col-md-4">
        <h4>Bank Statement</h4>
        @if ($data->customer->employment)
                                                                                                <div class="post-gallery-img">
                                                            @if (ltrim(strstr($data->customer->employment->bank_statement, '.'), '.') == "pdf")

                    <!--<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_files">Open File</button>-->
<a class="btn btn-primary" target="_blank" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->bank_statement}}">Open File</a>
                                                                                                     @else
                                            
                                           
                                        
           @if (ltrim(strstr($data->customer->employment->bank_statement, '.'), '.') == "pdf")
        <embed src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->bank_statement}}" type="application/pdf"   height="300px" width="100%" class="responsive">
         @else
          
                                            <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->bank_statement}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_files">
                                            @endif
                                                                                                     @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <div class="pdf">
                                                                                                                        <object data="pdf_file_name.pdf" type="application/pdf" width="600" height="400">
                                                                                                                             <a class="btn btn-warning" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->bank_statement}}">Click to open file</a>
                                                                                                                        </object>
                                                                                                                    </div>
                                         
                                                                                <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->bank_statement}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
    </div>
    <div class="col-md-4">
        <h4 >Utility bill</h4>
                                                                                                 @if ($data->customer->employment)
                                                                                                <div class="post-gallery-img">
                                                                                                    @if (ltrim(strstr($data->customer->employment->utility_bill, '.'), '.') == "pdf")

                                                                                                        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_utility_bill">Open File</button>-->
            
            <a class="btn btn-primary" target="_blank" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->utility_bill}}">Open File</a>
                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->utility_bill}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_utility_bill">
                                                                                                    @endif
                                                                                                </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_utility_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                @if (ltrim(strstr($data->customer->employment->utility_bill, '.'), '.') == "pdf")
                                                                                                                     
                                       <embed src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->utility_bill}}" type="application/pdf"   height="300px" width="100%" class="responsive">                                                                               <!--<iframe src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->utility_bill}}" style="width:100%;height:700px;"></iframe>-->
                                                                                                                      @else
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->utility_bill}}" class="img-responsive" style="width:100%;">
                                                                                                                    @endif
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
    </div>
        <div class="col-md-4">

                                                                                                <h4 >Cheque</h4>
                                                                                                @if ($data->customer->employment)
                                                                                                <input type="hidden" name="old_cheque" value="{{$data->customer->employment->cheque}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($data->customer->employment->cheque, '.'), '.') == "pdf")

                                                                                                        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_cheque">Open File</button>-->
                                                                                                        
                    <a class="btn btn-primary" target="_blank" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->cheque}}">Open File</a>
                    
                    <embed src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->cheque}}" type="application/pdf"   height="300px" width="100%" class="responsive">
                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->cheque}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_cheque">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_cheque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->cheque}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
    </div>
    <div class="col-md-4">
                                                                                        @if ($data->product_id == 4)
                                                                                                <h4 >File Uploads</h4>
                                                                                                @if ($data->customer->employment)
                                                                                                <input type="hidden" name="old_file_uploads" value="{{$data->customer->employment->file_uploads}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($data->customer->employment->file_uploads, '.'), '.') == "pdf")

                                                                                                        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_file_uploads">Open File</button>-->
                                                                                                        
                    <a class="btn btn-primary" target="_blank" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->file_uploads}}">Open File</a>
                    
                    <embed src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->file_uploads}}" type="application/pdf"   height="300px" width="100%" class="responsive">
                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->file_uploads}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_file_uploads">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_file_uploads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->file_uploads}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                        @endif



                                                                                                <h4 >Others</h4>
                                                                                                @if ($data->customer->employment)
                                                                                                <input type="hidden" name="old_other_files" value="{{$data->customer->employment->other_files}}">
                                                                                                    <br>
                                                                                                <div class="post-gallery-img">
                                                                                                     @if (ltrim(strstr($data->customer->employment->other_files, '.'), '.') == "pdf")

                                                                                                        <!--<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_other_files">Open File</button>-->
                                                                                                        
                    <a class="btn btn-primary" target="_blank" href="{{ asset('customerfiles/files')}}/{{$data->customer->employment->other_files}}">Open File</a>
                    
                    <embed src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->other_files}}" type="application/pdf"   height="300px" width="100%" class="responsive">
                                                                                                     @else
                                                                                                        <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->other_files}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_other_files">
                                                                                                     @endif
                                                                                                    </div>
                                                                                                    <div class="modal fade bd-example-modal-xl" id="exampleModal_other_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                        <div class="modal-dialog modal-xl" role="document">
                                                                                                             <div class="modal-content">
                                                                                                                <div class="modal-body">
                                                                                                                    <img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->other_files}}" class="img-responsive" style="width:100%;">
                                                                                                                </div>
                                                                                                                <div class="modal-footer">
                                                                                                                    <button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                                                                                                                    {{-- <button type="button" class="btn btn-primary"></button> --}}
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
    </div>
    
</div>