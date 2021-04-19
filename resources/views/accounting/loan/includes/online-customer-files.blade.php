<div class="row">
	<div class="col-md-4">
		<h4>ID Card Online</h4>
		
		@if ($data->customer->customerVerification)
		@php $id = json_decode(json_encode($data->customer->customerVerification()->first()->documents[0]), true)@endphp
		<div class="post-gallery-img">@if (ltrim(strstr($data->customer->employment->id_card, '.'), '.') == "pdf")
			<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_id_card">Open File</button>
		@else
		<img src="{{ asset('customer/verification/documents')}}/{{$id['id_cards']['name']}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_id_card">@endif</div>
		<div class="modal fade bd-example-modal-xl" id="exampleModal_id_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<img src="{{ asset('customer/verification/documents')}}/{{$id['id_cards']['name']}}" class="img-responsive" style="width:100%;">
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>{{--
						<button type="button" class="btn btn-primary"></button>--}}</div>
				</div>
			</div>
		</div>@endif</div>
	<div class="col-md-4">
	 <h4>Bank Statement</h4>
        @if ($data->customer->employment)
                                                                                                <div class="post-gallery-img">
                                                            @if (ltrim(strstr($data->customer->employment->bank_statement, '.'), '.') == "pdf")

                                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_files">Open File</button>

                                                                                                     @else
                                            
                                           
                                            
           @if (ltrim(strstr($data->customer->employment->bank_statement, '.'), '.') == "pdf")
        <iframe src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->bank_statement}}" style="width:100%;height:700px;"></iframe>
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
		<h4>Utility bill</h4>
		@if ($data->customer->employment)
		@php $util = json_decode(json_encode($data->customer->customerVerification()->first()->documents[1]), true)@endphp
		<div class="post-gallery-img">@if (ltrim(strstr($data->customer->employment->utility_bill, '.'), '.') == "pdf")
			<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_utility_bill">Open File</button>@else
			<img src="{{ asset('customer/verification/documents')}}/{{$util['utility']['name']}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_utility_bill">@endif</div>
		<div class="modal fade bd-example-modal-xl" id="exampleModal_utility_bill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<img src="{{ asset('customer/verification/documents')}}/{{$util['utility']['name']}}" class="img-responsive" style="width:100%;">
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>{{--
						<button type="button" class="btn btn-primary"></button>--}}</div>
				</div>
			</div>
		</div>@endif
	</div>
	<div class="col-md-4">
		<h4>Signature</h4>
		@if (isset($data->customer->customerVerification()->first()->documents[3]))
		@php $signature = json_decode(json_encode($data->customer->customerVerification()->first()->documents[3]), true)@endphp
		<div class="post-gallery-img">@if (ltrim(strstr($data->customer->employment->utility_bill, '.'), '.') == "pdf")
			<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_sign">Open File</button>@else
			<img src="{{ asset('customer/verification/documents')}}/{{$signature['signature']['name']}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_sign">@endif</div>
		<div class="modal fade bd-example-modal-xl" id="exampleModal_sign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<img src="{{ asset('customer/verification/documents')}}/{{$signature['signature']['name']}}" class="img-responsive" style="width:100%;">
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>{{--
						<button type="button" class="btn btn-primary"></button>--}}</div>
				</div>
			</div>
		</div>@endif
	</div>
	<div class="col-md-4">
		<h4>Others</h4>
		@if ($data->customer->employment)
		<input type="hidden" name="old_other_files" value="{{$data->customer->employment->other_files}}">
		<br>
		<div class="post-gallery-img">@if (ltrim(strstr($data->customer->employment->other_files, '.'), '.') == "pdf")
			<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal_other_files">Open File</button>@else
			<img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->other_files}}" title="view image" style="width:70px; hieght:70px; cursor:pointer;" data-toggle="modal" data-target="#exampleModal_other_files">@endif</div>
		<div class="modal fade bd-example-modal-xl" id="exampleModal_other_files" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<img src="{{ asset('customerfiles/files')}}/{{$data->customer->employment->other_files}}" class="img-responsive" style="width:100%;">
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>{{--
						<button type="button" class="btn btn-primary"></button>--}}</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>