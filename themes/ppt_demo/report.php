<? include "include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<? include '_script.php'?>
</head>

<body>
<? include '_header.php'?>
<? include '_menu.php'?>
<div id="page">
<h3 style="margin-bottom:20px;">ข้อมูลรายงานสรุป</h3>
<div id="tabs_wrapper">
	<div id="tabs_container">
		<ul id="tabs">
			<li class="active"><a href="#tab1">กลุ่มเป้าหมาย</a></li>
			<li><a href="#tab2">เชิงประเด็น</a></li>
			<li><a href="#tab3">ข้อมูลพื้นฐาน</a></li>
		</ul>
	</div>
	<div id="tabs_content_container">
		<div id="tab1" class="tab_content" style="display: block;">
			<div class="data">
            	<h4>เด็กและเยาวชน</h4>
                <ul>
                	<li><a href="report_sum.php?act=child1">เด็กและเยาวชนในสถาบัน</a></li>
                	<li><a href="report_sum.php?act=child2">เด็กและเยาวชนในสถานพินิจฯ</a></li>
                    <li><a href="report_sum.php?act=child3">เด็กและเยาวชนออกกลางคัน</a></li>
                    <li><a href="report_sum.php?act=child4">ปัญหาเด็กและเยาวชนในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=child5">สถานการณ์การมีบุตรของวัยรุ่นไทย</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>สตรี</h4>
                <ul>
                	<li><a href="report_sum.php?act=women1">ปัญหาสตรีในท้องถิ่น</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>คนพิการ</h4>
                <ul>
                	<li><a href="report_sum.php?act=disabled1">ปัญหาคนพิการในท้องถิ่น</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>ครอบครัว</h4>
                <ul>
                	<li><a href="report_sum.php?act=family1">ปัญหาครอบครัวในท้องถิ่น</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>ผู้สูงอายุ</h4>
                <ul>
                	<li><a href="report_sum.php?act=older1">ปัญหาผู้สูงอายุในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=older2">ผู้ต้องขังสูงอายุ</a></li>
                    <li><a href="report_sum.php?act=older3">ผู้สูงอายุในสถาบัน</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>ผู้ด้อยโอกาส</h4>
                <ul>
                	<li><a href="report_sum.php?act=disadvantaged1">ผู้มีรายได้ต่ำกว่าเส้นความยากจน</a></li>
                </ul>
            </div>
          
		</div>
		<div id="tab2" class="tab_content">
			<div class="data">
            	<h4>เชิงประเด็น</h4>
                <ul>
                	<li><a href="report_sum.php?act=issue1">ปัญหาด้านที่อยู่อาศัยและสิ่งแวดล้อมในท้องถิ่น</a></li>
                	<li><a href="report_sum.php?act=issue2">ปัญหาด้านสุขภาพอนามัยในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=issue3">ปัญหาด้านการศึกษาในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=issue4">ปัญหาด้านการมีงานทำและรายได้ในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=issue5">ปัญหาด้านความไม่ปลอดภัยในชีวิตและทรัพย์สินในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=issue6">ปัญหาด้านวัฒนธรรมและจริยธรรมในท้องถิ่น</a></li>
                    <li><a href="report_sum.php?act=issue7">การกระทำความผิดที่ละเมิดกฎหมายทางอาญา</a></li>
                    <li><a href="report_sum.php?act=issue8">จำนวนคนว่างงาน บรรจุงาน และสมัครงาน</a></li>
                    <li><a href="report_sum.php?act=issue9">ผู้ป่วยสุขภาพจิต</a></li>
                    <li><a href="report_sum.php?act=issue10">ผู้ได้รับอุบัติเหตุจากยานพาหนะ</a></li>
                    <li><a href="report_sum.php?act=issue11">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดสุขภาพดี</a></li>
                    <li><a href="report_sum.php?act=issue11">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดมีบ้านอาศัย</a></li>
                    <li><a href="report_sum.php?act=issue11">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดฝักใฝ่การศึกษา</a></li>
                    <li><a href="report_sum.php?act=issue11">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดรายได้ก้าวหน้า</a></li>
                    <li><a href="report_sum.php?act=issue11">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดปลูกฝั่งค่านิยมไทย</a></li>
                    <li><a href="report_sum.php?act=issue11">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดร่วมใจพัฒนา</a></li>
                </ul>
            </div>
		</div>
		<div id="tab3" class="tab_content">
			<div class="data">
            	<h4>ข้อมูลพื้นฐาน</h4>
                <ul>
                	<li><a href="report_sum.php?act=basic1">แนวโน้มประชากรไทย</a></li>
                	<li><a href="report_sum.php?act=basic2">สถิติประชากรรายอายุ</a></li>
                    <li><a href="report_sum.php?act=basic3">อัตราส่วนการเป็นภาระ</a></li>
                    <li><a href="report_sum.php?act=basic4">คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</a></li>
                </ul>
            </div>
		</div>
	</div>
    
    <div class="clear"></div>
</div>


</div><!--page-->
</body>
</html>