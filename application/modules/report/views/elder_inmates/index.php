<?
	if(!empty($style))
	{
		if($style == 'export')
		{
			?>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<style type='text/css'>
			table tr td, table tr th
			{
				border:solid 1px #000;
				border-left:none;
				border-bottom:none;
			}
			table
			{
				border:solid 1px #000;
				border-right:none; border-top:none;
				width:100%;
			}
			</style>
			<?
		}
	}
?>

<style type='text/css'>
	@media print
	{
		.print_hide { display:none; }
	}
	
	@media screen
	{
		.screen_hide { display:none; }
	}
</style>
<h2>รายงานผู้ต้องขังสูงอายุ</h2>

<div style='line-height:40px; text-align:right;' class='print_hide'>
	<a href='report/elder_inmates/export_index' target='_blank'>
		<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
	</a>
		<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>
	หน่วย : ราย
</div>
<table class='tbreport' cellpadding="0" cellspacing="0">
	<tr>
		<th style='width:300px;' class="txtcen">ปี</th>
		<th style='width:200px;' class="txtcen">ชาย</th>
		<th style='width:200px;' class="txtcen">หญิง</th>
		<th style='width:200px;' class="txtcen">รวม</th>
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
		<td>
			<a href="report/elder_inmates/report2?year=<?=$i;?>" class='print_hide' target="_blank"> <?=$set_year[$i];?> </a>
			<span class='screen_hide'><?=$set_year[$i];?></span>
		</td>
		<td class="txtright"><?=number_format($get_result[0]['m']);?></td>
		<td class="txtright"><?=number_format($get_result[0]['f']);?></td>
		<td class="txtright"><?=number_format($get_result[0]['sum']);?></td>
	</tr>
	<?	}	?>
	
	<tr class="total" style='display:none;'>
		<td>รวม</td>
		<td> <?=number_format(@$total['m']);?> </td>
		<td> <?=number_format(@$total['f']);?> </td>
		<td> <?=number_format(@$total['sum']);?> </td>
	</tr>
</table>

<div style='margin-top:20px;'>ที่มา : กรมราชทัณฑ์ กระทรวงยุติธรรม</div>