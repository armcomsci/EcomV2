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

<div class="modal fade" id="FormAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มที่อยู่จัดส่ง</h5>
        </div>
        <div class="modal-body">
            <form id="" method="post">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>ที่อยู่</label>
                            <input name="con_subject" type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-form-row">
                            <label>จังหวัด</label>
                            <div class="">
                                <select class="Province">
                                    <option></option>
                                    @foreach ($province as $pv)
                                        <option data-value="{{ $pv->PROVINCE_ID }}" value="{{ $pv->PROVINCE_NAME }}" >{{ $pv->PROVINCE_NAME }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>เขต/อำเภอ</label>
                            <div class="">
                                <select class="District">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>ตำบล/แขวง</label>
                            <div class="">
                                <select class="SubDistrict">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <p class="single-form-row">
                            <label>รหัสไปรณีย์</label>
                            <input name="con_subject" type="text">
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-addr btn-success">เพิ่มที่อยู่ใหม่</button>
          <button type="button" class="btn-addr btn-danger"  data-bs-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="FormBillAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มข้อมูลใบกำกับภาษี</h5>
        </div>
        <div class="modal-body">
            <form id="" method="post">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>เลขประจำตัวผู้เสียภาษี</label>
                            <input name="con_subject" type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>ชื่อ-นามสกุล/ชื่อบริษัท</label>
                            <input name="con_subject" type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>ที่อยู่</label>
                            <input name="con_subject" type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-form-row">
                            <label>จังหวัด</label>
                            <div>
                                <select class="Province">
                                    <option></option>
                                    @foreach ($province as $pv)
                                        <option data-value="{{ $pv->PROVINCE_ID }}" value="{{ $pv->PROVINCE_NAME }}" >{{ $pv->PROVINCE_NAME }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>เขต/อำเภอ</label>
                            <div>
                                <select class="District">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>ตำบล/แขวง</label>
                            <div>
                                <select class="SubDistrict">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <p class="single-form-row">
                            <label>รหัสไปรณีย์</label>
                            <input name="con_subject" type="text">
                        </p>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-addr btn-success">เพิ่มที่อยู่ใหม่</button>
          <button type="button" class="btn-addr btn-danger"  data-bs-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
<script>
    

    new SlimSelect({
        select: ".Province"
    })

    $(document).on('click','.next-step, .prev-step',function(){
        var $activeTab          = $('.tab-pane.active');

        if ( $(this).hasClass('next-step') ){

            var nextTab = $activeTab.next('.tab-pane').attr('id');
            if(nextTab == "checkout-menu2"){
                $('.process-row').addClass('process-row-2');
                $("#step-2").prop('src',url+'/assets/img_custom/ชำระเงิน.jpg');
            }
            if(nextTab == "checkout-menu3"){
                $('.process-row').addClass('process-row-3');
                $("#step-3").prop('src',url+'/assets/img_custom/cf.jpg');
            }
            $('.tab-pane').removeClass('active show');
            $('#'+nextTab).addClass('active show');
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
      

        $('.Address_Add').click(function (e) { 
            e.preventDefault();
            let type = $(this).data('typeship');

            if(type == 'ship'){
                $('#FormAddress').modal('show');
            }else if(type == 'bill'){
                $('#FormBillAddress').modal('show');
            }
        });

        $(".Province").change(function (e) { 
            e.preventDefault();
            let form = $(this).parent('form');

            let id = $(this).find(':selected').data('value');
            $.ajax({
                type: "get",
                url: url+"/GetDistricts/"+id,
                dataType: "json",
                beforeSend: function() {
                    $('.District').empty();
                    $('.District').prop("disabled", true);

                    $('.SubDistrict').empty();
                    $('.SubDistrict').prop("disabled", true);
                },
                success: function (response) {
                    $('.District').prop("disabled", false);
                    $('.SubDistrict').prop("disabled", false);

                    let option2 = "<option></option>";
                    $.each(response, function (index, value) {
                        option2 += "<option data-value='"+value.AMPHUR_ID+"' value='"+value.AMPHUR_NAME.trim()+"' >"+value.AMPHUR_NAME+"</option>";
                    });
                    $('#Checkout-Step-1 .District').append(option2);
                    new SlimSelect({
                        select: "#Checkout-Step-1 .District"
                    })
                }
            });
        });

        $('.District').change(function (e) {
            let id = $(this).find(':selected').data('value');
            let form = $(this).parent('form');
           
            e.preventDefault();
            if(id != ""){
                $.ajax({
                    type: "get",
                    url: url+"/GetSubDistrict/"+id,
                    dataType: "json",
                    beforeSend: function() {
                        $('.SubDistrict').empty();
                        $('.SubDistrict').prop("disabled", true);
                    },
                    success: function (response) {

                        $('.District').prop("disabled", false);
                        $('.SubDistrict').prop("disabled", false);

                        let option2 = "<option></option>";
                        $.each(response, function (index, value) {
                            option2 += "<option data-value='"+value.DISTRICT_ID+"' value='"+value.DISTRICT_NAME.trim()+"' >"+value.DISTRICT_NAME+"</option>";
                        });
                        $('#Checkout-Step-1 .SubDistrict').append(option2);
                        new SlimSelect({
                            select: "#Checkout-Step-1 .SubDistrict"
                        })
                    }
                });
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