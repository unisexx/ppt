<h3>รายงาน จำนวนลูกจ้างและผู้ประสบอันตรายจากการทำงาน จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>


<table class="tbreport" border='1'>
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th rowspan="2" class="txtcen">จำนวนลูกจ้างในข่ายฯ (ณ 31 ธ.ค.ของทุกปี)</th>
<th colspan="5" class="txtcen">ความรุนแรงจากอันตรายที่ประสบ</th>
<th colspan="2" class="txtcen">จำนวนประสบอันตราย</th>
<th colspan="2" class="txtcen">อัตราการประสบอันตรายต่อลูกจ้าง 1,000 ราย</th>
</tr>
<tr>
  <td class="txtcen">ตาย</td>
  <td class="txtcen">ทุพพลภาพ</td>
  <td class="txtcen">สูญเสียอวัยวะบางส่วน</td>
  <td class="txtcen">หยุดงานเกิน 3 วัน</td>
<td class="txtcen">หยุดงานไม่เกิน 3 วัน</td>
<td class="txtcen">นับทุกกรณี</td>
<td class="txtcen">นับกรณีร้ายแรง</td>
<td class="txtcen">นับทุกกรณี</td>
<td class="txtcen">นับกรณีร้ายแรง</td>
</tr>
<?php foreach($dangers as $key=>$row):?>
	<tr>
	  <td><?php echo $key+1?></td>
	  <td><?php echo $row['province']?></td>
	  <td><?php echo number_format($row['total'])?></td>
	  <td><?php echo number_format($row['dead'])?></td>
	  <td><?php echo number_format($row['disability'])?></td>
	  <td><?php echo number_format($row['lose'])?></td>
	  <td><?php echo number_format($row['stopmore3'])?></td>
	  <td><?php echo number_format($row['stopless3'])?></td>
	  <td><?php echo number_format($row['all_case'])?></td>
	  <td><?php echo number_format($row['severe_case'])?></td>
	  <td><?php echo number_format($row['rate_all_case'], 2)?></td>
	  <td><?php echo number_format($row['rate_severe_case'], 2)?></td>
	</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สำนักงานประกันสังคม  : เว็บไซต์สำนักงานประกันสังคม  http://www.sso.go.th</div>