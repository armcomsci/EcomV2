@extends('main_theme')

@section('content')
<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ติดต่อเรา</li>
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
                <div class="col-lg-4">
                    <div class="contact-info-wrap">
                        <div class="contact-title mb-30">
                            <h3>ติดต่อเรา</h3>
                        </div>

                        <div class="contact-info-text">
                            <ul>
                                <li>
                                    <div class="contact-title">
                                        <i class="fa fa-home"></i>
                                        <h4>Address</h4>
                                    </div>
                                    <p>J.T. Pack of Foods Co.,Ltd. <br> 
                                        75/75 ม.5 ซอยทองคำ 3 ถนนจันทร์ทองเอี่ยม
                                        ตำบลบางรักพัฒนา อำเภอบางบัวทอง จังหวัดนนทบุรี 11110</p>
                                </li>
                                <li>
                                    <div class="contact-title">
                                        <i class="fa fa-envelope-open-o"></i>
                                        <h4>Phone</h4>
                                    </div>
                                    <p>Call Center : <a href="tel:02-033-7900">02-033-7900 กด 5</a></p>
                                </li>
                                <li>
                                    <div class="contact-title">
                                        <i class="fa fa-phone"></i>
                                        <h4>Email</h4>
                                    </div>
                                    <p>Jtpackoffoods@Gmail.Com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="contact-info-wrap">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.1208143487193!2d100.40972831483207!3d13.891723490257077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e28fc384330331%3A0x1a8c098a04d51fde!2z4Lia4LiI4LiBLiDguYDguIgu4LiX4Li1LuC5geC4nuC5h-C4hCDguK3guK3guJ8g4Lif4Li54LmJ4LiU4Liq4LmMIOC4quC4s-C4meC4seC4geC4h-C4suC4meC5g-C4q-C4jeC5iA!5e0!3m2!1sth!2sth!4v1592902551081!5m2!1sth!2sth" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection