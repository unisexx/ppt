<h2>รายงาน ตำแหน่งงานว่าง</h2>
<form action='' method='get'>
	<div id="search">
	  <div id="searchBox">
		<?=form_dropdown('province', get_option('id', 'province', 'provinces'), @$_GET['province'], '', "-- เลือกทุกจังหวัด --");?>
	  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>รายงานจำนวนตำแหน่งงานว่าง ผู้สมัครงาน และผู้บรรจุงาน 
	<span style='color:#F33;'>
		<?=(@$province_)?'จังหวัด '.$province_[0]['province']:'ทุกจังหวัด';	?>
	</span>
</div>

<?php if(is_login()): // ถ้าไม่ได้ login จะไม่เห็น?>
<div id="btnBox" style="margin:10px 0;">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="window.open('disadvantaged/vacancy_import','_blank')" class="btn_import"/>
</div>
<?php endif; ?>


<div style='line-height:40px; text-align:right;'>
	<a href='import_file/vacancy/define.docx' target='_blank'><img src="themes/ppt/images/define.png" width="32" height="32" style="margin-bottom:-6px; margin-right: 10px;" class="vtip" title="นิยามข้อมูล"></a>
	<a href='report/vacancy/export?province=<?=@$_GET['province'];?>' target='_blank'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<a href='report/vacancy/export/print?province=<?=@$_GET['province'];?>' target='_blank'><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
</div>

<table class='tbreport'>
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
		<td class='topic txtcen'><?=$year_list[$i];?></td>
		<TD class="txtright"><?=($vacancy_res[0]['vacancies']=='-')?$vacancy_res[0]['vacancies']:@number_format($vacancy_res[0]['vacancies']);; ?></TD>
		<TD class="txtright"><?=($vacancy_res[0]['candidates']=='-')?$vacancy_res[0]['candidates']:@number_format($vacancy_res[0]['candidates']);; ?></TD>
		<TD class="txtright"><?=($vacancy_res[0]['active']=='-')?$vacancy_res[0]['active']:@number_format($vacancy_res[0]['active']);; ?></TD>
	</tr>
	<?	
	}
	?>
</table>

<div style='line-height:30px; margin-top:20px;'>
	<div>ที่มา : กรมการจัดหางาน กระทรวงแรงงาน</div>
</div>