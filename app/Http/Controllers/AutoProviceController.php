<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AutoProviceController extends Controller
{

    public function GetProvince(){
        $provinces = DB::table('91W2_province')
                    ->select('PROVINCE_ID','PROVINCE_NAME')
                    ->get();

        return $provinces;
    }

    public function GetDistricts($id){

        $amphurs = DB::table('91W2_amphur')
                    ->select('AMPHUR_ID','AMPHUR_NAME')
                    ->where('PROVINCE_ID',$id)
                    ->get();
        return response()->json($amphurs, 200);

    }

    public function GetSubDistricts($id){
        $districts = DB::table('91W2_district')
                    ->select('DISTRICT_ID','DISTRICT_NAME')
                    ->where('AMPHUR_ID',$id)
                    ->get();
        return  response()->json($districts, 200);
    }
}
