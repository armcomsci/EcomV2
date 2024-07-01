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
    .btn-step{
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

    $getAddrShip    = [];
    $getAddrBill    = [];
    // dd($getAddrShip);
@endphp
<div class="main-content-wrap contact-wrap">
    <div class="contact-form-area section-ptb">
        <div class="container-ext">
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
<script>
    
    $(document).on('click','.next-step, .prev-step',function(){
        var $activeTab          = $('.tab-pane.active');
        var FormCheckOut        = [];
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
                    FormCheckOut.push({
                        key : 'FormAddress',
                        value : $('#Checkout-Step-1').serializeArray()
                    },{
                        key : 'FormTypeSend',
                        value : $('.active_type_ship').data('id')
                    });
                    if(check_bill.is(':checked')){
                        FormCheckOut.push({
                            key : 'FormAddressBill',
                            value : $('#form-bill-addr').serializeArray()
                        })
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
                    FormCheckOut.push({
                        key : 'FormPayment',
                        value : $('.active_type_pay').find('img').data('payname')
                    });

                    $('.process-row').addClass('process-row-3');
                    $("#step-3").prop('src',url+'/assets/img_custom/cf.jpg');

                    $('.tab-pane').removeClass('active show');
                    $('#'+nextTab).addClass('active show');

                    console.log(FormCheckOut);
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

    $(document).ready(function () {

        $("input[name='ship_tel']").mask('0000000000');

        $("input[name='ship_postcode'], input[name='AddShip_postcode']").mask('00000');

        $(".Province").change(function (e) { 
            e.preventDefault();
            let form = $(this).closest('form').attr('id');
            let id = $(this).find(':selected').data('value');

            $.ajax({
                type: "get",
                url: url+"/GetDistricts/"+id,
                dataType: "json",
                beforeSend: function() {
                   $('#'+form+' .District').empty();
                   $('#'+form+' .District').prop("disabled", true);

                   $('#'+form+' .SubDistrict').empty();
                   $('#'+form+' .SubDistrict').prop("disabled", true);

                },
                success: function (response) {
                    $('#'+form+' .District').prop("disabled", false);
                    $('.SubDistrict').prop("disabled", false);

                    let option2 = "<option></option>";
                    $.each(response, function (index, value) {
                        option2 += "<option data-value='"+value.AMPHUR_ID+"' value='"+value.AMPHUR_NAME.trim()+"' >"+value.AMPHUR_NAME+"</option>";
                    });
                    $('#'+form+' .District').append(option2);
                }
            });
        });

        $('.District').change(function (e) {
            let id      = $(this).find(':selected').data('value');
            let form    = $(this).closest('form').attr('id');

            e.preventDefault();
            if(id != ""){
                $.ajax({
                    type: "get",
                    url: url+"/GetSubDistrict/"+id,
                    dataType: "json",
                    beforeSend: function() {
                         $('#'+form+' .SubDistrict').empty();
                         $('#'+form+' .SubDistrict').prop("disabled", true);
                    },
                    success: function (response) {
                        $('#'+form+' .District').prop("disabled", false);
                        $('#'+form+' .SubDistrict').prop("disabled", false);

                        let option2 = "<option></option>";
                        $.each(response, function (index, value) {
                            option2 += "<option data-value='"+value.DISTRICT_ID+"' value='"+value.DISTRICT_NAME.trim()+"' >"+value.DISTRICT_NAME+"</option>";
                        });
                        $('#'+form+' .SubDistrict').append(option2);
                    }
                });
            }
        });
        
        $('#Form-add-ship').submit(function (e) { 
            e.preventDefault();
            let required        = $('#Form-add-ship .require-add-ship');
            $.each(required, function(key,val) {             
                let input = $(this);
                if(input.val() == "" || input.val() == null){
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
            if(required){
                $.ajax({
                    type: "post",
                    url: url+"/SaveShipAddr",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#Form-add-ship .btn-addr').prop("disabled", true);
                    },
                    success: function (response) {
                        $('#Form-add-ship .btn-addr').prop("disabled", false);
                        if(response['status'] == 'success'){
                            $('#FormAddress').modal('hide');
                            Swal.fire({
                                title: 'บันทึกข้อมูลสำเร็จ',
                                text: '',
                                icon: 'success',
                                padding: '2em'
                            }).then((result) => {
                                let html = "<option value='"+response['data'].id+"'>"+response['data'].text+"</option>"
                                $("select[name='Address_ship']").append(html);
                                $("select[name='Address_ship']").val(response['data'].id);
                            });
                        }else{
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาดในการบันทึก',
                                text: '',
                                icon: 'success',
                                padding: '2em'
                            })
                        }
                    }
                });
            }
        });

        $('#Form-add-bill').submit(function (e) { 
            e.preventDefault();
            let required        = $('#Form-add-bill .require-add-bill');
            $.each(required, function(key,val) {             
                let input = $(this);
                if(input.val() == "" || input.val() == null){
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
            if(required){
                $.ajax({
                    type: "post",
                    url: url+"/SaveBillAddr",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#Form-add-bill .btn-addr').prop("disabled", true);
                    },
                    success: function (response) {
                        $('#Form-add-bill .btn-addr').prop("disabled", false);
                        if(response['status'] == 'success'){
                            $('#FormBillAddress').modal('hide');
                            Swal.fire({
                                title: 'บันทึกข้อมูลสำเร็จ',
                                text: '',
                                icon: 'success',
                                padding: '2em'
                            }).then((result) => {
                                let html = "<option value='"+response['data'].id+"'>"+response['data'].text+"</option>"
                                $("select[name='bill_addr']").append(html);
                                $("select[name='bill_addr']").val(response['data'].id);
                            });
                        }else{
                            Swal.fire({
                                title: 'เกิดข้อผิดพลาดในการบันทึก',
                                text: '',
                                icon: 'success',
                                padding: '2em'
                            })
                        }
                    }
                });
            }
        });

        $('.Address_Add').click(function (e) { 
            e.preventDefault();
            let type = $(this).data('typeship');

            if(type == 'ship'){
                $('#FormAddress').modal('show');
            }else if(type == 'bill'){
                $('#FormBillAddress').modal('show');
            }
        });

        $('.TypeShip').click(function (e) { 
            e.preventDefault();
            $('.TypeShip').removeClass('active_type_ship');
            $(this).addClass('active_type_ship');
        });

        $('.TypePayment').click(function (e) { 
            e.preventDefault();
            $('.TypePayment').removeClass('active_type_pay');
            $(this).addClass('active_type_pay');
        });

        $('#chekout-bill-addr').change(function (e) { 
            e.preventDefault();
            if($(this).is(':checked')){
                $('#form-bill-addr').fadeIn(500)
            }else{
                $('#form-bill-addr').fadeOut(500)
            }
        });

    });
    

</script>
@endsection