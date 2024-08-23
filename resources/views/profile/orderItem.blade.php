<table class="table">
    <thead>
        <tr>
            <th>รูปภาพสินค้า</th>
            <th>ชื่อสินค้า</th>
            <th>ราคา</th>
            <th>จำนวน</th>
            <th>ราคารวม</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['detail'] as $item)
            <tr>
               <td>
                    <img src="{{ $item['path'] }}" alt="{{ $item['name'] }}" title="{{ $item['name'] }}" style="max-width: 150px">
               </td>
               <td>{{ $item['name'] }}</td>
               <td>{{ $item['price'] }}</td>
               <td>{{ $item['qty'] }}</td>
               <td>{{ $item['price_total'] }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-end" colspan="4">ค่าส่ง</td>
            <td>{{ $data['shipping_cost'] }}</td>
        </tr>
        <tr>
            <td class="text-end" colspan="4">ส่วนลด</td>
            <td>{{ $data['discount_total_price'] }}</td>
        </tr>
        <tr>
            <td class="text-end" colspan="4">รวมทั้งหมด</td>
            <td>{{ $data['last_total'] }}</td>
        </tr>
    </tfoot>
</table>