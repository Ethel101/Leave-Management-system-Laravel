@extends('user.usermaster')

@section('content')






    <!-- PAGE CONTENT WRAPPER -->

    <div class="page-content-wrap">

        <div class="row">
            <div class="col-md-12">

                <form class="form-horizontal" method="post" action="{{url('/request_leave')}}" enctype="multipart/form-data">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Apply </strong> for Leave</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>
                        </div>

                        <div class="panel-body">

                            @if(isset($success))
                                <div style="margin-bottom: 40px" class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Success!</strong>
                                    <p class="alert-material-red" >{{$success}}</p>


                                </div>
                            @endif
                                @if(isset($failDate))
                                    <div style="margin-bottom: 40px" class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <strong>Fail!</strong>
                                        <p class="alert-material-red" >{{$failDate}}</p>


                                    </div>
                                @endif

                            @if($errors->first('email')!=null||$errors->first('username')!=null||$errors->first('password')!=null)
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Oh snap!</strong> <p class="alert-material-red" >{{ $errors->first('email')}}</p>
                                    <p class="alert-material-red" >{{ $errors->first('username')}}</p>
                                    <p class="alert-material-red" >{{ $errors->first('password')}}</p>


                                </div>
                            @endif


                            <div class="row">

                                <div class="col-md-6">




                                        <?php $lTypeDb = DB::table('leavetype')->get(); ?>


                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Type</label>
                                        <div class="col-md-9">
                                            <select name="leave_type" class="form-control">
                                                @foreach($lTypeDb as $leaveItem)
                                                <option value="{{$leaveItem->lid}}">{{$leaveItem->name}}</option>
                                                    @endforeach

                                            </select>
                                            <span class="help-block">Select Leave Type  </span>

                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Start Date</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <input name="start_date" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" value="" data-date-viewmode="years">
                                            </div>
                                           <!-- <label class="check"><input name="start_half" type="checkbox" class="icheckbox" value="1"/> Second Half</label> -->
                                            <!-- <span class="help-block">Leave starting date </span> -->
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="name" class="form-control"/>
                                            </div>
                                            <span class="help-block">Name of employee</span>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Leave Reason</label>
                                        <div class="col-md-9 col-xs-12">
                                            <textarea class="form-control" name="reason" rows="5"></textarea>
                                            <span class="help-block">Reason and additional notes on Leave</span>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contact Number</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                                <input type="text" class="form-control" name="mobno" placeholder="Mobile number "/>
                                            </div>
                                            <span class="help-block">Employee contact number</span>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="col-md-3 control-label">End Date</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                <input name="end_date" type="text" class="form-control datepicker" data-date-format="dd-mm-yyyy" value="" data-date-viewmode="years">
                                            </div>
                                         <!--   <label class="check"><input name="end_half" type="checkbox" class="icheckbox"  value="1"/> First Half</label> -->
                                            <!-- <span class="help-block">Leave starting date </span> -->
                                        </div>
                                    </div>





                                    <input type="hidden" value="{{ csrf_token()  }}" name="_token">




                                </div>

                            </div>

                        </div>
                        <!-- panel body end -->
                        <div class="panel-footer">
                            <button class="btn btn-default">Clear Form</button>
                            <button class="btn btn-primary pull-right">Apply Leave</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>








@endsection