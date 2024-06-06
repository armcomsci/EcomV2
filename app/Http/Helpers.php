<?php
use Illuminate\Support\Facades\DB;

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

function replaceLink($link){
    return str_replace('/',' ',$link);
}