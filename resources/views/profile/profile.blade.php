@extends('main_theme')
@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">โปรไฟล์</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<div class="main-content-wrap section-ptb my-account-page">
    <div class="container">
        <div class="row">
            <div class="account-dashboard">
                <div class="row">
                    <div class="col-md-12 col-lg-2">
                        <!-- Nav tabs -->
                        <ul role="tablist" class="nav flex-column dashboard-list">
                            <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link profileStatus active">ข้อมูลส่วนตัว</a></li>
                            <li><a href="#ordersWait" data-bs-toggle="tab" class="nav-link profileStatus" data-status="1">รายการรอชำระเงิน</a></li>
                            <li><a href="#orderPayment" data-bs-toggle="tab" class="nav-link profileStatus" data-status="2">รายการชำระเงินเรียบร้อย</a></li>
                            <li><a href="#orderSuccess" data-bs-toggle="tab" class="nav-link profileStatus" data-status="3">รายการสำเร็จ</a></li>
                            <li><a href="#orderCancel" data-bs-toggle="tab" class="nav-link profileStatus" data-status="6">รายการที่ยกเลิก</a></li>
                        </ul>
                    </div>
                    <div class="col-md-12 col-lg-10">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard-content">
                            <div class="tab-pane active" id="dashboard">
                                <div class="row">
                                    <form method="get" action="#" enctype="multipart/form-data" class="form-horizontal account-register clearfix" data-toggle="validator" role="form" >
                                        @csrf
                                        <div class="col-md-12 col-sm-12">
                                            <h3>ข้อมูลส่วนตัว</h3>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ordersWait">
                            </div>
                            <div class="tab-pane fade" id="orderPayment">
                            </div>
                            <div class="tab-pane fade" id="orderSuccess">
                            </div>
                            <div class="tab-pane fade" id="orderCancel">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('profile.modalOrderItem')

@include('profile.modalPayment')

@endsection

@section('script')
<script>


    $(document).on('click','.profileStatus',function(){
        let status = $(this).data('status');
        let idTag  = $(this).attr('href');
        let text   = $(this).text();
        $.ajax({
            type: "post",
            url: url+"/ProfileStatus",
            data: {'status': status},
            beforeSend: function() {
                // Swal.fire({
                //     title: 'ระบบกำลังประมวลผล',
                //     html: 'กรุณารอสักครู่.....',
                //     icon : 'warning',
                //     timer: 25000,
                //     timerProgressBar: true,
                //     allowOutsideClick: false,
                //     allowEscapeKey:false,
                //     showCancelButton: false,
                //     showConfirmButton:false
                // }); 
            },
            success: function (response) {
                // Swal.close();
                $(idTag).html(response);
                $('#statusTitle').text(text);
            }
        });
    });

    $(document).on('click','.showItem',function(e){
        let orderId =$(this).closest("tr").find("td:first-child").text();
        $.ajax({
            type: "post",
            url: url+"/ProfileOrderItem",
            data: {'orderId': orderId},
            // dataType: "dataType",
            success: function (response) {
                $('#order_item').modal('show');
                $('#order_item').find('.modal-body').html(response);
               
            }
        });
    });

    $(document).on('click','.paymentOrder',function(e){
        let reOrderId = $(this).closest("tr").find("td:first-child").text();
        $.ajax({
            type: "post",
            url: url+"/paymentOrder",
            data: {'orderId':reOrderId},
            // dataType: "dataType",
            beforeSend: function() {
                Swal.fire({
                    title: 'ระบบกำลังประมวลผล',
                    html: 'กรุณารอสักครู่.....',
                    icon : 'warning',
                    timer: 25000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    showCancelButton: false,
                    showConfirmButton:false
                }); 
            },
            success: function (response) {
                Swal.close();
                $('#order_payment').modal('show');
                $('#order_payment').find('.modal-body').html(response);
                // if(response == "success"){
                //     window.location.href = url+"/Checkout";
                // }
            }
        });
    });

    $(document).on('click','.reOrder',function(e){
        let reOrderId = $(this).closest("tr").find("td:first-child").text();
        $.ajax({
            type: "post",
            url: url+"/ReOrder",
            data: {'orderId':reOrderId},
            // dataType: "dataType",
            beforeSend: function() {
                Swal.fire({
                    title: 'ระบบกำลังประมวลผล',
                    html: 'กรุณารอสักครู่.....',
                    icon : 'warning',
                    timer: 25000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    showCancelButton: false,
                    showConfirmButton:false
                }); 
            },
            success: function (response) {
                Swal.close();
                if(response == "success"){
                    window.location.href = url+"/Checkout";
                }
            }
        });
    });

</script>
@endsection