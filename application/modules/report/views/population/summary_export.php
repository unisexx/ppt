<h3>รายงาน แนวโน้มประชากร </h3>
<div id="resultsearch">แนวโน้มประชากร 
    <label><?php echo empty($_GET['province_code']) ? 'ทุกจังหวัด' : 'จังหวัด '.iconv('TIS-620', 'UTF-8', $this->db->getone('select province from provinces where code = '.$_GET['province_code'])); ?></label>
</div>
<div style="padding:10px; text-align:right;">
  หน่วย:ราย
</div>

<table width="650" border="1">
    <tr>
        <th>ปี</th>
        <th>ชาย</th>
        <th>หญิง</th>
        <th>รวม</th>
    </tr>
    <?php foreach($result as $key => $item): ?>
    <tr <?php echo cycle($key); ?>>
        <td class="topic"><?php echo $item['year_data']; ?></td>
        <td style="text-align: right;"><?php echo number_format($item['male_population'], 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item['female_population'], 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item['summary_population'], 0); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
<!-- <div id="remark">หมายเหตุ : อัตราส่วนการเป็นภาระ ภาพรวม, วัยเด็ก, ผู้สูงอายุ 	กรุณาดูสูตรการคำนวณในหนังสือสถิติประชากรไทย ปี 2549 หน้า 12</div> -->
