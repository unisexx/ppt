<h2>สถานการณ์ทางสังคม</h2>

<div style="color:#F00; font-size: 16px; padding: 20px 0;">* ขออภัยข้อมูลอยู่ระหว่างการตรวจสอบ</div>
<script src="media/js/highcharts/highcharts.js"></script>
<script src="media/js/highcharts/modules/data.js"></script>
<script src="media/js/highcharts/modules/exporting.js"></script>

<div id="chart_1" class="chart_area"></div>
<div style="text-align:center;">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง</div>
<br><br>
<div id="chart_2" class="chart_area"></div>
<div style="text-align:center;">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง</div>
<!--<div id="chart_3" class="chart_area" ></div><br /><br />
<div id="chart_4" class="chart_area"></div>-->

<script>
$(document).ready(function() {
    var url =  "<?php echo empty($_GET['test']) ? site_url('dashboard/chart_1') : site_url('dashboard/chart_1/?test=true'); ?>";
    $.getJSON(url,function(data) {var chart = new Highcharts.Chart(data);});
    
    var url =  "<?php echo empty($_GET['test']) ? site_url('dashboard/chart_2') : site_url('dashboard/chart_2/?test=true'); ?>";
    $.getJSON(url,function(data) {var chart = new Highcharts.Chart(data);});
    
    //var url =  "<?php echo empty($_GET['test']) ? site_url('dashboard/chart_3') : site_url('dashboard/chart_3/?test=true'); ?>";
    //$.getJSON(url,function(data) {var chart = new Highcharts.Chart(data);});
    
    //var url =  "<?php echo empty($_GET['test']) ? site_url('dashboard/chart_4') : site_url('dashboard/chart_4/?test=true'); ?>";
    //$.getJSON(url,function(data) {var chart = new Highcharts.Chart(data);});
});
</script>