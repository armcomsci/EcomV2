@extends('main_theme')

@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">วิธีสั่งซื้อ</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<div class="product-area section-ptb">
    <div class="container-ext">
        <img src="{{ asset('assets/img_custom/6ขั้นตอนการสั่งซื้อสินค้า.jpg') }}" alt="">
    </div>
</div>
@endsection