<h3>รายงาน องค์กรที่ได้รับการสนับสนุนเงินจากกองทุนส่งเสริมการจัดการสวัสดิการสังคม ทั้งประเทศ</h3>

<table class="tbreport" border="1">
<tr>
<th class="txtcen">ปีงบประมาณ</th>
<th class="txtcen">จำนวนองค์กร (แห่ง)</th>
<th class="txtcen">จำนวนเงิน (บาท)</th>
</tr>
<?php foreach($promotefunds as $row):?>
<tr>
  <td class="topic"><a href="promotefund/report2/<?php echo $row['budgetyear']?>"><?php echo $row['budgetyear']?></a></td>
  <td><?php echo number_format($row['org_sum']); ?></td>
  <td><?php echo number_format($row['org_total_sum']); ?></td>
  </tr>
<tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนส่งเสริมการจัดการสวัสดิการสังคม</div>

