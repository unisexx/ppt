<h3>รายงาน องค์กรที่ได้รับการสนับสนุนเงินจากกองทุนส่งเสริมการจัดการสวัสดิการสังคม จำแนกรายจังหวัดและประเภทองค์กร ประจำปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<div id="search">
  <div id="searchBox">
    <select name="select" onchange="window.open(this.options[this.selectedIndex].value,'_self')">
      <?php foreach($years as $row):?>
      	<option value="promotefund/report2/<?php echo $row['budgetyear']?>" <?php echo ($row['budgetyear'] == $this->uri->segment(3,0))?"selected":"";?>><?php echo $row['budgetyear']?></option>
      <?php endforeach;?>
    </select>
</div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $this->uri->segment(3,0)?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href="promotefund/export2/<?php echo $this->uri->segment(3,0)?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
  <th rowspan="2" class="txtcen">ที่</th>
  <th rowspan="2" class="txtcen">จังหวัด</th>
  <th colspan="2" class="txtcen">องค์กรภาครัฐ</th>
  <th colspan="2" class="txtcen">องค์กรสวัสดิการชุมชน</th>
  <th colspan="2" class="txtcen">องค์กรสาธารณะประโยชน์</th>
</tr>
<tr>
  <td class="txtcen">จำนวน (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
  <td class="txtcen">จำนวน (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
  <td class="txtcen">จำนวน (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($promotefunds as $key=>$row):?>
<tr>
  <td><?php echo $key+1?></td>
  <td><?php echo $row['pv']?></td>
  <td><?php echo number_format($row['under_type1'])?></td>
  <td><?php echo number_format($row['sum_under_type1'])?></td>
  <td><?php echo number_format($row['under_type2'])?></td>
  <td><?php echo number_format($row['sum_under_type2'])?></td>
  <td><?php echo number_format($row['under_type3'])?></td>
  <td><?php echo number_format($row['sum_under_type3'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนส่งเสริมการจัดการสวัสดิการสังคม</div>