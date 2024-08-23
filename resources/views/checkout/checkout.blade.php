@extends('main_theme')

@if(!(auth()->check()))
    @php
    $url = url('/');
    @endphp
    <script>
        var url = '{{ $url }}';   

        window.location.href = url+"/Login"
    </script>
@endif

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .process-step .btn:focus{outline:none}
    .process{display:table;width:100%;position:relative;margin-bottom: 20px;}
    .process-row,.process-row2,.process-row3,.process-row4{display:table-row}
    .process-step button[disabled]{opacity:1 !important;filter: alpha(opacity=100) !important}
    .process-row:before{top:55px;bottom:0;position:absolute;content:" ";width:20%;height:5px;background-color:#ffa920;z-order:0}
    .process-row-2:before{top:55px;bottom:0;position:absolute;content:" ";width: 50%;height:5px;background-color:#ffa920;z-order:0}
    .process-row-3:before{top:55px;bottom:0;position:absolute;content:" ";width: 100%;height:5px;background-color:#ffa920;z-order:0}
    /* .process-row-4:before{top:55px;bottom:0;position:absolute;content:" ";width: 70%;height:5px;background-color:#ffa920;z-order:0}
    .process-row-5:before{top:55px;bottom:0;position:absolute;content:" ";width: 90%;height:5px;background-color:#ffa920;z-order:0} */
    .process-step{display:table-cell;text-align:center;position:relative}
    .process-step p{margin-top:4px}
    .btn-circle{width:108px;height:108px;text-align:center;padding: 0px;border: none;}
    #form-bill-addr{ display: none; }
    .TypeShip,.TypePayment{ cursor: pointer; }
    .btn-addr{
        border: 1px solid #626262;
        line-height: 12px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        color: #ffffff;
        overflow: hidden;
        position: relative;
        z-index: 1;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }
    .btn-step,.btn-confirm{
        border: 1px solid #626262;
        line-height: 20px;
        padding: 10px 30px;
        font-size: 16px;
        font-weight: 500;
        text-transform: uppercase;
        color: #ffffff;
        overflow: hidden;
        position: relative;
        z-index: 1;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }
    .btn-modal{
        border: 1px solid #626262;
        line-height: 20px;
        padding: 4px 20px;
        font-size: 16px;
        font-weight: 500;
        text-transform: uppercase;
        color: #ffffff;
        overflow: hidden;
        position: relative;
        z-index: 1;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }
    .confirm_order_email,#re_otp{
        background: cornflowerblue;
    }
    #confirm_otp_email,#confirm_otp{
        background: darkgreen;
    }
    #cancel_otp_email,#cancel_otp{
        background: brown;
    }
    .confirm-otp,.confirm_order{
        background-color: cadetblue;
    }
    .confirm-email{
        background-color: indianred;
    }
    .next-step{
        background-color: #198754;
    }
    .prev-step{
        background-color: #fd7e14;
    }
    .active_type_ship,.active_type_pay{
        border: 2px solid #12be29;
        padding: 5px;
        border-radius: 5px;
    }
    .text-right{
        text-align: right;
    }
    .deleteItem,.AddItem,.deleteQty{
        cursor: pointer;
    }
</style>
<link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
@endsection

@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ยืนยันสินค้า</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>
@php
    $username = '';
    $readonly = '';
    if (auth()->check()){
        if(auth()->user()->email != ''){
            $username = auth()->user()->email;
            $readonly = 'readonly';
        }
    }   
    $getAddrShip    = getAddr('ship');
    $getAddrBill    = getAddr('vat');

    // $getAddrShip    = [];
    // $getAddrBill    = [];
    // dd($getAddrShip);
@endphp
<div class="main-content-wrap contact-wrap">
    <div class="contact-form-area section-ptb">
        <div class="container-ext" id="content-checkout">
            <div class="process">
                <div class="process-row nav nav-tabs">
                    <div class="process-step">
                        <button type="button" class="btn btn-default btn-circle" href="#checkout-menu1">
                            <img src="{{ asset('assets/img_custom/จัดส่ง.jpg') }}" class="step" id="step-1" alt="">
                        </button>
                        <p>ชื่อ/ที่อยู่จัดส่ง</p>
                    </div>
                    <div class="process-step">
                        <button type="button" class="btn btn-default btn-circle" href="#checkout-menu2">
                            <img src="{{ asset('assets/img_custom/ชำระเงินเทา.jpg') }}" class="step" id="step-2" alt="">
                        </button>
                        <p>ช่องทางชำระเงิน</p>
                    </div>
                    <div class="process-step">
                        <button type="button" class="btn btn-default btn-circle" href="#checkout-menu3">
                            <img src="{{ asset('assets/img_custom/cfเทา.jpg') }}" class="step" id="step-3" alt="">
                        </button>
                        <p>ยืนยันคำสั่งซื้อ</p>
                    </div>                             
                </div>
            </div>
            <div class="tab-content">
                <div id="checkout-menu1" class="tab-pane fade active in">
                    @include('checkout.checkout-step-1')
                </div>
                <div id="checkout-menu2" class="tab-pane">
                    @include('checkout.checkout-step-2')
                </div>     
                <div id="checkout-menu3" class="tab-pane ">
                    @include('checkout.checkout-step-3')
                </div>                      
            </div>
        </div>
        </div>
    </div>
