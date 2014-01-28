<h3>รายงาน จำนวนศูนย์พัฒนาเด็กเล็ก จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->rsegment(3)?></h3>
<div id="search">
  <div id="searchBox">
    <select name="select2" id="select2">
      <option>2556</option>
      <option>2555</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ 2556
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href="smallchild/export2/<?php echo $this->uri->rsegment(3)?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
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
  <td><a href="smallchild/report3/<?php echo $row['budgetyear']?>/<?php echo $row['pv']?>"><?php echo $row['pv']?></a></td>
  <td><?php echo nformat($row['org_sum'])?></td>
  <td><?php echo nformat($teach_sum)?></td>
  <td><?php echo nformat($em_sum)?></td>
  <td><?php echo nformat($total)?></td>
  <td><?php echo nformat($row['child_sum'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมส่งเสริมการปกครองท้องถิ่น</div>

