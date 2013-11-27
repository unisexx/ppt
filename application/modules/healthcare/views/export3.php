<h3>รายงาน ผู้เข้าถึงสิทธิหลักประกันสุขภาพ  จำแนกตาม ประเภทสิทธิ์และจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
หน่วย : คน
<table class="tbreport" border="1">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="4" class="txtcen">สิทธิประกันสุขภาพถ้วนหน้า</th>
<th colspan="4" class="txtcen">บุคคลที่ยังไม่ได้รับการลงทะเบียน</th>
<th colspan="4" class="txtcen">สิทธิข้าราชการ/สิทธิรัฐวิสาหกิจ</th>
<th colspan="4" class="txtcen">สิทธิและสถานะอื่นๆ</th>
<th colspan="4" class="txtcen">สิทธิประกันสังคม</th>
<th colspan="4" class="txtcen">บุคคลผู้มีปัญหาสถานะและสิทธิ</th>
</tr>
<tr>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
</tr>
<?php foreach($healthcares as $key=>$row):?>
	<tr>
	  <td><?php echo $key+1?></td>
	  <td><?php echo $row['province']?></td>
	  <td class="txtright"><?php echo number_format($row['health_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['health_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['health_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['health_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_sum'])?></td>
	</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สำนักงานหลักประกันสุขภาพแห่งชาติ  (สปสช.)</div>

