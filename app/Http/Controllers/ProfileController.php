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

    public function profile(){
        $profiles = $this->getProfile();
        
        return view('profile.profile',compact('profiles'));
    }

    public function profileStatus(Request $req){
        $status = $req->status;

        $order = DB::table('91W2_firesale_orders')
        ->join('91W2_firesale_addresses','91W2_firesale_orders.ship_to','91W2_firesale_addresses.id')
        ->join('91W2_config_deliver','91W2_firesale_orders.deliver_method','91W2_config_deliver.id')
        ->select('91W2_firesale_orders.id',
                '91W2_firesale_orders.price_sub',
                '91W2_firesale_orders.price_total',
                '91W2_firesale_orders.created',
                '91W2_firesale_orders.ship_to',
                '91W2_firesale_orders.TrackingNo',
                '91W2_firesale_orders.CustCode',
                '91W2_firesale_orders.payment_by',
                '91W2_firesale_orders.discount_total_price',
                '91W2_firesale_orders.shipping_cost',
                '91W2_firesale_addresses.firstname',
                '91W2_firesale_addresses.lastname',
                '91W2_firesale_addresses.address1',
                '91W2_firesale_addresses.city',
                '91W2_firesale_addresses.county',
                '91W2_firesale_addresses.postcode',
                '91W2_config_deliver.TimeStart',
                '91W2_config_deliver.TimeEnd'                       
                )
        ->where('91W2_firesale_orders.created_by',Auth::id());
        $order = $order->where('91W2_firesale_orders.order_status',$status);
        $order = $order->orderBy('id','DESC')->get();


        return view('profile.profileStatus',compact('order','status'));
    }

    public function orderItem(Request $req){
        $order_id = $req->orderId;

        $Order = DB::table('91W2_firesale_orders')
                ->select('91W2_firesale_orders.id'
                        ,'91W2_firesale_orders.price_total'
                        ,'91W2_firesale_orders.created'
                        ,'91W2_firesale_orders.created_by'
                        ,'91W2_firesale_orders.code_used'
                        ,'91W2_firesale_orders.order_status'
                        ,'91W2_firesale_orders.shipping_cost'
                        ,'91W2_firesale_orders.discount_total_price'
                        )
                ->where('id',$order_id)
                ->first();

        $Order_list = DB::table('91W2_firesale_orders_items')
                        ->join('91W2_firesale_products','91W2_firesale_orders_items.product_id','91W2_firesale_products.id')
                        ->select('91W2_firesale_orders_items.name'
                                ,'91W2_firesale_orders_items.code'
                                ,'91W2_firesale_orders_items.price'
                                ,'91W2_firesale_orders_items.qty'
                                ,'91W2_firesale_orders_items.created_by'
                                ,'91W2_firesale_products.id'
                                ,'91W2_firesale_products.slug'
                                )
                        ->where('order_id',$order_id)
                        ->get();

        $i = 0;
        foreach ($Order_list as $key => $value) {
            
            $url_path = "https://images.jtpackconnect.com/imageallproducts/".$value->code."_F.jpg";

            $data['detail'][$i]['name']         = $value->name;
            $data['detail'][$i]['path']         = $url_path;
            $data['detail'][$i]['code']         = $value->code;
            $data['detail'][$i]['slug']         = $value->slug;
            $data['detail'][$i]['price']        = number_format($value->price,2);
            $data['detail'][$i]['qty']          = $value->qty;
            $data['detail'][$i]['price_total']  = number_format($value->price*$value->qty,2);
            $data['detail'][$i]['created_by']   = $value->created_by;
            $i++;
        }
        $data['total']                  = number_format($Order->price_total,2);
        $data['discount_total_price']   = number_format($Order->discount_total_price,2);
        $data['shipping_cost']          = number_format($Order->shipping_cost,2);
        $data['last_total']             = number_format(($Order->price_total-$Order->discount_total_price)+$Order->shipping_cost,2);

        return view('profile.orderItem',compact('data'));
    }
}
