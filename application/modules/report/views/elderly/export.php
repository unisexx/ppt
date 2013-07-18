<link rel="stylesheet" type="text/css" href="../../../themes/ppt/css/style.css"/>
<div id="resultsearch">
	ผู้สูงอายุที่อยู่ในความอุปการะของสถาบัน แสดง 
	<span style='color:#F33;'><?=($_GET['WLIST'] == NULL)?'ทุกสถาบัน':'สถาบัน '.$main_list[0];?></span>, 
	<span style='color:#F33;'><?='ปี '.$_GET['YEAR'];?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	หน่วย : ราย
</div>


<table class='tbreport'>
	<tr>
		<th style='width:400px;' class="txtcen">ชื่อหน่วยงาน</th>
		<th style='width:200px;' class="txtcen">เป้าหมาย</th>
		<th style='width:200px;' class="txtcen">ยอดยกมา</th>
		<th style='width:200px;' class="txtcen">รับเข้า</th>
		<th style='width:200px;' class="txtcen">จำหน่าย</th>
		<th style='width:200px;' class="txtcen">คงเหลือ</th>
	</tr>
	<?
	$total = array('target'=>0, 'balance'=>0, 'admission'=>0, 'distribution'=>0, 'remain'=>0, 'build'=>0);
	foreach($result as $rs)
	{
		$total['target'] += $rs['target'];
		$total['balance'] += $rs['balance'];
		$total['admission'] += $rs['admission'];
		$total['distribution'] += $rs['distribution'];
		$total['remain'] += $rs['remain'];
		$total['build'] += $rs['build'];
		?>
	 	<tr>
			<td><?=$rs['title'];?></td>
	 		<td class="txtright"><?=number_format($rs['target'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['balance'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['admission'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['distribution'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['remain'], 0);?></td>
	 	</tr>
		<?
	}
	?>
	
	<tr class="total" style='font-weight:bold;'>
		<td>รวม</td>
		<td class="txtright"> <?=number_format(@$total['target']);?> </td>
		<td class="txtright"> <?=number_format(@$total['balance']);?> </td>
		<td class="txtright"> <?=number_format(@$total['admission']);?> </td>
		<td class="txtright"> <?=number_format(@$total['distribution']);?> </td>
		<td class="txtright"> <?=number_format(@$total['remain']);?> </td>
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