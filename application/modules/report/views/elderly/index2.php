<h2>รายงานเด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน</h2>
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
	<span style='color:#F33;'><?=(@$main_list[$_GET['WLIST']])?'สถาบัน '.$main_list[$_GET['WLIST']]:'ทุกสถาบัน';?></span>, 
	<span style='color:#F33;'><?=(@$ylist)?'ปี '.$ylist:'ทุกปีงบประมาณ';?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	<a href='report/elderly/export_index2?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$_GET['WLIST'];?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<a href='report/elderly/export_index2/print?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$_GET['WLIST'];?>'><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
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
	$total = array('target'=>0,'balance'=>0,'admission'=>0,'distribution'=>0,'remain'=>0, 'build'=>0);
	$condition = '';
	$condition = (@$_GET['YEAR'])?" AND YEAR LIKE '".$_GET['YEAR']."'":'';
$this->db->debug = false;
	for($i=0; $i<count($rs); $i++)
	{
		$wdata_list = $this->elderly->get_row($rs[$i]);
			$wlist_dtl=$this->elderly_list->get_row($wdata_list['wlist_id']);

				$total['target'] += @$wdata_list['target'];
				$total['balance'] += @$wdata_list['balance'];
				$total['admission'] += @$wdata_list['admission'];
				$total['distribution'] += @$wdata_list['distribution'];
				$total['remain'] += @$wdata_list['remain'];
				$total['build'] += @$wdata_list['build'];
				?>
				<tr>
					<td>
						<?=$wlist_dtl['name'];?>
						<?=(@$_GET['YEAR'])?'':' (ปี พ.ศ. '.$wdata_list['year'].')';?>
					</td>
					<td><?=number_format($wdata_list['target'], 0);?></td>
					<td><?=number_format($wdata_list['balance'], 0);?></td>
					<td><?=number_format($wdata_list['admission'], 0);?></td>
					<td><?=number_format($wdata_list['distribution'], 0);?></td>
					<td><?=number_format($wdata_list['remain'], 0);?></td>
					<td><?=number_format($wdata_list['build'], 0);?></td>
				</tr>
				<?
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