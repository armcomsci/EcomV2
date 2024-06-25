<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <h3 class="shoping-checkboxt-title">ที่อยู่จัดส่ง</h3>
        <form id="Checkout-Step-1" method="post">
            <div class="row">
                @if(count($getAddrShip)== 0)
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>ชื่อ</label>
                        <input name="con_name" class="require" type="text">
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>นามสกุล</label>
                        <input name="con_name" class="require" type="text">
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>Email</label>
                        <input name="con_email" class="require" type="email" value="{{ $username }}" {{ $readonly }} >
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>เบอร์ติดต่อ</label>
                        <input name="con_email" class="require" type="email">
                    </p>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <p class="single-form-row">
                        <label>ที่อยู่</label>
                        <input name="con_subject" class="require" type="text">
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12 mt-2">
                    <div class="single-input">
                        <label>จังหวัด</label>
                        <div class="">
                            <select name="Province" class="Province require">
                                <option></option>
                                @foreach ($province as $pv)
                                    <option data-value="{{ $pv->PROVINCE_ID }}" value="{{ $pv->PROVINCE_NAME }}" >{{ $pv->PROVINCE_NAME }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-2">
                    <div class="single-input">
                        <label>เขต/อำเภอ</label>
                        <div class="">
                            <select name="District" class="District form-control require">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <div class="single-input">
                        <label>ตำบล/แขวง</label>
                        <div class="">
                            <select name="SubDistrict" class="SubDistrict require form-control">
                                <option></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <p class="single-form-row">
                        <label>รหัสไปรณีย์</label>
                        <input name="con_subject" class="require" type="text">
                    </p>
                </div>
                @else 
                <div class="col-lg-12 col-sm-12" style="margin-bottom: 15px;">
                    <div class="single-input">
                        <div class="d-flex justify-content-between">
                            <div class="p-2">
                                <label style="margin-bottom: 15px;">เลือกที่อยู่จัดส่ง</label>
                            </div>
                            <div class="ml-auto p-2">
                                <button type="button" class="btn-addr btn-success Address_Add" data-typeship="ship">เพิ่มที่อยู่จัดส่ง</button>
                            </div>
                        </div>
                        <div class="nice-select wide">
                            <select>
                                @foreach ($getAddrShip as $addr)
                                    <option value="{{ $addr->id }}">{{ $addr->address1." ".$addr->city." ".$addr->county." ".$addr->postcode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-6 col-sm-12">
                    <label><input type="checkbox" id="chekout-bill-addr"> ต้องการใบกำภาษี</label>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <form id="form-bill-addr"  class="mb-4" method="post">
            <h3 class="shoping-checkboxt-title">ที่อยู่ใบกำกับภาษี</h3>
            <div class="row" id="">
                <div class="col-lg-12 col-sm-12">
                    <div class="single-input">
                        <div class="d-flex justify-content-between">
                            <div class="p-2">
                                <label style="margin-bottom: 15px;">เลือกที่อยู่ใบกำกับภาษี</label>
                            </div>
                            <div class="ml-auto p-2">
                                <button type="button" class="btn-addr btn-success Address_Add" data-typeship="bill">เพิ่มข้อมูลใบกำกับภาษี</button>
                            </div>
                        </div>
                        <div class="nice-select wide">
                            <select>
                                @foreach ($getAddrBill as $addrBill)
                                    <option value="{{ $addrBill->id }}">{{ $addrBill->company." ".$addrBill->address1." ".$addrBill->city." ".$addrBill->county." ".$addrBill->postcode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form id="form-type-ship" method="post">
            <h3 class="shoping-checkboxt-title">ประเภทการจัดส่ง</h3>
            <div class="row" id="">
                <div class="col-lg-6 col-sm-12 TypeShip">
                    <img src="{{ asset('assets/img_custom/ส่งแบบปกติ.jpg') }}" alt="">
                    <div class="text-center">ส่งแบบปกติ</div>
                </div>
                <div class="col-lg-6 col-sm-12 TypeShip">
                    <img src="{{ asset('assets/img_custom/ส่งแบบด่วน.jpg') }}" alt="">
                    <div class="text-center">ส่งแบบด่วน</div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="d-flex flex-row-reverse bd-highlight mt-5">
    <div class="p-2 bd-highlight">
        <button type="button" class="btn-step next-step">ถัดไป <i class="fa fa-chevron-right"></i></button>
    </div>
</div>