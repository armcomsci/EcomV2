@extends('main_theme')

@section('css')
<style>
.login-box {

    padding: 20px;
    max-width: 480px;
    text-align: center;
    letter-spacing: 1px;
    position: relative;
}


.login-box h2 {
    margin: 20px 0 20px;
    padding: 0;
    text-transform: uppercase;
    color: #80BB01;
}

.social-button {
	  background-position: 25px 0px;
    box-sizing: border-box;
    color: rgb(255, 255, 255);
    cursor: pointer;
    display: inline-block;
    height: 50px;
	  line-height: 50px;
    text-align: left;
    text-decoration: none;
    text-transform: uppercase;
    vertical-align: middle;
    width: 100%;
	  border-radius: 3px;
    margin: 10px auto;
    outline: rgb(255, 255, 255) none 0px;
    padding-left: 20%;
    transition: all 0.2s cubic-bezier(0.72, 0.01, 0.56, 1) 0s;
	  -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

#facebook-connect {
    background: rgb(255, 255, 255) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook.svg?sanitize=true') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
    border: 1px solid rgb(60, 90, 154);
}

#facebook-connect:hover {
	  border-color: rgb(60, 90, 154);
	  background: rgb(60, 90, 154) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/facebook-white.svg?sanitize=true') no-repeat scroll 5px 0px / 30px 50px padding-box border-box;
	  -webkit-transition: all .8s ease-out;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease-out;
}

#facebook-connect span {
	  box-sizing: border-box;
    color: rgb(60, 90, 154);
    cursor: pointer;
    text-align: center;
    text-transform: uppercase;
    border: 0px none rgb(255, 255, 255);
    outline: rgb(255, 255, 255) none 0px;
	  -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

#facebook-connect:hover span {
	  color: #FFF;
	  -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

#google-connect {
    background: rgb(255, 255, 255) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/google-plus.png') no-repeat scroll 5px 0px / 50px 50px padding-box border-box;
    border: 1px solid rgb(220, 74, 61);
}

#google-connect:hover {
	  border-color: rgb(220, 74, 61);
	  background: rgb(220, 74, 61) url('https://raw.githubusercontent.com/eswarasai/social-login/master/img/google-plus-white.png') no-repeat scroll 5px 0px / 50px 50px padding-box border-box;
	  -webkit-transition: all .8s ease-out;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease-out;
}

#google-connect span {
	  box-sizing: border-box;
    color: rgb(220, 74, 61);
    cursor: pointer;
    text-align: center;
    text-transform: uppercase;
    border: 0px none rgb(220, 74, 61);
    outline: rgb(255, 255, 255) none 0px;
	  -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

#google-connect:hover span {
	  color: #FFF;
	-webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

#line-connect {
    background: rgb(255, 255, 255) url('{{ asset('/assets/img_custom/btn_base.png') }}') no-repeat scroll 5px 1px / 45px 45px padding-box border-box;
    border: 1px solid #06C755;
}

#line-connect:hover {
	  border-color: #06C755;
	  background: #06C755 url('{{ asset('/assets/img_custom/line_44.png') }}') no-repeat scroll 5px 1px / 45px 45px padding-box border-box;
	-webkit-transition: all .8s ease-out;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease-out;
}

#line-connect span {
	  box-sizing: border-box;
    color: rgb(14 210 56);
    cursor: pointer;
    text-align: center;
    text-transform: uppercase;
    border: 0px none rgb(220, 74, 61);
    outline: rgb(255, 255, 255) none 0px;
	  -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

#line-connect:hover span {
	  color: #FFF;
	  -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

</style>
@endsection

@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">เข้าสู่ระบบ</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

 <!-- main-content-wrap start -->
 <div class="main-content-wrap section-ptb lagin-and-register-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-sm-12">
                <div class="login-register-wrapper">
                    <!-- login-register-tab-list start -->
                    <div class="login-register-tab-list nav">
                        <a class="active">
                            <h4>เข้าสู่ระบบ</h4>
                        </a>
                    </div>
                    <!-- login-register-tab-list end -->
                    <div id="lg1">
                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form id="Login" method="post" onsubmit="return false">
                                    <div class="login-input-box">
                                        <input type="text" name="user_name" placeholder="User Name">
                                        <input type="password" name="user_password" placeholder="Password">
                                    </div>
                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            <input type="checkbox">
                                            <label>จดจำฉันในระบบ</label>
                                            <a href="#">ลืมรหัสผ่าน ?</a>
                                        </div>
                                        <div class="button-box">
                                            <button class="login-btn btn" type="submit"><span>เข้าสู่ระบบ</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-lg-5 col-sm-12">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active">
                            <h4>เข้าสู่ระบบด้วยโซเชียล</h4>
                        </a>
                    </div>
                    <div class="login-box login-form-container">
                        <a href="#" class="social-button" id="facebook-connect"> <span>เข้าสู่ระบบโดย Facebook</span></a>
                        <a href="{{ url('/google/login') }}" class="social-button" id="google-connect"> <span>เข้าสู่ระบบโดย Google</span></a>
                        <a href="#" class="social-button" id="line-connect"> <span>เข้าสู่ระบบโดย Line</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap end -->

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#Login').submit(function (e) { 
            e.preventDefault();
            let username = $("input[name='user_name']");
            let password = $("input[name='user_password']");

            if($.trim(username.val()) == ''){
                Swal.fire({
                    title: "กรุณาระบุ Username",
                    text: '',
                    icon: "warning"
                });
                return false
            }
            if($.trim(password.val()) == ''){
                Swal.fire({
                    title: "กรุณาระบุ Password",
                    text: '',
                    icon: "warning"
                });
                return false
            }
            
            $.ajax({
                type: "post",
                url: url+"/Checklogin",
                data: $('#Login').serialize(),
                beforeSend: function() {
                    Swal.fire({
                        title: 'loadding....',
                        text: '',
                        // timer: 2000,
                        showConfirmButton : false,
                        showCancelButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey : false
                        // timerProgressBar: true
                    })
                    $('.login-btn').prop('disabled',true);
                },
                success: function (response) {
                    Swal.close();
                    $('.login-btn').prop('disabled',false);
                    if(response.status == "EmailError"){
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่พบ Email ในระบบ',
                            text: '',
                        });
                        return false;
                    }
                    else if(response.status == "PasswordError"){
                        Swal.fire({
                            icon: 'error',
                            title: 'กรุณาตรวจสอบ Password ',
                            text: '',
                        });
                        return false;
                    }
                    else if(response.status == "Error"){
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาดกรุณาเข้าสู่ระบบใหม่',
                            text: '',
                        });
                        return false;
                    }else{
                        window.location.assign(url+response.url);
                    }
                }
            });
        });
    });
</script>
@endsection