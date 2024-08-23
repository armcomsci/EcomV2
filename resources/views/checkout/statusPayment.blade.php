@extends('main_theme')
@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ยืนยันสินค้า</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<div class="main-content-wrap contact-wrap">
    <div class="contact-form-area section-ptb">
        <div class="container-ext" >
            <div class="text-center">
                @if ($resultCode == 00)
                <img src="{{ url('assets/img_custom/success.svg') }}" alt="" style="width: 300px; margin-bottom: 20px;">
                <div class="caption text-center">
                    <h1 style="color: #468e77">ชำระเงินสำเร็จ</h1>
                    <a href="{{ url('/') }}"  style="color: #468e77">
                        <h2>กลับสู่หน้าหลักใน <span id="time">5</span></h2>
                    </a>
                </div>
                @else
                <img src="{{ url('assets/img_custom/error.svg') }}" alt="" style="width: 300px; margin-bottom: 20px;">
                <div class="caption text-center">
                    <h1 style="color: #fd4138">เกิดข้อผิดพลาดในการชำระเงิน</h1>
                    <a href="{{ url('/Profile/Edit') }}"  style="color: #fd4138">
                        <h2>กลับสู่ชำระเงินใน <span id="time">5</span></h2>
                    </a>
                </div>    
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    setInterval(function() {
        var i = document.getElementById('time');
        if (parseInt(i.innerHTML) == 0) {
            @if ($resultCode == 00)
                location.href = url+"/Profile";
            @else
                location.href = url+"/Product";
            @endif
        }
        if (parseInt(i.innerHTML)!=0) {
            i.innerHTML = parseInt(i.innerHTML)-1;
        }
    }, 1000);
</script>
@endsection