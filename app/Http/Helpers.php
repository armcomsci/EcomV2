<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function Get_header_category($id = null){
    $lang = session()->get('locale');
    $category = DB::table('91W2_firesale_categories');
    if($lang == "th"){
        $category = $category->select('title AS title','id','slug');
    }
    elseif($lang == "en"){
        $category = $category->select('title_en AS title','id','slug');
    }
    if($id == ""){
        $category = $category->where('parent','=','0');
    }else{
        $category = $category->where('parent','=',$id);
    }
    $category = $category->where('status','=','1');
    $category = $category->orderBy('ordering_count','ASC');
    $category = $category->get();
    return $category;
}

function getAddr($type){
    $address    = DB::table('91W2_firesale_addresses')
                    ->where('created_by',Auth::id())
                    ->where('91W2_firesale_addresses.status_used','Y');
                    if($type == 'vat'){
                        $address    = $address->where('vat_status','Y');
                    }elseif($type == 'ship'){
                        $address    = $address->whereNull('vat_status');
                    }
                    $address    = $address->orderByDesc('id');
                    $address    = $address->get();
    return $address;
}

function encode_pass($pass,$salt = null){
    if($salt == ""){
        $salt = substr(md5(uniqid(rand(), true)), 0, 6);
    }
    $password  = sha1($pass.$salt);
    return $password;
}

function replaceLink($link){
    return str_replace('/','_',$link);
}