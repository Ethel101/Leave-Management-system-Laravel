<?php namespace App\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Muneef
 * Date: 09/11/16
 * Time: 15:07
 */

use App\User;

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



}