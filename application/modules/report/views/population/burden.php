<h3>รายงาน อัตราส่วนการพึ่งพิงของประชากร</h3>
<div style="color:#F00; font-size: 16px; padding: 20px 0;">* ขออภัยข้อมูลอยู่ระหว่างการตรวจสอบ</div>
<div id="search">
    <form>
    <div id="searchBox">
        <?php echo form_dropdown('province_id', get_option('code', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทั้งประเทศ --'); ?>
        <input type="submit" title="ค้นหา" class="btn_search" />
    </div>
    </form>
</div>

<div id="resultsearch"><b>ผลที่ค้นหา :</b> อัตราส่วนการพึ่งพิงของประชากร  <?php echo $province_name; ?>
</div>
<div style="padding:10px; text-align:right;">
  <a href="report/population/burden_rate/export<?=GetCurrentUrlGetParameter();?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
  <a href="report/population/burden_rate/print<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
</div>

<table class="tbreport">
    <tr>
        <th class="txtcen">ปี</th>
        <th class="txtcen">ภาพรวม</th>
        <th class="txtcen">วัยเด็ก</th>
        <th class="txtcen">ผู้สูงอายุ</th>
    </tr>
    <?php foreach($result as $key => $item): ?>
    <tr <?php echo cycle($key); ?>>
    	<?
    		@$rate_child = ($item['total_child']/$item['total_work'])*100;
			@$rate_old = ($item['total_old']/$item['total_work'])*100;
			$rate_sum = $rate_child+$rate_old;
    	?>
        <td class="topic txtcen"><?php echo $item['year_data']; ?></td>
        <td class="txtright"><?php echo number_format($rate_sum, 2); ?></td>
        <td class="txtright"><?php echo number_format($rate_child, 2); ?></td>
        <td class="txtright"><?php echo number_format($rate_old, 2); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูลประชากร  สำนักบริหารการทะเบียน กรมการปกครอง </div>
<div id="remark">หมายเหตุ : <br>
อัตราส่วนพึ่งพิงรวมหมายถึงจำนวนประชากรเด็กและประชากรสูงอายุต่อจำนวนประชากรวัยแรงงาน 100 คน <br>
อัตราส่วนพึ่งพิงวัยเด็กคำนวณจากประชากรวัยเด็กหารประชากรวัยแรงงานคูณ 100 <br>
อัตราส่วนพึ่งพิงผู้สูงอายุคำนวณจากประชากรผู้สูงอายุหารประชากรวัยแรงงานคูณ 100
</div>
