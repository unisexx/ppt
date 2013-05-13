<h3>รายงาน อัตราส่วนการเป็นภาระของประชากร</h3>
<div id="search">
    <form>
    <div id="searchBox">
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <input type="submit" title="ค้นหา" class="btn_search" />
    </div>
    </form>
</div>

<div id="resultsearch"><b>ผลที่ค้นหา :</b> อัตราส่วนการเป็นภาระของประชากร  จังหวัด
<label>ทุกจังหวัด</label></div>
<div style="padding:10px; text-align:right;">
  <a href="#"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
  <a href="#"><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>หน่วย:ราย
</div>

<table class="tbreport">
    <tr>
        <th>ปี</th>
        <th>ภาพรวม</th>
        <th>วัยเด็ก</th>
        <th>ผู้สูงอายุ</th>
    </tr>
    <?php foreach($result as $key => $item): ?>
    <tr <?php echo cycle($key); ?>>
        <td class="topic"><?php echo $item['year_data']; ?></td>
        <td><?php echo number_format($item['total'], 2); ?></td>
        <td><?php echo number_format($item['total_child'], 2); ?></td>
        <td><?php echo number_format($item['total_old'], 2); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
<div id="remark">หมายเหตุ : อัตราส่วนการเป็นภาระ ภาพรวม, วัยเด็ก, ผู้สูงอายุ 	กรุณาดูสูตรการคำนวณในหนังสือสถิติประชากรไทย ปี 2549 หน้า 12</div>
