 @extends('admin.master')
 @section('content')


<?php

 $leavereqDb  = DB::table('leaveapply')->get();
 $leavereqDb = array_reverse($leavereqDb);

 ?>



 <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Responsive tables</h3>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">id</th>
                                                    <th width="100">Name</th>
                                                    <th width="100">Number</th>
                                                    <th width="100">Leave Type</th>
                                                    <th >Reason</th>
                                                    <th width="100">Start Date</th>
                                                    <th width="100">End Date</th>
                                                    <th width="100">Total Days</th>
                                                     <th width="100">Status</th>
                                                      <th width="100">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leavereqDb as $leaveObj)
                                            <?php
                                            $stat = $leaveObj->status;
                                             $statusString  = 'Status';
                                             if($leaveObj->status == 0 ){
                                            $statusString = 'Pending';
                                            }else if($leaveObj == 1){
                                            $statusString = 'Aproved';
                                            }else if($leaveObj == 2){
                                            $statusString = 'Rejected';
                                            }
                                             ?>
                                                <tr id="trow_1">
                                                    <td class="text-center">1</td>
                                                    <td><strong>{{$leaveObj->name}}</strong></td>
                                                     <td>{{$leaveObj->number}}</td>
                                                      <td>{{$leaveObj->leave_type}}</td>
                                                      <td>{{$leaveObj->reason}}</td>
                                                      <td>{{$leaveObj->start_date}}</td>
                                                      <td>{{$leaveObj->end_date}}</td>
                                                      <td>{{$leaveObj->totalleave}}</td>
                                                      @if($stat== 0)
                                                    <td><span class="label label-warning">Pending</span></td>
                                                    @elseif($stat == 1)
                                                     <td><span class="label label-success">Approved</span></td>
                                                     @elseif($stat == 2)
                                                      <td><span class="label label-danger">Rejected</span></td>
                                                      @endif
                                                    <td>@if($stat != 1)
                                                        <a href="{{url('/leave?id='.$leaveObj->id.'&act=1&var=2')}}" type="button" class="btn btn-success">Approve</a>
                                                        @endif
                                                        <a href="{{url('/leave?id='.$leaveObj->id.'&act=2&var=2')}}" type="button" class="btn btn-danger">Reject</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->
                @endsection