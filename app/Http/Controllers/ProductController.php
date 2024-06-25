<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productAll(){
        // session()->forget('cart');
        // dd(session()->get('cart'));
        $product        = $this->GetProduct();
        $product        = $product->where('91W2_firesale_products.status','=',1);
        $product        = $product->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->orderByDesc('91W2_firesale_products.created')
                                ->paginate(12);

        return view('product.productAll',compact('product'));
    }

    public function productCate($cate,$cate_sub = null){
        
        $categories         = null;
        $sub_cate_id        = null;
        $id_where_cate      = [];

        if($cate != "" && $cate_sub == null){
            $categories   = DB::table('91W2_firesale_categories')->where('title',$cate)->first();
            $category     = DB::table('91W2_firesale_categories')->where('parent',$categories->id)->where('status','1')->get();

            foreach ($category as $key => $value) {
                $id_where_cate[] = $value->id;
            }
        }

        elseif($cate_sub != ""){
            $categories_sub     = DB::table('91W2_firesale_categories')->where('title',$cate_sub)->first();
            $sub_cate_id        = $categories_sub->id;
        }


        $product       = $this->GetProduct();
        $product       = $product->where('91W2_firesale_products.status','=',1);
        if(count($id_where_cate) != 0){
            $product   = $product->whereIn('91W2_firesale_products_firesale_categories.firesale_categories_id',$id_where_cate);
        }
        if($sub_cate_id != ""){
            $product   = $product->where('91W2_firesale_products_firesale_categories.firesale_categories_id',$sub_cate_id);
        }
        $product   = $product->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->orderByDesc('91W2_firesale_products.created')
                                ->paginate(12);

        return view('product.productAll',compact('product'));
    }

    public function productDetail($detail){
        
        $detail = str_replace('_','/',$detail);

        $product        = $this->GetProduct();
        $product        = $product->where('91W2_firesale_products.status','=',1);
        $product        = $product->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->where('91W2_firesale_products.title',$detail)
                                ->first();

        $titleCate      = DB::table('91W2_firesale_categories as categories')
                            ->selectRaw("(select title from  91W2_firesale_categories where id = categories.parent ) as CateTitle, categories.parent")
                            ->where('categories.title',$product->Category_title)
                            ->first();

        $related        = $this->GetProduct();
        $related        = $related->where('91W2_firesale_products.status','=',1);
        $related        = $related->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->where('91W2_firesale_categories.parent',$titleCate->parent)
                                ->inRandomOrder()
                                ->limit(12)
                                ->get();

        return view('product.productDetail',compact('product','detail','titleCate','related'));
    }

    public function addToCart(Request $req){

        $code   = $req->code;
        $stock  = DB::table('91W2_firesale_products')->where('code',$code)->first();

        if($stock->stock <= 0 || $stock->stock < $req->qty){
            $resp['status']     =  '01';
            $resp['txt']        =  "OutStock"; 
            return $resp;
        }

        $product        = $this->GetProduct();
        $product        = $product->where('91W2_firesale_products.status','=',1);
        $product        = $product->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->where('91W2_firesale_products.code',$code)
                                ->first();


        $oldCart = session()->get('cart');
        if(session()->has("cart.$code")){
            if (array_key_exists($code, $oldCart)) {
                $qty = $oldCart[$code]['quantity'];
                if(isset($req->qty)){
                   $qty = $qty+$req->qty;
                }else{
                    $qty++;
                }
                if( $stock->stock < $qty){
                    $resp['status']     =  '01';
                    $resp['txt']        =  "OutStock"; 
                    return $resp;
                }
                session()->put("cart.$code.quantity", $qty);
            }
        }else{
            if(isset($req->qty)){
                $qty       = $req->qty;
            }else{
                $qty       = 1;
            }
            if( $stock->stock < $qty){
                $resp['status']     =  '01';
                $resp['txt']        =  "OutStock"; 
                return $resp;
            }
            $cartdata['product_name']       = $product->title;
            $cartdata['slug']               = $product->slug;
            $cartdata['product_code']       = $product->code;  
            $cartdata['quantity']           = $qty;
            $cartdata['product_price']      = $product->price;
            $cartdata['product_price_m3']   = $product->price;
            $cartdata['categories_id']      = $product->firesale_categories_id;
            
            session()->put("cart.$code", $cartdata);
        }

        session()->save();

        $Cart       =  session()->get('cart');
        $qtySum     = [0];
        $Sum        = [0];
        foreach ($Cart as $key => $value) {
            $qtySum[]   = $value['quantity'];
            $Sum[]      = $value['product_price']*$value['quantity'];
        }
 
        $resp['status']     =  '00';
        $resp['txt']        =  session()->get('cart'); 
        $resp['qtySum']     =  array_sum($qtySum);
        $resp['Sum']        =  number_format(array_sum($Sum),2);
      
        return $resp;

    }

    public function clearCart(Request $req){
        if(isset($req->code)){
            $code = $req->code;
            session()->forget("cart.$code");
        }else{
            session()->forget('cart');
        }
        return 'success';
    }

    public function GetProduct(){

        $productAll = DB::table('91W2_firesale_products_firesale_categories');
        $productAll = $productAll->join('91W2_firesale_products','91W2_firesale_products_firesale_categories.row_id','=','91W2_firesale_products.id');
        $productAll = $productAll->join('91W2_firesale_products_firesale_chanel',function($productAll) {
            $productAll =  $productAll->on('91W2_firesale_products.id','=','91W2_firesale_products_firesale_chanel.row_id');
            $productAll =  $productAll->where('91W2_firesale_products_firesale_chanel.firesale_chanel_id','=',2);
        });
        $productAll = $productAll->join('91W2_firesale_categories','91W2_firesale_products_firesale_categories.firesale_categories_id','=','91W2_firesale_categories.id');
        $productAll = $productAll->select('91W2_firesale_categories.title AS Category_title'
                                        ,'91W2_firesale_products.title AS title'
                                        ,'91W2_firesale_categories.parent'
                                        ,'91W2_firesale_categories.slug AS slug_name'
                                        ,'91W2_firesale_products.id'
                                        ,'91W2_firesale_products.short_description'
                                        ,'91W2_firesale_products.description'
                                        ,'91W2_firesale_products.slug'
                                        ,'91W2_firesale_products.rrp'
                                        ,'91W2_firesale_products.short_description'
                                        ,'91W2_firesale_products.description'
                                        ,'91W2_firesale_products.price'
                                        ,'91W2_firesale_products.code'
                                        ,'91W2_firesale_products.stock'
                                        ,'91W2_firesale_products_firesale_categories.firesale_categories_id'
                                    );
        return $productAll;
    }
}
