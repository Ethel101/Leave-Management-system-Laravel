<?php namespace App\Http\Controllers;



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
class AdminController extends Controller
{

    public function __construct()
    {

    }

    function test(){
       return view('admin.test');
    }

    function populateUser(){

        $demoUser = new User();
        $demoUser->name = 'demo user';
        $demoUser->username = 'demo';
        $demoUser->level = '1';

        $demoUser->password  = Hash::make('pass');
        $demoUser->save();



    }

    function checkAdmin(){
        if(Auth::check()&&Auth::user()->level=='1'){
            return true;
        }else{
            return false;
        }
    }

    function redirectAdminLogin(){
        return Redirect('admin_login');
    }



    function adminLoginGet(){
        if($this->checkAdmin()){

            return Redirect('admin_dashboard');
        }else{
        return view('admin.adminlogin');
        }
    }

    function adminLoginPost(){

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
                if(Auth::user()->level == '1') {
                    return redirect('admin_dashboard');
                }else{
                    $err1 = new MessageBag(['i' => ['Not enough permission to access admin panel']]);
                    return Redirect('admin_login')->withErrors($err1);
                }
                //return 'succes';

            } else {
                $err = new MessageBag(['i' => ['Invaid Username or Password']]);

                return Redirect::back()->withErrors($err);

            }
        }

    }



        function adminDashGet(){
            if($this->checkAdmin()){
                return view('admin.dashboard');
            }else{
               return  $this->redirectAdminLogin();
            }

    }


    function userLogout(){
        Auth::logout();
        return Redirect('admin_login');
    }

    function addEmployee(){

        if($this->checkAdmin()){
           return view('admin.addemp');
        }else{
            return Redirect('admin_login');
        }

    }

    function addEmployeePost()
    {
        if ($this->checkAdmin()) {
            $name = Input::get();
            $validator = Validator::make(
                [
                    'name' => Input::get('name'),
                    'designation' => Input::get('designation'),
                    'duty' => Input::get('duty'),
                    'note' => Input::get('note'),
                    'email' => Input::get('email'),
                    'admin' => Input::get('admincheck'),

                    'password' => Input::get('password'),
                    'username' => Input::get('username')
                ],
                [
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:3',
                    'username' => 'required|unique:users'
                ]
            );
            if ($validator->fails()) {
                //return 'validator fail';
                $messages = $validator->messages();
                $erUsername = $messages->first('username');
                $erPass = $messages->first('password');
                $erEmail = $messages->first('email');
                // dd($validator);
                return view('admin.addemp')->withErrors($validator);
                // The given data did not pass validation
            } else {

                    $admin = Input::get('admincheck');
                if($admin==null){
                    $admin = 0;
                }

            $user = new User();
                $user->name = Input::get('name');
                $user->designation = Input::get('designation');
                $user->duty = Input::get('duty');
                $user->note = Input::get('note');
                $user->username = Input::get('username');
                $user->password = Hash::make(Input::get('password'));
                $user->email = Input::get('email');
                $user->level = $admin;

                if(Input::hasFile('proimg')){
                    $imageFile = Input::file('proimg');
                    $filename = time() . '-profile_photo' . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->move('profileimg', $filename);
                    $ext = $imageFile->getClientOriginalExtension();
                   $user->image = $filename;
                }

                $user->save();
                return view('admin.addemp')->with('success','Employee Successfully saved');

            }
        }
    }

    function deleteEmployees(){
        if($this->checkAdmin()){
            $inputId = Input::get('id');
            if($inputId!=null){
                DB::table('users')->where('id',$inputId)->delete();
            }
            return Redirect('admin_dashboard');
        }else{
         return   $this->redirectAdminLogin();
        }
    }

    function getProfileView(){
        if($this->checkAdmin()){
            $id = Input::get('id');
            $users = DB::table('users')->where('id',$id)->first();
            return view('admin.empdetails')->with('uId',$id);
        }else{
            return $this->redirectAdminLogin();
        }
    }

    function  getUpdateEmp(){

        if($this->checkAdmin()){
        $eid = Input::get('eid');
        if($eid!=null){
            return view('admin.editemp')->with('eid',$eid);
        }
        }else{
            return $this->redirectAdminLogin();
        }
    }

    function  postUpdateEmp(){

        if($this->checkAdmin()){
            $eid = Input::get('eid');
            $validator = Validator::make(
                [
                    'name' => Input::get('ename'),
                    'designation' => Input::get('edesignation'),
                    'duty' => Input::get('eduty'),
                    'note' => Input::get('enote'),
                    'email' => Input::get('eemail'),
                    'admin' => Input::get('eadmincheck'),

                    'password' => Input::get('epassword'),
                    'username' => Input::get('eusername')
                ],
                [

                    'email' => 'required|email|unique:users,email,'.$eid,
                    'password' => 'required|min:3',
                    'username' => 'required|unique:users,username,'.$eid
                ]
            );
            if ($validator->fails()) {
                //return 'validator fail';
                $messages = $validator->messages();
                $erUsername = $messages->first('username');
                $erPass = $messages->first('password');
                $erEmail = $messages->first('email');
                // dd($validator);
                return view('admin.addemp')->withErrors($validator);
                // The given data did not pass validation
            } else {

                $admin = Input::get('eadmincheck');
                if ($admin == null) {
                    $admin = 0;
                }
                $filename = "";
                if(Input::hasFile('eproimg')){
                    $imageFile = Input::file('proimg');
                    $filename = time() . '-profile_photo' . '.' . $imageFile->getClientOriginalExtension();
                    $imageFile->move('profileimg', $filename);
                    $ext = $imageFile->getClientOriginalExtension();

                }


                $updateData = [['name'=>Input::get('ename')],['designation'=>Input::get('edesignation')],['duty'=>Input::get('eduty')],['note'=>Input::get('enote')],['email'=>Input::get('eemail')],['username'=>Input::get('eusername')],
                ['password'=>Hash::make(Input::get('epassword'))],['level'=>Input::get('eadmin')],['image'=>$filename]];
                $updateDataA = ['name'=>Input::get('ename'),'designation'=>Input::get('edesignation'),'duty'=>Input::get('eduty'),'note'=>Input::get('enote'),'email'=>Input::get('eemail'),'username'=>Input::get('eusername'),
                    'password'=>Hash::make(Input::get('epassword')),'level'=>Input::get('eadmin'),'image'=>$filename];
                DB::table('users')->where('id',$eid)->update($updateDataA);

                return Redirect('emp_detail?id='.$eid);


            }
        }else{
            return $this->redirectAdminLogin();
        }
    }


    function getLeaveRequest(){
        if($this->checkAdmin()){
            return view('admin.listleaverequest');
        }else{
            return Redirect('admin_login');
        }
    }


    function  getLeaveAction(){
        if($this->checkAdmin()){
            $var = Input::get('var');
            if($var == 2){
                $id = Input::get('id');
                if($id!=null){
                $act = Input::get('act');
                    if($act!=null){
                if($act == 1){
                    DB::table('leaveapply')->where('id',$id)->update(['status'=>1]);
                }elseif($act == 2){
                    DB::table('leaveapply')->where('id',$id)->update(['status'=>2]);
                }
                    }
            }
            }
            return Redirect('admin_leaves');
        }else{
            return Redirect('admin_login');
        }
    }


}