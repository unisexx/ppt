<h3>รายงาน ผู้เข้าถึงสิทธิหลักประกันสุขภาพ ประเภท<?php echo $type[$_GET['type']]?> จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<div id="search">
  <div id="searchBox">ปีงบประมาณ
    <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="healthcare/report2/<?php echo $row['year_data']?>?type=<?php echo $_GET['type']?>" <?php echo ($row['year_data'] == $this->uri->segment(3,0))?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $this->uri->segment(3,0)?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href='healthcare/export2/<?php echo $this->uri->segment(3,0)?>?type=<?php echo $_GET['type']?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>หน่วย : คน</div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="4" class="txtcen"><?php echo $type[$_GET['type']]?></th>
</tr>
<tr>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
</tr>
<?php foreach($healthcares as $key=>$row):?>
	<tr>
	  <td class="txtleft"><?php echo $key+1?></td>
	  <td><?php echo $row['pv']?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_men'])?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_women'])?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_none'])?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_sum'])?></td>
	</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สำนักงานหลักประกันสุขภาพแห่งชาติ  (สปสช.)</div>

