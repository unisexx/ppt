<h2 class='head_sideup'>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ ทั่วประเทศ</h2>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>ปีงบประมาณ
	<span style='color:#F33;'><?php echo $year;?></span>
</div>
<table  class='tbreport' border='1'>
<tr>
  <th rowspan="2" class="txtcen">ปีงบประมาณ</th>
  <th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
  <th colspan="2" class="txtcen">รายโครงการ</th>
  </tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($result as $key=>$item): ?>
<tr>
  <td class="topic"><?php echo $item['year'] ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_person']); ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_money_person']); ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_project']); ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_money_project']); ?></td>
</tr>
<?php endforeach; ?>
</table>
<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>