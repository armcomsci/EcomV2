<span style="margin-right: 15px; color:red; font-size:28px;">โปรดชำระเงินภายใน : </span><span id="CD_Credit" style="margin-right: 15px; color:red; font-size:28px;"> 2:59</span>
<form id="checkout-form" action="{{ url('/CreditCardGB') }} ">                     
    <div id="gb-form" style="height: 600px;"></div>  
    <input type="hidden" name="order_id" id="o_id_credit" value="{{ $idOrder }}">
    <input type="hidden" name="price" id="p_credit" value="{{ $Sum }}">
</form> 
@if(!isset($ProfilePage))
<button onclick="backToCheckOut()" class="mt-5" style="background-color: darkorange"><i class="fa fa-chevron-left"></i> ย้อนกลับ</button>
@endif
<script src="{{ asset('assets/js/GBPrimePay.js') }}"></script>
<script>
    new GBPrimePay({                                             
        publicKey: "{{ env('GB_publicKey') }}",                           
        gbForm: '#gb-form',                                        
        merchantForm: '#checkout-form',                            
        customStyle: {                                             
        backgroundColor: '#eaeaea'                               
        },                                                         
        env: 'test' // default prd | optional: test, prd           
        //  env: 'prd' // default prd | optional: test, prd        
    });      
    var cdCredit = "2:59";
    $('#CD_Credit').empty();
    $('#CD_Credit').html(cdCredit);
    var timerCredit2 = $('#CD_Credit').html();
    var intervalCredit
    clearInterval(intervalCredit);
    intervalCredit = setInterval(function() {
        let timerCredit = timerCredit2.split(':');
        //by parsing integer, I avoid all extra string processing
        let minutes = parseInt(timerCredit[0], 10);
        let seconds = parseInt(timerCredit[1], 10);
        --seconds;
        minutes = (seconds < 0) ? --minutes : minutes;
        if (minutes < 0) clearInterval(intervalCredit);
        seconds = (seconds < 0) ? 59 : seconds;
        seconds = (seconds < 10) ? '0' + seconds : seconds;
        //minutes = (minutes < 10) ?  minutes : minutes;
        $('#CD_Credit').html(minutes + ':' + seconds);
        timerCredit2 = minutes + ':' + seconds;
        if(timerCredit2 == "0:00"){
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