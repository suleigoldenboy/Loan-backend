 <div class="tab-pane fade" id="audit-details" role="tabpanel" aria-labelledby="audit-details-tab">
    <div class="media">
        <div class="media-body">
             <div class="table-responsive">
                                    <table id="data-table" class="table table-bordered table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Note</th>
                                            <th>By</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                         @foreach ($data->audit_trial as $audit)
                                             <!-- <tr>
                                               <td>{{$audit->type}}</td>
                                               <td>{{$audit->note}}</td>
                                               <td>{{getAdminUserName($audit->user_id)}}</td>
                                               <td>{{$audit->created_at}}</td>
                                             </tr> -->
                                         @endforeach
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
        </div>
    </div>
</div>