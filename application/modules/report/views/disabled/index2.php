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
	<span style='color:#F33;'><?=($_GET['WLIST'] == NULL)?'ทุกสถาบัน':'สถาบัน '.$main_list[$_GET['WLIST']];?></span>, 
	<span style='color:#F33;'><?=(empty($_GET['YEAR']))?'แสดงทุกปี':'ปี '.$_GET['YEAR'];?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	<a href='report/welfare/export_index2?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$_GET['WLIST'];?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<a href='report/welfare/export_index2/print?YEAR=<?=@$_GET['YEAR'];?>&WLIST=<?=@$_GET['WLIST'];?>'><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>
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
		<th style='width:200px; display:none;'>สะสม</th>
	</tr>
	<? 	$total = array('target'=>0, 'balance'=>0, 'admission'=>0, 'distribution'=>0, 'remain'=>0, 'build'=>0);
		foreach($rs as $rs) { 
			$total['target'] += $rs['target'] = (empty($rs['target']))?0:$rs['target'];
			$total['balance'] += $rs['balance'] = (empty($rs['balance']))?0:$rs['balance'];
			$total['admission'] += $rs['admission'] = (empty($rs['admission']))?0:$rs['admission'];
			$total['distribution'] += $rs['distribution'] = (empty($rs['distribution']))?0:$rs['distribution'];
			$total['remain'] += $rs['remain'] = (empty($rs['remain']))?0:$rs['remain'];
			$total['build'] += $rs['build'] = (empty($rs['build']))?0:$rs['build'];
	?>
		<tr>
			<td>
				<?=$rs['title'];?>
				<?=(empty($_GET['YEAR']))?' ( ปี พ.ศ.'.$rs['year'].' )':'';?>
			</td>
			<td><?=$rs['target'];?></td>
			<td><?=$rs['balance'];?></td>
			<td><?=$rs['admission'];?></td>
			<td><?=$rs['distribution'];?></td>
			<td><?=$rs['remain'];?></td>
			<td style='display:none;'><?=$rs['build'];?></td>
		</tr>
	<? } ?>
	<tr class="total">
		<td>รวม</td>
		<td> <?=number_format(@$total['target']);?> </td>
		<td> <?=number_format(@$total['balance']);?> </td>
		<td> <?=number_format(@$total['admission']);?> </td>
		<td> <?=number_format(@$total['distribution']);?> </td>
		<td> <?=number_format(@$total['remain']);?> </td>
		<td style='display:none;'> <?=number_format(@$total['build']);?> </td>
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