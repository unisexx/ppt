<h2>รายงาน จำนวนและอัตราผู้ป่วยสุขภาพจิต (ต่อประชากร 100,000 คน)</h2>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>รายงานจำนวนและอัตราผู้ป่วยสุขภาพจิต(ต่อ 100,000 คน) แสดง จังหวัด  
	<span style='color:#F33;'>
		<?=(@$province_)?'สถานีจังหวัด '.@$province_[0]['province']:'ทุกจังหวัด';	?>
	</span>
</div>
<div style='line-height:40px; text-align:right;'>
	หน่วย : ราย
</div>

<table class='tbreport' border='1'>
	<tr>
		<td style='border:none;'></td>
		<? for($i=0; $i<count($tbl_head); $i++) { ?><th style='font-weight:bold;' colspan='2'><?=$tbl_head[$i];?></th><? } ?>
	</tr>
	<tr>
		<th style='width:200px;'>ปี</th>
		<? for($i=0; $i<count($tbl_head); $i++) { ?>
			<td style='font-weight:bold;'>จำนวน</td>
			<td style='font-weight:bold;'>อัตรา</td>
		<? } ?>
	</tr>
	
	<?
	for($i=0; $i<count($year_list); $i++)
	{

		$mental_sql = "SELECT 	SUM(PSY_NUMBER) PSY_NUMBER, 
			SUM(PSY_RATE) PSY_RATE,
			SUM(FEAR_NUMBER) FEAR_NUMBER,
			SUM(FEAR_RATE) FEAR_RATE,
			SUM(DEPRESS_NUMBER) DEPRESS_NUMBER,
			SUM(DEPRESS_RATE) DEPRESS_RATE,
			SUM(RETARDED_NUMBER) RETARDED_NUMBER,
			SUM(RETARDED_RATE) RETARDED_RATE,
			SUM(APOPLEXY_NUMBER) APOPLEXY_NUMBER,
			SUM(APOPLEXY_RATE) APOPLEXY_RATE,
			SUM(DRUGADD_NUMBER) DRUGADD_NUMBER,
			SUM(DRUGADD_RATE) DRUGADD_RATE,
			SUM(OTHER_NUMBER) OTHER_NUMBER,
			SUM(OTHER_RATE) OTHER_RATE,
			SUM(SUICIDE_SUCC_NUMBER) SUICIDE_SUCC_NUMBER,
			SUM(SUICIDE_SUCC_RATE) SUICIDE_SUCC_RATE,
			SUM(SUICIDE_UNSUC_NUMBER) SUICIDE_UNSUC_NUMBER,
			SUM(SUICIDE_UNSUC_RATE) SUICIDE_UNSUC_RATE 
		FROM MENTAL_NUMBER WHERE YEAR LIKE '".$year_list[$i]."' ";
		$mental_sql .= (@$_GET['province'])?"AND PROVINCE_ID LIKE '".$_GET['province']."'":'';
		$mental_res = $this->mental->get($mental_sql);
		
		$res_ary = array('psy', 'fear', 'depress', 'retarded', 'apoplexy', 'drugadd', 'other', 'suicide', 'autism');
	?>
	<tr>
		<td><?=$year_list[$i];?></td>
		<? 
			$total['number'] = $total['rate'] = 0;
			for($j=0; $j<count($res_ary); $j++) 
			{
				if($res_ary[$j] == 'suicide')
				{
					
				?>
					<td><?=@number_format(@$mental_res[0][$res_ary[$j].'_succ_number']+@$mental_res[0][$res_ary[$j].'_unsuc_number']); ?></td>
					<td><?=@number_format(@$mental_res[0][$res_ary[$j].'_succ_rate']+@$mental_res[0][$res_ary[$j].'_unsuc_rate']); ?></td>
				<?	
					$total['number'] += @$mental_res[0][$res_ary[$j].'_succ_number']+@$mental_res[0][$res_ary[$j].'_unsuc_number'];
					$total['rate'] += @$mental_res[0][$res_ary[$j].'_succ_rate']+@$mental_res[0][$res_ary[$j].'_unsuc_rate'];
				}
				else
				{
				?> 
					<td><?=@number_format(@$mental_res[0][$res_ary[$j].'_number']); ?></td>
					<td><?=@number_format(@$mental_res[0][$res_ary[$j].'_rate']); ?></td>
				<?
					$total['number'] += @$mental_res[0][$res_ary[$j].'_number'];
					$total['rate'] += @$mental_res[0][$res_ary[$j].'_rate'];
				}
				
			}
		?>
		<td><?=number_format($total['number']);?></td>
		<td><?=number_format($total['rate']);?></td>
	</tr>
	<?	
	}
	?>
</table>

<div style='line-height:30px; margin-top:20px;'>
	<div><strong>ที่มา : </strong> </div>
	<div><strong>หมายเหตุ : </strong>  </div>
</div>