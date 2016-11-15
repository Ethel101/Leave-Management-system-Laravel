<?php namespace App\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Muneef
 * Date: 09/11/16
 * Time: 15:07
 */
//require base_path('vendor/Carbon/Carbon.php');

use App\Leaveapply;
use App\User;
//use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\MessageBag;
class UserController extends Controller
{


    function testView(){
     //echo  'test = '.Carbon::now();
    }


    function checkUserLogin(){
        if(Auth::check()){
            return true;
        }else{
          return false;
        }
    }





    function getLoginPage(){
if( $this->checkUserLogin()){
    return Redirect('user_dash');
}else{
        return view('user.login');
}
    }


    function  loginPost(){

        $username = Input::get('username');
        $pass = Input::get('password');


        $validator = Validator::make(
            [
                'password' => Input::get('password'),
                'username' => Input::get('username')
            ],
            [
                'password' => 'required',
                'username' => 'required'
            ]
        );
        if ($validator->fails()) {
            //return 'validator fail';
            $messages = $validator->messages();
            $erUsername = $messages->first('username');
            $erPass = $messages->first('password');
            // dd($validator);
            return view('admin.adminlogin')->withErrors($validator);
            // The given data did not pass validation
        } else {


            //dd($input = Input::all());

            if (Auth::attempt([
                'username' => Input::get('username'),
                'password' => Input::get('password')

            ])
            ) {
                    return redirect('user_dash');

                //return 'succes';

            } else {
                $err = new MessageBag(['i' => ['Invaid Username or Password']]);

                return Redirect::back()->withErrors($err);

            }

        }

    }


    function userLogout(){

        if(Auth::logout()){
            return Redirect('user_login');
        }

    }



    function getDashUser(){
        if($this->checkUserLogin()){
                return view('user.userdash');
        }else{
            return Redirect('user_login');
        }
    }


    function getLeaveReq(){
        if($this->checkUserLogin()){
            return view('user.leaverequest');
        }else{
            return Redirect('user_login');
        }
    }


    function postLeaveReq(){
        if($this->checkUserLogin()){


          //  $name = Input::get();
            $validator = Validator::make(
                [
                    'name' => Input::get('name'),
                    'start_date' => Input::get('start_date'),
                    'end_date' => Input::get('end_date'),
                    'start_half' => Input::get('start_half'),
                    'end_half' => Input::get('end_half'),
                    'reason' => Input::get('reason'),

                    'number' => Input::get('mobno'),
                    'leave_type' => Input::get('leave_type')
                ],
                [
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'reason' => 'required',
                    'leave_type' => 'required',
                    'number' => 'required',
                ]
            );
            if ($validator->fails()) {
                //return 'validator fail';
                $messages = $validator->messages();
               /* $erUsername = $messages->first('username');
                $erPass = $messages->first('password');
                $erEmail = $messages->first('email'); */
                // dd($validator);
                return view('user.leaverequest')->withErrors($validator);
                // The given data did not pass validation
            } else {

                $startHalf = Input::get('start_half');
                $endHalf = Input::get('end_half');

                if($startHalf==null){
                    $startHalf = 0;
                }
                if($endHalf==null){
                    $endHalf =0;
                }

                $startDate = Input::get('start_date');
                $endDate = Input::get('end_date');
                $begin = new \DateTime( $startDate );
                $end = new \DateTime($endDate );
                $difference = $begin->diff($end);
                $days = $difference->days +1;

                if($startHalf==1){
                    $days = $days-0.5;
                }if($endHalf==1){
                    $days = $days-0.5;
                }
              //  dd($difference->days);

                $leaveModel = new Leaveapply();
                $leaveModel->empid = Auth::user()->id;
                $leaveModel->username = Auth::user()->username;

                $leaveModel->name = Input::get('name');
                $leaveModel->start_date = Input::get('start_date');
                $leaveModel->end_date = Input::get('end_date');
                $leaveModel->reason = Input::get('reason');
                $leaveModel->start_half = $startHalf;
                $leaveModel->end_half = $endHalf;
                $leaveModel->number = Input::get('mobno');
                $leaveModel->leave_type = Input::get('leave_type');;
                $leaveModel->status = 0;
                $leaveModel->totalleave = $days;


                $leaveModel->save();
                return view('user.leaverequest')->with('success','Employee Successfully saved');

            }



        }else{
            return Redirect('user_login');
        }
    }



}