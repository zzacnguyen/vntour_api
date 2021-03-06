<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\usersModel;
use Auth;
use Validator;
use DB;
use Hash;
use Socialite;
use App\contact_infoModel;
use App\persionalUserModel;
use App\PointUserModel;
use App\tourguideModel;
class loginController extends Controller
{
    // web 
    public function postLoginW(Request $request)
    {
        $messages = [
            'required' => 'Trường bắt buộc nhập',
            'username.min'    => 'Tài khoản có độ dài từ 4-20 ký tự'
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4',
            'password' => 'required'
        ],$messages);
        if ($validator->fails()) {
            return redirect('loginW')->withErrors($validator)->withInput();
        } 
        else 
        {
            $username = $request->input('username');
            $pass = $request->input('password');
            if( Auth::attempt(['username' => $username, 'password' => $pass])) {
                return redirect('/');
                // return Auth::user()->user_id;
            } else {
                return redirect()->back()->with(['erro'=>'Tên tài khoản hoặc mật khẩu không đúng','userold'=>$username]);
            }
        }
    }

    public function logoutW()
    {
        Auth::logout();
        return redirect('/');
    }

    public function registerW(Request $request)
    {
        $user = $request->input('username');
        $pass     = $request->input('password');
        $passold     = $request->input('passwordC');

        $messages = [
            'username.email'        => 'Không đúng định dạng email',
            'password.min'    => 'Tài khoản có độ dài từ 4-20 ký tự',
            'password.max' => 'sdsdsdsd',
            'username.min' => 'sdsdsd'
        ];
        $validator = Validator::make($request->all(), [
            'username' => 'min:4',
            'username' => 'max:20',
            'password' => 'required:min:4',
            'password' => 'required:max:20'
        ],$messages);
        if ($validator->fails()) {
            return -1; // validate
        } 
        elseif ($this->check_username_existW($user)) {
            return -2;
        }
        elseif($pass != $passold){
            return -3;
        }
        else 
        {
            $username = $request->input('username');
            $pass     = $request->input('password');
            $userRegister                      = new usersModel();
            $userRegister->username            = $user;
            $userRegister->password            = bcrypt($pass);
            $userRegister->save();

            $lam = usersModel::where('username',$username)->first();

            $id_user = $lam->user_id;
            $contact = new contact_infoModel();
            $contact->user_id = $id_user;
            // $contact->save();

            $per = new persionalUserModel();
            $per->user_id = $lam->user_id;
            $per->account_active = 1;
            $per->save();

            $point = new PointUserModel();
            $point->point_now = 0;
            $point->point_exchanged = 0;
            $point->point_total = 0;
            $point->user_id = $id_user;
            $point->save();
            
            if ($contact->save()) {
                return 1;
            }
            else{
                return -4;
            }
            
        }
    }

    function check_username_existW($user){
        $result = DB::table('vnt_user')
                        ->select('username')
                        ->where('username',$user)
                        ->get();
        foreach ($result as $value) {
            $erro = $value;
        }
        if (isset($erro))
            return true;
        else
            return false;  
    }
    // login facebook
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        // dd($user);
        $social = usersModel::where('user_facebook_id',$user->id)->orWhere('username',$user->email)->first();
        if ($social) {
            Auth::login($social);
            return redirect('/');
        }
        else{
            $u = usersModel::create([
                'username'         => $user->email,
                'user_facebook_id' => $user->id,
                'user_groups_id'   => 1
            ]);
            $u->save();
            Auth::login($u);
            return redirect('/');
        }
    }

    // app
    public function postLogin(Request $request)
    {
        $rules = [
            'username' =>'required',
            'password' => 'required|min:4'
        ];
   
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $erro = array('result' => null,'error' => 2, 'status' => 'ERROR');
            return json_encode($erro);
        } 
        else 
        {
            $username = $request->input('username');
            $pass = $request->input('password');
            if( Auth::attempt(['username' => $username, 'password' =>$pass])) {

                // $contact = DB::select('CALL login_info(?)',array(Auth::user()->user_id));
                $result = DB::select('CALL login_info_phone(?)',array(Auth::user()->user_id));
                // dd($result);
                $level = array(); // personal
                foreach ($result as $result) {
                    if ($result->admin != null ) {
                        $level[] = 6; // admin
                    }
                    if($result->moderator != null && $result->active_mod == 1){
                        $level[] = 5; // moderator
                    }
                    if($result->partner != null && $result->active_partner == 1){
                        $level[] = 4; // partner
                    }
                    if($result->enterprise != null && $result->active_enter == 1){
                        $level[] = 2; // enterprise
                    }
                    if($result->tour_guide != null && $result->active_tour == 1){
                        $level[] = 3; // tour_guide
                    }
                    if($result->personal != null && $result->active_personal == 1){
                        $level[] = 1;
                    }

                    $result_info = array(
                        'id'       => $result->user_id,
                        'username' => $result->username,
                        'fullname' => $result->contact_name,
                        'avatar'   => $result->contact_avatar,
                        'level'    => $level
                    );
                    
                }
                $result_user['result'] = $result_info;  
                $result_user['error'] = null;
                $result_user['status'] = "OK";
                return json_encode($result_user);
            } else {
                $erro = array('result' => null,'error' => 1, 'status' => 'ERROR');
                return json_encode($erro);
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        if (!Auth::check()) {
            $logout = array('error' => null, 'status' => 'OK');
            return json_encode($logout);
        }
    }
    public function logout_api()
    {
        // if (Auth::check()) {
        //     $user = Auth::logout();
        //     return "Bạn đã đăng xuất"; 
        // }
        // else
        //     echo "loi";
        $user = Auth::user();
        $user->remember_token = null;
        $user->save();
        return ("Bạn đã đăng xuất"); 
    }

    public function register(Request $request)
    {
        // $erro = (
        //     '1' => 'Tên tài khoản và mật khẩu không được để trống',
        //     '2' => 'Mật khẩu phải có độ dài từ 6-20 ký tự',
        //     '3' => 'Tên tài khoản đã tồn tại',
        //     '4' => 'Tài khoản có độ dài từ 5-25 ký tự',
        //     '5' => 'Đăng ký thành công'
        // )

        $user = $request->input('username');
        $password = $request->input('password');
        $country  = $request->input('country');
        $language  = $request->input('language');
 
        if (empty($user) || empty($password)) // kiểm tra rỗng
            $erro['error'] = 1;
        else if (strlen($password) < 6 || strlen($password) > 20) //kiểm tra độ dài pass
            $erro['error'] = 2;
        else if (strlen($user) < 5 || strlen($user) > 25) // kiểm tra độ dài tên tài khoản
            $erro['error'] = 4;
        else if ($this->check_username_exist($user) == "false") // kiểm tra tài khoản tồn tại
            $erro['error'] = 3;
        if (isset($erro)) {
            $erro['status'] = "ERROR";
            return json_encode($erro);
        }
        else
        {
            $userRegister                      = new usersModel();
            $userRegister->username      	   = $user;
            $userRegister->password            = bcrypt($password);
            
            if ($userRegister->save()) {
                $lam = usersModel::where('username',$user)->first();

                $id_user = $lam->user_id;
                $contact = new contact_infoModel();
                $contact->user_id = $id_user;
                $contact->save();

                $per = new persionalUserModel();
                $per->user_id = $lam->user_id;
                $per->account_active = 1;
                $per->save();

                $point = new PointUserModel();
                $point->point_now = 0;
                $point->point_exchanged = 0;
                $point->point_total = 0;
                $point->user_id = $id_user;
                $point->save();

                $erro = array('error' => null, 'status' => 'OK');
                return json_encode($erro);
            }
            else
            {
                $erro = array('error' => 6, 'status' => 'ERROR');
            }   
        }
    }

    function check_username_exist($user){
        $result = DB::table('vnt_user')
                        ->select('username')
                        ->where('username',$user)
                        ->get();
        foreach ($result as $value) {
            $erro = $value;
        }
        if (isset($erro))
            return "false";
        else
            return "true";  
    }

    public function checkUserSocial($idSocial,$email)
    {
        // $u = usersModel::where('social_login_id',$idSocial)->orWhere('username',$email)->first();
        $u = DB::table('vnt_user')->join('vnt_contact_info', 'vnt_user.user_id', '=', 'vnt_contact_info.user_id')
            ->where('social_login_id',$idSocial)->orWhere('contact_email_address',$email)->first();
        return json_encode($u);
    }

    public function registerSocial(Request $request)
    {
        $user            = $request->input('username');
        $pass            = $request->input('password');
        $social_login_id = $request->social_login_id;
        try 
        {
            $username = $request->input('username');
            $pass     = $request->input('password');
            $userRegister                      = new usersModel();
            $userRegister->username            = $user;
            $userRegister->password            = bcrypt($pass);
            $userRegister->social_login_id            = $social_login_id;
            $userRegister->save();

            $lam = usersModel::where('username',$username)->first();

            $id_user = $lam->user_id;
            $contact = new contact_infoModel();
            $contact->user_id = $id_user;
            $contact->contact_email_address = $username;
            // $contact->save();

            $per = new persionalUserModel();
            $per->user_id = $lam->user_id;
            $per->account_active = 1;
            $per->save();

            $point = new PointUserModel();
            $point->point_now = 0;
            $point->point_exchanged = 0;
            $point->point_total = 0;
            $point->user_id = $id_user;
            $point->save();
            
            if ($contact->save()) {
                return 1;
            }
        } catch (Exception $e) {
            return -1;
        }
            
    }

    public function getInfoUserSocial($user_id){
        $result = DB::select('CALL login_info_phone(?)',array($user_id));
        // dd($result);
        $level = array();
        foreach ($result as $result) {
            if ($result->admin != null) {
                $level[] = 1;
            }
            if($result->moderator != null && $result->active_mod == 1){
                $level[] = 2;
            }
            if($result->partner != null && $result->active_partner == 1){
                $level[] = 3;
            }
            if($result->enterprise != null && $result->active_enter == 1){
                $level[] = 4;
            }
            if($result->tour_guide != null && $result->active_tour == 1){
                $level[] = 5;
            }

            $result_info = array(
                'id' => $result->user_id,
                'username' =>$result->username,
                'avatar' =>$result->contact_avatar,
                'level' =>$level
            );
        }
        return json_encode($result_info);
    }

    public function login_admin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if( Auth::attempt(['username' => $username, 'password' => $password])) {
            $user = Auth::user();
                
            $result = DB::select('CALL login_info_phone(?)',array(Auth::user()->user_id));
                $flag = false;
                $level = array();
                foreach ($result as $result) {
                    if ($result->admin != null) {
                        $flag = true;
                        $level = 1;
                    }
                    elseif ($result->moderator != null && $result->active_mod == 1) 
                    {
                        $flag = true;
                        $level = 2;
                    }

                    $result_info = array(
                        'id' => $result->user_id,
                        'username' =>$result->username,
                        'avatar' =>$result->contact_avatar,
                        'level' =>$level
                    );
                }
            if ($flag) {
                Session()->put('login',true);  
                Session()->put('user_info',$result_info);
                return redirect('lvtn-dashboard');
            }
            else{
                return redirect('lvtn-login');
            } 
                
        } 
        else {
            return redirect()->back()->with(['erro'=>'Tên tài khoản hoặc mật khẩu không đúng','userold'=>$username]);
        }
    }

}
