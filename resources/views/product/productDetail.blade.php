@extends('main_theme')

@section('css')
<style>
    .single-add-to-cart{
        max-width: 550px;
    }
    .quantity-container {
        display: inline-flex;
        align-items: center;
        background-color: #8CC63F; /* สีเขียว */
        border-radius: 5px;
        overflow: hidden;
    }

    .quantity-btn {
        background-color: #8CC63F; /* สีเขียว */
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 18px;
        width: 30px;
        text-align: center;
    }

    #quantity {
        width: 70px;
        text-align: center;
        border: none;
        font-size: 18px;
        padding: 5px;
        background-color: white;
    }

    .order-summary {
        width: 80%;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        font-family: sans-serif;
    }

    .order-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 16px;
    }

    hr {
        border: none;
        border-top: 1px solid #ddd;
        margin: 10px 0;
    }

    .total {
        font-weight: bold;
        font-size: 18px;
    }

    .order-button {
        background-color: #ff1493;
        color: white;
        border: none;
        padding: 15px;
        width: 48%;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
        margin-top: 20px;
    }
    .color-box {
        display: inline-block;
        padding: 15px 30px;
        border: 2px solid #8CC63F; /* ขอบสีเขียว */
        border-radius: 8px;
        font-size: 18px;
        color: #000000; /* สีตัวอักษรดำ */
        text-align: center;
        font-family: sans-serif;
        cursor: pointer;
    }
    .order-button:hover {
        background-color: #ff69b4;
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
                        <ul class="stock-cont mt-3">
                            <li class="product-sku">
                                <h5>รหัสสินค้า: <span>{{ $product->code }}</span></h5>
                            </li>
                            <li class="product-stock-status">
                                <h5>หมวด: 
                                    <a href="{{ url('/Product/'.$titleCate->CateTitle) }}">{{ $titleCate->CateTitle }}</a>,
                                    <a href="{{ url('/Product/'.$titleCate->CateTitle.'/'.$product->Category_title) }}">{{ $product->Category_title }}</a>
                                </h5>
                            </li>
                        </ul>
                        @if ($productSpec->ColorAppearanceTexture != "N/A")
                        <div class="color-box mt-3 mb-3"> 
                            {{ $productSpec->ColorAppearanceTexture }}
                        </div>
                        @endif
                        <h3>จำนวน</h3>
                        <div class="quantity-container">
                            <button class="quantity-btn" id="minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
                            <input type="text" id="quantity" name="quantity"  value="1" readonly title="Qty">
                            <button class="quantity-btn" id="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                        {{-- <div class="single-add-to-cart mt-3">
                            <form action="#" class="cart-quantity d-flex">
                                <div class="quantity">
                                    <div class="cart-plus-minus">
                                        <input type="number" class="input-text" name="quantity" value="1" title="Qty">
                                    </div>
                                </div>
                                <button class="add-to-cart-siggle cart-plus-minus" data-code="{{ $product->code }}" type="button" data-cart="add">เพิ่มลงตะกร้า</button>
                                <button class="add-to-cart-now" type="button" data-code="{{ $product->code }}" data-cart="now">ซื้อเลย</button>
                            </form>
                        </div> --}}
                        <div class="order-summary mt-3">
                            <div class="order-row">
                                <span>จำนวน</span>
                                <span>0 ชิ้น</span>
                            </div>
                            <div class="order-row">
                                <span>ราคา</span>
                                <span>0 บาท/ชิ้น</span>
                            </div>
                            <hr>
                            <div class="order-row total">
                                <span>ราคาสุทธิ</span>
                                <span>{{ number_format($product->price) }} บาท</span>
                            </div>
                            <button class="order-button add-siggle cart-plus-minus" data-code="{{ $product->code }}" type="button" data-cart="add">เพิ่มลงตะกร้า</button>
                            <button class="order-button add-now" type="button" data-code="{{ $product->code }}" data-cart="now">ซื้อเลย</button>
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
                                <a data-bs-toggle="tab" role="tab" href="#description" class="active">รายละเอียดสินค้า</a>
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
                                    <h4>วัสดุ</h4>
                                    <h5>{{  $productSpec->RawMaterialName  }}</h5>
                                </div>
                                <div class="product_desc mb-30">
                                    <h4>ขนาดสินค้า</h4>
                                    <h5>ขนาด : {{  convertInchToCm($productSpec->GW_width)." x ".convertInchToCm($productSpec->GW_length)." x ".convertInchToCm($productSpec->GW_Heigth)   }}CM</h5>
                                </div>
                                <div class="product_desc mb-30">
                                    <h4>ขนาดบรรจุ 1 กล่อง</h4>
                                    {{ $productSpec->packsizname }}
                                </div>
                                {{-- <div class="product_desc mb-30">
                                    <h4>ข้อแนะนำการใช้งาน</h4>
                                    <h5>{{  $productSpec->ProductFeatures  }}</h5>
                                </div>
                                <div class="product_desc mb-30">
                                    <h4>อายุการใช้งาน</h4>
                                    <h5>{{  $productSpec->ShelfLife  }}</h5>
                                </div> --}}
                            </div>
                        </div>
                        <!-- End Single Content -->           
                    </div>
                </div>
                
            </div>
        </div>

        <div class="product-description-area section-pt mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-tab">
                        <ul role="tablist" class="nav">
                            <li class="active" role="presentation">
                                <a data-bs-toggle="tab" role="tab" href="#description" class="active">คุณสมบัติสินค้า</a>
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
                                    @if($productSpec->UseMicroWave == "N")
                                        <h5>ไม่สามารถเข้าไมโครเวฟได้</h5>
                                    @elseif($productSpec->UseMicroWave == "Y") 
                                        <h5>สามารถเข้าไมโครเวฟได้</h5>
                                    @endif
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
        var min = 1;
        var max = 99;   

        $('.add-siggle, .add-now').click(function (e) { 
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

        $('#plus').click(function() {
            var currentVal = parseInt($('#quantity').val());
            if (currentVal < max) {
                $('#quantity').val(currentVal + 1);
            }
        });

        $('#minus').click(function() {
            var currentVal = parseInt($('#quantity').val());
            if (currentVal > min) {
                $('#quantity').val(currentVal - 1);
            }
        });
    });
</script>
@endsection