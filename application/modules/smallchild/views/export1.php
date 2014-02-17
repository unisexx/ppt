<h3>รายงาน จำนวนศูนย์พัฒนาเด็กเล็ก ทั้งประเทศ</h3>

<table border="1">
  <tr>
    <th rowspan="2" class="txtcen">ปี พ.ศ.</th>
    <th rowspan="2" class="txtcen">จำนวนศูนย์ฯ</th>
    <th colspan="3" class="txtcen">เจ้าหน้าที่ประจำศูนย์</th>
    <th rowspan="2" class="txtcen">จำนวนเด็ก(คน)</th>
  </tr>
  <tr>
    <td class="txtcen">ครูผู้ดูแลเด็ก</td>
    <td class="txtcen">พนักงานจ้าง</td>
    <td class="txtcen">รวม</td>
  </tr>
  <?php foreach($smallchilds as $row):?>
  <?php
  		$teach_sum = $row['teach_5_sum']+$row['teach_4_sum'];
		$em_sum = $row['em_boss_sum']+$row['em_general_sum']+$row['em_mission_sum'];
		$total = $teach_sum + $em_sum;
  ?>
  <tr>
    <td class="topic"><?php echo $row['budgetyear']?></td>
    <td><?php echo nformat($row['org_sum'])?></td>
    <td><?php echo nformat($teach_sum)?></td>
    <td><?php echo nformat($em_sum)?></td>
    <td><?php echo nformat($total)?></td>
    <td><?php echo nformat($row['child_sum'])?></td>
  </tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : กรมส่งเสริมการปกครองท้องถิ่น</div>

