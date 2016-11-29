@extends('admin.master')
@section('content')


<?php
$leaveTypeDb = DB::table('leavetype')->get();

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
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END CONTEXTUAL CLASSES TABLE SAMPLE -->





@endsection