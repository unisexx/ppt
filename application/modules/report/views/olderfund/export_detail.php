<h2 class='head_sideup'>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ รายจังหวัด </h2>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>ปีงบประมาณ
	<span style='color:#F33;'><?='ปี '.(empty($_GET['year']))? 'ทุกปีงบประมาณ':$_GET['year'];?></span>
</div>
<table class='tbreport' border='1'>
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
<th colspan="2" class="txtcen">รายโครงการ</th>
</tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<tr>
  <td></td>
  <td>รวมทั้งประเทศ</td>
  <td style='text-align:right;'><?php echo number_format($cnt[0]['total_person']) ?></td>
  <td style='text-align:right;'><?php echo number_format($cnt[0]['total_money_person']) ?></td>
  <td style='text-align:right;'><?php echo number_format($cnt[0]['total_project']) ?></td>
  <td style='text-align:right;'><?php echo number_format($cnt[0]['total_money_project']) ?></td>

  </tr>
<?php foreach($result as $key=>$item):$key += 1; ?>
<tr>
  <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
  <td><?php echo $item['province'] ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_person']) ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_money_person']); ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_project']) ?></td>
  <td style='text-align:right;'><?php echo number_format($item['total_money_project']); ?></td>
  </tr>
<?php endforeach; ?>
</table>
<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>