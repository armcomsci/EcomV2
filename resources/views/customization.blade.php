@extends('main_theme')

@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ออกแบบงานพิมพ์ LOGO</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<div class="product-area section-ptb">
    <div class="container-ext">
        <img src="{{ asset('assets/img_custom/ขั้นตอนงานสกรีน-เว็บ003_0.jpg') }}" alt="">

        <img src="{{ asset('assets/img_custom/ขั้นตอนงานสกรีน-เว็บ-ไอคอน_0.jpg') }}" alt="">
    </div>
</div>
@endsection