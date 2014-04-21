<h3>รายงาน ผู้ได้รับผลกระทบจาก<span class="txtcen">อุทกภัย</span> จำแนกรายจังหวัด ปีงบประมาณ <?php echo $_GET['year_data']?></h3>

<!-- <form method="get" action="publicdanger/report_flood"> -->
<div id="search">
  <div id="searchBox">ปีงบประมาณ
    <select name="year_data" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="publicdanger/report_flood?year_data=<?php echo $row['year_data']?>&no=1" <?php echo ($row['year_data'] == $_GET['year_data'])?"selected":"";?>><?php echo $row['year_data']?></option>
      <?php endforeach;?>
    </select>
    
    ครั้งที่
  <select name="no" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
  <?php foreach($nos as $row):?>
  	<option value="publicdanger/report_flood?year_data=<?php echo $_GET['year_data']?>&no=<?php echo $row['no']?>" <?php echo ($row['no'] == $_GET['no'])?"selected":"";?>><?php echo $row['no']?></option>
  <?php endforeach;?>
  </select>
  
  <!-- <input type="submit" title="ค้นหา" value=" " class="btn_search"> -->
  </div>
</div>
<!-- </form> -->

<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปี <?php echo $_GET['year_data']?> ครั้งที่ <?php echo $_GET['no']?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href='publicdanger/export_flood?year_data=<?php echo $_GET['year_data']?>&no=<?php echo $_GET['no']?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">ราษฎรที่ประสบอุทกภัย</th>
</tr>
<tr>
  <td class="txtcen">คน</td>
  <td class="txtcen">ครัวเรือน</td>
</tr>
<?php foreach($floods as $key=>$row):?>
<tr>
  <td class="txtleft"><?php echo $key+1?></td>
  <td class="txtleft"><?php echo $row['province']?></td>
  <td class="txtright"><?php echo number_format($row['people'])?></td>
  <td class="txtright"><?php echo number_format($row['household'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>