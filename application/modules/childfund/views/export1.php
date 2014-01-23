<h3>รายงาน การให้การสนับสนุนจากกองทุนคุ้มครองเด็กทั้งประเทศ</h3>

<table class="tbreport" border="1">
<tr>
<th rowspan="2" class="txtcen">ปีงบประมาณ</th>
<th colspan="2" class="txtcen">ประเภทบุคคล</th>
<th colspan="2" class="txtcen">ประเภทองค์กร</th>
</tr>
<tr>
  <td class="txtcen">จำนวนเด็ก (คน)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
  <td class="txtcen">จำนวนองค์กร (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($childfunds as $row):?>
<tr>
  <td class="topic"><?php echo $row['budgetyear']?></td>
  <td class="txtright"><?php echo number_format($row['people_sum'])?></td>
  <td class="txtright"><?php echo number_format($row['total_sum'])?></td>
  <td class="txtright">31</td>
  <td class="txtright">253,000</td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนคุ้มครองเด็ก  </div>