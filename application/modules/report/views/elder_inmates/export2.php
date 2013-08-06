<h2 class='head_sideup'>รายงานผู้ต้องขังสูงอายุ <?=(@$set_year[$_GET['year']])?'ปี '.$set_year[$_GET['year']]:'ทุกปีงบประมาณ';?></h2>

<table class='tbreport' border='1'>
	<tr>
		<th style='width:300px;' class="txtcen">จังหวัด</th>
		<th style='width:200px;' class="txtcen">ชาย</th>
		<th style='width:200px;' class="txtcen">หญิง</th>
		<th style='width:200px;' class="txtcen">รวม</th>
	</tr>
	<?
	$pv_list = $this->province->limit(100)->get("SELECT id, province FROM PROVINCES ORDER BY PROVINCE ASC");
	$total['f'] = $total['m'] = $total['sum'] = 0;
	for($i=0; $i<count($pv_list); $i++)
	{
		$inmates_list = $this->inmateslist->get("SELECT id FROM ELDER_INMATES_LIST WHERE PROVINCE_ID LIKE '".$pv_list[$i]['id']."'");
		
		$inmates_qry = "SELECT SUM(VALUE1_M) VALUE1_M, SUM(VALUE1_F) VALUE1_F, SUM(VALUE2_M) VALUE2_M, SUM(VALUE2_F) VALUE2_F, SUM(VALUE3_M) VALUE3_M, SUM(VALUE3_F) VALUE3_F FROM ELDER_INMATES WHERE 1=1 ";
		
		for($j=0; $j<count($inmates_list); $j++)
		{
			if($j==0) { $inmates_qry .= 'AND ('; }
				$inmates_qry .= "INMATESLIST_ID LIKE '".$inmates_list[$j]['id']."' ";
			if(@$inmates_list[$j+1]) { $inmates_qry .= 'OR '; }
			else { $inmates_qry .= ') '; }
		}
		$inmates_qry .= (@$set_year[$_GET['year']])?"AND YEAR LIKE '".$set_year[$_GET['year']]."'":"";
		
		$inmates_res = $this->inmates->get($inmates_qry);
		
		
		$result['m'] = $inmates_res[0]['value1_m']+$inmates_res[0]['value2_m']+$inmates_res[0]['value3_m'];
		$result['f'] = $inmates_res[0]['value1_f']+$inmates_res[0]['value2_f']+$inmates_res[0]['value3_f'];
		$result['sum'] = $result['m'] + $result['f'];
		
		$total['m'] += $result['m'];
		$total['f'] += $result['f'];
		$total['sum'] += $result['sum'];
		?>
		<tr class='topic'>
			<td><?=$pv_list[$i]['province'];?></td>
			<td class="txtright"><?=number_format($result['m']);?></td>
			<td class="txtright"><?=number_format($result['f']);?></td>
			<td class="txtright"><?=number_format($result['sum']);?></td>
		</tr>
		<?
	}
	?>
	<tr class="total">
		<td>รวม</td>
		<td class="txtright"> <?=number_format(@$total['m']);?> </td>
		<td class="txtright"> <?=number_format(@$total['f']);?> </td>
		<td class="txtright"> <?=number_format(@$total['sum']);?> </td>
	</tr>
</table>
<div>ที่มา : กรมราชทัณฑ์ กระทรวงยุติธรรม</div>