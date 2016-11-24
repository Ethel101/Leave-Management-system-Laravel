@extends('admin.master')
@section('content')


<?php

if(isset($uId)){
$userObj = DB::table('users')->where('id',$uId)->first();
$leavDb =  DB::table('leave')->where('empid',$userObj->id)->first();
$totalLeav = 0;
if($leavDb!=null){
$totalLeav = $leavDb->totalleave;
}
}else{

}
?>

<div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-5">

                            <div class="panel panel-default">
                                <div  class="panel-body profile" style="background: url('assets/images/gallery/music-4.jpg') center center no-repeat;padding-top: 100px;">
                                    <div class="profile-image">
                                        <img style="width: 180px;height: 180px" src="profileimg/{{$userObj->image}}" alt="{{$userObj->username}}"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"  style="color: #002240;">{{$userObj->name}}</div>
                                        <div class="profile-data-title" style="color: #002240;">{{$userObj->designation}}</div>
                                    </div>

                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-edit"></span> Edit</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary btn-rounded btn-block"><span class="fa fa-window-close"></span> Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body list-group border-bottom">
                                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> Activity</a>
                                     <a href="#" class="list-group-item"><span class="fa fa-users"></span> Username <span class="badge badge-danger">{{$userObj->username}}</span></a>
                                      <a href="#" class="list-group-item"><span class="fa fa-users"></span> Email <span class="badge badge-danger">{{$userObj->email}}</span></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> Total Leave <span class="badge badge-danger">{{$totalLeav}}</span></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-folder"></span> Duty<span class="badge badge-danger">{{$userObj->duty}}</span></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-cog"></span> Settings</a>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-5">

                            <!-- START TIMELINE -->

                                            <button class="btn btn-info btn-rounded btn-block"><span class="fa fa-edit"></span> Edit</button>



                            <!-- END TIMELINE -->

                        </div>

                    </div>

                </div>
                <!-- END PAGE CONTENT WRAPPER -->


@endsection