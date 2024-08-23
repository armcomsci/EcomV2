<h3 id="statusTitle"></h3>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>เลขออเดอร์</th>
                <th>วันที่</th>
                <th>จำนวนเงิน</th>
                <th>รายการ</th>

                @if($status == 1)
                @php
                    $htmlBtn = "<button class=\"paymentOrder\">ชำระเงิน</button>";
                @endphp
                    <th>ชำระเงิน</th>
                @else
                @php
                    $htmlBtn = "<button class=\"reOrder\">ทำรายการใหม่</button>";
                @endphp
                    <th>ทำรายการซ้ำ</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($order) != 0)
                @foreach ($order as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ DateThai($item->created) }}</td>
                        <td>{{ number_format($item->price_total,2) }}</td>
                        <td>
                            <button class="showItem" data-orderid="{{ $item->id }}">รายการสินค้า</button>
                        </td>
                        <td>
                            {!! $htmlBtn !!}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">ไม่พบข้อมูล</td>
                </tr>
            @endif
            
        </tbody>
    </table>
</div>