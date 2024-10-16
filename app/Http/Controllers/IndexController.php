<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

require_once('ProductController.php');

class IndexController extends ProductController
{
    public function index(){

        $banner = DB::table('91W2_pmslides')
                ->join('91W2_files','91W2_pmslides.file_id', '=', '91W2_files.id')
                ->where('91W2_pmslides.slider_id','=','3')
                ->orderBy('order','ASC')
                ->get();
        
        $CTime =  date('Ymd',time());
        $banner_social = DB::table('91W2_Banner_social')
                        ->whereRaw("date_format(str_to_date(DateStart, '%d-%m-%Y'),'%Y%m%d') <= '$CTime' AND  date_format(str_to_date(DateEnd, '%d-%m-%Y'),'%Y%m%d') >= '$CTime' ")->orderBy('sort','ASC')
                        ->limit(4)
                        ->get();

        $productTab_1       = $this->GetProduct();
        $productTab_1       = $productTab_1->where('91W2_firesale_categories.parent',91)
                                ->where('91W2_firesale_products.status','=',1)
                                ->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->distinct()
                                ->inRandomOrder()
                                ->paginate(11);

        // dd($productTab_1);

        $productTab_2       = $this->GetProduct();
        $productTab_2       = $productTab_2->where('91W2_firesale_categories.parent',11)
                                ->where('91W2_firesale_products.status','=',1)
                                ->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->distinct()
                                ->inRandomOrder()
                                ->paginate(11);

        $productTab_3       = $this->GetProduct();
        $productTab_3       = $productTab_3->where('91W2_firesale_categories.parent',170)
                                ->where('91W2_firesale_products.status','=',1)
                                ->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->distinct()
                                ->inRandomOrder()
                                ->paginate(11);

        $productTab_4       = $this->GetProduct();
        $productTab_4       = $productTab_4->where('91W2_firesale_categories.parent',53)
                                ->where('91W2_firesale_products.status','=',1)
                                ->where('91W2_firesale_products.status_active','A')
                                ->where('91W2_firesale_products.product_special_flag','N')
                                ->distinct()
                                ->inRandomOrder()
                                ->paginate(11);

        return view('index',compact('banner','banner_social','productTab_1','productTab_2','productTab_3','productTab_4'));
    }

    public function orderMethod(){
        return view('orderMethod');
    }

    public function special(){
        return view('special');
    }

    public function Customization(){
      
        return view('customization');
    }

    public function contact(){
        return view('contact');
    }

}
