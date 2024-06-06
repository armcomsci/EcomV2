<header class="header">
    <!-- Header Top Start -->
    <div class="header-top-area d-none d-lg-block border-bm-gray">

        <div class="container-ext">
            <div class="row">
                <div class="offset-lg-6 col-lg-6">
                    <div class="top-info-wrap text-end">
                        <ul class="my-account-container">
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Cart</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Checkout</a></li>
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
                        <img src="assets/images/icon/img-headphone.png" alt="">
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
                                    <select class="nice-select">
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
                                    </select>
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
                                <a href="#"><i class="icon-shopping-bag2"></i><span class="cart-total">2</span> <span class="cart-total-amunt">$260</span></a>
                                <ul class="mini-cart">
                                    <li class="cart-item">
                                        <div class="cart-image">
                                            <a href="single-product.html"><img alt="" src="assets/images/product/product-01.jpg"></a>
                                        </div>
                                        <div class="cart-title">
                                            <a href="single-product.html">
                                                <h4>Product Name 01</h4>
                                            </a>
                                            <div class="quanti-price-wrap">
                                                <span class="quantity">1 ×</span>
                                                <div class="price-box"><span class="new-price">$130.00</span></div>
                                            </div>
                                            <a class="remove_from_cart" href="#"><i class="icon-x"></i></a>
                                        </div>
                                    </li>
                                    <li class="cart-item">
                                        <div class="cart-image">
                                            <a href="single-product.html"><img alt="" src="assets/images/product/product-02.jpg"></a>
                                        </div>
                                        <div class="cart-title">
                                            <a href="single-product.html">
                                                <h4>Product Name 03</h4>
                                            </a>
                                            <div class="quanti-price-wrap">
                                                <span class="quantity">1 ×</span>
                                                <div class="price-box"><span class="new-price">$130.00</span></div>
                                            </div>
                                            <a class="remove_from_cart" href="#"><i class="icon-trash icons"></i></a>
                                        </div>
                                    </li>
                                    <li class="subtotal-box">
                                        <div class="subtotal-title">
                                            <h3>Sub-Total :</h3><span>$ 260.99</span>
                                        </div>
                                    </li>
                                    <li class="mini-cart-btns">
                                        <div class="cart-btns">
                                            <a href="cart.html">View cart</a>
                                            <a href="checkout.html">Checkout</a>
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
                                <li><a href="{{ url('/OrderProcess') }}">วิธีสั่งซื้อ</a></li>
                                <li><a href="{{ url('/') }}">เทรนด์ฮิต</a></li>
                                <li><a href="{{ url('/Customization') }}">ออกแบบงานพิมพ์ LOGO</a></li>
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
                            <a href="#"><i class="icon-shopping-bag2"></i><span class="cart-total">2</span> <span class="cart-total-amunt">$260</span></a>
                            <ul class="mini-cart">
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="single-product.html"><img alt="" src="assets/images/product/product-01.jpg"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="single-product.html">
                                            <h4>Product Name 01</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">1 ×</span>
                                            <div class="price-box"><span class="new-price">$130.00</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="#"><i class="icon-x"></i></a>
                                    </div>
                                </li>
                                <li class="cart-item">
                                    <div class="cart-image">
                                        <a href="single-product.html"><img alt="" src="assets/images/product/product-02.jpg"></a>
                                    </div>
                                    <div class="cart-title">
                                        <a href="single-product.html">
                                            <h4>Product Name 03</h4>
                                        </a>
                                        <div class="quanti-price-wrap">
                                            <span class="quantity">1 ×</span>
                                            <div class="price-box"><span class="new-price">$130.00</span></div>
                                        </div>
                                        <a class="remove_from_cart" href="#"><i class="icon-trash icons"></i></a>
                                    </div>
                                </li>
                                <li class="subtotal-box">
                                    <div class="subtotal-title">
                                        <h3>Sub-Total :</h3><span>$ 260.99</span>
                                    </div>
                                </li>
                                <li class="mini-cart-btns">
                                    <div class="cart-btns">
                                        <a href="cart.html">View cart</a>
                                        <a href="checkout.html">Checkout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mobile-menu-btn ">
                            <div class="off-canvas-btn">
                                <a href="#"><img src="assets/images/icon/bg-menu.png" alt=""></a>
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
                            <li class="menu-item-has-children"><a href="#">Home</a>
                                <ul class="dropdown">
                                    <li><a href="{{ url('/') }}">Home Page 1</a></li>
                                    <li><a href="index-2.html">Home Page 2</a></li>
                                    <li><a href="index-3.html">Home Page 3</a></li>
                                    <li><a href="index-4.html">Home Page 4</a></li>
                                    <li><a href="index-5.html">Home Page 5</a></li><li><a href="index-6.html">Home Page 6</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="#">Shop</a>
                                <ul class="megamenu dropdown">
                                    <li class="mega-title has-children"><a href="#">Shop Layouts</a>
                                        <ul class="dropdown">
                                            <li><a href="shop.html">Shop Left Sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                            <li><a href="shop-list-left.html">Shop List Left Sidebar</a></li>
                                            <li><a href="shop-list-right.html">Shop List Right Sidebar</a></li>
                                            <li><a href="shop-fullwidth.html">Shop Full Width</a></li>
                                        </ul>
                                    </li>
                                    <li class="mega-title has-children"><a href="#">Product Details</a>
                                        <ul class="dropdown">
                                            <li><a href="product-details.html">Single Product Details</a></li>
                                            <li><a href="variable-product-details.html">Variable Product Details</a></li>
                                            <li><a href="external-product-details.html">External Product Details</a></li>
                                            <li><a href="gallery-product-details.html">Gallery Product Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="mega-title has-children"><a href="#">Shop Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="error404.html">Error 404</a></li>
                                            <li><a href="compare.html">Compare Page</a></li>
                                            <li><a href="cart.html">Cart Page</a></li>
                                            <li><a href="checkout.html">Checkout Page</a></li>
                                            <li><a href="wishlist.html">Wish List Page</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Blog</a>
                                <ul class="dropdown">
                                    <li><a href="blog.html">Blog Left Sidebar</a></li>
                                    <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                    <li><a href="blog-grid.html">Blog Grid Page</a></li>
                                    <li><a href="blog-largeimage.html">Blog Large Image</a></li>
                                    <li><a href="blog-details.html">Blog Details Page</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children "><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="frequently-questions.html">FAQ</a></li>
                                    <li><a href="my-account.html">My Account</a></li>
                                    <li><a href="login-register.html">login &amp; register</a></li>
                                </ul>
                            </li>
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
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
                            <li><a href="my-account.html">My account</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                        </ul>
                    </div>

                </div>
                <!-- offcanvas widget area end -->
            </div>
        </div>
    </aside>
    <!-- off-canvas menu end -->
</header>