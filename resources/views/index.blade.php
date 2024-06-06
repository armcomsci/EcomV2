@extends('main_theme')

@section('css')
<style>
    .slick-slider{
        display: flow-root !important;
    }
</style>
@endsection

@section('content')

<!-- Hero Section Start -->
<div class="hero-slider hero-slider-four">
    @foreach ( $banner as $value)
    <!-- Single Slide Start -->
    <div class="single-slide" style="background-image: url({{ $value->path }})">
        <!-- Hero Content One Start -->
        <div class="hero-content-two container-ext">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-content-text text-center text-black">
                        {{-- <h1>Happy Summer <br>Vegetable Organic Food 2019 </h1>
                            <p>Exclusive Offer -20% Off This Week </p>
                            <div class="slider-btn">
                                <a href="#">shopping Now</a>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Content One End -->
    </div>
    <!-- Single Slide End -->
    @endforeach

</div>
<!-- Hero Section End -->

<!-- Our Customer Support Area  Start -->
<div class="our-customer-support section-pt-30">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="single-banner mb-30">
                    <a href=""><img src="{{ asset('assets/img_custom/ส่งฟรี_0.png') }}" alt="ส่งฟรี" style="width: 100%;"></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="single-banner mb-30">
                    <a href=""><img src="{{ asset('assets/img_custom/สายด่วน_0.png') }}" alt="สายด่วน" style="width: 100%;"></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="single-banner mb-30">
                    <a href=""><img src="{{ asset('assets/img_custom/ครบในที่เดียว_0.png') }}" alt="ครบในที่เดียว" style="width: 100%;"></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <div class="single-banner mb-30">
                    <a href=""><img src="{{ asset('assets/img_custom/ISO_0.png') }}" alt="ISO" style="width: 100%;"></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Our Customer Support Area  End -->

<div class="our-customer-support section-pt-30">
    <div class="container-ext">
        <div class="row row-8">
            <div class="custom-col-service col-md-4">
                <!-- Single Support Start-->
                <div class="single-support mt-30">
                    <img src="{{ asset('assets/img_custom/หมวดธุรกิจร้านกาแฟ.jpg') }}" alt="">        
                </div>
                <!-- Single Support End-->
            </div>
            <div class="custom-col-service col-md-4">
                <!-- Single Support Start-->
                <div class="single-support mt-30">
                    <img src="{{ asset('assets/img_custom/หมวดธุรกิจร้านอาหาร.jpg') }}" alt="">   
                </div>
                <!-- Single Support End-->
            </div>
            <div class="custom-col-service col-md-4">
                <!-- Single Support Start-->
                <div class="single-support mt-30">
                    <img src="{{ asset('assets/img_custom/หมวดธุรกิจ-โรงเเรม.jpg') }}" alt="">
                </div>
                <!-- Single Support End-->
            </div>
            <div class="custom-col-service col-md-4">
                <!-- Single Support Start-->
                <div class="single-support mt-30">
                    <img src="{{ asset('assets/img_custom/หมวดธุรกิจ-โรงพยาบาล.jpg') }}" alt="">
                </div>
                <!-- Single Support End-->
            </div>
            <div class="custom-col-service col-md-4">
                <!-- Single Support Start-->
                <div class="single-support mt-30">
                    <img src="{{ asset('assets/img_custom/หมวดธุรกิจ-เลี้ยงสัมนา.jpg') }}" alt="">
                </div>
                <!-- Single Support End-->
            </div>
        </div>
    </div>
</div>

@if(count($banner_social) > 0)
<div class="section-box section-pt-30">
    <!-- Banner Area Start -->
    <div class="banner-area ">
        <div class="container-ext">
            <div class="row">
                @foreach ($banner_social as $banner_social_item)
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="single-banner mb-30">
                        <a href="{{ $banner_social_item->Link }}"><img src="{{ $banner_social_item->path_img }}" alt="โปรโมทกล่อง" style="width: 100%; height: 170px;"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!-- Flash Sale -->
<div class="product-area section-pt-30">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-12">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h3>Flash Sale</h3>
                </div>
                <!-- Section Title End -->
            </div>
        </div>
        <div class="product-wrapper-four">
            <div class="row row-8 product-row-6-active">
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-04.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">144.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-05.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">147.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">lobortis Aliquam</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-09.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">144.00 - 147.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Select options</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-10.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">186.00</span>
                                <span class="old-price">192.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-10.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">186.00</span>
                                <span class="old-price">192.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-10.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">186.00</span>
                                <span class="old-price">192.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-04.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">144.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-30">
                        <div class="product-image">
                            <a href="product-details.html"><img src="assets/images/product/product-04.jpg" alt=""></a>
                            <span class="onsale">Sale!</span>

                            <!-- countdown start -->
                            <div class="countdown-deals" data-countdown="2024/06/04 10:00"></div>
                            <!-- countdown end -->
                        </div>
                        <div class="product-button">
                            <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">144.00</span>
                            </div>
                            <h6 class="product-name"><a href="product-details.html">Aliquam lobortis</a></h6>
                            <div class="product-rating">
                                <ul>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li><a href="#"><i class="icon-star"></i></a></li>
                                    <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart">Add to cart</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Flash Sale -->

<!-- Product Tab 1 -->
<div class="product-area section-ptb bg-gray">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-box-wrapper">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!-- Section Title Start -->
                            <div class="section-title ml-3 mb-20">
                                <h3>บรรจุภัณฑ์พลาสติก</h3>
                            </div>
                            <!-- Section Title End -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="view-all-product text-end mb-15">
                                <a href="#">View All <i class="icon-chevrons-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row row-8 border-tp-gray no-gutters box-product-wrap">
                        <div class="col-lg-4 col-md-4">
                            <div class="product-col border_none">
                                <!-- Single Product Start -->
                                @php
                                    $url_path = "https://images.jtpackconnect.com/imageallproducts/".$productTab_1[0]->code."_F.jpg";
                                @endphp
                                <div class="single-product-wrap">
                                    <div class="product-image text-center">
                                        <a href="{{ url('/ProductDetail/'.replaceLink($productTab_1[0]->title)) }}"><img src="{{ $url_path }}" alt="{{ $productTab_1[0]->title }}" title="{{ $productTab_1[0]->title }}" style="width: 330px; height: 330px;" ></a>
                                        {{-- <span class="onsale">Sale!</span> --}}
                                    </div>
                                    <div class="product-button">
                                        <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                                    </div>
                                    <div class="product-content">
                                        <div class="price-box">
                                            <span class="new-price">฿{{ number_format($productTab_1[0]->price) }}</span>
                                            <span class="old-price">฿{{ number_format($productTab_1[0]->rrp) }}</span>
                                        </div>
                                        <h6 class="product-name"><a href="{{ url('/ProductDetail/'.replaceLink($productTab_1[0]->title) )}}" title="{{ $productTab_1[0]->title }}">{{ $productTab_1[0]->title }}</a></h6>
                                        {{-- <div class="product-rating">
                                            <ul>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                            </ul>
                                        </div> --}}
                                        <div class="product-button-action">
                                            <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="product-wrapper-five">
                                <div class="row row-8 product-two-row-5">
                                    @for ($i = 1; $i < count($productTab_1); $i++)
                                    @php
                                        $url_path_productTab_1 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_1[$i]->code."_F.jpg";
                                    @endphp
                                    <div class="product-col">
                                        <!-- Single Product Start -->
                                        <div class="single-product-wrap mt-10">
                                            <div class="product-image">
                                                <a  href="{{ url('/ProductDetail/'.replaceLink($productTab_1[$i]->title)) }}"><img src="{{ $url_path_productTab_1 }}" alt="{{ $productTab_1[$i]->title }}" title="{{ $productTab_1[$i]->title }}" ></a>
                                            </div>
                                            <div class="product-content">
                                                <div class="price-box">
                                                    <span class="new-price">฿{{ number_format($productTab_1[$i]->price) }}</span>
                                                    <span class="old-price">฿{{ number_format($productTab_1[$i]->rrp) }}</span>
                                                </div>
                                                <h6 class="product-name "><a href="{{ url('/ProductDetail/'.replaceLink($productTab_1[$i]->title)) }}" class="line-clamp">{{ $productTab_1[$i]->title }}</a></h6>
                                                <div class="product-button-action">
                                                    <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Tab 1 -->

 <!-- Product Tab 2 -->
<div class="product-area section-ptb">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-box-wrapper">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!-- Section Title Start -->
                            <div class="section-title ml-3 mb-20">
                                <h3>ช้อน-ส้อมพลาสติก</h3>
                            </div>
                            <!-- Section Title End -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="view-all-product text-end mb-15">
                                <a href="#">View All <i class="icon-chevrons-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row row-8 border-tp-gray no-gutters box-product-wrap">
                        <div class="col-imgbanner">
                            <div class="box-area-image">
                                <img src="assets/images/banner/img-tab2-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-single-product">
                            <div class="product-col border_none">
                                <!-- Single Product Start -->
                                @php
                                    $url_path_2 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_2[0]->code."_F.jpg";
                                @endphp
                                <div class="single-product-wrap">
                                    <div class="product-image text-center">
                                        <a href="{{ url('/ProductDetail/'.replaceLink($productTab_2[0]->title) )}}"><img src="{{ $url_path_2 }}" alt="{{ $productTab_2[0]->title }}" title="{{ $productTab_2[0]->title }}"></a>
                                        {{-- <span class="onsale">Sale!</span> --}}
                                    </div>
                                    <div class="product-button">
                                        <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                                    </div>
                                    <div class="product-content">
                                        <div class="price-box">
                                            <span class="new-price">฿{{ number_format($productTab_2[0]->price) }}</span>
                                            <span class="old-price">฿{{ number_format($productTab_2[0]->rrp) }}</span>
                                        </div>
                                        <h6 class="product-name"><a href="{{ url('/ProductDetail/'.replaceLink($productTab_2[0]->title) )}}">{{ $productTab_2[0]->title }}</a></h6>
                                        {{-- <div class="product-rating">
                                            <ul>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                            </ul>
                                        </div> --}}
                                        <div class="product-button-action">
                                            <a href="#" class="add-to-cart">Select options</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                        </div>
                        <div class="col-lg-5 col-group-products">
                            <div class="product-wrapper-five">
                                    <div class="row row-8 product-two-row-3">
                                        @for ($i = 1; $i < count($productTab_2); $i++)
                                        @php
                                            $url_path_productTab_2 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_2[$i]->code."_F.jpg";
                                        @endphp
                                        <div class="product-col">
                                            <!-- Single Product Start -->
                                            <div class="single-product-wrap mt-10">
                                                <div class="product-image">
                                                    <a  href="{{ url('/ProductDetail/'.replaceLink($productTab_2[$i]->title)) }}"><img src="{{ $url_path_productTab_2 }}" alt="{{ $productTab_2[$i]->title }}" title="{{ $productTab_2[$i]->title }}"></a>
                                                </div>
                                                <div class="product-content">
                                                    <div class="price-box">
                                                        <span class="new-price">฿{{ number_format($productTab_2[$i]->price) }}</span>
                                                        <span class="old-price">฿{{ number_format($productTab_2[$i]->rrp) }}</span>
                                                    </div>
                                                    <h6 class="product-name "><a href="{{ url('/ProductDetail/'.replaceLink($productTab_2[$i]->title)) }}" class="line-clamp">{{ $productTab_2[$i]->title }}</a></h6>
                                                    <div class="product-button-action">
                                                        <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Tab 2 -->

<!-- Product Tab 3 -->
<div class="product-area section-ptb bg-gray">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-box-wrapper">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!-- Section Title Start -->
                            <div class="section-title ml-3 mb-20">
                                <h3>หลอดพลาสติก</h3>
                            </div>
                            <!-- Section Title End -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="view-all-product text-end mb-15">
                                <a href="#">View All <i class="icon-chevrons-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row row-8 border-tp-gray no-gutters box-product-wrap">
                        <div class="col-lg-4 col-md-4">
                            <div class="product-col border_none">
                                <!-- Single Product Start -->
                                @php
                                    $url_path_3 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_3[0]->code."_F.jpg";
                                @endphp
                                <div class="single-product-wrap">
                                    <div class="product-image text-center">
                                        <a href="{{ url('/ProductDetail/'.replaceLink($productTab_3[0]->title) )}}"><img src="{{ $url_path_3 }}" alt="{{ $productTab_3[0]->title }}" title="{{ $productTab_3[0]->title }}" style="width: 330px; height: 330px;"></a>
                                        {{-- <span class="onsale">Sale!</span> --}}
                                    </div>
                                    <div class="product-button">
                                        <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                                    </div>
                                    <div class="product-content">
                                        <div class="price-box">
                                            <span class="new-price">฿{{ number_format($productTab_3[0]->price) }}</span>
                                            <span class="old-price">฿{{ number_format($productTab_3[0]->rrp) }}</span>
                                        </div>
                                        <h6 class="product-name"><a href="{{ url('/ProductDetail/'.replaceLink($productTab_3[0]->title) )}}" title="{{ $productTab_3[0]->title }}">{{ $productTab_3[0]->title }}</a></h6>
                                        {{-- <div class="product-rating">
                                            <ul>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                            </ul>
                                        </div> --}}
                                        <div class="product-button-action">
                                            <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="product-wrapper-five">
                                <div class="row row-8 product-two-row-5">
                                    @for ($i = 1; $i < count($productTab_3); $i++)
                                    @php
                                        $url_path_productTab_3 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_3[$i]->code."_F.jpg";
                                    @endphp
                                    <div class="product-col">
                                        <!-- Single Product Start -->
                                        <div class="single-product-wrap mt-10">
                                            <div class="product-image">
                                                <a href="{{ url('/ProductDetail/'.replaceLink($productTab_3[$i]->title)) }}"><img src="{{ $url_path_productTab_3 }}" alt="{{ $productTab_3[$i]->title }}" title="{{ $productTab_3[$i]->title }}"></a>
                                            </div>
                                           
                                            <div class="product-content">
                                                <div class="price-box">
                                                    <span class="new-price">฿{{ number_format($productTab_3[$i]->price) }}</span>
                                                    <span class="old-price">฿{{ number_format($productTab_3[$i]->rrp) }}</span>
                                                </div>
                                                <h6 class="product-name "><a href="{{ url('/ProductDetail/'.replaceLink($productTab_3[$i]->title)) }}" class="line-clamp">{{ $productTab_3[$i]->title }}</a></h6>
                                                <div class="product-button-action">
                                                    <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Tab 3 -->

<!-- Product Tab 4 -->
<div class="product-area section-ptb">
    <div class="container-ext">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-box-wrapper">

                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!-- Section Title Start -->
                            <div class="section-title ml-3 mb-20">
                                <h3>ผลิตภัณฑ์จากกระดาษ</h3>
                            </div>
                            <!-- Section Title End -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="view-all-product text-end mb-15">
                                <a href="#">View All <i class="icon-chevrons-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row row-8 border-tp-gray no-gutters box-product-wrap">
                        <div class="col-imgbanner">
                            <div class="box-area-image">
                                <img src="assets/images/banner/img-tab2-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-single-product">
                            <div class="product-col border_none">
                                <!-- Single Product Start -->
                                @php
                                    $url_path_4 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_4[0]->code."_F.jpg";
                                @endphp
                                <div class="single-product-wrap">
                                    <div class="product-image text-center">
                                        <a href="{{ url('/ProductDetail/'.replaceLink($productTab_4[0]->title) )}}"><img src="{{ $url_path_4 }}"  alt="{{ $productTab_4[0]->title }}" title="{{ $productTab_4[0]->title }}"></a>
                                        {{-- <span class="onsale">Sale!</span> --}}
                                    </div>
                                    <div class="product-button">
                                        <a href="wishlist.html" class="add-to-wishlist"><i class="icon-heart"></i></a>
                                    </div>
                                    <div class="product-content">
                                        <div class="price-box">
                                            <span class="new-price">฿{{ number_format($productTab_4[0]->price) }}</span>
                                            <span class="old-price">฿{{ number_format($productTab_4[0]->rrp) }}</span>
                                        </div>
                                        <h6 class="product-name"><a href="{{ url('/ProductDetail/'.replaceLink($productTab_4[0]->title) )}}">{{ $productTab_4[0]->title }}</a></h6>
                                        {{-- <div class="product-rating">
                                            <ul>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li><a href="#"><i class="icon-star"></i></a></li>
                                                <li class="bad-reting"><a href="#"><i class="icon-star"></i></a></li>
                                            </ul>
                                        </div> --}}
                                        <div class="product-button-action">
                                            <a href="#" class="add-to-cart">Select options</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Product End -->
                            </div>
                        </div>
                        <div class="col-lg-5 col-group-products">
                            <div class="product-wrapper-five">
                                <div class="row row-8 product-two-row-3">
                                    @for ($i = 1; $i < count($productTab_4); $i++)
                                    @php
                                        $url_path_productTab_4 = "https://images.jtpackconnect.com/imageallproducts/".$productTab_4[$i]->code."_F.jpg";
                                    @endphp
                                    <div class="product-col">
                                        <!-- Single Product Start -->
                                        <div class="single-product-wrap mt-10">
                                            <div class="product-image">
                                                <a href="{{ url('/ProductDetail/'.replaceLink($productTab_4[$i]->title)) }}"><img src="{{ $url_path_productTab_4 }}" alt="{{ $productTab_4[$i]->title }}" title="{{ $productTab_4[$i]->title }}"></a>
                                            </div>
                                            <div class="product-content">
                                                <div class="price-box">
                                                    <span class="new-price">฿{{ number_format($productTab_4[$i]->price) }}</span>
                                                    <span class="old-price">฿{{ number_format($productTab_4[$i]->rrp) }}</span>
                                                </div>
                                                <h6 class="product-name "><a href="{{ url('/ProductDetail/'.replaceLink($productTab_4[$i]->title)) }}" class="line-clamp">{{ $productTab_2[$i]->title }}</a></h6>
                                                <div class="product-button-action">
                                                    <a href="#" class="add-to-cart">เพิ่มลงตะกร้า</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Product End -->
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Tab 4 -->

<div class="section-box section-pt-30">
    <!-- Banner Area Start -->
    <div class="banner-area section-pb-30">
        <div class="container-ext">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-banner mb-30">
                        <a href="#"><img src="{{ asset('assets/img_custom/โปรโมทกล่อง.jpg') }}" alt="โปรโมทกล่อง" style="width: 100%; height: 170px;"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-banner mb-30">
                        <a href="#"><img src="{{ asset('assets/img_custom/โปรโมทหลอด.jpg') }}" alt="โปรโมทหลอด" style="width: 100%; height: 170px;"></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="single-banner mb-30">
                        <a href="#"><img src="{{ asset('assets/img_custom/โปรโมทฟิม.jpg') }}" alt="โปรโมทฟิม" style="width: 100%;  height: 170px;"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection