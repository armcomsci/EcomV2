<div>
    <figure class="figure">
        <figcaption class="figure-caption">
            <span style="margin-right: 15px; color:red; font-size:28px;">โปรดชำระเงินภายใน : </span><span id="CD_QRcash" style="float: right;margin-right: 15px; color:red; font-size:28px;"> 2:59</span>
        </figcaption>
    </figure>
</div>
<img src="{{ $genQr }}" class="rounded mx-auto d-block" alt="">
@if(!isset($ProfilePage))
<div>
    <button onclick="backToCheckOut()" class="mt-5" style="background-color: darkorange"><i class="fa fa-chevron-left"></i> ย้อนกลับ</button>
</div>
@endif
<script>
    
    var cdQr = "2:59";
    var secQr = 180;
    var idOrder = {!! $idOrder !!}
    $('#CD_QRcash').empty();
    $('#CD_QRcash').html(cdQr);
    var timerQr1 = $('#CD_QRcash').html();
    var intervalQr
    clearInterval(intervalQr);
    intervalQr = setInterval(function() {
        let timerQr = timerQr1.split(':');
        //by parsing integer, I avoid all extra string processing
        let minutes = parseInt(timerQr[0], 10);
        let seconds = parseInt(timerQr[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(intervalQr);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('#CD_QRcash').html(minutes + ':' + seconds);
        timerQr1 = minutes + ':' + seconds;
        secQr--;
        
        if(secQr%5 == 0){
            $.ajax({
                type: "post",
                url: url+"/CheckQrPayment",
                data: { 'orderId' : idOrder },
                // dataType: "dataType",
                success: function (response) {
                    
                }
            });
        }
        if(timerQr1 == "0:00"){
            @if(!isset($ProfilePage))
                backToCheckOut();
            @else
                $("#cancelPayment").click();
            @endif
            // location.reload();
            return false;
        }
    }, 1000);
</script>