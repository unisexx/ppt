<h2>รายงาน ตำแหน่งคนว่างงาน</h2>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>รายงานจำนวนและอัตราผู้ป่วยสุขภาพจิต(ต่อ 100,000 คน) แสดง จังหวัด  
	<span style='color:#F33;'>
		<?=(@$province_)?'สถานีจังหวัด '.$province_[0]['province']:'ทุกจังหวัด';	
		
		?>
	</span>
</div>
<div style='line-height:40px; text-align:right;'>
	หน่วย : ราย
</div>

<table class='tbreport' border='1'>
	<tr>
		<? for($i=0; $i<count($tbl_head); $i++) { ?>
			<th><?=$tbl_head[$i];?></td>
		<? } ?>
	</tr>
	
	<?
	for($i=0; $i<count($year_list); $i++)
	{
		$vacancy_sql = "SELECT 
			SUM(VACANCIES) VACANCIES,
			SUM(CANDIDATES) CANDIDATES,
			SUM(ACTIVE) ACTIVE
		FROM VACANCY WHERE YEAR LIKE '".$year_list[$i]."' ";
		$vacancy_sql .= (@$_GET['province'])?"AND PROVINCE_ID LIKE '".$_GET['province']."'":'';
		
		$vacancy_res = $this->vacancy->get($vacancy_sql);
		$vacancy_res[0]['vacancies'] = (@$vacancy_res[0]['vacancies'])?$vacancy_res[0]['vacancies']:'-';
		$vacancy_res[0]['candidates'] = (@$vacancy_res[0]['candidates'])?$vacancy_res[0]['candidates']:'-';
		$vacancy_res[0]['active'] = (@$vacancy_res[0]['active'])?$vacancy_res[0]['active']:'-';
	?>
	<tr>
		<td class='topic'><?=$year_list[$i];?></td>
		<TD><?=($vacancy_res[0]['vacancies']=='-')?$vacancy_res[0]['vacancies']:@number_format($vacancy_res[0]['vacancies']);; ?></TD>
		<TD><?=($vacancy_res[0]['candidates']=='-')?$vacancy_res[0]['candidates']:@number_format($vacancy_res[0]['candidates']);; ?></TD>
		<TD><?=($vacancy_res[0]['active']=='-')?$vacancy_res[0]['active']:@number_format($vacancy_res[0]['active']);; ?></TD>
	</tr>
	<?	
	}
	?>
</table>

<div style='line-height:30px; margin-top:20px;'>
	<div><strong>ที่มา : </strong> </div>
	<div><strong>หมายเหตุ : </strong> </div>
</div>