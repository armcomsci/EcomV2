<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function getProfile(){
        $getProfile = DB::table('91W2_profiles')
                        ->select('display_name','first_name','last_name','mobile')
                        ->where('user_id',Auth::id())
                        ->get();
        return $getProfile;
    }
}
