<h3>รายงาน ผู้ได้รับผลกระทบจากภัยจราจร  จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<div id="search">
  <div id="searchBox">ปีงบประมาณ
    <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="publicdanger/report_traffic/<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == $this->uri->segment(3,0))?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปี <?php echo $this->uri->segment(3,0)?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href='publicdanger/export_traffic/<?php echo $this->uri->segment(3,0)?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="3" class="txtcen">ที่</th>
<th rowspan="3" class="txtcen">จังหวัด</th>
<th rowspan="3" class="txtcen">จำนวนครั้ง</th>
<th colspan="3" class="txtcen">ราษฎรที่ประสบภัยจราจร</th>
</tr>
<tr>
  <td rowspan="2" class="txtcen">เสียชีวิต</td>
  <td colspan="2" class="txtcen">บาดเจ็บ</td>
</tr>
<tr>
  <td class="txtcen">สาหัส</td>
  <td class="txtcen">เล็กน้อย</td>
</tr>
<?php foreach($traffics as $key=>$row):?>
<tr>
  <td class="txtright"><?php echo $key+1?></td>
  <td class="txtleft"><?php echo $row['province']?></td>
  <td class="txtright"><?php echo number_format($row['counter'])?></td>
  <td class="txtright"><?php echo number_format($row['death'])?></td>
  <td class="txtright"><?php echo number_format($row['serious_injury'])?></td>
  <td class="txtright"><?php echo number_format($row['minor_injury'])?></td>
</tr>	
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>

