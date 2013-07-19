<link rel="stylesheet" type="text/css" href="../../../themes/ppt/css/style.css"/>
<div id="resultsearch" style="text-align: center;">
	รายงานจำนวนและอัตราผู้ป่วยสุขภาพจิต(ต่อ 100,000 คน) 
	<span style='color:#F33;'>
		<?=(@$province_)?'จังหวัด '.@$province_[0]['province']:'ทุกจังหวัด';	?>
	</span>
</div>
<div style='line-height:40px; text-align:right;'>
	หน่วย : คน
</div>

<table class='tbreport'>
	<tr>
		<td style='border:none;'></td>
		<? for($i=0; $i<count($tbl_head); $i++) { ?><th style='font-weight:bold; text-align: center;' colspan='2'><?=$tbl_head[$i];?></th><? } ?>
	</tr>
	<tr>
		<th style='width:200px; text-align: center;'>ปี</th>
		<? for($i=0; $i<count($tbl_head); $i++) { ?>
			<td style='font-weight:bold;' class="txtcen">จำนวน</td>
			<td style='font-weight:bold;' class="txtcen">อัตรา</td>
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
			SUM(SUICIDE_UNSUC_RATE) SUICIDE_UNSUC_RATE, 
			SUM(AUTISM_NUMBER) AUTISM_NUMBER,
			SUM(AUTISM_RATE) AUTISM_RATE
		FROM MENTAL_NUMBER WHERE YEAR LIKE '".$year_list[$i]."' ";
		$mental_sql .= (@$_GET['province'])?"AND PROVINCE_ID LIKE '".$_GET['province']."'":'';
		$mental_res = $this->mental->get($mental_sql);
		
		$res_ary = array('psy', 'fear', 'depress', 'retarded', 'apoplexy', 'drugadd', 'other', 'suicide', 'autism');
	?>
	<tr>
		<td style="text-align: center;"><?=$year_list[$i];?></td>
		<? 
			$total['number'] = $total['rate'] = 0;
			for($j=0; $j<count($res_ary); $j++) 
			{
				if($res_ary[$j] == 'suicide')
				{
					
				?>
					<td class="txtright"><?=@number_format(@$mental_res[0][$res_ary[$j].'_succ_number']+@$mental_res[0][$res_ary[$j].'_unsuc_number']); ?></td>
					<td class="txtright"><?=@number_format(@$mental_res[0][$res_ary[$j].'_succ_rate']+@$mental_res[0][$res_ary[$j].'_unsuc_rate']); ?></td>
				<?	
					$total['number'] += @$mental_res[0][$res_ary[$j].'_succ_number']+@$mental_res[0][$res_ary[$j].'_unsuc_number'];
					$total['rate'] += @$mental_res[0][$res_ary[$j].'_succ_rate']+@$mental_res[0][$res_ary[$j].'_unsuc_rate'];
				}
				else
				{
				?> 
					<td class="txtright"><?=@number_format(@$mental_res[0][$res_ary[$j].'_number']); ?></td>
					<td class="txtright"><?=@number_format(@$mental_res[0][$res_ary[$j].'_rate']); ?></td>
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
	<div>ที่มา : กรมสุขภาพจิต กระทรวงสาธารณสุข</div>
	<div>หมายเหตุ : กรุงเทพหมานคร ประกอบไปด้วยผู้ป่วยสุขภาพจิตในรพ. ของหน่วยงาน ดังต่อไปนี้ 
รพ.ในสังกัดกรมสุภาพจิต, รพ.ในสังกัดกรุงเทพมหานคร, รพ.ในสังกัดกรมการแพทย์, รพ.สังกัดกระทรวงกลาโหม, รพ.สังกัดสำนักงานตำรวจแห่งชาติ  (รพ.ตำรวจ), รพ.สังกัดทบวงมหาวิทยาลัย</div>
<div>ประมวลผลโดย : ระบบฐานข้อมูลทางสังคม</div>
 
</div>