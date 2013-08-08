<link rel="stylesheet" type="text/css" href="http://dbmso.m-society.go.th/themes/ppt/css/style.css"/>
<div id="resultsearch" style="text-align: center;">
	รายงานจำนวนตำแหน่งงานว่าง ผู้สมัครงาน และผู้บรรจุงาน 
	<span style='color:#F33;'>
		<?=(@$province_)?'จังหวัด '.$province_[0]['province']:'ทุกจังหวัด';	
		
		?>
	</span>
</div>

<table class="tbreport">
	<tr>
		<? for($i=0; $i<count($tbl_head); $i++) { ?>
			<th class="txtcen"><?=$tbl_head[$i];?></td>
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
		<td class="topic txtcen"><?=$year_list[$i];?></td>
		<TD class="txtright"><?=($vacancy_res[0]['vacancies']=='-')?$vacancy_res[0]['vacancies']:@number_format($vacancy_res[0]['vacancies']);; ?></TD>
		<TD class="txtright"><?=($vacancy_res[0]['candidates']=='-')?$vacancy_res[0]['candidates']:@number_format($vacancy_res[0]['candidates']);; ?></TD>
		<TD class="txtright"><?=($vacancy_res[0]['active']=='-')?$vacancy_res[0]['active']:@number_format($vacancy_res[0]['active']);; ?></TD>
	</tr>
	<?	
	}
	?>
</table>

<div style="line-height:30px; margin-top:20px;">
	<div>ที่มา : กรมการจัดหางาน กระทรวงแรงงาน</div>
	<div>ประมวลผลโดย : ระบบฐานข้อมูลทางสังคม</div>
</div>