<h3>รายงาน สถานการณ์การมีบุตรของวัยรุ่นไทย</h3>
<table class="tbreport" border="1">
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