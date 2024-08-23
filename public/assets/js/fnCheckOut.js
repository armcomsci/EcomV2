function sumPriceOrder(){

    let toTalPrice = 0;
    let QtySum     = 0;
    $('.ProductSumPrice').each(function() {
        let QtySumPrice =  numeral($(this).text()).value();
        // console.log(QtySumPrice);
        toTalPrice += QtySumPrice;
    });

    $("input[name='ProductQty']").each(function() {
        QtySum +=  numeral($(this).val()).value();
    });


    toTalPrice = numeral(toTalPrice).format('0,0.00');

    $('.shopping-cart-wrap .cart-total').text(QtySum);

    $('.shopping-cart-wrap .cart-total-amunt').text("฿"+toTalPrice);

    $('.subtotal-title span').text(toTalPrice);
    $('#SumOrder').text(toTalPrice);

    let SumOrder        = numeral($('#SumOrder').text());
    let ShipOrder       = numeral($('#ShipOrder').text());
    let DisCountOrder   = numeral($('#DisCountOrder').text());

    let SumAll          = (SumOrder.value()+ShipOrder.value())-DisCountOrder.value();

    $('#SumAllOrder').text(numeral(SumAll).format('0,0.00'));
}

var interval
var contentCheckOut

function countdown_otp(cd){

    $('#CD_otp').empty();
    $('#CD_otp').html(cd);
    let timer2 = cd;
    
    interval = setInterval(function() {
        let timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        let minutes = parseInt(timer[0], 10);
        let seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('#CD_otp').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;

        if(timer2 == "0:00"){
            Swal.fire({
                title:'เกิดข้อผิดพลาด !',
                text: "รหัสยืนยันตัวตนหมดอายุ กรุณาทำรายอีกครั้ง",
                icon: 'warning',
            }).then(function(){
                $('#auth_otp').modal('hide');
            });
           
            return false;
        }
    }, 1000);
}

function countdown_otp_Email(cd){

    $('#CD_otp_email').empty();
    $('#CD_otp_email').html(cd);
    let timer2 = cd;

    interval = setInterval(function() {
        let timer = timer2.split(':');
        //by parsing integer, I avoid all extra string processing
        let minutes = parseInt(timer[0], 10);
        let seconds = parseInt(timer[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(interval);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('#CD_otp_email').html(minutes + ':' + seconds);
        timer2 = minutes + ':' + seconds;

        if(timer2 == "0:00"){
            Swal.fire({
                title:'เกิดข้อผิดพลาด !',
                text: "รหัสยืนยันตัวตนหมดอายุ กรุณาทำรายอีกครั้ง",
                icon: 'warning',
            }).then(function(){
                $('#auth_otp_email').modal('hide');
            });
           
            return false;
        }
    }, 1000);
}

function CheckTime_CheckOut(){
    let today       = new Date();
    let id_deliver  = $('.active_type_ship').data('id');
    if(id_deliver != 1){
        let time        =  parseFloat(today.getHours() + "." + today.getMinutes());
        let TimeStart   = parseFloat($('#Time_Start_'+id_deliver).val());
        let TimeEnd     = parseFloat($('#Time_End_'+id_deliver).val());

        if(time < TimeStart || time > TimeEnd){
            Swal.fire({
                title: 'ต้องการทำรายการใหม่ ?',
                text: "เนื่องจากรายการดังกล่าวไม่อยู่ในช่วงเวลาที่สามารถส่งด่วนได้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "get",
                        url: url1+"/CancelOrderSend/"+Order,
                        // data: $('#Form_cancel').serialize(),
                        // dataType: "dataType",
                        success: function (response) {
                            if(response == "success"){
                                window.location.href = window.location.href;
                            }
                        }
                    }); 
                }
            });
            return false;
        }
    }
}

function QtyCart(Item,code){
    let inPutQty    = Item;
    let QtyVal      = numeral(inPutQty.val()).value();
    $.ajax({
        type: "post",
        url: url+"/AddCart",
        data: { 'qty' : QtyVal,'code': code },
        // dataType: "dataType",
        success: function (response) {
            if(response.status == "01"){
                Swal.fire({
                    title: 'สินค้าในสต็อกคงเหลือไม่เพียงพอ',
                    text: "คงเหลือในสต็อกสูงสุดเพียง "+response.Stock+" ขออภัยในความไม่สะดวก",
                    icon: 'warning',
                });
                inPutQty.val(response.Stock);
                inPutQty.blur();
                return false;
            }
            if(QtyVal == 1){
                inPutQty.prev().removeClass('fa-solid fa-minus deleteQty');
                inPutQty.prev().addClass(' fa-regular fa-trash-can deleteItem');
            }else if(QtyVal >= 1){
                inPutQty.prev().removeClass('fa-regular fa-trash-can deleteItem');
                inPutQty.prev().addClass('fa-solid fa-minus deleteQty');
            }
          
            let Price = inPutQty.parent().next().text();
        
            Price =  numeral(Price).value();
        
            let PriceSum =  numeral(Price*QtyVal);
        
            inPutQty.parent().next().next().text(PriceSum.format('0,0.00'));
        
            sumPriceOrder();
        }
    });
}

function SaveOrder(FormCheckOut){
    
    $.ajax({
        type: "post",
        url: url+"/SaveOrder",
        data: FormCheckOut,
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
                showConfirmButton:false,
                willClose: () => {
                    clearInterval(interval)
                }
            }); 
        },
        success: function (response) {
            contentCheckOut = $('#content-checkout').clone();
            Swal.close();
            if( response.status == "outStock" ){
                $('#product_outstock').modal('show');
                html_out_stock  = "";
                let i = 1;
                $('#p_out_stock tbody').empty();
                $.each(response['data'].p_stock, function (index, value) { 
                    let price = numeral(value.price);
                    let sum_p = numeral(value.sum_p);
                    html_out_stock += "<tr id=\"Product_stock_"+value.code+"\">";
                    html_out_stock += "<td class=\"text-center\">"+i+"</td>";
                    html_out_stock += "<td class=\"text-center\" width=\"250px\"><a href=\"#\"><img style=\"width:150px;\" src=\""+value.path+"\" alt=\""+value.product_name+"\" title=\""+value.product_name+"\" class=\"img-thumbnail\" /></a></td>";
                    html_out_stock += "<td class=\"text-left\" width=\"200px\"><a href=\"#\">"+value.product_name+"</a></td>";
                    // html_out_stock += "<td class=\"text-left\">"+value.code+"<br /><span style=\"color:red;\">สินค้าคงเหลือ : "+value.stock+"</span></td>";
                    html_out_stock += "<td class=\"text-center\">";
                    html_out_stock += "<input type=\"text\" value=\""+value.qty+"\" class=\"quantity-stock\" size=\"1\" >";
                    html_out_stock += "<br /><span style=\"color:red;\">สินค้าคงเหลือ : "+value.stock+"</span></td>";
                    html_out_stock += "<td class=\"text-center\">"+price.format('0,0')+"</td>";
                    html_out_stock += "<td class=\"text-center\" id=\"p_stock_sum_"+value.order_id+"\">"+sum_p.format('0,0')+"</td>";
                    html_out_stock += "<td class=\"text-center\" style=\"vertical-align: middle;\"><button type=\"button\" class=\"deleteItem\" data-code=\""+value.code+"\"> <i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button></td>";
                    html_out_stock += "</tr>";
                    i++;
                });
                $('#p_out_stock tbody').append(html_out_stock);
                return;
            }else{
                let typeCheckOut = $('.active_type_pay').find('img').data('payname');
                $('#content-checkout').html(response);
            }
        }
    });
}

function backToCheckOut(){
    $('#content-checkout').html(contentCheckOut);
}

function confirmSMS(){
    let token_otp   = $('#token_otp').val();
    let ref_otp     = $('#ref_otp').val();
    let otp         = $('#otp').val();

    if(otp == ""){
        Swal.fire({
            title:'กรุณาระบุ OTP ใหม่ !',
            text: "",
            icon: 'warning',
        });
        return false;
    }else{
        $.ajax({
            type: "post",
            url: url+"/CheckSMS_Otp",
            data: {'token_otp':token_otp,'ref_otp':ref_otp,'otp':otp},
            // dataType: "dataType",
            success: function (response) {
                if(response.status_code == "000"){
                    $('#cancel_otp').click();
                    SaveOrder(FormCheckOut);
                }else{
                    Swal.fire({
                        title:'กรุณาระบุ OTP ใหม่ !',
                        text: "",
                        icon: 'warning',
                    });
                }
            }
        });
    }
}

function confirmOtpEmail(){
    let otpEmail        = $('#otpEmail').val();
    let ref_otp_email   = $('#ref_otp_email').val();
    if(otpEmail == ""){
        Swal.fire({
            title:'กรุณาระบุ OTP ใหม่ !',
            text: "",
            icon: 'warning',
        });
        return false;
    }else{
        $.ajax({
            type: "post",
            url: url+"/CheckEmail_Otp",
            data: {'ref_otp_email':ref_otp_email,'otpEmail':otpEmail},
            // dataType: "dataType",
            success: function (response) {
                if(response.status == "success"){
                    $('#cancel_otp_email').click();
                    SaveOrder(FormCheckOut);
                }else{
                    Swal.fire({
                        title:'กรุณาระบุ OTP ใหม่ !',
                        text: "",
                        icon: 'warning',
                    });
                }
            }
        });
    }
}

let cancel_otp = document.getElementById('auth_otp')
cancel_otp.addEventListener('hidden.bs.modal', function (event) {
    clearInterval(interval);
})
let cancel_otp_email = document.getElementById('auth_otp_email')
cancel_otp_email.addEventListener('hidden.bs.modal', function (event) {
    clearInterval(interval);
})
