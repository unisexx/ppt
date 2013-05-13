<script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	$("#tabs li").click(function() {
		//	First remove class "active" from currently active tab
		$("#tabs li").removeClass('active');

		//	Now add class "active" to the selected/clicked tab
		$(this).addClass("active");

		//	Hide all tab content
		$(".tab_content").hide();

		//	Here we get the href value of the selected tab
		var selected_tab = $(this).find("a").attr("href");

		//	Show the selected tab content
		$(selected_tab).fadeIn();

		//	At the end, we add return false so that the click on the link is not executed
		return false;
	});
});
/* ]]> */
</script>

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
                	<li><a href="report/welfare">เด็กและเยาวชนในสถาบัน</a></li>
                	<li><a href="offense/offense_report">เด็กและเยาวชนในสถานพินิจฯ</a></li>
                    <li><a href="#">เด็กและเยาวชนออกกลางคัน</a></li>
                    <li><a href="#">ปัญหาเด็กและเยาวชนในท้องถิ่น</a></li>
                    <li><a href="report/child/pregnant">สถานการณ์การมีบุตรของวัยรุ่นไทย</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>สตรี</h4>
                <ul>
                	<li><a href="#">ปัญหาสตรีในท้องถิ่น</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>คนพิการ</h4>
                <ul>
                	<li><a href="#">ปัญหาคนพิการในท้องถิ่น</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>ครอบครัว</h4>
                <ul>
                	<li><a href="#">ปัญหาครอบครัวในท้องถิ่น</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>ผู้สูงอายุ</h4>
                <ul>
                	<li><a href="#">ปัญหาผู้สูงอายุในท้องถิ่น</a></li>
                    <li><a href="report/elder_inmates">ผู้ต้องขังสูงอายุ</a></li>
                    <li><a href="#">ผู้สูงอายุในสถาบัน</a></li>
                </ul>
            </div>
            <div class="data">
            	<h4>ผู้ด้อยโอกาส</h4>
                <ul>
                	<li><a href="poor_province/poor_report">ผู้มีรายได้ต่ำกว่าเส้นความยากจน</a></li>
                </ul>
            </div>
          
		</div>
		<div id="tab2" class="tab_content">
			<div class="data">
            	<h4>เชิงประเด็น</h4>
                <ul>
                	<li><a href="#">ปัญหาด้านที่อยู่อาศัยและสิ่งแวดล้อมในท้องถิ่น</a></li>
                	<li><a href="#">ปัญหาด้านสุขภาพอนามัยในท้องถิ่น</a></li>
                    <li><a href="#">ปัญหาด้านการศึกษาในท้องถิ่น</a></li>
                    <li><a href="#">ปัญหาด้านการมีงานทำและรายได้ในท้องถิ่น</a></li>
                    <li><a href="#">ปัญหาด้านความไม่ปลอดภัยในชีวิตและทรัพย์สินในท้องถิ่น</a></li>
                    <li><a href="#">ปัญหาด้านวัฒนธรรมและจริยธรรมในท้องถิ่น</a></li>
                    <li><a href="report/crime">การกระทำความผิดที่ละเมิดกฎหมายทางอาญา</a></li>
                    <li><a href="report/vacancy">จำนวนคนว่างงาน บรรจุงาน และสมัครงาน</a></li>
                    <li><a href="report/mental">ผู้ป่วยสุขภาพจิต</a></li>
                    <li><a href="#">ผู้ได้รับอุบัติเหตุจากยานพาหนะ</a></li>
                    <li><a href="report/family/index?keydata=1">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดสุขภาพดี</a></li>
                    <li><a href="report/family/index?keydata=2">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดมีบ้านอาศัย</a></li>
                    <li><a href="report/family/index?keydata=3">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดฝักใฝ่การศึกษา</a></li>
                    <li><a href="report/family/index?keydata=4">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดรายได้ก้าวหน้า</a></li>
                    <li><a href="report/family/index?keydata=5">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดปลูกฝั่งค่านิยมไทย</a></li>
                    <li><a href="report/family/index?keydata=6">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : หมวดร่วมใจพัฒนา</a></li>
                </ul>
            </div>
		</div>
		<div id="tab3" class="tab_content">
			<div class="data">
            	<h4>เชิงประเด็น</h4>
                <ul>
                	<li><a href="report/population/summary_rate">แนวโน้มประชากรไทย</a></li>
                	<li><a href="report/population/age_rate">ปัญหาด้านสุขภาพอนามัยในท้องถิ่น</a></li>
                    <li><a href="report/population/burden_rate">อัตราส่วนการเป็นภาระ</a></li>
                    <li><a href="#">คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</a></li>
                </ul>
            </div>
		</div>
	</div>
    
    <div class="clear"></div>
</div>