@extends('main_theme')

@section('content')
<style>
    .accordion_1 {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 13px;
        font-size: 16px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        transition: all 0.5s;
    }
    .accordion_1:hover, .active_panel{
        background-color: #ff5e00;
        color: #eee;
    }
    .accordion_1::after{
        content: "\02795";
        font-size: 16px;
        color: #777;
        float: right;
        margin-left: 5px;
    }
    .active_panel::after{
        content: "\2796";
    }
    .panel{
        padding: 0 10px;
        background-color: white;
        max-height: 0;
        transition: max-height 0.5s;
        overflow: hidden;
    }

</style>

<div class="breadcrumb-area">
    <div class="container-ext">
        <div class="row">
            <div class="col-12">
                <!-- breadcrumb-list start -->
                <ul class="breadcrumb-list">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">นโยบายคุกกี้</li>
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
                <h4>นโยบายคุกกี้</h4>
                <div id="Policy_cookie">
                    <div class="col-sm-12">
                        <p class="mt-3">
                            บริษัท เจ.ที.แพ็ค ออฟ ฟู้ดส์ จำกัด (“บริษัท”) ให้ความสำคัญและมุ่งมั่นที่จะคุ้มครองข้อมูลส่วนบุคคลและความเป็นส่วนตัวของท่าน อย่างไรก็ตาม เพื่อให้บริการที่มีคุณภาพแก่ท่าน รวมถึงประสบการณ์ที่ดีในการใช้งานบนเว็บไซต์ของบริษัทที่ https://jtpackoffoods.com/ หรือบนแพลทฟอร์มอื่น ๆ ในอินเทอร์เน็ต เช่น เพจเฟสบุ๊ค (facebook fanpage) บัญชีไลน์ (official line account) ของบริษัท เป็นต้น (เรียกรวมกันว่า ”เว็บไซต์”) บริษัท อาจเก็บรวบรวม ใช้ และ/หรือ เปิดเผยข้อมูลส่วนบุคคลเกี่ยวกับการเข้าเยี่ยมชมเว็บไซต์ของท่าน และการใช้งานเว็บไซต์ของท่าน (เรียกรวมกันว่า “ข้อมูลส่วนบุคคล”) โดยการใช้คุกกี้ หรือ เทคโนโลยีอื่นใดที่คล้ายคลึงกันเมื่อท่านเข้าเยี่ยมชมเว็บไซต์ของบริษัท เพื่อให้บริษัทสามารถอำนวยความสะดวกในการใช้งานเว็บไซต์ พัฒนาประสบการณ์การใช้งานของผู้ใช้ และตอบสนองต่อความต้องการเฉพาะของท่าน <br>
                            นโยบายคุกกี้ฉบับนี้อธิบายถึงรายละเอียดดังต่อไปนี้ <br><br>
                            1. คุกกี้คืออะไร
                                คุกกี้ (Cookie) คือ ข้อมูลตัวอักษรขนาดเล็กซึ่งถูกจัดเก็บไว้ในคอมพิวเตอร์หรืออุปกรณ์ที่เชื่อมต่อกับอินเทอร์เน็ต เช่น สมาร์ทโฟน หรือ แท็บเล็ต ของท่านเมื่อท่านเข้าเยี่ยมชมเว็บไซต์ของบริษัท ซึ่งโดยปกติคุกกี้จะทำหน้าที่บันทึกข้อมูลส่วนบุคคลของท่านเมื่อเข้าสู่เว็บไซต์ของบริษัท เช่น ชื่อ ที่อยู่ อีเมล รหัสผ่าน ไอพีแอดเดรส (IP Address) เบอร์โทรศัพท์ และคำค้นหา และการตั้งค่าผู้ใช้งานต่าง ๆ (เช่น ภาษา) เป็นต้น 
                                คุกกี้จะช่วยให้บริษัททราบว่า ท่านใช้งานเว็บไซต์ของบริษัทอย่างไร เพื่อที่บริษัทจะสามารถพัฒนาปรับปรุงประสบการณ์การใช้งาน/การให้บริการแก่ท่านให้ดียิ่งขึ้นและตรงกับความต้องการของท่านได้ โดยการบันทึกการตั้งค่าของคุกกี้ จะช่วยจดจำการตั้งค่าการใช้งานของท่าน ซึ่งจะทำให้การเข้าเยี่ยมชมเว็บไซต์ของท่านในครั้งต่อไปเป็นไปอย่างสะดวก รวดเร็ว และตอบสนองต่อความต้องการของท่านมากยิ่งขึ้น
                            <br>
                            2. บริษัทใช้คุกกี้ประเภทใด
                                บริษัทอาจใช้คุกกี้ ดังต่อไปนี้ เมื่อท่านเข้าเยี่ยมชมเว็บไซต์ของบริษัทฯ
                                •	คุกกี้ประเภทที่มีความจำเป็นอย่างยิ่ง (Strictly Necessary Cookies)
                                •	คุกกี้เพื่อการวิเคราะห์/วัดผลการทำงานของเว็บไซต์ (Site Analytical/ Performance Cookies) 
                            <br>
                            3. บริษัทใช้คุกกี้อย่างไร
                                บริษัท จะเก็บรวบรวม ใช้ หรือ เปิดเผยข้อมูลส่วนบุคคลของท่าน ซึ่งรวมถึง การตั้งค่าการใช้งานของท่านเมื่อท่านเข้าเยี่ยมชมเว็บไซต์ของบริษัทโดยการนำไฟล์คุกกี้จำนวนหนึ่งเข้าสู่เว็บบราวเซอร์ของท่าน ในกรณีนี้ บริษัทใช้คุกกี้เพื่อดำเนินการตามวัตถุประสงค์ดังต่อไปนี้
                            <br>
                            <br>
                            <table class="table">
                                <thead class="table-success">
                                    <th>
                                        หมวดหมู่ของคุกกี้		
                                    </th>
                                    <th>
                                        วัตถุประสงค์และคำอธิบายหมวดหมู่ของคุกกี้
                                    </th>
                                    <th>
                                        อายุการใช้งาน
                                    </th>
                                </thead>
                                <tbody style="font-size: 12px;">
                                    <tr>
                                        <td style="width:15%;">
                                            คุกกี้ประเภทที่มีความจำเป็นอย่างยิ่ง (Strictly Necessary Cookies) คุกกี้เพื่อการวิเคราะห์/วัดผลการทำงานของเว็บไซต์ (Site Analytical/ Performance Cookies)
                                        </td>
                                        <td style="width:75%;">
                                            คุกกี้ประเภทนี้มีความสำคัญต่อการทำงานของเว็บไซต์ ซึ่งรวมถึงคุกกี้ที่ทำให้ท่านสามารถเข้าถึงข้อมูลและใช้งานในเว็บไซต์ของเราได้อย่างปลอดภัย  คุกกี้ประเภทนี้จะช่วยให้เราสามารถจดจำและนับจำนวนผู้เข้าเยี่ยมชมเว็บไซต์ตลอดจนช่วยให้เราทราบถึงพฤติกรรมในการเยี่ยมชมเว็บไซต์ เพื่อปรับปรุงการทำงานของเว็บไซต์ให้มีคุณภาพดีขึ้นและมีความเหมาะสมมากขึ้น อีกทั้งเพื่อรวบรวมข้อมูลทางสถิติเกี่ยวกับวิธีการเข้าและพฤติกรรมการเยี่ยมชมเว็บไซต์ ซึ่งจะช่วยปรับปรุงการทำงานของเว็บไซต์โดยให้ผู้ใช้งานสามารถค้นหาสิ่งที่ต้องการได้อย่างง่ายดาย และช่วยให้เราเข้าใจถึงความสนใจของผู้ใช้ และวัดความมีประสิทธิผลของโฆษณาของเราหากคุณไม่อนุญาตคุกกี้เหล่านี้ เราจะไม่ทราบว่าคุณได้เยี่ยมชมเว็บไซต์ของเราเมื่อใด และจะไม่สามารถตรวจสอบผลการทำงานของเว็บไซต์ได้
                                        </td>
                                        <td>
                                            90 วัน
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <br>
                            อนึ่ง คุกกี้บางประเภทในเว็บไซต์นี้จัดการโดยบุคคลที่สาม เช่น การโฆษณา ผู้ประกอบการที่เกี่ยวข้องกับลักษณะการทำงานต่าง ๆ อาทิ วิดีโอ แผนที่ และโซเชียลมีเดีย และผู้ให้บริการเว็บไซต์ภายนอกอื่น ๆ เช่น บริการวิเคราะห์การเข้าเยี่ยมชมเว็บไซต์ เป็นต้น คุกกี้เหล่านี้มักจะเป็นคุกกี้เพื่อการวิเคราะห์/วัดผลการทำงาน ท่านควรต้องศึกษานโยบายการใช้คุกกี้และนโยบายส่วนบุคคลในเว็บไซต์ของบุคคลที่สาม เพื่อให้เข้าใจถึงวิธีการที่บุคคลที่สามอาจนำข้อมูลของท่านไปใช้ <br>
                            4. การจัดการคุกกี้
                            ท่านสามารถจัดการคุกกี้ โดยการเปลี่ยนแปลงการตั้งค่าคุกกี้ โดยการยอมรับ ปฏิเสธ หรือ ลบคุกกี้ซึ่งถูกตั้งค่าไว้ในเว็บไซต์ของบริษัท ท่านสามารถดำเนินการดังกล่าวได้โดยการเลือกการตั้งค่าคุกกี้หรือตั้งค่าบราวเซอร์ของท่าน เช่น ห้ามการติดตั้งคุกกี้ลงบนอุปกรณ์ของท่านโดยการปิดการใช้งานคุกกี้ดังกล่าว ท่านสามารถปิดการทำงานของคุกกี้ได้ โดยการตั้งค่าเบราว์เซอร์ของท่าน และตั้งค่าความเป็นส่วนตัวเพื่อระงับการรวบรวมข้อมูลโดยคุกกี้ในอนาคต (รายละเอียดเพิ่มเติมสามารถศึกษาได้จาก AboutCookies.org)
                            อย่างไรก็ตาม การตั้งค่าคุกกี้ดังกล่าวอาจส่งผลต่อประสิทธิภาพการใช้งานเว็บไซต์ของบริษัท เนื่องจากท่านอาจไม่สามารถใช้งานเว็บไซต์บางส่วน หรืออาจใช้งานเว็บไซต์ของบริษัทได้ไม่เต็มประสิทธิภาพ หรืออาจไม่สามารถเก็บข้อมูลการตั้งค่าการใช้งานของท่านได้ นอกจากนี้ อาจส่งผลต่อการแสดงผลหน้าเว็บไซต์ของบริษัทซึ่งอาจทำให้ไม่อาจแสดงผลได้อย่างถูกต้องสมบูรณ์
                            <br>
                            5. ประกาศความเป็นส่วนตัว
                            หากท่านต้องการทราบข้อมูลเพิ่มเติมเกี่ยวกับการเก็บรวบรวม ใช้ และ/หรือ เปิดเผย ข้อมูลส่วนบุคคลของท่าน โปรดอ่านประกาศความเป็นส่วนตัวของบริษัท ที่ประกาศความเป็นส่วนตัวของผู้มาติดต่อ ซึ่งเผยแพร่อยู่บนเว็บไซต์ของบริษัท โดยนโยบายการใช้คุกกี้นี้ถือเป็นส่วนหนึ่งของประกาศความเป็นส่วนตัวของบริษัท
                            <br>
                            6. การแก้ไขนโยบายคุกกี้
                            เราขอสงวนสิทธิ์ในการเปลี่ยนแปลงและแก้ไขประกาศฉบับนี้ โปรดเยี่ยมชมเว็บไซต์นี้เป็นระยะ ๆ เพื่อตรวจสอบนโยบายคุกกี้ รวมถึงข้อมูลเพิ่มเติมอื่น ๆ ที่เราจะปรับปรุงข้อมูลที่เผยแพร่อยู่บนเว็บไซต์ของบริษัทให้เป็นปัจจุบัน และในกรณีที่เหมาะสม เราอาจจะแจ้งให้ท่านทราบถึงการเปลี่ยนแปลงใด ๆ ผ่านทางอีเมลที่ท่านได้ให้ไว้ ขอให้ท่านอ่านรายละเอียดนโยบายการใช้คุกกี้ และประกาศความเป็นส่วนตัวที่เราได้ประกาศไว้บนเว็บไซต์ทุกครั้งก่อนเข้าใช้งาน
                            <br>
                            7. การติดต่อ หากมีข้อสงสัยเกี่ยวกับนโยบายคุกกี้ฉบับนี้ ท่านสามารถติดต่อบริษัทเพื่อสอบถามข้อมูลเพิ่มเติม หรือร้องขอใช้สิทธิของเจ้าของข้อมูลส่วนบุคคลตามกฎหมายได้ที่ช่องทาง ดังต่อไปนี้ 
                            บริษัท เจ.ที.แพ็ค ออฟ ฟู้ดส์ จำกัด<br>
                            สถานที่ติดต่อ :		เลขที่ 75/75 ม.5 ซอยทองคำ 3 ถนนจันทร์ทองเอี่ยม  <br>
                            ตำบลบางรักพัฒนา อำเภอบางบัวทอง จังหวัดนนทบุรี 11110 <br>
                            เบอร์โทรศัพท์ :        	02-033-7939 <br>
                            อีเมล : 			Jtgroupdpo@jtpackoffoods.com <br>
                            เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคล <br>
                            สถานที่ติดต่อ :		เลขที่ 75/75 ม.5 ซอยทองคำ 3 ถนนจันทร์ทองเอี่ยม  <br>
                            ตำบลบางรักพัฒนา อำเภอบางบัวทอง จังหวัดนนทบุรี 11110 <br>
                            เบอร์โทรศัพท์ :        	02-033-7939 <br>
                            อีเมล : 			Jtgroupdpo@jtpackoffoods.com <br>
                            <br>
                            นโยบายคุกกี้ (Cookies Policy) ฉบับนี้ ปรับปรุงครั้งล่าสุดเมื่อ วันที่  1 เดือน พฤศจิกายน พ.ศ. 2565

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection