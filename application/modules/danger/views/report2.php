<h3>รายงาน จำนวนลูกจ้างและผู้ประสบอันตรายจากการทำงาน จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>

<div id="search">
  <div id="searchBox">ปีงบประมาณ
    <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="danger/report2/<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == $this->uri->segment(3,0))?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปี <?php echo $this->uri->segment(3,0);?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href='danger/export2/<?php echo $this->uri->segment(3,0)?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
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
	  <td class="txtright"><?php echo number_format($row['total'])?></td>
	  <td class="txtright"><?php echo number_format($row['dead'])?></td>
	  <td class="txtright"><?php echo number_format($row['disability'])?></td>
	  <td class="txtright"><?php echo number_format($row['lose'])?></td>
	  <td class="txtright"><?php echo number_format($row['stopmore3'])?></td>
	  <td class="txtright"><?php echo number_format($row['stopless3'])?></td>
	  <td class="txtright"><?php echo number_format($row['all_case'])?></td>
	  <td class="txtright"><?php echo number_format($row['severe_case'])?></td>
	  <td class="txtright"><?php echo number_format($row['rate_all_case'], 2)?></td>
	  <td class="txtright"><?php echo number_format($row['rate_severe_case'], 2)?></td>
	</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สำนักงานประกันสังคม  : เว็บไซต์สำนักงานประกันสังคม  http://www.sso.go.th</div>
<div>หมายเหตุ : ผู้ประสบอันตรายกรณีร้ายแรง ประกอบด้วย ตาย ทุพพลภาพ สูญเสียอวัยวะบางส่วน และหยุดงานเกิน 3 วัน</div>