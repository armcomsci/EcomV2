<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function productAll(){
        
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
        dd($detail);
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
                                    );
        return $productAll;
    }
}
