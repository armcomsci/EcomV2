<div class="modal fade" id="FormAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">เพิ่มที่อยู่จัดส่ง</h5>
        </div>
        <form id="Form-add-ship" method="post" onsubmit="return false;">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <p class="single-form-row">
                            <label>ที่อยู่</label>
                            <input name="AddShip_addr" class="require-add-ship" type="text">
                        </p>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="single-form-row">
                            <label>จังหวัด</label>
                            <select name="AddShip_province" class="form-control require-add-ship Province" >
                                <option></option>
                                @foreach ($province as $pv)
                                    <option data-value="{{ $pv->PROVINCE_ID }}" value="{{ $pv->PROVINCE_NAME }}" >{{ $pv->PROVINCE_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>เขต/อำเภอ</label>
                            <select name="AddShip_district" class="form-control require-add-ship District">
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <div class="single-form-row">
                            <label>ตำบล/แขวง</label>
                            <select name="AddShip_subDistrict" class="require-add-ship form-control SubDistrict" >
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 mt-2">
                        <p class="single-form-row">
                            <label>รหัสไปรณีย์</label>
                            <input name="AddShip_postcode" class="require-add-ship" type="text">
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