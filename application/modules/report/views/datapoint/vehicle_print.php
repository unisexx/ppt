<html>
	<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
	<body>
<h3>รายงาน ผู้ประสบอุบัติเหตุจากยานพาหนะ</h3>
<div style="padding:10px; text-align:right;">
  <img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">หน่วย:คน</div>
<table class="tbreport" border="1" bordercolor="#eee">
<tr>
  <th rowspan="2">ปี</th>
  <th colspan="2">ตาย</th>
  <th colspan="2">บาดเจ็บสาหัส</th>
  <th colspan="2">บาดเจ็บเล็กน้อย</th>
  <th rowspan="2">มูลค่าทรัพย์สินเสียหาย (บาท)</th>
  </tr>
<tr>
  <td>ชาย</td>
  <td>หญิง</td>
  <td>ชาย</td>
  <td>หญิง</td>
  <td>ชาย</td>
  <td>หญิง</td>
  </tr>
<?php foreach($result as $key =>$item): ?>
<tr>
  <td class="topic"><?php echo $item['year'] ?></td>
  <td><?php echo number_format($item['die_male']) ?></td>
  <td><?php echo number_format($item['die_female']) ?></td>
  <td><?php echo number_format($item['coma_male']) ?></td>
  <td><?php echo number_format($item['coma_female']) ?></td>
  <td><?php echo number_format($item['pain_male']) ?></td>
  <td><?php echo number_format($item['pain_female']) ?></td>
  <td><?php echo number_format($item['total']) ?></td>
  </tr>
 <?php endforeach; ?>
</table>

<div id="ref"><b>ที่มา :</b></div>
<script>window.print();</script>
</body>
</html>