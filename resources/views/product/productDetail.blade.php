@extends('main_theme')

@section('css')
<style>
    .single-add-to-cart{
        max-width: 550px;
    }
</style>
@endsection

@section('content')
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/Product/'.$titleCate->CateTitle) }}">{{ $titleCate->CateTitle }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/Product/'.$titleCate->CateTitle.'/'.$product->Category_title) }}">{{ $product->Category_title }}</a></li>
                    <li class="breadcrumb-item active">{{ $detail }}</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb-area end -->


<!-- main-content-wrap start -->
<div class="main-content-wrap shop-page section-ptb">
    <div class="container">
        <div class="row single-product-area product-details-inner">
            <div class="col-lg-5 col-md-6">
                <!-- Product Details Left -->
                <div class="product-large-slider">
                    @php
                         $fontStyle = array('1'=>'F','2'=>'B','3'=>'L','4'=>'R','5'=>'T','6'=>'BT','7'=>'P');
                    @endphp
                    @foreach ($fontStyle as $key => $value)
                        @php
                            $url_path = "https://images.jtpackconnect.com/imageallproducts/".$product->code."_".$value.".jpg";
                        @endphp
                        <div class="pro-large-img img-zoom">
                            <img src="{{ $url_path }}" alt="{{  $product->title }}" title="{{  $product->title }}" />
                            <a href="{{ $url_path }}" data-fancybox="images"  title="{{  $product->title }}"><i class="fa fa-search"></i></a>
                        </div>
                    @endforeach 
                 
                </div>
                <div class="product-nav">
                    @foreach ($fontStyle as $key => $value)
                        @php
                            $url_path = "https://images.jtpackconnect.com/imageallproducts/".$product->code."_".$value.".jpg";
                        @endphp
                        <div class="pro-nav-thumb">
                            <img src="{{ $url_path }}" alt="{{  $product->title }}" title="{{  $product->title }}" />
                        </div>
                    @endforeach 
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content">
                    <div class="product-info">
                        <h3>{{ $product->title }}</h3>
                       
                        <div class="price-box">
                            <span class="new-price">฿{{ number_format($product->price) }}</span>
                            <span class="old-price">฿{{ number_format($product->rrp) }}</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>

                        <div class="single-add-to-cart">
                                <form action="#" class="cart-quantity d-flex">
                                    <div class="quantity">
                                        <div class="cart-plus-minus">
                                            <input type="number" class="input-text" name="quantity" value="1" title="Qty">
                                        </div>
                                    </div>
                                    <button class="add-to-cart-siggle cart-plus-minus" data-code="{{ $product->code }}" type="button" data-cart="add">เพิ่มลงตะกร้า</button>
                                    <button class="add-to-cart-now" type="button" data-code="{{ $product->code }}" data-cart="now">ซื้อเลย</button>
                                </form>
                        </div>
                        <ul class="stock-cont mt-3">
                            <li class="product-sku">รหัสสินค้า: <span>{{ $product->code }}</span></li>
                            <li class="product-stock-status">หมวด: <a href="{{ url('/Product/'.$titleCate->CateTitle) }}">{{ $titleCate->CateTitle }}</a>,<a href="{{ url('/Product/'.$titleCate->CateTitle.'/'.$product->Category_title) }}">{{ $product->Category_title }}</a></li>
                        </ul>
                        <div class="share-product-socail-area">
                            <p>Share this product</p>
                            <ul class="single-product-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-description-area section-pt">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-tab">
                        <ul role="tablist" class="nav">
                            <li class="active" role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#description" class="active">Description</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product_details_tab_content ">
                        <!-- Start Single Content -->
                        <div class="product_tab_content" id="description" role="tabpanel">
                            <div class="product_description_wrap  mt-30">
                                <div class="product_desc mb-30">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>

                                    <p>Pellentesque aliquet, sem eget laoreet ultrices, ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tempor, lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio quis mi. Cras neque metus, consequat et blandit et, luctus a nunc. Etiam gravida vehicula tellus, in imperdiet ligula euismod eget.</p>
                                </div>

                            </div>
                        </div>
                        <!-- End Single Content -->           
                    </div>
                </div>
            </div>
        </div>

        <div class="related-product-area section-pt">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>สินค้าแนะนำ</h3>
                    </div>
                </div>
            </div>
            <div class="row row-8 product-row-6-active">
                @foreach ($related as $item)
                @php
                    $url_path_related = "https://images.jtpackconnect.com/imageallproducts/".$item->code."_F.jpg";
                @endphp
                <div class="product-col">
                    <!-- Single Product Start -->
                    <div class="single-product-wrap mt-10">
                        <div class="product-image">
                            <a href="{{ url('/ProductDetail/'.replaceLink($item->title)) }}">
                                <img src="{{ $url_path_related }}" alt="{{  $item->title }}" title="{{  $item->title }}">
                            </a>
                            {{-- <span class="onsale">Sale!</span> --}}
                        </div>
                        <div class="product-content">
                            <div class="price-box">
                                <span class="new-price">฿{{ number_format($item->price) }}</span>
                                <span class="old-price">฿{{ number_format($item->rrp) }}</span>
                            </div>
                            <h6 class="product-name"><a href="{{ url('/ProductDetail/'.replaceLink( $item->title)) }}" class="line-clamp">{{  $item->title }}</a></h6>
                            <div class="product-button-action">
                                <a href="#" class="add-to-cart" data-code="{{ $item->code }}">เพิ่มลงตะกร้า</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>
