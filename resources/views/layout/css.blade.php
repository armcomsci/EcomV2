<!-- CSS
============================================ -->

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/plaza-font.css') }}">

<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/animation.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/fancy-box.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/jqueryui.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
    .cart-checkout{
        max-height: 500px;
        overflow: scroll;
        width: 270px;
        overflow-x: hidden;
    }
    .shopping-cart-wrap ul.mini-cart .cart-item .cart-title .remove_from_cart::before{
        color: red;
    }
    .mini-cart-btns .cart-btns a.clearOrder:hover {
        background: #bb0101;
        border: 1px solid #cf002d;
    }
</style>