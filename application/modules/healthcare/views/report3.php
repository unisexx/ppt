<h3>รายงาน ผู้เข้าถึงสิทธิหลักประกันสุขภาพ  จำแนกตาม ประเภทสิทธิ์และจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<div id="search">
  <div id="searchBox">ปีงบประมาณ
    <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="healthcare/report3/<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == $this->uri->segment(3,0))?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $this->uri->segment(3,0)?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href='healthcare/export3/<?php echo $this->uri->segment(3,0)?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>หน่วย : คน</div>
<table class="tbreport">
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
	  <td class="txtleft"><?php echo $key+1?></td>
	  <td><?php echo $row['pv']?></td>
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

