<div class="row">
    <table class="table table-bordered border-success" id="lastStep_Product">
        <thead>
            <th class="text-center">ลำดับที่</th>
            <th class="text-center">รูปภาพ</th>
            <th>ชื่อสินค้า</th>
            <th class="text-center">จำนวน</th>
            <th class="text-center">ราคาต่อหน่วย</th>
            <th class="text-center">รวม</th>
        </thead>
        <tbody style="font-size: 16px;">
            @php
                 $total = [0];
            @endphp
            @if(session()->has('cart'))
            @php
                $Carts = session()->get('cart');
                $i = 1;
               
            @endphp
            @foreach ($Carts as $key => $Cart)
            <?php
                $url_path = "https://images.jtpackconnect.com/imageallproducts/".$Cart['product_code']."_F.jpg";
                $total[]  = $Cart['quantity']*$Cart['product_price'];
            ?>
            <tr data-code="{{ $Cart['product_code'] }}">
                <td class="text-center">{{ $i }}</td>
                <td class="text-center">
                    <a href="#">
                        <img width="150px" src="{{ $url_path }}" alt="{{ $Cart['product_name'] }}" title="{{ $Cart['product_name'] }}" class="img-thumbnail" /></a>
                </td>
                <td class="text-left" style="width: 400px;">
                    <div style="max-width: 350px;">
                        {{ $Cart['product_name'] }} 
                    </div>
                </td>
                <td class="text-center" >
                    @if ($Cart['quantity'] == 1)
                        <i class="fa-regular fa-trash-can deleteItem" data-code="{{ $Cart['product_code'] }}"></i>
                    @else
                        <i class="fa-solid fa-minus deleteQty" data-code="{{ $Cart['product_code'] }}"></i>
                    @endif
                    <input type="number" name="ProductQty" value="{{ $Cart['quantity'] }}" style="width: 45px">
                    <i class="fa-solid fa-plus AddItem"></i>
                </td>
                <td class="text-right">{{ number_format($Cart['product_price'],2) }}</td>
                <td class="text-right ProductSumPrice">{{ number_format($Cart['product_price']*$Cart['quantity'],2) }}</td>
            </tr>
            <?php $i++; ?>
            @endforeach
            @else
            <tr>
                <td colspan="6" class="text-center">ไม่พบรายการสินค้า</td>
            </tr>
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="5">รวม</td>
                <td class="text-right" id="SumOrder">{{ number_format(array_sum($total),2)  }}</td>
            </tr>
            <tr>
                <td class="text-right" colspan="5">ค่าจัดส่ง</td>
                <td class="text-right" id="ShipOrder"></td>
            </tr>
            <tr>
                <td class="text-right" colspan="5">ส่วนลด</td>
                <td class="text-right" id="DisCountOrder">0.00</td>
            </tr>
            <tr>
                <td class="text-right" colspan="5">รวมยอดสุทธิ</td>
                <td class="text-right" id="SumAllOrder"></td>
            </tr>
        </tfoot>
    </table>
    <div class="coupon-content" id="checkout-coupon" style="display: block;">
        <div class="coupon-info">
            <form action="#">
                <p class="checkout-coupon">
                    <input type="text" placeholder="Coupon code" id="input-coupon"> 
                    <button type="button" class="btn button-apply-coupon" id="apply_coupon"  value="โค้ดส่วนลด">ใช้โค้ด</button>
                </p>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">
            <h3>ที่จัดส่ง/ใบกำกับภาษี</h3>
            <div class="d-flex bd-highlight">
                <div class="p-2 flex-fill bd-highlight">
                    <h5>ที่อยู่จัดส่ง</h5>
                    <p id="Send_Ship">

                    </p>
                </div>
                <div class="p-2 flex-fill bd-highlight" >
                    <h5>ที่อยู่ใบกำกับภาษี</h5>
                    <p id="Send_Bill">

                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <h3>ช่องทางจัดส่ง/วิธีชำระเงิน</h3>
            <div class="d-flex bd-highlight">
                <div class="p-2 flex-fill bd-highlight">
                    <h5>ช่องทางจัดส่ง</h5>
                    <p id="Send_Type_Deliver">

                    </p>
                </div>
                <div class="p-2 flex-fill bd-highlight">
                    <h5>วิธีชำระเงิน</h5>
                    <p id="Send_Type_Payment">

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex flex-row-reverse bd-highlight mt-5">
    <div class="p-2 bd-highlight">
        <button type="button" class="btn-step prev-step"><i class="fa fa-chevron-left"></i> ย้อนหลับ</button>
        @php
            $getProfile = getProfile();
        @endphp
        @if ($getProfile != '' && $getProfile->otp_status == 'N')
            <button type="button" class="btn-confirm confirm-otp confirm_order_sms" > ยืนยัน OTP ผ่าน SMS</button>
            <button type="button" class="btn-confirm confirm-email confirm_order_email" > ยืนยัน OTP ผ่าน Email</button>
        @else
            <button type="button" class="btn-confirm confirm_order" ><i class="fa fa-check"></i> ยืนยัน</button>
        @endif
    </div>
</div>    