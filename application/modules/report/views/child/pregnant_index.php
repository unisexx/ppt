
<h3>รายงาน สถานการณ์การมีบุตรของวัยรุ่นไทย</h3>
<a href="report/child/pregnant_parent" target="_blank"><div style="padding:10px; background:#EAEAEA; border:1px solid #ccc; font-weight:700; width:180px; float:right">จำแนกตามอายุบิดา/มารดา</div></a>
<div id="search">
  <div id="searchBox">
  	<form action="report/child/pregnant">
     <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '- ทุกจังหวัด -'); ?>
 	 <?php echo form_dropdown('amphur_id', (empty($rs['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '- เลือกอำเภอ -'); ?>
      <select name="select3">
      <option>-- ทุกตำบล --</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </form>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b>
	 สถานการณ์การมีบุตรของวัยรุ่นไทย จังหวัด <label><?php echo (!empty($_GET['province_id'])) ? $province : "ทุกจังหวัด" ?></label>
	  อำเภอ <label><?php echo (!empty($_GET['amphur_id'])) ? $province : "ทุกอำเภอ" ?></label> 
	  ตำบล <label><?php echo (!empty($_GET['district_id'])) ? $province : "ทุกตำบล" ?></label>
</div>
<div style="padding:10px; text-align:right;">
<a href="report/child/pregnant/export" >
<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="report/child/pregnant/print" >
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
หน่วย:คน</div>
<table class="tbreport">
<tr>
<th rowspan="2">ปี</th>
<th colspan="3">อายุต่ำกว่า 15 ปีบริบูรณ์</th>
<th colspan="3">อายุ 15 ปี - ต่ำกว่า 20 ปีบริบูรณ์</th>
<th colspan="3">รวมมารดาวัยรุ่น</th>
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
<td><?php echo number_format($item['all_lower15']) ?></td>
<td><?php echo number_format($item['lower15']) ?></td>
<td>
<?
	$lower_avg = $item['all_lower15']==0 || $item['lower15']==0 ? 0 : ($item['lower15']/$item['all_lower15'])*100;echo number_format($lower_avg,2);
?>
</td>
<td><?php echo number_format($item['all_equal']) ?></td>
<td><?php echo number_format($item['equal']) ?></td>
<td>
<?
	$lower_avg = $item['all_equal']==0 || $item['equal']==0 ? 0 : ($item['equal']/$item['all_equal'])*100;echo number_format($lower_avg,2);
?>	
</td>
<td><?php echo number_format($item['all_lower15']+$item['all_equal']) ?></td>
<td><?php echo number_format($item['equal']+$item['lower15']) ?></td>
<td>
<?
	$lower_avg = ($item['all_lower15']+$item['all_equal'])==0 || ($item['equal']+$item['lower15'])==0 ? 0 : (($item['equal']+$item['lower15'])/($item['all_lower15']+$item['all_equal']))*100;echo number_format($lower_avg,2);
?>	
</td>
</tr>
<?php endforeach; ?>
</table>

<div id="ref">ที่มา :</div>
<div id="remark">หมายเหตุ :</div>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
       $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>

