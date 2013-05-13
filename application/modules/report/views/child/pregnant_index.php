<h3>รายงาน สถานการณ์การมีบุตรของวัยรุ่นไทย</h3>
<a href="report/child/pregnant_parent" target="_blank"><div style="padding:10px; background:#EAEAEA; border:1px solid #ccc; font-weight:700; width:180px; float:right">จำแนกตามอายุบิดา/มารดา</div></a>
<div id="search">
  <div id="searchBox">
  	<form action="report/child/pregnant">
     <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '- ทุกจังหวัด -'); ?>
    <select name="select" id="select">
      <option>-- ทุกอำเภอ --</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
    <select name="select3" id="select3">
      <option>-- ทุกตำบล --</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </form>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> สถานการณ์การมีบุตรของวัยรุ่นไทย จังหวัด <label>ทุกจังหวัด</label> อำเภอ <label>ทุกอำเภอ</label> ตำบล <label>ทุกตำบล</label></div>
<div style="padding:10px; text-align:right;">
<img src="images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
<img src="images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">หน่วย:คน</div>
<table class="tbreport">
<tr>
<th rowspan="2">ปี</th>
<th colspan="3">อายุต่ำกว่า 15 ปีบริบูรณ์</th>
<th colspan="3">อายุ 15 ปี - ต่ำกว่า 20 ปีบริบูรณ์</th>
<th colspan="3">อายุต่ำกว่า 20 ปีบริบูรณ์</th>
</tr>
<tr>
  <td>เด็กหญิงทั้งหมด</td>
  <td>เด็กหญิงที่มีบุตร</td>
  <td>ร้อยละ</td>
  <td>หญิงทั้งหมด</td>
  <td>หญิงที่มีบุตร</td>
  <td>ร้อยละ</td>
  <td>หญิงทั้งหมด</td>
  <td>หญิงที่มีบุตร</td>
  <td>ร้อยละ</td>
</tr>
<?php //var_dump($val);
foreach($val as $key=>$item): 
?>
<tr>
<td class="topic"><?php echo  $key;?></td>
<td></td>
<td><?php echo number_format($item['lower15']) ?></td>
<td></td>
<td></td>
<td><?php echo number_format($item['equal']) ?></td>
<td></td>
<td></td>
<td><?php echo number_format($item['more']) ?></td>
<td></td>
</tr>
<?php endforeach; ?>
</table>

<div id="ref">ที่มา :</div>


