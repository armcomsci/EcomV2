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

    public function checkPrice(Request $req){
        $deliver_id = $req->id;
        $status     = $req->status;
        // dd($req);
        if($status == "Old"){
            $addr = DB::table('91W2_firesale_addresses')->where('id',$req->address_id)->first();
           
            $province = $addr->county;
        }elseif($status == "New"){
            $province = $req->address_id;
        }

        if($deliver_id == 1){

            $Deliver = DB::table('91W2_province')->select('DeliverPrice')->where('PROVINCE_NAME',$province)->first();

            $price   = $Deliver->DeliverPrice;

        }elseif($deliver_id == 2){

            $data = DB::table('91W2_config_deliver')->select('area_send','price')->where('id',$deliver_id)->first();
            $price = $data->price;

            $areaSend = json_decode($data->area_send,true);
            
            if(!in_array($province,$areaSend)){
                $data1['price']  = 0;
                $data1['county'] = $province;
                $data1['status'] = 'Area Error';

                return response()->json($data1);
            }

        }

        $cart = session()->get('cart');
        foreach ($cart as $key => $value) {
            $qty[] = $value['quantity'];
        }
        $SumQty = array_sum($qty);


        session()->put("shipping", $price);
        session()->put("shipping_id", $deliver_id);

        $data1['price']  = $price;
        $data1['county'] = $province;
        $data1['status'] = 'success';
       
        // $data2           = json_decode($data1,true);
      
        return response()->json($data1);
    }

    public function useCode(Request $req){
  
        $DateTime  = time();

        $Coupon     = $req->code;
        if($Coupon == ""){
            session()->forget("discount");
            return "Clear code";
        }
        if(auth()->check()){
            $user_id   = auth()->id();
        }else{
            $user_id  = 0;
        }

        $CheckCode  = DB::table('91W2_firesale_discount_codes')
                        ->where('code',$Coupon)
                        ->where('used','y')
                        ->orWhere('start','>=',$DateTime)
                        ->where('end','<=',$DateTime)
                        ->first();

        if($CheckCode != ""){
            $CodeFlag = false;
            // $Cart = session()->get('cart');
            $CodeForUser      = explode(',',$CheckCode->for_user);
            $CodeForProduct   = explode(',',$CheckCode->products);
            $CodeForCate      = explode(',',$CheckCode->categories);

            if($CheckCode->for_user == "" && ($CheckCode->products != "" && $CheckCode->categories != "")){
               
                $cart = session()->get('cart');
                foreach ($cart as $key => $value) {
                    if(in_array($key,$CodeForProduct) || in_array($value['categories_id'],$CodeForCate)){
                        $CodeFlag = true;
                        break;
                    }else{
                        $CodeFlag = false;
                    }
                }

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->for_user == "" && ($CheckCode->products == "" && $CheckCode->categories != "")){
               
                $cart = session()->get('cart');
                foreach ($cart as $key => $value) {
                    if(in_array($value['categories_id'],$CodeForCate)){
                        $CodeFlag = true;
                        break;
                    }else{
                        $CodeFlag = false;
                    }
                }

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->for_user == "" && ($CheckCode->products != "" && $CheckCode->categories == "")){
               
                $cart = session()->get('cart');
                foreach ($cart as $key => $value) {
                    if(in_array($key,$CodeForProduct)){
                        $CodeFlag = true;
                        break;
                    }else{
                        $CodeFlag = false;
                    }
                }

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->for_user != "" && ($CheckCode->products != "" && $CheckCode->categories != "")){
               
                if(in_array($user_id,$CodeForUser)){
                    $CodeFlag = true;
                    $cart = session()->get('cart');
                    foreach ($cart as $key => $value) {
                        if(in_array($key,$CodeForProduct) || in_array($value['categories_id'],$CodeForCate)){
                            $CodeFlag = true;
                            break;
                        }else{
                            $CodeFlag = false;
                        }
                    }
                }

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->for_user != "" && ($CheckCode->products == "" && $CheckCode->categories != "")){
              
                if(in_array($user_id,$CodeForUser)){
                    $CodeFlag = true;
                    $cart = session()->get('cart');
                    foreach ($cart as $key => $value) {
                        if(in_array($value['categories_id'],$CodeForCate)){
                            $CodeFlag = true;
                            break;
                        }else{
                            $CodeFlag = false;
                        }
                    }
                }

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->for_user != "" && ($CheckCode->products != "" && $CheckCode->categories == "")){
             
                if(in_array($user_id,$CodeForUser)){
                    $CodeFlag = true;
                    $cart = session()->get('cart');
                    foreach ($cart as $key => $value) {
                        if(in_array($key,$CodeForProduct)){
                            $CodeFlag = true;
                            break;
                        }else{
                            $CodeFlag = false;
                        }
                    }
                }

               

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->for_user != "" && ($CheckCode->products == "" && $CheckCode->categories == "")){
               
                if(in_array($user_id,$CodeForUser)){
                    $CodeFlag = true;
                }

                if($CodeFlag){
                    $discount['id']     =   $CheckCode->id;
                    $discount['code']   =   $CheckCode->code;
                    $discount['value']  =   $CheckCode->value;
                    $discount['type']   =   $CheckCode->type;
                    session()->put("discount", $discount);
                }else{
                    session()->forget("discount");
                    return "Can't use for user";
                }
            }

            if($CheckCode->usage != "multiple" && $CodeFlag){
                $UseCode = DB::table('91W2_firesale_orders')->where('code_used',$CheckCode->id)->where('created_by',$user_id)->count();
                if($UseCode != "0"){
                    session()->forget("discount");
                    return "Code Can't use";
                }
            }
            Session()->save();
            return response()->json($CheckCode);
        }else{
            session()->forget("discount");
            return "Code Not Found";
        }
    }

   
}
