var cd = "4:59";
$("input[name='ship_tel']").mask('0000000000');

$("input[name='AddBill_cardId']").mask('0-0000-00000-00-0');

$("input[name='ProductQty']").mask('000');

$("input[name='ship_postcode'], input[name='AddBill_postcode']").mask('00000');

$(document).on('change','.Province',function(e){
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

            if($('.TypeShip').hasClass('active_type_ship')){
                $('.active_type_ship').click();
            }

        }
    });
});

$(document).on('change','.District',function(e){
    e.preventDefault();
    let id      = $(this).find(':selected').data('value');
    let form    = $(this).closest('form').attr('id');
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

$(document).on('click','.confirm_order_sms',function(e){
    e.preventDefault();
    
    let ship_tel      = $("input[name='ship_tel']").length;
    let phone = null;

    if(ship_tel > 0){
        phone = $("input[name='ship_tel']").val();
    }
    $.ajax({
        type: "post",
        url: url+"/SendOtpSMS",
        data: { 'phone' : phone },
        beforeSend: function() {
            // setting a timeout
            $('.btn-confirm').attr('disabled',true);
            $('#otpEmail').val('');
        },
        success: function (response) {
            $('#auth_otp').modal('show');
            $('.btn-confirm').attr('disabled',false);
            if(response['code'] == "000"){
                let ref_no = response['result'].ref_code;
                let token  = response['result'].token;

                $('#tel_phone').text(phone);
                $('#ref_no').text(ref_no);
                $('#token_otp').val(token);
                $('#ref_otp').val(ref_no);

                countdown_otp(cd);
            }else{
                Swal.fire({
                    title:'เกิดข้อผิดพลาดในการส่ง OTP ผ่าน SMS !',
                    text: "กรุณาทำรายอีกครั้ง",
                    icon: 'warning',
                })
            }
           
        }
    });
});

$(document).on('click','#re_otp',function(e){
    e.preventDefault();
    $('.confirm_order_sms').click();
});

$(document).on('click','.confirm_order_email',function(e){
    e.preventDefault();
   
    let email_ship = $("input[name='email']").length;
    let email = null;

    if(email_ship > 0){
        email = $("input[name='email']").val();
    }

    $.ajax({
        type: "post",
        url: url+"/SendOtpEmail",
        data: { 'email' : email },
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
            $('#otpEmail').val('');
        },
        success: function (response) {
            // $('.btn-confirm').attr('disabled',false);
            Swal.close();
            $('#auth_otp_email').modal('show');
            if(response.status == 'success'){
                let otpEmail = response.email
                $('#email_otp').text(otpEmail);
                $('#ref_no_email').text(response.ref);
                $('#ref_otp_email').val(response.ref);
                countdown_otp_Email(cd);
            }else{
                Swal.fire({
                    title:'เกิดข้อผิดพลาดในการส่ง OTP ผ่าน Email !',
                    text: "กรุณาทำรายอีกครั้ง",
                    icon: 'warning',
                })
            }
        }
    });
});

$(document).on('click','#re_otp_email',function(e){  
    e.preventDefault();
    $('.confirm_order_email').click();
});

$(document).on('click','.confirm_order',function(e){
    e.preventDefault();
    SaveOrder(FormCheckOut);
});

$(document).on('submit','#Form-add-ship',function(e){
    e.preventDefault();
    let required        = $('#Form-add-ship .require-add-ship');
    let required_status = true;
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
    if(required_status){
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
                        icon: 'error',
                        padding: '2em'
                    })
                }
            }
        });
    }
});

$(document).on('submit','#Form-add-bill',function(e){
    e.preventDefault();
    let required        = $('#Form-add-bill .require-add-bill');
    let required_status = true;
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
    if(required_status){
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
                        icon: 'error',
                        padding: '2em'
                    })
                }
            }
        });
    }
});

$(document).on('click','.Address_Add',function(e){
    e.preventDefault();
    let type = $(this).data('typeship');

    $('.TypeShip').removeClass('active_type_ship');

    if(type == 'ship'){
        $('#FormAddress').modal('show');
    }else if(type == 'bill'){
        $('#FormBillAddress').modal('show');
    }

});

$(document).on('change',"select[name='Address_ship']",function(e){
    if($('.TypeShip').hasClass('active_type_ship')){
        $('.active_type_ship').click();
    }
});


