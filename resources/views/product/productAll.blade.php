@extends('main_theme')

@section('content')
<!-- breadcrumb-area start -->
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">สินค้าทั้งหมด</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->

<!-- main-content-wrap start -->
<div class="main-content-wrap shop-page section-ptb">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-3 order-lg-1 order-2">
                <!-- shop-sidebar-wrap start -->
                <div class="shop-sidebar-wrap">
                    <div class="shop-box-area">

                        <!--sidebar-categores-box start  -->
                        <div class="sidebar-categores-box shop-sidebar mb-30">
                            @php
                                $categorys = Get_header_category();
                            @endphp
                            <h4 class="title">หมวดหมู่สินค้า</h4>
                            <!-- category-sub-menu start -->
                            <div class="category-sub-menu">
                                <ul>
                                @foreach ($categorys as $key => $item)
                                    <li class="has-sub">
                                        <a href="{{ url('/Product/'.$item->title) }}">{{ $item->title }}</a>
                                        @php
                                            $sub_cats = Get_header_category($item->id);
                                        @endphp
                                        <ul>
                                            @foreach ($sub_cats as $sub_cat)
                                                <li><a href="{{ url('/Product/'.$item->title.'/'.$sub_cat->title) }}">{{ $sub_cat->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            <!-- category-sub-menu end -->
                        </div>
                        <!--sidebar-categores-box end  -->

                        <!-- shop-sidebar start -->
                        <div class="shop-sidebar mb-30">
                            <h4 class="title">ค้นหาด้วยราคา</h4>
                            <!-- filter-price-content start -->
                            <div class="filter-price-content">
                                <form action="#" method="post">
                                    <div id="price-slider" class="price-slider"></div>
                                    <div class="filter-price-wapper">
                                        <a class="add-to-cart-button" href="#">
                                            <span>ค้นหา</span>
                                        </a>
                                        <div class="filter-price-cont">
                                            <span>Price:</span>
                                            <div class="input-type">
                                                <input type="text" id="min-price" readonly="" />
                                            </div>
                                            <span>—</span>
                                            <div class="input-type">
                                                <input type="text" id="max-price" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- filter-price-content end -->
                        </div>
                    </div>
                </div>
                <!-- shop-sidebar-wrap end -->
            </div>
            <div class="col-lg-9 order-lg-2 order-1">

                <!-- shop-product-wrapper start -->
                <div class="shop-product-wrapper">
                    <div class="row align-itmes-center">
                        <div class="col">
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar">
                                <!-- product-view-mode start -->

                                <div class="product-mode">
                                    
                                </div>
                                <!-- product-view-mode end -->

                                <!-- product-short start -->
                                <div class="product-short">
                                    <p>เรียงจาก :</p>
                                    <select class="nice-select" name="sortby">
                                        <option value=""></option>
                                        <option value="trending">น้อย-มาก</option>
                                        <option value="sales">มาก-น้อย</option>
                                    </select>
                                </div>
                                <!-- product-short end -->
                            </div>
                            <!-- shop-top-bar end -->
                        </div>
                    </div>

                    <!-- shop-products-wrap start -->
                    <div class="shop-products-wrap">
                        <div class="shop-product-wrap">
                            <div class="row row-8">
                                @foreach ($product as $item)
                                @php
                                    $url_path = "https://images.jtpackconnect.com/imageallproducts/".$item->code."_F.jpg";
                                @endphp
                                <div class="product-col col-lg-3 col-md-4 col-sm-6">
                                    <!-- Single Product Start -->
                                    <div class="single-product-wrap mt-10">
                                        <div class="product-image">
                                            <a href="{{ url('/ProductDetail/'.replaceLink($item->title)) }}"><img src="{{ $url_path }}" alt="{{ $item->title }}" title="{{ $item->title }}" ></a>
                                            {{-- <span class="onsale">Sale!</span> --}}
                                        </div>
                                        <div class="product-content">
                                            <div class="price-box">
                                                <span class="new-price">฿{{ number_format($item->price) }}</span>
                                                <span class="old-price">฿{{ number_format($item->rrp) }}</span>
                                            </div>
                                            <h6 class="product-name"><a href="{{ url('/ProductDetail/'.replaceLink($item->title)) }}" title="{{ $item->title }}" class="line-clamp">{{ $item->title }}</a></h6>
                                            <div class="product-button-action">
                                                <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                @endforeach
                               
                            </div>
                        </div>    
                    </div>
                    <!-- shop-products-wrap end -->

                    @include('pagination',$product)
                    
                </div>
                <!-- shop-product-wrapper end -->
            </div>
        </div>
    </div>
</div>

@endsection