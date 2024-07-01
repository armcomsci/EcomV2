<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends AutoProviceController
{
    public function index(){

        $province               = $this->GetProvince();

        $DeliverTypeSend        = DB::table('91W2_config_deliver')->where('status_use','Y')->get();

        return view('checkout.checkout',compact('province','DeliverTypeSend'));
    }
}
