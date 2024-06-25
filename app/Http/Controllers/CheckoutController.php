<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends AutoProviceController
{
    public function index(){

        $province = $this->GetProvince();

        return view('checkout.checkout',compact('province'));
    }
}
