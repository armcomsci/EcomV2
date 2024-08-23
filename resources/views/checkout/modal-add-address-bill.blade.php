<div class="modal fade" id="FormBillAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มข้อมูลใบกำกับภาษี</h5>
        </div>
        <form id="Form-add-bill" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>เลขประจำตัวผู้เสียภาษี</label>
                            <input name="AddBill_cardId" class="require-add-bill" type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>ชื่อ-นามสกุล/ชื่อบริษัท</label>
                            <input name="AddBill_company" class="require-add-bill"  type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>ที่อยู่</label>
                            <input name="AddBill_addr" class="require-add-bill"  type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-form-row">
                            <label>จังหวัด</label>
                            <div>
                                <select class="form-control require-add-bill Province" name="AddBill_province">
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
                                <select class="form-control require-add-bill District" name="AddBill_district">
                                    <option></option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>ตำบล/แขวง</label>
                            <div>
                                <select class="require-add-bill form-control SubDistrict"  name="AddBill_subDistrict">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <p class="single-form-row">
                            <label>รหัสไปรณีย์</label>
                            <input class="require-add-bill" type="text" name="AddBill_postcode">
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-addr btn-success">เพิ่มที่อยู่ใหม่</button>
                <button type="button" class="btn-addr btn-danger"  data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </form>
      </div>
    </div>
</div>