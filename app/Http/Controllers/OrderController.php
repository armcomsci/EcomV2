<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function saveOrder(Request $req){
        // dd($req);
        DB::beginTransaction();

        $CheckStock = $this->CheckStock();
        // dd($CheckStock);
        if(!$CheckStock['status'] === true ){
            return $CheckStock;
        }elseif($CheckStock['status']){
           
            $FromAddr       = $req['FormAddress'];
            $FormTypeSend   = $req['FormTypeSend'];
            $FormPayment    = $req['FormPayment'];
            $user_id        = Auth::id();  
   
            if($FromAddr[0]['name'] == "Address_ship"){
                // ลูกค้าเก่า
                $Id_address = $FromAddr[0]['value'];
            }else{
                $name                   =     $FromAddr[0]['value'];
                $lastname               =     $FromAddr[1]['value'];
                $email                  =     $FromAddr[2]['value'];
                $tel                    =     $FromAddr[3]['value'];
                $ship_addr              =     $FromAddr[4]['value'];
                $ship_province          =     $FromAddr[5]['value'];
                $ship_district          =     $FromAddr[6]['value'];
                $ship_subDistrict       =     $FromAddr[7]['value'];
                $ship_postcode          =     $FromAddr[8]['value'];

                $addr['created']        = now();
                $addr['firstname']      = $name;
                $addr['lastname']       = $lastname;
                $addr['email']          = $email;
                $addr['phone']          = $tel;
                $addr['address1']       = $ship_addr;
                $addr['subDistrict']    = $ship_subDistrict;
                $addr['city']           = $ship_district;
                $addr['county']         = $ship_province;
                $addr['postcode']       = $ship_postcode;

                $LastAddId  =  DB::table('91W2_firesale_addresses')->insertGetId($addr);

                $checkProfile = DB::table('91W2_profiles')->where('user_id',$user_id)->count();

                if($checkProfile == 0){
                    $profile['display_name']    = $name.' '.$lastname;
                    $profile['first_name']      = $name;
                    $profile['last_name']       = $lastname;
                    $profile['mobile']          = $tel;
                    $profile['user_id']         = $user_id;
                    $profile['created']         = now();
                    $profile['updated']         = now();
                    $profile['created_by']      = $user_id;

                    DB::table('91W2_profiles')->insert($profile);
                }

                $Id_address = $LastAddId;
            }


            $PriceSum[] = 0;
            if(session()->has('cart')){
                $Carts = session()->get('cart');
                foreach ($Carts as $key => $value) {
                    $PriceSum[] = $value['product_price']*$value['quantity'];
                }
            }

            $shipping   = session()->get('shipping');

            $Sum        =   array_sum($PriceSum);
            $PriceTax   =   $Sum-($Sum*0.07);

            $order['created']           =   now();
            $order['updated']           =   now();
            $order['created_by']        =   $user_id;
            $order['ordering_count']    =   0;
            $order['ip']                =   $req->ip();
            $order['gateway']           =   20;
            $order['order_status']      =   1;
            $order['price_sub']         =   $PriceTax;
            $order['price_ship']        =   0;
            $order['price_total']       =   $Sum;
            $order['currency']          =   1;
            $order['exchange_rate']     =   1;
            $order['ship_to']           =   $Id_address;
            $order['bill_to']           =   $Id_address;
            $total2 = 0;
            if(session()->has('discount')){
                $Code     =  session()->get('discount');
                $id       =  $Code['id'];

                if($Code['type'] == "fixed"){
                    $sum_discount   = $Code['value'];
                }else{
                    $sum_discount   = ($Code['value']/100)*$Sum;
                }      
                $total2 = $sum_discount;

                $order['code_used']     = $id;   
                $order['discount_total_price'] = $total2;   
            }
            $order['deliver_method']    =   $FormTypeSend;
            $order['shipping_cost']     =   $shipping;
            $order['shipping']          =   8;
            $order['payment_by']        =   $FormPayment;
            $order['status_tel']        =   "ไม่ต้องการ";

            $idOrder = DB::table('91W2_firesale_orders')->insertGetID($order);  

            foreach ($Carts as $key => $value) {
                // $p_id[] = $key;
                $OrderDT['created']         = now();
                $OrderDT['updated']         = now();
                $OrderDT['created_by']      = $user_id;
                $OrderDT['ordering_count']  = 0;
                $OrderDT['order_id']        = $idOrder;
                $OrderDT['product_id']      = $value['product_id'];
                $OrderDT['code']            = $value['product_code'];
                $OrderDT['name']            = $value['product_name'];
                $OrderDT['price']           = $value['product_price'];
                $OrderDT['price_m3']        = $value['product_price_m3'];
                $OrderDT['qty']             = $value['quantity'];
                $OrderDT['type_product']    = "original";
                try {
                    DB::table('91W2_firesale_orders_items')->insert($OrderDT);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return $th->getMessage();
                }     
            }
            
            session()->forget("cart");

            DB::commit();
            // $idOrder =  rand(10,10000);
            if($FormPayment == "Thai QR Cash"){

                $genQr = $this->GenerateQRcode($Sum,$idOrder);

                return view('checkout.thai_qr',compact('genQr','idOrder'))->render();

            }elseif($FormPayment == "บัตรเครดิต"){

                return view('checkout.credit_card',compact('Sum','idOrder'))->render();
            }
          
            // $line_name      =   $Address->firstname." ".$Address->lastname;
            // $line_address   =   $Address->address1." ".$Address->city." ".$Address->county." ".$Address->postcode;
            // $line_phone     =   $profiles->mobile;

            // return view('checkout.thai_qr',compact('idOrder','Sum','customerName','customerEmail'))->render();
        }

        
    }

    public function reOrder(Request $req){ 
        $orderId = $req->orderId;

        session()->forget("cart");

        $Order = DB::table('91W2_firesale_orders_items')
                ->join('91W2_firesale_products','91W2_firesale_orders_items.product_id','=','91W2_firesale_products.id')
                ->join('91W2_firesale_products_firesale_categories','91W2_firesale_orders_items.product_id','=','91W2_firesale_products_firesale_categories.row_id')
                ->select('91W2_firesale_products.title'
                        ,'91W2_firesale_products.id'
                        ,'91W2_firesale_products.slug'
                        ,'91W2_firesale_products.code'
                        ,'91W2_firesale_products.price'
                        ,'91W2_firesale_products.price_m3'
                        ,'91W2_firesale_products_firesale_categories.firesale_categories_id')
                ->where('91W2_firesale_orders_items.order_id',$orderId)
                ->get();

              
        foreach ($Order as $key => $value) {
            $p_id = $value->code;
            if(session()->has('cart')){
                $oldCart = session()->get('cart');  
               
                if (array_key_exists($p_id, $oldCart)) {
                    $qty = $oldCart[$p_id]['quantity'];
                    $qty++;
                    session()->put("cart.$p_id.quantity", $qty);
                }else{
                    $cartdata['product_id']     = $value->id;
                    $cartdata['product_name']   = $value->title;
                    $cartdata['slug']           = $value->slug;
                    $cartdata['product_code']   = $value->code;
                    $cartdata['quantity']       = 1;
                    $cartdata['product_price']  = $value->price;
                    $cartdata['product_price_m3']  = $value->price_m3;
                    $cartdata['categories_id']  = $value->firesale_categories_id;
                    session()->put("cart.$p_id", $cartdata);
                }
            }
            else {
                $cartdata['product_id']    = $value->id;
                $cartdata['product_name']  = $value->title;
                $cartdata['slug']          = $value->slug;
                $cartdata['product_code']  = $value->code;
                $cartdata['quantity']      = 1;
                $cartdata['product_price'] = $value->price;
                $cartdata['product_price_m3']  = $value->price_m3;
                $cartdata['categories_id'] = $value->firesale_categories_id;
                session()->put("cart.$p_id", $cartdata);
            }
        }
        
        // Session()->save();

        return 'success';
    }

    public function orderWaitPayment(Request $req){
        $idOrder = $req->orderId;

        $order = DB::table('91W2_firesale_orders')
                ->select('91W2_firesale_orders.id',
                        '91W2_firesale_orders.price_sub',
                        '91W2_firesale_orders.price_total',
                        '91W2_firesale_orders.created',
                        '91W2_firesale_orders.ship_to',
                        '91W2_firesale_orders.TrackingNo',
                        '91W2_firesale_orders.CustCode',
                        '91W2_firesale_orders.payment_by',
                        '91W2_firesale_orders.discount_total_price',
                        )
                ->where('91W2_firesale_orders.created_by',Auth::id());
                $order = $order->where('91W2_firesale_orders.id',$idOrder);
                $order = $order->first();

        $Sum = $order->price_total;
        $ProfilePage = 1;
        if($order->payment_by == "Thai QR Cash"){

            $genQr = $this->GenerateQRcode($Sum,$idOrder);

            return view('checkout.thai_qr',compact('genQr','idOrder','ProfilePage'))->render();

        }elseif($order->payment_by == "บัตรเครดิต"){

            return view('checkout.credit_card',compact('Sum','idOrder','ProfilePage'))->render();
        }
    }

    public function CheckStock(){
         // เช็คสต็อก
        $Carts_stock    = session()->get('cart');

        $product_stock  = array();
        $i = 0;
        $a = 0;

        // $Stock['email']          = Auth::user()->email;
        foreach ($Carts_stock as $key => $value) {
            $Stock['items'][$a]['GoodCode'] = $value['product_code'];
            $a++;
        }

        $data_product = json_encode($Stock,true);
        // API URL
        $ch = curl_init();
                
        curl_setopt($ch,CURLOPT_PORT,'9093');
        curl_setopt($ch, CURLOPT_URL,'http://om.jtpackconnect.com:9093/api/ecom/checkstock');
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_product);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10); 
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type: application/json','Content-Length: ' . strlen($data_product)));
        $server_output = curl_exec($ch);
        // $File_name_api = date("d_m_Y")."_"."API_Log.txt";
        // Storage::disk('local_api')->prepend($File_name_api, $server_output);
        $error  =  curl_error($ch);
    
        curl_close ($ch);
        $res_1 = json_decode($server_output,true);

        if($res_1['success']){
        foreach ($res_1['checkStock'] as $key => $value) {
            foreach($value as $k2 => $value2){
                $stock_arr[$k2] = $value2['IntStk'];
            }
        }
        // dd($stock_arr);
        $count_1 = 0;

        foreach ($Carts_stock as $key => $value) {

            $codeProduct            = $key;
    
            if($stock_arr[$codeProduct] < $value['quantity']){
                $product_stock['soldout']   =   "outstock";
                $product_stock_1            =   DB::table('91W2_firesale_products')->where('code',$codeProduct)->first();
                $path_img                   =   "https://images.jtpackconnect.com/imageallproducts/".$codeProduct."_F.jpg";

                $product_stock['p_stock'][$i]['p_id']          =  $product_stock_1->id;
                $product_stock['p_stock'][$i]['product_name']  =  $product_stock_1->title;
                $product_stock['p_stock'][$i]['code']          =  $product_stock_1->code;
                $product_stock['p_stock'][$i]['price']         =  $product_stock_1->price;
                $product_stock['p_stock'][$i]['qty']           =  $value['quantity'];
                $product_stock['p_stock'][$i]['sum_p']         =  $product_stock_1->price*$value['quantity'];
                $product_stock['p_stock'][$i]['path']          =  $path_img;
                $product_stock['p_stock'][$i]['stock']         =  $stock_arr[$codeProduct];
                $i++;
            }
            $count_1++;
        }

        if(count($product_stock) > 0){
            $resp['status'] = 'outStock';
            $resp['data']   = $product_stock;
            
        }else{
            $resp['status'] = true;
            $resp['data']   = [];
        }
        
        }else{
            $resp['status']     = 'errorcode';
            $resp['data']       = [];
            $resp['errorcode']  = $res_1['errorcode'];
        }
        return $resp;
    }

    private function GenerateQRcode($Price,$IdOrder){
        if (!empty($Price)) {
            $token          = env('GB_TOKEN'); // Add your token here
            $tokenKey       = rawurlencode($token);
            $referenceNo    = $IdOrder; // Add your reference number here
            $backgroundUrl  = url('/GB/Callback/BG');
            $field          = 'token='.$tokenKey.'&referenceNo='.$referenceNo.'&amount='.$Price.'&backgroundUrl='.$backgroundUrl;
            $requestHeaders = [
                'Cache-Control' => 'no-cache',
            ];
            $url = env('GB_url') . 'v3/qrcode';
 
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLINFO_HEADER_OUT, true);
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
            $output = curl_exec($ch);
            curl_close($ch);
            // dd($output);
            $body = 'data:image/png;base64,' . base64_encode($output);
            return $body;
        }
    }

    // private function SendLine($idOrder){
    //     define('LINE_API',"https://notify-api.line.me/api/notify");

    //     $str    = " \nOrder ที่ : ".$idOrder."\nชื่อ-นามสกุล : ".$line_name." \nที่อยู่ : ".$line_address."\nเวลาสั่งซื้อ : ".now()." \nยอดเงิน : ".number_format(($Sum-$total2)+$req->shipping_cost)." บาท \nช่องทางชำระเงิน : ".$payment."\nติดต่อกลับเพื่อยืนยัน : ".$tel_cf."\nส่งแบบ : ".$type_pay->title."\nเบอร์ติดต่อ : ".$line_phone; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
    //     $res  = json_decode(json_encode(notify_message($str)),true);
    //     $res['order_id'] = $idOrder;
    //     $res['price']    = ($Sum-$total2)+$req->shipping_cost;
    //     $res1 = json_encode($res,true);
    // }

    public function creditGB(Request $req){
        // dd(Auth::user());
        DB::beginTransaction();
        $secret_key  = env('GB_secret_key');
        $gbToken    = $req->gbToken;
        $price      = $req->price;
        $order_id   = $req->order_id;

        // $Profiles  = DB::table('91W2_profiles')->where('user_id',Auth::id())->first();      
        // if(session()->has('cart')){
        //     $cart    = session()->get('cart');
        //     $detail = "";
        //     foreach ($cart as $key => $value) {
        //         $detail .= $value['product_name']." x".$value['quantity']." ราคา:".number_format($value['product_price']*$value['quantity'])."<br>";
        //     }
        // }else{
        //     $cart = DB::table('91W2_firesale_orders_items')->where('order_id',$order_id)->get();
        //     $detail = "";
        //     foreach ($cart as $key => $value) {
        //         $detail .= $value->name." x".$value->qty." ราคา:".number_format($value->price*$value->qty)."<br>";
        //     }
        // }
        $detail = '';
        $data = array(
            'amount' => $price,
            'referenceNo' => $order_id,
            'detail' => $detail,
            'customerName' => 'มงคล'." ".'พิศุทธิ์ทิฆัมพร',
            // 'customerEmail' => Auth::user()->email,
            'customerEmail' => Auth::user()->email,
            'customerTelephone' => '0850461923',
            // 'merchantDefined1' => 'Promotion',
            'card' => array(
                'token' => $gbToken,
            ),
            'otp' => 'Y',
            'backgroundUrl' => url('/GB/Callback/BG'),
                'responseUrl' => url('/GB/Callback')
        );
       

        $payload = json_encode($data);

        $ch = curl_init(env('GB_url').'/v1/tokens/charge');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERPWD, $secret_key . ':');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload))
        );

        $result = curl_exec($ch);
        // dd($result,env('GB_url').'/v1/tokens/charge');
        curl_close($ch);

        $chargeResp = json_decode($result, true);

 
        return view('checkout.GB_token',['Charge'=>$chargeResp]);
    }   

    public function logGB(Request $req){

        $file_name  = date("d_m_Y")."_"."GB_Log.txt";

        $key = $req->referenceNo;

        $log[$key]['Order_id']          =   $req->referenceNo;
        $log[$key]['amount']            =   $req->amount;
        $log[$key]['gbpReferenceNo']    =   $req->gbpReferenceNo;
        $log[$key]['referenceNo']       =   $req->referenceNo;
        $log[$key]['currencyCode']      =   $req->currencyCode;
        $log[$key]['resultCode']        =   $req->resultCode;
        $log[$key]['datetime']          =   date('Y-m-d H:i:s');

        if($req->resultCode == "00"){
            try {
                $data['ReferenceNo']    = $req->gbpReferenceNo;
                $data['RefNo_Datetime'] = now();
                $data['order_status']   = 2;
                $Count = DB::table('91W2_firesale_orders')
                        ->where('id',$key)
                        ->update($data);
                
                if($Count > 1){
                    DB::rollBack();
                }else{
                   
                    DB::commit();
                }
            } catch (\Throwable $th) {
                DB::rollBack();
            } 
        }
        $data1   =   json_encode($log,true);

        Storage::disk('local')->prepend($file_name, $data1);
   
    }

    public function checkpay_qr(Request $req){

        $orderId    = $req->orderId;
        $file_name  = date("d_m_Y")."_"."GB_Log.txt";
       
        if (Storage::disk('local')->exists($file_name)) {
            $txFile = trim(Storage::disk('local')->get($file_name));
            $txFile1 = str_replace("\n",',',$txFile);
            $txFile1 = "[".$txFile1."]";
            $data2  = json_decode($txFile1,true);

            foreach ($data2 as $key => $value) {

                if (array_key_exists($orderId,$value))
                {
                    if($value[$orderId]['resultCode'] == "00"){
                        return "pay success";
                    }else{
                        return "pay fail";
                    }
                }else{
                    continue;
                }
            }
            
        }else{
            return "pay fail";
        } 
    }

    public function callbackGB(Request $req){
        DB::beginTransaction();

        $resultCode     =   $req->resultCode;
        $gbpReferenceNo =   $req->gbpReferenceNo;
        $order_id       =   $req->referenceNo; 

        if($resultCode == "00"){
            try {
                $data['ReferenceNo']    = $gbpReferenceNo;
                $data['RefNo_Datetime'] = now();
                $data['order_status']   = 2;
                $Count = DB::table('91W2_firesale_orders')
                        ->where('id',$order_id)
                        ->update($data);
                
                if($Count > 1){
                    DB::rollBack();
                }
                
            } catch (\Throwable $th) {
                DB::rollBack();
            } 
            DB::commit();

            // Update_Best_Sell($order_id);
        }
        session()->forget("discount");
        session()->forget("cart");
        return view('checkout.statusPayment',compact('resultCode','order_id'));
    }
}
