<div class="row">
    <table class="table table-bordered border-success">
        <thead>
            <th>ลำดับที่</th>
            <th>รูปภาพ</th>
            <th>ชื่อสินค้า</th>
            <th>จำนวน</th>
            <th>ราคาต่อหน่วย</th>
            <th>รวม</th>
        </thead>
        <tbody style="font-size: 16px;">
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
            <tr>
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
                    {{ $Cart['quantity'] }}
                </td>
                <td class="text-right">{{ number_format($Cart['product_price'],2) }}</td>
                <td class="text-right">{{ number_format($Cart['product_price']*$Cart['quantity'],2) }}</td>
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
                <td class="text-right" colspan="5">ค่าจัดส่ง</td>
                <td></td>
            </tr>
            <tr>
                <td class="text-right" colspan="5">ส่วนลด</td>
                <td></td>
            </tr>
            <tr>
                <td class="text-right" colspan="5">รวม</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <div class="coupon-content" id="checkout-coupon" style="display: block;">
        <div class="coupon-info">
            <form action="#">
                <p class="checkout-coupon">
                    <input type="text" placeholder="Coupon code">
                    <button type="submit" class="btn button-apply-coupon" name="apply_coupon" value="โค้ดส่วนลด">ใช้โค้ด</button>
                </p>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h3>ที่จัดส่ง/ใบกำกับภาษี</h3>
        </div>
        <div class="col-6">
            <h3>ช่องทางจัดส่ง</h3>
        </div>
    </div>
</div>
<div class="d-flex flex-row-reverse bd-highlight mt-5">
    <div class="p-2 bd-highlight">
        <button type="button" class="btn-step prev-step"><i class="fa fa-chevron-left"></i> ย้อนหลับ</button>
    </div>
</div>    