</div>

@if(count($getAddrShip) > 0)
    @include('checkout.modal-add-address-ship')
@endif

@include('checkout.modal-add-address-bill')

@include('checkout.modal-otp-sms')

@include('checkout.modal-otp-email')

<div id="product_outstock" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <!-- Modal content-->
        <div class="modal-content" >
            <div class="modal-body" style="height: 100%;">
                <h4 class="modal-title">รายการที่คงเหลือไม่เพียงพอ</h4>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" id="p_out_stock">
                        <thead>
                            <tr>
                                <td class="text-center">ลำดับที่</td>
                                <td class="text-center">รูปภาพ</td>
                                <td class="text-left">ชื่อสินค้า</td>
                                <td class="text-center">จำนวน</td>
                                <td class="text-right">ราคาต่อหน่วย</td>
                                <td class="text-right">รวม</td>
                                <td class="text-center">ลบรายการ</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">บันทึกรายการ</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@if(!session()->has('cart'))
    @php
    $url = url('/');
    @endphp
    <script>
        var url = '{{ $url }}';   
        Swal.fire({
            title: 'ไม่พบสินค้าในตะกร้า',
            text: 'กรุณาเลือกสินค้า',
            icon: 'warning',
            padding: '2em'
        }).then((result) => {
            window.location.href = url+"/Product"
        });
        
    </script>
