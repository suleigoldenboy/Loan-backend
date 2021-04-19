@extends('layouts.admin-app')
@section('content')
<div class="col-md-12">
    <div class="row layout-top-spacing">
        <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                    <div class="btn-group">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Audit Trial</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <table class="table table-hover table-checkable order-column full-width" id="example4">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th> User </th>
                                                <th> Action </th>
                                                <th> Date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($logs)
                                            @foreach($logs as $log)
                                            <tr class="odd gradeX">
                                            <td class="patient-img">
                                                <img src="{{ asset('assets/img/staff/'.$log->users->avatar) }}" alt="">
                                            </td>
                                            <td>
                                                {{ $log->users->first_name }}
                                                {{ $log->users->last_name }}
                                            </td>
                                            <td>
                                                {{ $log->note }}
                                            </td>
                                            <td>
                                                <?php 
                                                    
                                                    $a_dcdate = new \DateTime($log->created_at);
                                                    $logsDate =  $a_dcdate->format('D M d, Y h:i:s a');
                                                    echo $logsDate;
                                                ?>
                                            </td>
                                            </tr>
                                            @endforeach

                                            
                                        @endif
                                        </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
    </div>
</div>
@endsection
