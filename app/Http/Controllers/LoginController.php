<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendForgetPassword;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function checkLogin(Request $req){
        $Email      = $req->user_name;
        $PassWord   = $req->user_password;

        $CheckEmail = DB::table('91W2_users')->where('email',$Email)->first();

       
        if($CheckEmail != ""){
            $salt       = $CheckEmail->salt;
            $Passnew    = encode_pass($PassWord,$salt);

            $CheckLogin = DB::table('91W2_users')
                        ->where('email',$Email)
                        ->where('password',$Passnew)
                        ->where('active',1)
                        ->first();
  
            if($CheckLogin != ""){
                Auth::loginUsingId($CheckLogin->id,true);
   
                if (Auth::check()) {
                    DB::table('91W2_users')->where('id',$CheckLogin->id)->update(['last_login' => time()]);
                    
                    $data['status'] =  "Success";
                }else{
                    $data['status'] =  "Error";
                }
            }else{
                $data['status'] =  "PasswordError";
            }
        }else{
            $data['status'] =  "EmailError";
        }

        if(session()->has('cart')){
            $data['url'] = "/Checkout";
        }else{
            $data['url'] = "/";
        }
        
        return response()->json($data, 200);
    }

    public function logout(){        
        Auth::logout();
        return redirect('Login');
    }

    public function forget(){
        return view('forgetUser');
    }

    public function resetPass(Request $req){
        DB::beginTransaction();
        $email = $req->email;

        $CheckMail = DB::table('91W2_users')->where('email',$email)->orderByDesc('id')->first();
        if($CheckMail != ""){

            $data['Email'] = $CheckMail->email;
            $data['Pass']  = $CheckMail->password;
            $data['salt']  = $CheckMail->salt;
            try {
                Mail::to($CheckMail->email)->send(new SendForgetPassword($data));

                $log['email']       =   $CheckMail->email;
                $log['password']    =   $CheckMail->password;
                $log['salt']        =   $CheckMail->salt;
                $log['created_by']  =   $CheckMail->id;
                $log['created_time']=   now();

                $count = DB::table('91W2_Log_forget_pass')->insert($log);
  
                if($count > 1){
                    DB::rollback();
                }
                
                DB::commit();
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }else{
            return "Email Not Found";
        }
    }
    
     public function reset(){
        if(!isset($_GET['reset']) || !isset($_GET['u']) || !isset($_GET['e']) ){
            abort(404);
        }else{
            $Pass = $_GET['reset'];
            $salt = $_GET['u'];
            $email= base64_decode($_GET['e']);

            $CheckUser = DB::table('91W2_users')->where('email',$email)->where('password',$Pass)->where('salt',$salt)->first();
            if($CheckUser != ""){
                
                return view('resetPassword',compact('CheckUser','Pass','salt'));
            }else{
                abort(404);
            }
        }
    }

    public function ChagePass(Request $req){
        DB::beginTransaction();
        $Passold = $req->reset;
        $saltold = $req->u;
        $email   = $req->email;
        $PassNew = "";
        if($req->password == $req->password_conf){
            $saltNew = substr(md5(uniqid(rand(), true)), 0, 6);
            $PassNew = encode_pass($req->password,$saltNew);
        }
        if($PassNew != ""){
            try {
                $CheckUser = DB::table('91W2_users')
                        ->where('email',$email)
                        ->where('password',$Passold)
                        ->where('salt',$saltold)
                        ->update(['password'=>$PassNew,'salt'=>$saltNew]);
                if($CheckUser > 1){
                    DB::rollBack();
                    return "save fail";
                }else{
                    DB::commit();

                    $User =  DB::table('91W2_users') 
                            ->where('email',$email)
                            ->where('password',$PassNew)
                            ->where('salt',$saltNew)
                            ->first();

                    Auth::loginUsingId($User->id,true);
                    if(Auth::check()){
                        return "success";
                    }else{
                        return "fail login";
                    }    
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                return "save fail";
            }
        }else{
            return "fail Password";
        }
    }

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        $googleUser       =   Socialite::driver('google')->user(); 
        $email            =   $googleUser->email;
        $name             =   $googleUser->name;
        $register_by      =   "google";
        $checkAuth        =   $this->checkEmail($email,$name,$register_by);
        if ($checkAuth) {
            $log_login['u_id']          =  Auth::id();
            $log_login['login_by']      =  $register_by;
            $log_login['create_time']   =  now();
            DB::table('91W2_login_log')->insert($log_login);

            DB::table('91W2_users')->where('id',$checkAuth)->update(['last_login' => time()]);
            if(session()->has('cart')){
                return redirect('/CheckOut');
            }else{
                return redirect('/');
            }
        }
    }

    public function facebookLogin(){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback(){
        $facebook         =   Socialite::driver('facebook')->user(); 
        $email            =   $facebook->email;
        $name             =   $facebook->name;
        $register_by      =   "facebook";
        $checkAuth        =   $this->checkEmail($email,$name,$register_by);

        if ($checkAuth) {
            $log_login['u_id']          =  Auth::id();
            $log_login['login_by']      =  $register_by;
            $log_login['create_time']   =  now();
            DB::table('91W2_login_log')->insert($log_login);

            DB::table('91W2_users')->where('id',$checkAuth)->update(['last_login' => time()]);
            if(session()->has('cart')){
                return redirect('/CheckOut');
            }else{
                return redirect('/');
            }
        }
    }

    public function lineLogin(){
        // dd(env('LINE_CLIENT_ID'),env('LINE_CLIENT_SECRET'),env('LINE_REDIRECT_URI'));
        return Socialite::driver('line')->redirect();
    }

    public function lineCallback(){
        $line             =   Socialite::driver('line')->user(); 
        $email            =   $line->email;
        $name             =   $line->name;
        $register_by      =   "line";
        $checkAuth        =   $this->checkEmail($email,$name,$register_by);

        if (Auth::check()) {
            $log_login['u_id']          =  Auth::id();
            $log_login['login_by']      =  $register_by;
            $log_login['create_time']   =  now();
            DB::table('91W2_login_log')->insert($log_login);

            DB::table('91W2_users')->where('id',$checkAuth)->update(['last_login' => time()]);
            if(session()->has('cart')){
                return redirect('/CheckOut');
            }else{
                return redirect('/');
            }
        }
    }


    public function checkEmail($email,$username,$register_by){
        $Check_user =   DB::table('91W2_users')->where('email',$email)->orWhere('username',$username)->first();
        // dd($Check_user);
        $salt       =   substr(md5(uniqid(rand(), true)), 0, 6);
        $password   =   encode_pass('123456',$salt);
       
        if($Check_user == ""){  
            
            $data['email']      = Str::lower($email);
            $data['password']   = $password;
            $data['salt']       = $salt;
            $data['group_id']   = "2";
            $data['active']     = "1";
            $data['created_on'] = time();
            $data['last_login'] = time();
            $data['username']   = $username;
            $data['points']     = 0;
            $data['api']        = 0;
            $data['register_by'] = $register_by;
           
            $id = DB::table('91W2_users')->insertGetId($data);

            $user = DB::table('91W2_users')->where('id',$id)->where('Api_status','N')->first();
            if($user != ""){
               
                $data['u_id']           = $id;
                $data['prefix']         = "คุณ";
                $data['email']          = $email;
                $data['phone_number']   = "-";
                $data['name']           = "-";
                $data['lastname']       = "-";
                $data['password']       = $password;
                $data['s_id']           = "0";
                $data['salt']           = $salt;
                $data['username']       = $username;
                $data['address']        = "-";
                $data['referable_id']   = $id;

                $data = json_encode($data,true);
                $ch = curl_init();
                    
                curl_setopt($ch,CURLOPT_PORT,'9090');
                curl_setopt($ch, CURLOPT_URL,'http://www.api.jtpackconnect.com:9090/api/user');
                
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
                curl_setopt($ch, CURLOPT_TIMEOUT, 20);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10); 
                curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Content-Length: ' . strlen($data)));
                $server_output = curl_exec($ch);
                
                $error  =  curl_error($ch);
            
                curl_close ($ch);
                $res_1 = json_decode($server_output);
                if($res_1->success){
                    DB::table('91W2_users')->where('id',$id)->update(['Api_status'=>'Y']);
                }
            }
            Auth::loginUsingId($id,true);
            $res_id = $id;
        }else{
            $res_id  = $Check_user->id;
            Auth::loginUsingId($Check_user->id,true);
        }     
        return $res_id;
       
    }

}
