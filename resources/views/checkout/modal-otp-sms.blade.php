<div id="auth_otp" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
        <h4 class="modal-title">ยืนยันตัวตนด้วย OTP ผ่าน SMS</h4>
        </div>
        <div class="modal-body">
                <form id="otp-form">
                    @csrf
                    <div>
                        <h4>Ref.<span id="ref_no"></span></h4>
                        ระบุรหัสยืนยันตัวตนที่เบอร์ 
                        <label for="" id="tel_phone"></label>
                        <br>
                        <input type="text" name="otp" id="otp" autocomplete="off"> 
                        <span class="Er otp_error" style="display: none;">OTP ไม่ถูกต้อง</span>
                        <button class="btn-modal" id="re_otp"><i class="fa fa-refresh"></i> ส่งใหม่</button>
                        <br>
                        <span >หมดอายุใน: </span><span id="CD_otp"></span>
                        <input type="hidden" name="token" id="token_otp" value="">
                        <input type="hidden" name="ref" id="ref_otp" value="">
                    </div>
                </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal" id="confirm_otp" onclick="confirmSMS()">ยืนยัน</button>
            <button type="button" class="btn-modal" id="cancel_otp"   data-bs-dismiss="modal">ยกเลิก</button>
        </div>
    </div>

    </div>
</div>