$(document).on('click',"#apply_coupon",function(e){
    e.preventDefault();
    let code        = $('#input-coupon').val();
    if(code == ''){
        Swal.fire({
            title: 'กรุณาระบุโค้ดส่วนลด',
            text: "",
            icon: 'warning'
        });
        return false;
    }
    $.ajax({
        type: "post",
        url: url+"/UseCoupon",
        data: {'code':code},
        // dataType: "dataType",
        success: function (response) {
            if(response == "Can't use for user"){
                Swal.fire({
                    title:'โค้ดดังกล่าวไม่สามารถใช้งานได้ !',
                    text: "",
                    icon: 'error',
                });
                return false;
            }
            else if(response == "Code Can't use" ){
                Swal.fire({
                    title:'โค้ดถูกใช้แล้ว !',
                    text: "",
                    icon: 'error',
                });
                return false;
            }else if(response == "Code Not Found"){
                Swal.fire({
                    title:'ไม่พบโค้ดดังกล่าว !',
                    text: "",
                    icon: 'error',
                });
                return false;
            }else{
                Swal.fire({
                    title:'เพิ่มโค้ดสำเร็จ !',
                    text: "",
                    icon: 'success',
                });
                let discount =  numeral(response.value);
                $('#DisCountOrder').text('- '+discount.format('0,0.00'));

                sumPriceOrder();
            }
        }
    });
});

$(document).on('click',".TypeShip",function(e){
    e.preventDefault();
    let id      = $(this).data('id');
    let add_id  = '';
    let status  = 'New';
    let TypeShip =  $(this);
    if($("#Checkout-Step-1").find('.addr_Old').length == 0 ){
        add_id = $('#Checkout-Step-1 .Province').val();
        if(add_id == ''){
            Swal.fire({
                title: 'กรุณากรอกข้อมูลจังหวัด',
                text: "",
                icon: 'warning',
            });
            return false;
        }
       
    }else{
        add_id = $("select[name='Address_ship']").val();
        status = 'Old';
    }

    $.ajax({
        type: "post",
        url: url+"/DeliverPrice",
        data: { 'id' : id, 'address_id' : add_id, 'status' : status },
        // dataType: "dataType",
        success: function (response) {
            if(response.status == 'success'){
                if(id == 1){
                    if(response.price != 0){
                        Swal.fire({
                            title: 'นอกพื้นที่บริการส่งฟรีค่ะ',
                            text: "พื้นที่จัดส่งจังหวัด "+response.county+" การสั่งซื้อจะมีค่าส่ง "+response.price+" บาท ",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ยืนยัน',
                            cancelButtonText: 'ยกเลิก'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('.TypeShip').removeClass('active_type_ship');
                                TypeShip.addClass('active_type_ship');
                            }else{
                                $('.TypeShip').removeClass('active_type_ship');
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'ส่งฟรีในพื้นที่จัดส่ง',
                            text: "หลังจากชำระเงิน จะได้รับสินค้าภายใน 3-5 วัน",
                            icon: 'success',
                        });
                        $('.TypeShip').removeClass('active_type_ship');
                        TypeShip.addClass('active_type_ship');
                    }  
                }else if(id == 2){
                    Swal.fire({
                        title: 'ส่งแบบเร่งด่วน',
                        text: "ค่าจัดส่ง "+response.price+" จะได้รับสินค้าภายในวันถัดไป",
                        icon: 'success',
                    });
                    $('.TypeShip').removeClass('active_type_ship');
                    TypeShip.addClass('active_type_ship');
                }
                let ShipPrice = numeral(response.price);
                $('#ShipOrder').text('+ '+ShipPrice.format('0,0.00'));

                sumPriceOrder();

            }else if(response.status == 'Area Error'){
                Swal.fire({
                    title: 'พื้นที่ดังกล่าวยังไม่สามารถส่งด่วนได้',
                    text: "ขออภัยในความไม่สะดวก",
                    icon: 'warning'
                });
            }
        }
    });
});

$(document).on('click',".TypePayment",function(e){
    e.preventDefault();
    $('.TypePayment').removeClass('active_type_pay');
    $(this).addClass('active_type_pay');
});

$(document).on('change',"#chekout-bill-addr",function(e){
    e.preventDefault();
    if($(this).is(':checked')){
        $('#form-bill-addr').fadeIn(500)
    }else{
        $('#form-bill-addr').fadeOut(500)
    }
});

