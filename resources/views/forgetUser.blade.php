@extends('main_theme')

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
<div class="main-content-wrap section-ptb lagin-and-register-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="login-register-wrapper">
                    <!-- login-register-tab-list start -->
                    <div class="login-register-tab-list nav">
                        <a class="active">
                            <h4>ลืมรหัสผ่าน</h4>
                        </a>
                    </div>
                    <div id="lg1">
                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form id="FormResetPassword" method="post" onsubmit="return false">
                                    <div class="login-input-box">
                                        <input  name="email" type="email" placeholder="กรุณาระบุ Email เพื่อทำการส่งรหัสผ่านใหม่">
                                    </div>
                                    <div class="button-box">
                                        <div class="button-box">
                                            <button class="login-btn btn" type="submit"><span>ยืนยัน</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#FormResetPassword").submit(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: url+"/ResetPassWord",
                data: $(this).serialize(),
                beforeSend: function() {
                    Swal.fire({
                        title: 'ระบบกำลังประมวลผล',
                        html: 'กรุณารอสักครู่.....',
                        icon : 'warning',
                        timer: 25000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        allowEscapeKey:false,
                        showCancelButton: false,
                        showConfirmButton:false
                    }); 
                },
                success: function (response) {
                    Swal.close();
                    if(response == "Email Not Found"){
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่พบ Email ในระบบ',
                            text: '',
                        });
                        return false;
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'ระบบได้ทำการรีเซ็ตรหัสผ่านแล้ว',
                            text: 'กรุณาคลิกลิงค์ที่ Email ของท่านเพื่อเปลี่ยนรหัสผ่าน',
                        }).then(function() {
                            window.location.href = url+"/Login";
                        });
                        return false;
                    }
                },error: function(){
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: '',
                    });
                    return false;
                }
            });
        });
    });
</script>
@endsection