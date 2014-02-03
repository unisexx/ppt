<h3>รายงาน จำนวนศูนย์พัฒนาเด็กเล็ก จำแนกรายจังหวัด ปีงบประมาณ <?php echo $_GET['year']?></h3>

<table border="1">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th rowspan="2" class="txtcen">จำนวนศูนย์</th>
<th colspan="3" class="txtcen">รายบุคคล</th>
<th rowspan="2" class="txtcen">จำนวนเด็ก (คน)</th>
</tr>
<tr>
  <td class="txtcen">ครูผู้ดูแลเด็ก</td>
  <td class="txtcen">พนักงานจ้าง</td>
<td class="txtcen">รวม</td>
</tr>
<?php foreach($smallchilds as $key=>$row):?>
<?php
  		$teach_sum = $row['teach_5_sum']+$row['teach_4_sum'];
		$em_sum = $row['em_boss_sum']+$row['em_general_sum']+$row['em_mission_sum'];
		$total = $teach_sum + $em_sum;
?>
<tr>
  <td><?php echo $key+1?></td>
  <td><?php echo $row['pv']?></td>
  <td><?php echo nformat($row['org_sum'])?></td>
  <td><?php echo nformat($teach_sum)?></td>
  <td><?php echo nformat($em_sum)?></td>
  <td><?php echo nformat($total)?></td>
  <td><?php echo nformat($row['child_sum'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมส่งเสริมการปกครองท้องถิ่น</div>

