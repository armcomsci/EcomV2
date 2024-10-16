@extends('main_theme')

@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">มาตรฐานการรับรอง</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<div class="main-content-wrap contact-wrap">
    <div class="contact-form-area section-ptb">
        <div class="container-ext">
            <div class="row">
                <div id="content" class="col-12">
                    <h2>มาตรฐานการรับรอง</h2>
                    <p>ISO : บริษัท เจ.ที.แพ็ค ออฟ ฟู้ดส์ จำกัด เข้าสู่ระบบ ISO เพื่อทำให้ลูกค้า มีความมั่นใจได้ว่าสินค้าของเราทุกชิ้นได้ผ่านกระบวนการที่เหมือนกัน การนำระบบประกันคุณภาพมาใช้ถือ ได้ว่าเป็นปรัชญาสำคัญที่จะนำไปสู่การประกันคุณภาพแบบครบวงจร ด้วยเทคนิคของ ISO จะสร้างความตระหนักในด้านคุณภาพแก่พนักงานทุกคน ความสำเร็จในการพัฒนาเข้าสู่ มาตรฐานสากลนั้นจะต้องคำนึงถึงการพัฒนาองค์กร ปัจจัยรอบด้าน รวมทั้งสภาพแวดล้อมภายนอกและภายใน และนำกลยุทธที่เน้นการเปลี่ยนแปลงองค์กร การจูงใจ การเปลี่ยนพฤติกรรม และการเปลี่ยนวัฒนธรรมองค์กร โดยเน้นการมีส่วนร่วม การให้ความรู้ อันจะทำให้ระบบคุณภาพอยู่อย่างถาวร ไม่ใช่ใบรับรองคุณภาพ ISO เป็นเพียงเฟอร์นิเจอร์อีกชิ้นหนึ่งขององค์กรเท่านั้น</p>
                    <p>
                        GMP : บริษัท เจ.ที.แพ็ค ออฟ ฟู้ดส์ จำกัด มุ่งมั่นพัฒนาระบบการผลิตผลิตภัณฑ์ของบริษัท ให้มีคุณภาพและมาตรฐานระดับสากลโดยยึดหลัก GMP เพื่อเพิ่มความปลอดภัยและใส่ใจต่อผู้บริโภค อีกทั้งเพื่อเพิ่มความเชื่อมั่นต่อผู้บริโภคว่าผลิตภัณฑ์ของบริษัทสะอาดปลอดภัยผลิตด้วยกระบวนการที่ได้มาตรฐานและได้รับการยอมรับในระดับสากล
                    </p>
                    <div class="row">    
                        <div class="col-sm-6" style="text-align: center">
                            <img src="https://jtpackoffoods.co.th/Ecommerce/image/cert/Cert_9001-2015_page-0001.jpg" style="height: 800px;" alt="">
                        </div>
                        <div class="col-sm-6" style="text-align: center">
                            <img src="https://jtpackoffoods.co.th/Ecommerce/image/cert/Cert_GHPs_page-0001.jpg" style="height: 800px;" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection