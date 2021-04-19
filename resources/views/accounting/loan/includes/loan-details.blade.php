<table id="multi-column-ordering" class="table table-hover dataTable" style="width: 100%;" role="grid" aria-describedby="multi-column-ordering_info">
                                  
                                     <tbody>
                                       <tr role="row">
                                            <td width='200'>{{trans('general.status')}}</td>
                                            <td> 
                                            
                                            @if ($data->status == "active")
                                               <b class="badge badge-success">
                                                {{ucfirst($data->status)}} 
                                                </b>
                                            @elseif($data->confirmation_status == "decline")
                                               <h4 class="badge badge-danger" style="color:#FFF;">
                                                LOAN DECLINED 
                                                <svg xmlns="#" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-down"><path d="M10 15v4a3 3 0 0 0 3 3l4-9V2H5.72a2 2 0 0 0-2 1.7l-1.38 9a2 2 0 0 0 2 2.3zm7-13h2.67A2.31 2.31 0 0 1 22 4v7a2.31 2.31 0 0 1-2.33 2H17"></path></svg>
                                                </h4>
                                             @else
                                             <b class="badge badge-danger">
                                               {{ucfirst($data->status)}} 
                                            </b>
                                             <div class="spinner-grow text-danger align-self-center" style="font-size:10px;">Loading...</div>
                                            @endif
                                             @if (!is_string($data->confirmation_status))
                                                  {{$data->confirmation_stage->name}}
                                              @endif
                                            
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td>Product</td>
                                            <td>{{$data->product->name}}</td>
                                        </tr>
                                        <tr role="row">
                                            <td>{{trans('general.duration')}}</td>
                                            <td>{{$data->loan_duration_length}} <label style="text-transform: capitalize;">{{$data->loan_duration}} (s)</label></td>
                                        </tr>
                                        <tr role="row">
                                            <td>{{trans('general.repayment_type')}}</td>
                                            <td>{{$data->repayment_method}}</td>
                                        </tr>
                                        <tr role="row">
                                            <td>{{trans('general.interest_method')}}</td>
                                            <td>{{$data->repayment_method}}</td>
                                        </tr>
                                        <tr role="row">
                                            <td class="text-info"><b >{{trans('general.loan_amount')}}</b></td>
                                            <td class="text-info">
                                            ₦{{number_format($data->principal,2)}}
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td class="text-info"><b >{{trans('general.approve_amount')}}</b></td>
                                            <td class="text-info">
                                           
                        ₦{{number_format($data->disbursed_amount ? $data->disbursed_amount : $data->principal,2)}}
                                              
                                                
            
                
               
         @if ($data->status != "active")
          @if(is_numeric($data->confirmation_status))
            @if(checkConfirmationProcess($data->confirmation_stage->privilege, "change_amount"))
                                                        <button type="button" class="btn btn-warning mb-4 mr-2 btn-sm" data-toggle="modal" data-target="#changeAmounttFormModal" style="font-size:11px; padding:4px;">
                                                            Change Amount 
                                                        </button>
                                                    @endif
                                                @endif
                                             @endif
                                              
                                             
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td>{{trans('general.interest')}}</td>
                                            <td>{{$data->interest_rate}} % ({{$data->repayment_method}})</td>
                                        </tr>
                                        <tr role="row">
                                            <td>{{trans('general.requested_on')}}</td>
                                            <td>{{$data->created_at}}</td>
                                        </tr>
                                         <tr role="row">
                                            <td>{{trans('general.approve_on')}}</td>
                                            <td>{{$data->release_date  ? $data->release_date  : ''}}</td>
                                        </tr>
                                        <tr role="row">
                                            <td>{{trans('general.maturity_date')}}</td>
                                            <td>{{$data->maturity_date ? $data->maturity_date : ''}}</td>
                                        </tr>
                                         <tr role="row">
                                            <td>{{trans('general.disbursed_by')}}</td>
                                            <td>{{$data->loan_disbursed_by ? $data->loan_disbursed_by->name : ''}}</td>
                                        </tr>
                                        </tbody>

                                   
                                    </table>