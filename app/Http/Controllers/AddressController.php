<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddressController extends ProfileController
{
    public function saveShip(Request $req){
        DB::beginTransaction();
        try {
            $proFile = $this->getProfile();
            $user_id = Auth::id();
    
            $dataShip['created']    = now();
            $dataShip['updated']    = now();
            $dataShip['created_by'] = $user_id;
            $dataShip['email']      = Auth::user()->email;
            $dataShip['address1']   = $req->AddShip_addr;
            $dataShip['subDistrict']= $req->AddShip_subDistrict;
            $dataShip['city']       = $req->AddShip_district;
            $dataShip['county']     = $req->AddShip_province;
            $dataShip['postcode']   = $req->AddShip_postcode;
            
            $lastId = DB::table('91W2_firesale_addresses')->insertGetId($dataShip);

            DB::commit();

            $res['status']       = 'success';
            $res['data']['id']   = $lastId;
            $res['data']['text'] = $req->AddShip_addr." ".$req->AddShip_subDistrict." ".$req->AddShip_district." ".$req->AddShip_province." ".$req->AddShip_postcode;

        } catch (\Throwable $th) {
            $res['status']  = 'error';
            $res['text']    = $th->getMessage();

            DB::rollback();
        }
        return $res;
    }

    public function saveBill(Request $req){
        DB::beginTransaction();
        try {
            $proFile = $this->getProfile();
            $user_id = Auth::id();
    
            $dataShip['created']    = now();
            $dataShip['updated']    = now();
            $dataShip['created_by'] = $user_id;
            $dataShip['email']      = Auth::user()->email;
            $dataShip['company']    = $req->AddBill_company;
            $dataShip['idcard']     = $req->AddBill_cardId;
            $dataShip['address1']   = $req->AddBill_addr;
            $dataShip['subDistrict']= $req->AddBill_subDistrict;
            $dataShip['city']       = $req->AddBill_district;
            $dataShip['county']     = $req->AddBill_province;
            $dataShip['postcode']   = $req->AddBill_postcode;
            $dataShip['vat_status'] = 'Y';
            $dataShip['Bill_flag']  = 'Y';
            
            $lastId = DB::table('91W2_firesale_addresses')->insertGetId($dataShip);

            DB::commit();

            $res['status']       = 'success';
            $res['data']['id']   = $lastId;
            $res['data']['text'] = $req->company." ".$req->AddShip_addr." ".$req->AddShip_subDistrict." ".$req->AddShip_district." ".$req->AddShip_province." ".$req->AddShip_postcode;

        } catch (\Throwable $th) {
            $res['status']  = 'error';
            $res['text']    = $th->getMessage();

            DB::rollback();
        }
        return $res;
    }
}
