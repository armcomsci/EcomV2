<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        dd($googleUser);
    }
}
