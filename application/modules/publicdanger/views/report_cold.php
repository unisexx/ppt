<h3>รายงาน ผู้ได้รับผลกระทบจาก<span class="txtcen">ภัยหนาว</span> จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<div id="search">
  <div id="searchBox">ปีงบประมาณ
    <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="publicdanger/report_cold/<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == $this->uri->segment(3,0))?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปี <?php echo $this->uri->segment(3,0)?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href='publicdanger/export_cold/<?php echo $this->uri->segment(3,0)?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">ราษฎรที่ประสบภัยหนาว</th>
</tr>
<tr>
  <td class="txtcen">ครัวเรือน</td>
  <td class="txtcen">คน</td>
</tr>
<?php foreach($colds as $key=>$row):?>
<tr>
  <td class="txtright"><?php echo $key+1?></td>
  <td class="txtleft"><?php echo $row['province']?></td>
  <td class="txtright"><?php echo number_format($row['household'])?></td>
  <td class="txtright"><?php echo number_format($row['people'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>

