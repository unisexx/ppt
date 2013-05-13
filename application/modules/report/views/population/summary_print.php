<html>
	<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
	<body>
<h3>รายงาน แนวโน้มประชากร </h3>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> แนวโน้มประชากร   จังหวัด
    <label><?php echo empty($_GET['province_id']) ? 'ทุกจังหวัด' : iconv('TIS-620', 'UTF-8', $this->db->getone('select province from provinces where id = '.$_GET['province_id'])); ?></label>
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
        <td style="text-align: right;"><?php echo number_format($item['total_male'], 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item['total_female'], 0); ?></td>
        <td style="text-align: right;"><?php echo number_format($item['total_male']+$item['total_female'], 2); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
<div id="remark">หมายเหตุ : อัตราส่วนการเป็นภาระ ภาพรวม, วัยเด็ก, ผู้สูงอายุ 	กรุณาดูสูตรการคำนวณในหนังสือสถิติประชากรไทย ปี 2549 หน้า 12</div>
<script>window.print();</script>
</body>
</html>