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


function DateThai($strDate,$ShowTime = true){
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));

    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    if($ShowTime){
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    }else{
        return "$strDay $strMonthThai $strYear";
    }
    
}

function getProfile(){
    $getProfile = DB::table('91W2_profiles')
                    ->select('display_name','first_name','last_name','mobile','otp_status')
                    ->where('user_id',Auth::id())
                    ->first();
    return $getProfile;
}

function Get_path_img($slug,$single = 0){
    $path = DB::table('91W2_file_folders')
            ->join('91W2_files','91W2_file_folders.id','=','91W2_files.folder_id')
            ->select('91W2_files.path','91W2_files.sort','91W2_files.id')
            ->where('91W2_file_folders.slug','=',$slug)
            ->orderBy('91W2_files.sort','ASC');
    if($single == 0){
        $path  = $path ->first();
    }elseif($single == 1 ){
        $path  = $path ->get();
    }

    return $path;
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

function sms_otp($phone){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://portal-otp.smsmkt.com/api/otp-send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "api_key:798d0b697a0e55efdd36fc3353909f7f",
            "secret_key:DQMB1ryhfEVtaLfR",
        ),
        CURLOPT_POSTFIELDS =>json_encode(array(
        "project_key"=>"ba4b07046a",
        "phone"=> $phone,
        )),
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $result_code	=	json_decode($response,true);
   
    return $result_code;
}

function validate_otp($token,$otp_password,$ref_code){
        
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://portal-otp.smsmkt.com/api/otp-validate',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "api_key:798d0b697a0e55efdd36fc3353909f7f",
            "secret_key:DQMB1ryhfEVtaLfR",
        ),
        CURLOPT_POSTFIELDS =>json_encode(array(
            "token"=>$token,
            "otp_code"=>$otp_password,
            "ref_code"=>$ref_code,
        )),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    
    $result	=	json_decode($response,true);

    $result1['status_code']	        =	$result['code'];
    $result1['status_detail']		=	$result['detail'];
    // $result1['status']              =   $result['result']['status'];
    $result1['ref_code']		    =	$ref_code;
    $result1['otp_confirm']			=	"Y";

    // $result_code	                    =	json_encode($result1,true);


    return $result1;
}

function notify_message($message){
    $token = "kTP99VkULlCskc81q4IxFG8z50clqUDS8uCF0s2NdOs";
    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array( 
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                        ."Authorization: Bearer ".$token."\r\n"
                        ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            ),
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents("https://notify-api.line.me/api/notify",FALSE,$context);
    $res = json_decode($result);
    return $res;
}