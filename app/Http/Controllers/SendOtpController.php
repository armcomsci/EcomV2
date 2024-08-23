<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\SendOtp;

class SendOtpController extends Controller
{
    //
    public function sendOtpSMS(Request $req){
        $phone = $req->phone;

        DB::beginTransaction();
        $check_status = DB::table('91W2_profiles')
                        ->select('otp_status','mobile')
                        ->where('user_id',Auth::id())
                        ->first();
    
        if($check_status->otp_status == "N"){
            if($phone == ""){
                $phone                  =   $check_status->mobile;
            }
            $phone = '0925936985';
            $sms                        =   sms_otp($phone);
            $sms['otp_confirm']			=	"N";
            json_encode($sms,true);
            return   response()->json($sms);

        }else if($check_status->otp_status == "Y"){
            $result1['otp_confirm']			=	"Y";
            $result_code	                =	json_encode($result1,true);
            return   response()->json($result_code);
        }
        
    }

    public function validate_otp(Request $req){
        DB::beginTransaction();

        $token  = $req->token_otp;
        $ref    = $req->ref_otp;
        $otp    = $req->otp;

        $check       = validate_otp($token,$otp,$ref);
        // dd($check);
        if($check['status_code'] == '000'){
            $update =  DB::table('91W2_profiles')->where('user_id',auth()->id())->update(['otp_status'=>'Y']);
            if($update > 1){
                DB::rollBack();
                return "fail";
            }else{
                DB::commit();
                return   response()->json($check);
            }            
        }else{
            DB::rollBack();
            return response()->json($check);
        }
    }

    public function sendOtpEmail(Request $req){
        DB::beginTransaction();
        try {
            $otp        =   mt_rand(100000, 999999);
            if($req->email != ""){
                $email      =   $req->email;
            }else{
                $email      =   Auth::user()->email;
            }
          
            $id         =   Auth::id();
            $saltNew    =   substr(md5(uniqid(rand(), true)), 0, 6);
    
            $openTime   = Carbon::now();
            $closeTime  = Carbon::parse($openTime)->addMinutes(6);
            
            $OTP['user_id']     = $id;
            $OTP['email']       = $email;
            $OTP['otp']         = $otp;
            $OTP['ref']         = $saltNew;
            $OTP['req_time']    = now();
            $OTP['expire_time'] = $closeTime;
            DB::table('91W2_Email_otp')->insert($OTP);
            DB::commit();
            
            Mail::to($email)->send(new SendOtp($OTP));
    
            $data['status'] = "success";
            $data['ref']    = $saltNew;
            $data['email']  = $email;
    
            return response()->json($data, 200);
    
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th;
        }      
    }

    public function confirmEmail(Request $req){
        DB::beginTransaction();
        try {
            $otpEmail   =   $req->otpEmail;
            $ref_email  =   $req->ref_otp_email;
            $id         =   Auth::id();
            // $openTime   =   Carbon::now()->format('Y-m-d H:i:s');
            // dd($otpEmail,$ref_email,$id,$openTime);
            $CheckOtp = DB::table('91W2_Email_otp')
                // ->whereRaw("expire_time <= '$openTime'  ")
                ->where(
                    [
                        'user_id'=> $id,
                        'ref'=> $ref_email,
                        'otp' => $otpEmail
                    ]
                )
                ->first();

            // dd($CheckOtp);
            if($CheckOtp != ""){
                
                DB::table('91W2_Email_otp')->where('id',$CheckOtp->id)->update(['status'=>'Y']);
                DB::table('91W2_profiles')->where('user_id',auth()->id())->update(['otp_status'=>'Y']);

                DB::commit();
                $data['status'] = 'success'; 

            }else{
                $data['status'] = 'error'; 
            }

            return response()->json($data, 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            $data['status'] = 'error2';

            return response()->json($data, 500);
        }      
    }
}
