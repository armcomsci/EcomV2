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
                            <h4>เปลี่ยนรหัสผ่าน</h4>
                        </a>
                    </div>
                    <div id="lg1">
                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form id="FormChangePassword" method="post" onsubmit="return false">
                                    @csrf
                                    <input type="hidden" name="reset" value="{{ $Pass }}">
                                    <input type="hidden" name="u" value="{{ $salt }}">
                                    <div class="login-input-box">
                                        <input  name="email" type="email" value="{{ $CheckUser->email }}" readonly>
                                    </div>
                                    <div class="login-input-box">
                                        <input name="password" type="password" placeholder="กรุณา Password ใหม่">
                                    </div>
                                    <div class="login-input-box">
                                        <input name="password_conf" type="password" placeholder="ยืนยัน Password">
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
    $("#FormChangePassword").submit(function (e) { 
        e.preventDefault();
        let password        = $("input[name='password']").val();
        let password_conf   = $("input[name='password_conf']").val();
        if(password != password_conf){
            Swal.fire({
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน กรุณาระบุใหม่',
                text: '',
            });
            return false;
        }else{
            $.ajax({
                type: "post",
                url: url+"/ChangePass",
                data: $(this).serialize(),
                // dataType: "dataType",
                beforeSend: function() {
                    $('.loadding').css('position','fixed');
                    $('.btn-default').prop('disabled',true);
                },
                success: function (response) {
                    $('.loadding').css('position','none');
                    $('.btn-default').prop('disabled',false);
                    if(response == "fail Password"){
                        Swal.fire({
                            icon: 'error',
                            title: 'กรุณาตรวจสอบรหัสผ่าน',
                            text: '',
                        });
                        return false;
                    }else if(response != "success"){
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: '',
                        });
                        return false;
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกข้อมูลสำเร็จ',
                            text: 'ระบบได้ทำการบันทึกข้อมูลเรียบร้อย',
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
        }
    });
</script>
@endsection