<h3>รายงาน ผู้ประสบอุบัติเหตุจากยานพาหนะ</h3>
<table class="tbreport" border="1">
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
