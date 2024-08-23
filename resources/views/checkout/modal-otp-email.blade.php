<div id="auth_otp_email" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
        <h4 class="modal-title">ยืนยันตัวตนด้วย OTP ผ่าน Email</h4>
        </div>
        <div class="modal-body">
                <form id="otp-mail-form">
                    @csrf
                    <div>
                        <h4>Ref.<span id="ref_no_email"></span></h4>
                        ระบุรหัสยืนยันตัวตนที่อีเมล :  <label for="" id="email_otp"></label>
                        <br>
                        <input type="text" name="otpEmail" id="otpEmail" autocomplete="off"> 
                        <span class="Er otp_error" style="display: none;">OTP ไม่ถูกต้อง</span>
                        <button class="btn-modal confirm_order_email" id="re_otp_email"><i class="fa fa-refresh"></i> ส่งใหม่</button>
                        <br>
                        <span >หมดอายุใน: </span><span id="CD_otp_email"></span>
                        <input type="hidden" name="ref_email" id="ref_otp_email" value="">
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal" id="confirm_otp_email" onclick="confirmOtpEmail()"><i></i>ยืนยัน</button>
            <button type="button" class="btn-modal" id="cancel_otp_email" data-bs-dismiss="modal">ยกเลิก</button>
        </div>
    </div>

    </div>
</div>