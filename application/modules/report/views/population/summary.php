<h3>รายงาน แนวโน้มประชากร </h3>
<div style="color:#F00; font-size: 16px; padding: 20px 0;">* ขออภัยข้อมูลอยู่ระหว่างการตรวจสอบ</div>
<div id="search">
    <form>
    <div id="searchBox">
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <input type="submit" title="ค้นหา" class="btn_search" />
    </div>
    </form>
</div>

<div id="resultsearch"><b>ผลที่ค้นหา :</b> แนวโน้มประชากร   จังหวัด
    <label><?php echo empty($_GET['province_id']) ? 'ทุกจังหวัด' : iconv('TIS-620', 'UTF-8', $this->db->getone('select province from provinces where id = '.$_GET['province_id'])); ?></label>
</div>
<div style="padding:10px; text-align:right;">
  <a href="report/population/summary_rate_export<?=GetCurrentUrlGetParameter();?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
  <a href="report/population/summary_rate_print<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>หน่วย:ราย
</div>

<table class="tbreport">
    <tr>
        <th class="txtcen">ปี</th>
        <th class="txtcen">ชาย</th>
        <th class="txtcen">หญิง</th>
        <th class="txtcen">รวม</th>
    </tr>
    <?php foreach($result as $key => $item): ?>
    <tr <?php echo cycle($key); ?>>
        <td class="topic"><?php echo $item['year_data']; ?></td>
        <td style="text-align: right;"><?php echo number_format($item['total_male'], 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item['total_female'], 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item['total_male']+$item['total_female'], 2); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
<div id="remark">หมายเหตุ : อัตราส่วนการเป็นภาระ ภาพรวม, วัยเด็ก, ผู้สูงอายุ 	กรุณาดูสูตรการคำนวณในหนังสือสถิติประชากรไทย ปี 2549 หน้า 12</div>
