<header class="header">
    <!-- Header Top Start -->
    <div class="header-top-area d-none d-lg-block border-bm-gray">
        @if (auth()->check())
            @php
                
                if(auth()->user()->email != ''){
                    $username = auth()->user()->email;
                }else{
                    $username = auth()->user()->username;
                    if(strpos($username,' ') > 1 ){
                        $exUser = explode(' ',$username);
                        $username = $exUser[0];
                    }
                }
                
            @endphp
        @endif
        <div class="container-ext">
            <div class="row">
                <div class="offset-lg-6 col-lg-6">
                    <div class="top-info-wrap text-end">
                        <ul class="my-account-container">
                            <li><a href="{{ url('/Checkout') }}">ตะกร้า</a></li>
                            @if (auth()->check())
                                <li><a href="{{ url('/Profile') }}">{{ $username }}</a></li>
                                <li><a href="{{ url('/Logout') }}" onclick="Logout(event)">ออกจากระบบ</a></li>
                            @else
                            <li><a href="{{ url('/Login') }}">เข้าสู่ระบบ</a></li>
                            @endif  
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Header Top End -->

    <!-- haeader Mid Start -->
    <div class="haeader-mid-area border-bm-1 d-none border-bm-gray d-lg-block ">
        <div class="container-ext">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-3 col-md-4 col-5">
                    <div class="logo-area  d-mt-30">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/images/icon/logo.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-9">
                    <div class="contact-call-wrap-top d-mt-30">
                        <img src="{{ asset('assets/images/icon/img-headphone.png') }}" alt="">
                        <div class="footer-call">
                            <p>Call Center</p>
                            <p>ติดต่อเรา : <a  href="tel:02-033-7900">02-033-7900 กด 5</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-9">

                    <div class="search-box-wrapper full_width">
                        <div class="search-box-inner-wrap">
                            <form class="search-box-inner border-2">
                                <div class="search-select-box">
                                    {{-- <select class="nice-select">
                                        <optgroup label="organic food">
                                            <option value="volvo">All</option>
                                            <option value="saab">watch</option>
                                            <option value="saab">air cooler</option>
                                            <option value="saab">audio</option>
                                            <option value="saab">speakers</option>
                                            <option value="saab">amplifires</option>
                                        </optgroup>
                                        <optgroup label="Fashion">
                                            <option value="mercedes">Womens tops</option>
                                            <option value="audi">Jeans</option>
                                            <option value="audi">Shirt</option>
                                            <option value="audi">Pant</option>
                                            <option value="audi">Watch</option>
                                            <option value="audi">Handbag</option>
                                        </optgroup>
                                    </select> --}}
                                </div>
                                <div class="search-field-wrap">
                                    <input type="text" class="search-field" placeholder="Search product...">

                                    <div class="search-btn">
                                        <button><i class="icon-search"></i></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3">
                    <div class="right-blok-box text-white d-flex">
                        <div class="box-cart-wrap">
                            <div class="shopping-cart-wrap">
                                @php
                                    $Cart       =  session()->get('cart');
                                    $qtySum     = [0];
                                    $Sum        = [0];
                                    if(session()->has("cart")){
                                        foreach ($Cart as $key => $value) {
                                            $qtySum[]   = $value['quantity'];
                                            $Sum[]      = $value['product_price']*$value['quantity'];
                                        }
                                    }
                                @endphp
                                <a href="#"><i class="icon-shopping-bag2"></i><span class="cart-total">{{ array_sum($qtySum) }}</span> <span class="cart-total-amunt">{{ number_format(array_sum($Sum),2) }}</span></a>
                                <ul class="mini-cart">
                                    <div class="cart-checkout">
                                        @if(session()->has("cart"))
                                        @foreach ($Cart as $itemInCart)
                                        @php
                                            $url_path = "https://images.jtpackconnect.com/imageallproducts/".$itemInCart['product_code']."_F.jpg";
                                        @endphp
                                        <li class="cart-item ProductCode-{{ $itemInCart['product_code'] }}">
                                            <div class="cart-image">
                                                <a href="{{ url('/Checkout') }}"><img alt="" src="{{ $url_path }}"></a>
                                            </div>
                                            <div class="cart-title">
                                                <a href="{{ url('/Checkout') }}">
                                                    <h4 class="cart-title-width line-clamp">{{ $itemInCart['product_name'] }}</h4>
                                                </a>
                                                <div class="quanti-price-wrap">
                                                    <span class="quantity">{{ $itemInCart['quantity'] }} ×</span>
                                                    <div class="price-box"><span class="new-price">฿{{ $itemInCart['product_price'] }}</span></div>
                                                </div>
                                                <a class="remove_from_cart" data-code="{{ $itemInCart['product_code'] }}" href="#"  onclick="return false;" ><i class="icon-x"></i></a>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    </div>
                                    <li class="subtotal-box">
                                        <div class="subtotal-title">
                                            <h3>ยอดรวม :</h3><span>฿{{ number_format(array_sum($Sum),2) }}</span>
                                        </div>
                                    </li>
                                    <li class="mini-cart-btns">
                                        <div class="cart-btns">
                                            <a href="#" class="clearOrder" onclick="return false;" >ลบรายการทั้งหมด</a>
                                            <a href="{{ url('/Checkout') }}">สั่งซื้อสินค้า</a>
                                        </div>
                                    </li>
                                  
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- haeader Mid End -->

    <!-- haeader bottom Start -->
    <div class="haeader-bottom-area bg-gren header-sticky">
        <div class="container-ext">
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="categories-menu-wrap_box">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h5 class="categori_toggle">หมวดหมู่สินค้า</h5>
                            </div>
                            <?php
                                $categorys2 = Get_header_category();
                            ?>
                            <div class="categories_menu_toggle">
                                <ul>
                                    @foreach ($categorys2 as $item)
                                        <li class="menu_item_children categorie_list"><a href="{{ url('/Product/'.$item->title) }}">{{ $item->title }}<i class="fa fa-angle-right"></i></a>
                                            <ul class="categories_mega_menu">
                                                @php
                                                    $sub_cats = Get_header_category($item->id);
                                                @endphp
                                                @foreach ($sub_cats as $sub_cat)
                                                    <li><a href="{{ url('/Product/'.$item->title.'/'.$sub_cat->title) }}">{{ $sub_cat->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 d-none d-lg-block">

                    <div class="main-menu-area white_text">
                        <!--  Start Mainmenu Nav-->
                        <nav class="main-navigation">
                            <ul>
                                <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                                <li><a href="{{ url('/Product') }}">สินค้าทั้งหมด</a></li>
                                <li><a href="{{ url('/SpecialProduct') }}">สินค้าราคาพิเศษ</a></li>
                                <li><a href="{{ url('/OrderProcess') }}">วิธีสั่งซื้อ</a></li>
                                <li><a href="{{ url('/Customization') }}">ออกแบบโลโก้</a></li>
                                <li><a href="{{ url('/Contact') }}">ติดต่อเรา</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>

                <div class="col-5 col-md-6 d-block d-lg-none">
                    <div class="logo"><a href="{{ url('/') }}"><img src="assets/images/logo/logo.png" alt=""></a></div>
                </div>

                <div class="col-lg-3 col-md-6 col-7">
                    <div class="right-blok-box text-white d-block d-lg-none d-flex">
                        <div class="shopping-cart-wrap">
                            <a href="#"><i class="icon-shopping-bag2"></i><span class="cart-total">{{ array_sum($qtySum) }}</span> <span class="cart-total-amunt">{{ number_format(array_sum($Sum),2) }}</span></a>
                            <ul class="mini-cart">
                                <div class="cart-checkout">
                                @if(session()->has("cart"))
                                @foreach ($Cart as $itemInCart)
                                @php
                                    $url_path = "https://images.jtpackconnect.com/imageallproducts/".$itemInCart['product_code']."_F.jpg";
                                @endphp
                                <li class="cart-item">
                                    <div class="cart-image ProductCode-{{ $itemInCart['product_code'] }}">
                                        <a href="{{ url('/Checkout') }}"><img alt="" src="{{ $url_path }}"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="{{ url('/Checkout') }}">
                                            <h4 class="cart-title-width line-clamp">{{ $itemInCart['product_name'] }}</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">{{ $itemInCart['quantity'] }} ×</span>
                                            <div class="price-box"><span class="new-price">฿{{ $itemInCart['product_price'] }}</span></div>
                                        </div>
                                        <a class="remove_from_cart" data-code="{{ $itemInCart['product_code'] }}" href="#"  onclick="return false;" ><i class="icon-x"></i></a>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                                <li class="subtotal-box">
                                    <div class="subtotal-title">
                                        <h3>ยอดรวม :</h3><span>฿{{ number_format(array_sum($Sum),2) }}</span>
                                    </div>
                                </li>
                                <li class="mini-cart-btns">
                                    <div class="cart-btns">
                                        <a href="#" class="clearOrder" onclick="return false;">ลบรายการทั้งหมด</a>
                                        <a href="{{ url('/Checkout') }}">สั่งซื้อสินค้า</a>
                                    </div>
                                </li>
                                </div>
                            </ul>
                        </div>
                        <div class="mobile-menu-btn ">
                            <div class="off-canvas-btn">
                                <a href="#"><img src="{{ asset('assets/images/icon/bg-menu.png') }} " alt=""></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- haeader bottom End -->

    <!-- off-canvas menu start -->
    <aside class="off-canvas-wrapper">
        <div class="off-canvas-overlay"></div>
        <div class="off-canvas-inner-content">
            <div class="btn-close-off-canvas">
                <i class="icon-x"></i>
            </div>

            <div class="off-canvas-inner">

                <div class="search-box-offcanvas">
                    <form>
                        <input type="text" placeholder="Search product...">
                        <button class="search-btn"><i class="icon-search"></i></button>
                    </form>
                </div>

                <!-- mobile menu start -->
                <div class="mobile-navigation">

                    <!-- mobile menu navigation start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li><a href="{{ url('/') }}">หน้าหลัก</a></li>
                            <li><a href="{{ url('/Product') }}">สินค้าทั้งหมด</a></li>
                            <li><a href="{{ url('/OrderProcess') }}">วิธีสั่งซื้อ</a></li>
                            <li><a href="{{ url('/') }}">เทรนด์ฮิต</a></li>
                            <li><a href="{{ url('/Customization') }}">ออกแบบงานพิมพ์ LOGO</a></li>
                            <li><a href="{{ url('/Contact') }}">ติดต่อเรา</a></li>
                        </ul>
                    </nav>
                    <!-- mobile menu navigation end -->
                </div>
                <!-- mobile menu end -->


                <div class="header-top-settings offcanvas-curreny-lang-support">
                    <h5>My Account</h5>
                    <ul class="nav align-items-center">
                        <li class="language">English <i class="fa fa-angle-down"></i>
                            <ul class="dropdown-list">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                            </ul>
                        </li>
                        <li class="curreny-wrap">Currency <i class="fa fa-angle-down"></i>
                            <ul class="dropdown-list curreny-list">
                                <li><a href="#">$ USD</a></li>
                                <li><a href="#"> € EURO</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- offcanvas widget area start -->
                <div class="offcanvas-widget-area">
                    <div class="top-info-wrap text-start text-black">
                        <h5>My Account</h5>
                        <ul class="offcanvas-account-container">
                            <li><a href="{{ url('/Checkout') }}">ตะกร้า</a></li>
                            @if (auth()->check())
                                <li><a href="{{ url('/Profile') }}">{{ $username }}</a></li>
                                <li><a href="{{ url('/Logout') }}" onclick="Logout(event)">ออกจากระบบ</a></li>
                            @else
                            <li><a href="{{ url('/Login') }}">เข้าสู่ระบบ</a></li>
                            @endif
                        </ul>
                    </div>

                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->
</header>