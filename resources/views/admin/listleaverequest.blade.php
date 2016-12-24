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
                                    <h3 class="panel-title">Employees Leave Request</h3>
                                </div>

                                <div class="panel-body panel-body-table">

                                    <div class="table-responsive">
                                        <table class="table datatable table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">id</th>
                                                    <th width="100">Name</th>
                                                    <th width="100">Number</th>
                                                    <th width="100">Leave Type</th>
                                                    <th width="100">Reason</th>
                                                    <th width="100">Start Date</th>
                                                    <th width="100">End Date</th>
                                                    <th width="100">Total Days</th>
                                                    <th width="100">Total Leave this year</th>

                                                    <th width="100">Created at</th>

                                                     <th width="100">Status</th>
                                                    <th width="100">Action Reason</th>

                                                    <th width="100">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($leavereqDb as $leaveObj)
                                            <?php
                                            $stat = $leaveObj->status;
                                            /* $statusString  = 'Status';
                                             if($leaveObj->status == 0 ){
                                            $statusString = 'Pending';
                                            }else if($leaveObj->status == 1){
                                            $statusString = 'Aproved';
                                            }else if($leaveObj == 2){
                                            $statusString = 'Rejected';
                                            }*/
                                             ?>
                                                <tr id="trow_1">
                                                    <td class="text-center">1</td>
                                                    <td><strong><a href="{{url('/emp_detail?id='.$leaveObj->empid)}}"> {{$leaveObj->name}}</a></strong></td>
                                                     <td>{{$leaveObj->number}}</td>
                                                      <td>{{\App\Http\Controllers\AdminController::getLeaveTypeName($leaveObj->leave_type)}}</td>
                                                      <td>{{$leaveObj->reason}}</td>
                                                      <td>{{$leaveObj->start_date}}</td>
                                                      <td>{{$leaveObj->end_date}}</td>
                                                      <td>{{$leaveObj->totalleave}}</td>
                                                    <td>{{\App\Http\Controllers\AdminController::calculateTotalLeave($leaveObj->empid)}}</td>
                                                       <td>{{$leaveObj->ontime}}<br>{{$leaveObj->ondate}}</td>
                                                      @if($stat== 0)
                                                    <td><span class="label label-warning">Pending</span></td>
                                                    @elseif($stat == 1)
                                                     <td><span class="label label-success">Approved</span></td>
                                                     @elseif($stat == 2)
                                                      <td><span class="label label-danger">Rejected</span></td>
                                                      @endif


                                                    <td>{{$leaveObj->rejreason}}</td>

                                                    <td>@if($stat != 1)
                                                        <a href="{{url('/leave?id='.$leaveObj->id.'&act=1&var=2')}}" type="button" class="btn btn-success">Approve</a>
                                                        @endif
                                                        <a href="#" class="mb-control btn btn-danger" data-box="#mb-reject" onclick="setVal({{$leaveObj->id}})" type="button" >Reject</a>
                                                        <a href="{{url('/del_leave?id='.$leaveObj->id)}}" onclick="return confirm('Do you really want Delete this Leave Application?');" type="button" class="btn btn-danger">Delete</a>

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



<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="" id="mb-reject">
    <div class="mb-container">
        <div class="mb-middle">
            <form action="" name="rejform" id="rejform" method="post">

            <div class="mb-title"><span class="fa fa-sign-out"></span> Reject <strong>Leave Request</strong> ?</div>
            <div class="mb-content">
                <p>Please specify reason for the rejection. </p>
                <div class="form-group">
                    <textarea class="form-control" name="rejreason" rows="5"></textarea>
                    <input type="hidden" name="act" value="2" hidden/>
                    <input type="hidden" name="var"  value="2" hidden/>
                    <input type="hidden" value="{{ csrf_token()  }}" name="_token">

                </div>
            </div>

            <div class="mb-footer">
                <div class="pull-right">
                    <button id="rejyes" type="submit" class="btn btn-success btn-lg">Yes</button>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END MESSAGE BOX -->
 <!-- &act=2&var=2" -->
     <script>

function setVal(id) {
    console.log('inside set val')
    <?php $rejId = "<script>document.write(id)</script>" ?>
    document.getElementById("rejform").action= "leave?id="+id;
}



     </script>



                @endsection