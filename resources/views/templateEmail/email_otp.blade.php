<h3>จาก บริษัท JT pack of foods</h3>
<h4>เรียน ท่านลูกค้า อีเมลฉบับนี้เป็นการแจ้งข้อมูลยืนยันตัวตน วันที่ {{ date("d-m-Y H:i") }} Ref No. {{ $data['ref'] }}</h4>
<br>
<p> รหัสยืนยันตัวของท่านคือ  <h1>{{  $data['otp'] }}</h1> รหัสนี้จะหมดอายุภายใน {{ $data['expire_time'] }}
<br>
เพื่อความปลอดภัยกรุณายืนยันตัวตนก่อนรหัสผ่านหมดอายุ ทางบริษัทขอขอบคุณเป็นอย่างสูง
</p>
