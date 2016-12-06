@extends('admin.master')
@section('content')


<?php
$leaveTypeDb = DB::table('leavetype')->get();

function inflatePreference(){

//$model = new \App\Leavetype();


}



?>


  <!-- START CONTEXTUAL CLASSES TABLE SAMPLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Leave Types</h3>
                                </div>
                                <div class="panel-body">
                                 <!--   <p>There available 5 classes: <code>active, success, info, warning, danger</code>. Add it to TR tag.</p> -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Leave Name</th>
                                                <th>Current Leave Limit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($leaveTypeDb as $leaveItem)


                                            <tr class="active">
                                                <td>{{$leaveItem->lid}}</td>
                                                <td>{{$leaveItem->name}}</td>
                                                <td>{{$leaveItem->llimit}}</td>
                                                <td> <input type="text" name="lval" class="form-control" value=""/></td>
                                                <td> <a href="{{url('/emp_detail?id='.$user->id)}}" type="button" class="btn btn-info">Update limit</a>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END CONTEXTUAL CLASSES TABLE SAMPLE -->
                            <form class="form-horizontal" method="post" action="{{url('/add_ltype')}}" enctype="multipart/form-data">

 <div class="panel panel-default">
  <div class="panel-heading">
                                     <h3 class="panel-title">Leave Types</h3>
                                 </div>

<div class="row">
                                        <div class="col-md-3" style="margin-top: 20px">

                                            <div class="form-group">
                                                <label class="col-md-6 control-label">Leave ID</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="lid" class="form-control"/>
                                                    </div>
                                                    <span class="help-block">in numericals</span>
                                                </div>
                                            </div>
                                            </div>


                                        <div class="col-md-3" style="margin-top: 20px">


                                             <div class="form-group">
                                                                                            <label class="col-md-6 control-label">Leave Type Name</label>
                                                                                            <div class="col-md-9">
                                                                                                <div class="input-group">
                                                                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                                                                    <input type="text" name="lname" class="form-control"/>
                                                                                                </div>
                                                                                                <span class="help-block"></span>
                                                                                            </div>
                                                                                        </div>

</div>

                                        <div class="col-md-3" style="margin-top: 20px">

                                             <div class="form-group">
                                                <label class="col-md-6 control-label">Limit (Days)</label>
                                                <div class="col-md-9">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" class="form-control" name="llimit"/>
                                                    </div>
                                                    <span class="help-block">in numericals</span>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    <div class="row">

                                    <div class="col-md-3"><button style="margin-top: 20px;margin-bottom: 20px" class="btn btn-primary pull-center">Add Leave Type</button></div>
                                    <div class="col-md-3"></div>
                                    <div class="col-md-3"></div>


                                                                        </div>

                                    </div>

</form>


@endsection