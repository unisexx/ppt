<?
$test_data = $this->elderly->limit(500)->get();

?>
<HR>
<h2>รายงานผู้สูงอายุในสถานสงเคราะห์และศูนย์บริการทางสังคม</h2>
<form action='' method='get'>
	<div id="search">
	  <div id="searchBox">
		<?=form_dropdown('YEAR', $year_list, @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
		<?=form_dropdown('WLIST', $main_list, @$_GET['WLIST'], null, '-- แสดงทั้งหมด --'); ?>
	  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>เด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน แสดง 
	<span style='color:#F33;'><?=(@$_GET['WLIST'] || @$_GET['WLIST'] == 0)?'สถาบัน '.$main_list[0]:'ทุกสถาบัน';?></span>, 
	<span style='color:#F33;'><?=(@$ylist)?'ปี '.$ylist:'ทุกปีงบประมาณ';?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	<a href='report/elderly/export_index?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$_GET['WLIST'];?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<a href='report/elderly/export_index/print?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$_GET['WLIST'];?>' target='_blank'><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
	หน่วย : ราย
</div>


<table class='tbreport'>
	<tr>
		<th style='width:400px;'>ชื่อหน่วยงาน</th>
		<th style='width:200px;'>เป้าหมาย</th>
		<th style='width:200px;'>ยอดยกมา</th>
		<th style='width:200px;'>รับเข้า</th>
		<th style='width:200px;'>จำหน่าย</th>
		<th style='width:200px;'>คงเหลือ</th>
		<th style='width:200px;'>สะสม</th>
	</tr>
	<?
		$total = array(
			"target"=>0,
			"balance"=>0,
			"admission"=>0,
			"distribution"=>0,
			"remain"=>0,
			"build"=>0
		);
		if(@$_GET['WLIST'] == '')
		{
			unset($_GET['WLIST']);
			$chk_wlist = 0;
		} else {
			$chk_wlist = 1;
		}
		
		if($chk_wlist == 1)
		{
			$i = $_GET['WLIST'];
			 	$total['target'] += @$rs[$i]['target'];
			 	$total['balance'] += @$rs[$i]['balance'];
			 	$total['admission'] += @$rs[$i]['admission'];
			 	$total['distribution'] += @$rs[$i]['distribution'];
			 	$total['remain'] += @$rs[$i]['remain'];
			 	$total['build'] += @$rs[$i]['build'];
			 	?>
			 	<tr>
					<td><a href="report/elderly/report2?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$i;?>" target='_blank'><?=$main_list[$i];?></a></td>
			 		<td><?=number_format($rs[$i]['target'], 0);?></td>
			 		<td><?=number_format($rs[$i]['balance'], 0);?></td>
			 		<td><?=number_format($rs[$i]['admission'], 0);?></td>
			 		<td><?=number_format($rs[$i]['distribution'], 0);?></td>
			 		<td><?=number_format($rs[$i]['remain'], 0);?></td>
			 		<td><?=number_format($rs[$i]['build'], 0);?></td>
			 	</tr>
			 	<?
		} ELSE {
			 for($i=0; $i<count($main_list); $i++)
			 {
			 	$total['target'] += @$rs[$i]['target'];
			 	$total['balance'] += @$rs[$i]['balance'];
			 	$total['admission'] += @$rs[$i]['admission'];
			 	$total['distribution'] += @$rs[$i]['distribution'];
			 	$total['remain'] += @$rs[$i]['remain'];
			 	$total['build'] += @$rs[$i]['build'];
			 	?>
			 	<tr>
					<td><a href="report/elderly/report2?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$i;?>" target='_blank'><?=$main_list[$i];?></a></td>
			 		<td><?=number_format(@$rs[$i]['target'], 0);?></td>
			 		<td><?=number_format(@$rs[$i]['balance'], 0);?></td>
			 		<td><?=number_format(@$rs[$i]['admission'], 0);?></td>
			 		<td><?=number_format(@$rs[$i]['distribution'], 0);?></td>
			 		<td><?=number_format(@$rs[$i]['remain'], 0);?></td>
			 		<td><?=number_format(@$rs[$i]['build'], 0);?></td>
			 	</tr>
			 	<?
			 } 
		}
	?>
	
	<tr class="total">
		<td>รวม</td>
		<td> <?=number_format(@$total['target']);?> </td>
		<td> <?=number_format(@$total['balance']);?> </td>
		<td> <?=number_format(@$total['admission']);?> </td>
		<td> <?=number_format(@$total['distribution']);?> </td>
		<td> <?=number_format(@$total['remain']);?> </td>
		<td> <?=number_format(@$total['build']);?> </td>
	</tr>
</table>