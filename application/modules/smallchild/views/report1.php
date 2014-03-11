<h3>รายงาน จำนวนศูนย์พัฒนาเด็กเล็ก ทั้งประเทศ</h3>

<?php if(is_login()): // ถ้าไม่ได้ login จะไม่เห็น?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="window.open('smallchild/form_import','_blank')" class="btn_import"/>
</div>
<?php endif; ?>

<div style="padding:10px; text-align:right;">
<a href="smallchild/export1"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
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
    <td class="topic"><a href="smallchild/report2?year=<?php echo $row['budgetyear']?>"><?php echo $row['budgetyear']?></a></td>
    <td class="txtright"><?php echo nformat($row['org_sum'])?></td>
    <td class="txtright"><?php echo nformat($teach_sum)?></td>
    <td class="txtright"><?php echo nformat($em_sum)?></td>
    <td class="txtright"><?php echo nformat($total)?></td>
    <td class="txtright"><?php echo nformat($row['child_sum'])?></td>
  </tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : กรมส่งเสริมการปกครองท้องถิ่น</div>