@endif
<script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
<script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="{{ asset('assets/js/GBPrimePay.js') }}"></script>
<script>
   
    var FormCheckOut        = {};

    $(document).on('click','.next-step, .prev-step',function(){
        var $activeTab          = $('.tab-pane.active');
       
        if ( $(this).hasClass('next-step') ){

            var nextTab         = $activeTab.next('.tab-pane').attr('id');
            var required_status = true;
            if(nextTab == "checkout-menu2"){

                let stepForm_1      = $('#Checkout-Step-1').find('.require-step-1').length;
               
                if(stepForm_1 > 0){
                    let required        = $('#Checkout-Step-1 .require-step-1');
                    $.each(required, function(key,val) {             
                        let input = $(this);
                        if(input.val() == ""){
                            let textAlert = input.prev().text();
                            Swal.fire({
                                title: 'กรุณาระบุข้อมูล',
                                text: 'ระบุ'+textAlert,
                                icon: 'warning',
                                padding: '2em'
                            }).then((result) => {
                                input.focus();
                            });
                            required_status = false;
                            return false;
                        }    
                    }); 
                }

                let check_bill = $('#chekout-bill-addr');
                if(check_bill.is(':checked')){
                    if($("select[name='bill_addr']").val() == null){
                        Swal.fire({
                            title: 'กรุณาระบุข้อมูล',
                            text: 'ระบุที่อยู่ใบกำกับภาษี',
                            icon: 'warning',
                            padding: '2em'
                        }).then((result) => {
                            input.focus();
                        });
                        required_status = false;
                        return false;
                    }
                }

                let TypeShip = $('.TypeShip');
                if(!TypeShip.hasClass('active_type_ship')){
                    Swal.fire({
                        title: 'กรุณาระบุข้อมูล',
                        text: 'เลือกช่องทางจัดส่ง',
                        icon: 'warning',
                        padding: '2em'
                    })
                    required_status = false;
                }
                
                if(required_status){
                    FormCheckOut.FormAddress  = $('#Checkout-Step-1').serializeArray();
                    FormCheckOut.FormTypeSend  = $('.active_type_ship').data('id');  

                    if(check_bill.is(':checked')){
                        FormCheckOut.FormAddressBill  = $('#form-bill-addr').serializeArray();
                    }
                    $('.process-row').addClass('process-row-2');
                    $("#step-2").prop('src',url+'/assets/img_custom/ชำระเงิน.jpg');

                    $('.tab-pane').removeClass('active show');
                    $('#'+nextTab).addClass('active show');

                }
       
            }

            if(nextTab == "checkout-menu3"){
                let TypePayment = $('.TypePayment');
                if(!TypePayment.hasClass('active_type_pay')){
                    Swal.fire({
                        title: 'กรุณาระบุข้อมูล',
                        text: 'เลือกช่องชำระเงิน',
                        icon: 'warning',
                        padding: '2em'
                    })
                    required_status = false;
                }
                
                if(required_status){ 
                    FormCheckOut.FormPayment  = $('.active_type_pay').find('img').data('payname');
                   
                    $('#Send_Ship, #Send_Bill, #Send_Type_Deliver, #Send_Type_Payment').empty();

                    let sendShip = $("select[name='Address_ship']").find(':selected').text();
                    $('#Send_Ship').append(sendShip);
                    
                    let check_bill = $('#chekout-bill-addr');
                    if(check_bill.is(':checked')){
                        let sendBill = $("select[name='bill_addr']").find(':selected').text();
                        $('#Send_Bill').append(sendBill);
                    }else{
                        $('#Send_Bill').append('ไม่ต้องการใบกำกับภาษี');
                    }

                    let ActiveShip = $('.active_type_ship').data('id');
                    let textShip   = '';
                    if(ActiveShip == 1){
                        textShip = 'ส่งแบบปกติ'
                    }else if(ActiveShip == 2){
                        textShip = 'ส่งแบบด่วน'
                    }
                    $('#Send_Type_Deliver').append(textShip);
                    
                    let ActivePayment = $('.active_type_pay').find('img').data('payname');
                    $('#Send_Type_Payment').append(ActivePayment);


                    $('.process-row').addClass('process-row-3');
                    $("#step-3").prop('src',url+'/assets/img_custom/cf.jpg');

                    $('.tab-pane').removeClass('active show');
                    $('#'+nextTab).addClass('active show');

                }
            }

            // alert(nextTab);
            
         } else {   
            var prevTab = $activeTab.prev('.tab-pane').attr('id');
            if(prevTab == "checkout-menu1"){
                $('.process-row').removeClass('process-row-2');
                $("#step-2").prop('src',url+'/assets/img_custom/ชำระเงินเทา.jpg');
            }
            if(prevTab == "checkout-menu2"){
                $('.process-row').removeClass('process-row-3');
                $("#step-3").prop('src',url+'/assets/img_custom/cfเทา.jpg');
            }
            $('.tab-pane').removeClass('active show');
            $("#"+prevTab).addClass('active show');
            // alert(prevTab);
        }
    });

    $(document).on('click','.deleteItem',function(e){
        e.preventDefault();
        let code        = $(this).data('code');
        let txtName     = $(this).parent().prev().text();
        let btnDelete   =  $(this);
        Swal.fire({
            title: 'ต้องการลบสินค้าออกจากตะกร้า ?',
            text: txtName,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: url+"/ClearItem",
                    data: {'code':code},
                    // dataType: "dataType",
                    success: function (response) {
                        if(response == "success"){
                            Swal.fire({
                                title:'ลบสินค้าสำเร็จ !',
                                text: "",
                                icon: 'success',
                            }).then(function(){
                                btnDelete.parent().parent().remove();
                                $('.ProductCode-'+code+',#Product_stock_'+code).remove();

                                sumPriceOrder();

                                let lastStep_Product = $('#lastStep_Product tbody tr').length;
                                if(lastStep_Product == 0){
                                    Swal.fire({
                                        title: 'ไม่พบสินค้าในตะกร้า',
                                        text: 'กรุณาเลือกสินค้า',
                                        icon: 'warning',
                                        padding: '2em'
                                    }).then((result) => {
                                        window.location.href = url+"/Product"
                                    });
                                }
                            });
                        }else{
                            Swal.fire({
                                title:'เกิดข้อผิดพลาด !',
                                text: "ไม่สามารถลบสินค้าได้",
                                icon: 'warning',
                            });
                        }
                    }
                }); 
            }
        });
    });

    $(document).on('blur',"input[name='ProductQty'], .quantity-stock",function(e){
        let val = numeral($(this).val()).value();
        if(val == 0){
            $('.deleteItem').click();
        }
        let Item = $(this);
        let code = $(this).parent().parent().data('code');

        QtyCart(Item,code);
    });

    $(document).on('click','.AddItem',function(e){
        let Item = $(this).prev();
        let val  = Item.val();
        let code = $(this).parent().parent().data('code');
        val = numeral(val).value();
        val++;
        Item.val(val);
        
        QtyCart(Item,code);
    });

    $(document).on('click','.deleteQty',function(e){
        let Item    = $(this).next();
        let val     = Item.val();
        let code    = $(this).parent().parent().data('code');
        val = numeral(val).value();
        val--;
        Item.val(val,code);

        QtyCart(Item,code);
    });

</script>
<script src="{{ asset('assets/js/fnCheckOut.js') }}" ></script>
<script src="{{ asset('assets/js/checkout.js') }}" ></script>
@endsection