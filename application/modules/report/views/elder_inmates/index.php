<h2>รายงานผู้ต้องขังสูงอายุ</h2>


<table class='tbreport'>
	<tr>
		<th style='width:400px;'>ปี</th>
		<th style='width:200px;'>ชาย</th>
		<th style='width:200px;'>หญิง</th>
		<th style='width:200px;'>รวม</th>
	</tr>

	<?
	$total['m'] = $total['f'] = $total['sum'] = 0;
	for($i=0; $i<count($set_year); $i++) {
		
		$get_result = $this->inmates->get("SELECT 
			SUM(VALUE1_M) VALUE1_M, 
			SUM(VALUE1_F) VALUE1_F, 
			SUM(VALUE2_M) VALUE2_M, 
			SUM(VALUE2_F) VALUE2_F, 
			SUM(VALUE3_M) VALUE3_M, 
			SUM(VALUE3_F) VALUE3_F
		FROM ELDER_INMATES WHERE YEAR LIKE '".$set_year[$i]."'");
		
		$get_result[0]['m'] = $get_result[0]['value1_m']+$get_result[0]['value2_m']+$get_result[0]['value3_m'];
		$get_result[0]['f'] = $get_result[0]['value1_f']+$get_result[0]['value2_f']+$get_result[0]['value3_f'];
		$get_result[0]['sum'] = $get_result[0]['m']+$get_result[0]['f'];
		
		$total['m'] += $get_result[0]['m'];
		$total['f'] += $get_result[0]['f'];
		$total['sum'] += $get_result[0]['sum'];
	?>
	<tr>
		<td><a href="report/elder_inmates/report2?year=<?=$i;?>" target="_blank"> <?=$set_year[$i];?> </a></td>
		<td><?=number_format($get_result[0]['m']);?></td>
		<td><?=number_format($get_result[0]['f']);?></td>
		<td><?=number_format($get_result[0]['sum']);?></td>
	</tr>
	<?	}	?>
	
	<tr class="total">
		<td>รวม</td>
		<td> <?=number_format(@$total['m']);?> </td>
		<td> <?=number_format(@$total['f']);?> </td>
		<td> <?=number_format(@$total['sum']);?> </td>
	</tr>
</table>