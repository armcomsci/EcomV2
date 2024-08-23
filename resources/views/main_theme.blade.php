<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>JT Pack of foods (E-commerce)</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layout.css')

    @yield('css')

    <style>
        .line-clamp{
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            white-space: normal;
            overflow: hidden;
        }
        .cart-title-width{
            max-width: 120px;
        }
    </style>
</head>
<body>

    <div class="main-wrapper">
        @include('layout.header')

        @yield('content')

        @include('layout.footer')
    </div>

    @include('layout.script')

    @php
        $url = url('/');
    @endphp
    <script>
        var url = '{{ $url }}';
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function Logout(e){
            e.preventDefault();
            var urlToRedirect = e.currentTarget.getAttribute('href');

            Swal.fire({
                title: "ต้องการออกจากระบบ ?",
                html: "",
                icon: "warning",
                showConfirmButton : true,
                showCancelButton : true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href =  urlToRedirect;
                }
            });
        }

        $(document).ready(function () {
            $('.add-to-cart').click(function (e) { 
                e.preventDefault();
                let code = $(this).data('code');
                $.ajax({
                    type: "post",
                    url: url+"/AddCart",
                    data: {'code':code},
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
                });
            });
            $('.clearOrder').click(function(e){
                Swal.fire({
                    title: "ต้องการเคลียร์สินค้าทั้งหมด ?",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ยืนยัน",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: url+"/ClearCart",
                            // data: {'code':code},
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
                                if(response == 'success'){
                                    Swal.fire({
                                        title: "ทำรายการสำเร็จ !",
                                        text: "",
                                        icon: "success"
                                    }).then((result) => {
                                        location.reload();
                                    });
                                }
                            }
                        });
                       
                    }
                });
            });   
        });
        
        $(document).on('click','.remove_from_cart',function(e){
            e.preventDefault();
            let code            = $(this).data('code');
            let productTitle    = $(this).prev().prev().children().text();
            Swal.fire({
                title: "ต้องการลบสินค้าในตะกร้า ?",
                text: productTitle,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: url+"/ClearCart",
                        data: {'code':code},
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
                            if(response == 'success'){
                                Swal.fire({
                                    title: "ทำรายการสำเร็จ !",
                                    text: "",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                    
                }
            });
        })
    </script>

    @yield('script')
</body>

</html>