<!-- main-content-wrap end -->
@endsection

@section('script')
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script>
    $("input[name='quantity']").mask('00');
    $(document).ready(function () {
        $('.add-to-cart-siggle, .add-to-cart-now').click(function (e) { 
            e.preventDefault();
            let code        = $(this).data('code');
            let quantity    = $("input[name='quantity']").val();
            let cart        = $(this).data('cart');
            $.ajax({
                type: "post",
                url: url+"/AddCart",
                data: {'code':code,'qty':quantity},
                beforeSend:function(){
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
                },
                success: function (response) {
                    Swal.close();
                    if(response['status'] == "01"){
                        Swal.fire({
                            title: 'สินค้าในสต็อกคงเหลือไม่เพียงพอ',
                            text: "ขออภัยในความไม่สะดวก",
                            icon: 'warning',
                        });
                        return false;
                    }else if(response['status'] == "00"){
                        if(cart == 'now'){
                            window.location.href = url+"/Checkout"
                        }else{
                            let product = response['txt'][code];
                            let checkId = $(".ProductCode-"+product.product_code);
                            if(checkId.length == 0){
                                let html;
                                let url_path = "https://images.jtpackconnect.com/imageallproducts/"+product.product_code+"_F.jpg";

                                html += "<li class=\"cart-item ProductCode-"+product.product_code+"\" >"
                                html += "<div class=\"cart-image\">"
                                html += "<a href=\""+url+"/Checkout\"><img alt=\""+product.product_name+"\" src="+url_path+"></a>";
                                html += "</div>"
                                html += "<div class=\"cart-title\">";
                                html += "<a href=\""+url+"/Checkout\">"
                                html += "<h4 class=\"cart-title-width line-clamp\">"+product.product_name+"</h4>"
                                html += "</a>"
                                html += "<div class=\"quanti-price-wrap\">"
                                html += "<span class=\"quantity\">"+product.quantity+"×</span>";
                                html += "<div class=\"price-box\"><span class=\"new-price\">฿"+product.product_price+"</span></div>";
                                html += "</div>"
                                html += "<a class=\"remove_from_cart\" href=\"#\" data-code="+product.product_code+"  onclick=\"return false;\" ><i class=\"icon-trash icons\"></i></a>";
                                html += "</div>"
                                html += "</li>"

                                $('.cart-checkout').prepend(html);
                            }else{
                                $(checkId).find('.quantity').text(product.quantity+"×");
                            }
                            
                            $('.cart-total').text(response['qtySum']);
                            $('.cart-total-amunt').text(response['Sum']);

                            $('.subtotal-title').find('span').text('฿'+response['Sum']);
                        }
                    }
                }
            });
        });
    });
</script>
@endsection