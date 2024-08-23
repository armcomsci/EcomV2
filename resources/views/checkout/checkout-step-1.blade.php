<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <h3 class="shoping-checkboxt-title">ที่อยู่จัดส่ง</h3>
        <form id="Checkout-Step-1" method="post">
            <div class="row">
                @if(count($getAddrShip)== 0)
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>ชื่อ</label>
                        <input name="ship_name" class="require-step-1" type="text">
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>นามสกุล</label>
                        <input name="ship_lastname" class="require-step-1" type="text">
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>Email</label>
                        <input name="email" class="require-step-1" type="email" value="{{ $username }}" {{ $readonly }} >
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <p class="single-form-row">
                        <label>เบอร์ติดต่อ</label>
                        <input name="ship_tel" class="require-step-1" >
                    </p>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <p class="single-form-row">
                        <label>ที่อยู่</label>
                        <input name="ship_addr" class="require-step-1" type="text">
                    </p>
                </div>
                <div class="col-lg-6 col-sm-12 mt-2">
                    <div class="single-input">
                        <label>จังหวัด</label>
                        <select name="ship_province" class="form-control require-step-1 Province" >
                            <option></option>
                            @foreach ($province as $pv)
                                <option data-value="{{ $pv->PROVINCE_ID }}" value="{{ $pv->PROVINCE_NAME }}" >{{ $pv->PROVINCE_NAME }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-2">
                    <div class="single-input">
                        <label>เขต/อำเภอ</label>
                        <select name="ship_district" class="form-control require-step-1 District">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <div class="single-input">
                        <label>ตำบล/แขวง</label>
                        <select name="ship_subDistrict " class="require-step-1 form-control SubDistrict" >
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 mt-3">
                    <p class="single-form-row">
                        <label>รหัสไปรณีย์</label>
                        <input name="ship_postcode" class="require-step-1" type="text">
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
                        <select class="form-control addr_Old" name="Address_ship">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($getAddrShip as $addr)
                                @php
                                    $selected = '';
                                    if($i = 0){
                                        $selected = "selected";
                                    }
                                @endphp
                                <option value="{{ $addr->id }}" {{ $selected }} >{{ $addr->address1." ".$addr->subDistrict." ".$addr->city." ".$addr->county." ".$addr->postcode }}</option>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="col-lg-6 col-sm-12">
                    <label><input type="checkbox" id="chekout-bill-addr" name="use_vat" value="Y"> ต้องการใบกำภาษี</label>
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
                        <select name="bill_addr" class="form-control">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($getAddrBill as $addrBill)
                                @php
                                    $selected = '';
                                    if($i = 0){
                                        $selected = "selected";
                                    }
                                @endphp
                                <option value="{{ $addrBill->id }}" {{ $selected }} >{{ $addrBill->company." ".$addrBill->address1." ".$addrBill->city." ".$addrBill->county." ".$addrBill->postcode }}</option>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <form id="form-type-ship" method="post">
            <h3 class="shoping-checkboxt-title">ประเภทการจัดส่ง</h3>
            <p>***คลิกเพื่อเลือกรูปแบบการจัดส่ง***</p>
            <div class="row" id="">
                @php
                    $time     = floatval(date('G.i'));
                @endphp
                @foreach ($DeliverTypeSend as $item)
                @php
                    $TimeStart  = floatval(str_replace(':','.',$item->TimeStart));
                    $TimeEnd    = floatval(str_replace(':','.',$item->TimeEnd));
                    $TxSend     = "";
                    $Color      = "";
                    $TypeShip   = "TypeShip";

                    if($TimeStart != 0 && $TimeEnd != 0){
                        if($time < $TimeStart || $time > $TimeEnd){
                            $diliver_send   = "";
                            $TypeShip       = "";
                            $Color          = "color:red";
                            $TxSend         = "สามารถส่งด่วนได้ในช่วงเวลา ".$item->TimeStart."-".$item->TimeEnd;
                        }
                    }
                @endphp
                <div class="col-lg-6 col-sm-12 {{ $TypeShip }}" data-id="{{ $item->id }}">
                    <img src="{{ $item->img }}"" alt="">
                    <div class="text-center">
                        {{ $item->title }}
                        <p style="{{ $Color }}">{{ $TxSend }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </form>
    </div>
</div>
<div class="d-flex flex-row-reverse bd-highlight mt-5">
    <div class="p-2 bd-highlight">
        <button type="button" class="btn-step next-step">ถัดไป <i class="fa fa-chevron-right"></i></button>
    </div>
</div>