<h3>รายงาน จำนวนศูนย์พัฒนาเด็กเล็ก จังหวัด <?php echo $_GET['province']?> ปีงบประมาณ <?php echo $_GET['year']?></h3>
<div id="search">
  <div id="searchBox">
  	<form method="get" action="smallchild/report3">
    <select name="year">
      <?php foreach($years as $row):?>
      	<option value="<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == $_GET['year'])?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
    <select name="province">
      <?php foreach($provinces as $row):?>
      	<option value="<?php echo $row['pv']?>" <?php echo ($row['pv'] == $_GET['province'])?"selected":"";?>><?php echo $row['pv']?></option>
      <?php endforeach;?>
    </select>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
	</form>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $_GET['year']?>
  <label></label> 
  จังหวัด <?php echo $_GET['province']?>
</div>
<div style="padding:10px; text-align:right;">
<a href="smallchild/export3?year=<?php echo $_GET['year']?>&province=<?php echo $_GET['province']?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">อำเภอ</th>
<th rowspan="2" class="txtcen">จำนวนศูนย์</th>
<th colspan="3" class="txtcen">รายบุคคล</th>
<th rowspan="2" class="txtcen">จำนวนเด็ก (คน)</th>
</tr>
<tr>
  <td class="txtcen">ครูผู้ดูแลเด็ก</td>
  <td class="txtcen">พนักงานจ้าง</td>
<td class="txtcen">รวม</td>
</tr>
<tr>
  <td></td>
  <td><?php echo $_GET['province']?></td>
  <td>&nbsp;</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<?php foreach($smallchilds as $key=>$row):?>
<?php
	$teach_sum = $row['teach_5_sum']+$row['teach_4_sum'];
	$em_sum = $row['em_boss_sum']+$row['em_general_sum']+$row['em_mission_sum'];
	$total = $teach_sum + $em_sum;
?>
<tr>
  <td><?php echo $key+1?></td>
  <td><a href="smallchild/report4?year=<?php echo $row['budgetyear']?>&province=<?php echo $row['pv']?>&ampor=<?php echo $row['am']?>"><?php echo $row['am']?></a></td>
  <td class="txtright"><?php echo nformat($row['org_sum'])?></td>
  <td class="txtright"><?php echo nformat($teach_sum)?></td>
  <td class="txtright"><?php echo nformat($em_sum)?></td>
  <td class="txtright"><?php echo nformat($total)?></td>
  <td class="txtright"><?php echo nformat($row['child_sum'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมส่งเสริมการปกครองท้องถิ่น</div>

