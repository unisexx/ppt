<html>
	<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" type="text/css" href="../../../themes/ppt/css/style.css"/>
	</head>
	<body>
<div id="resultsearch">อัตราส่วนการเป็นภาระของประชากร  จังหวัด
    <label><?=$province_name;?></label>
</div>
<div style="padding:10px; text-align:right;">
  หน่วย : ราย
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
        <td class="topic txtcen"><?php echo $item['year_data']; ?></td>
        <td class="txtright"><?php echo number_format($item['total'], 2); ?></td>
        <td class="txtright"><?php echo number_format($item['total_child'], 2); ?></td>
        <td class="txtright"><?php echo number_format($item['total_old'], 2); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
<div id="remark">หมายเหตุ : อัตราส่วนการเป็นภาระ ภาพรวม, วัยเด็ก, ผู้สูงอายุ 	กรุณาดูสูตรการคำนวณในหนังสือสถิติประชากรไทย ปี 2549 หน้า 12</div>
<script>window.print();</script>
</body>
</html>