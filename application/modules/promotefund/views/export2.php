<h3>รายงาน องค์กรที่ได้รับการสนับสนุนเงินจากกองทุนส่งเสริมการจัดการสวัสดิการสังคม จำแนกรายจังหวัดและประเภทองค์กร ประจำปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>

<table class="tbreport" border="1">
<tr>
  <th rowspan="2" class="txtcen">ที่</th>
  <th rowspan="2" class="txtcen">จังหวัด</th>
  <th colspan="2" class="txtcen">องค์กรภาครัฐ</th>
  <th colspan="2" class="txtcen">องค์กรสวัสดิการชุมชน</th>
  <th colspan="2" class="txtcen">องค์กรสาธารณะประโยชน์</th>
</tr>
<tr>
  <td class="txtcen">จำนวน (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
  <td class="txtcen">จำนวน (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
  <td class="txtcen">จำนวน (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($promotefunds as $key=>$row):?>
<tr>
  <td><?php echo $key+1?></td>
  <td><?php echo $row['pv']?></td>
  <td><?php echo number_format($row['under_type1'])?></td>
  <td><?php echo number_format($row['sum_under_type1'])?></td>
  <td><?php echo number_format($row['under_type2'])?></td>
  <td><?php echo number_format($row['sum_under_type2'])?></td>
  <td><?php echo number_format($row['under_type3'])?></td>
  <td><?php echo number_format($row['sum_under_type3'])?></td>
  </tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนส่งเสริมการจัดการสวัสดิการสังคม</div>

