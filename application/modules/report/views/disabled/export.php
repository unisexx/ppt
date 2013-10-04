<h2 class='head_sideup'>รายงานคนพิการอยู่ในความอุปการะของสถาบัน</h2>
<div id="resultsearch" class='print'>
	<strong>ผลที่ค้นหา : </strong>คนพิการที่อยู่ในความอุปการะของ 
	<span style='color:#F33;'><?='ปี '.$_GET['YEAR'];?></span>
</div>
<span style='line-height:50px; float:right;' class='hide_screen'>หน่วย : ราย</span>



<table class='tbreport' border='1'>
	<tr>
		<th class="txtcen">ชื่อหน่วยงาน</th>
		<th class="txtcen" style="width:100px;">เป้าหมาย</th>
		<th class="txtcen" style="width:100px;">ยอดยกมา</th>
		<th class="txtcen" style="width:100px;">รับเข้า</th>
		<th class="txtcen" style="width:100px;">จำหน่าย</th>
		<th class="txtcen" style="width:100px;">คงเหลือ</th>
		<!--<th style='display:none;'>สะสม</th>-->
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
			<td>
				<? $rs['id'] = ($rs['title'] == 'อื่น ๆ')?6:$rs['id']; ?>
				<?=$rs['title'];?>
			</td>
	 		<td class="txtright"><?=number_format($rs['target'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['balance'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['admission'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['distribution'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['remain'], 0);?></td>
	 		<!--<td style='display:none;'><?=number_format($rs['build'], 0);?></td>-->
	 	</tr>
		<?
	}
	?>
	
	<tr class="total">
		<td>รวม</td>
		<td class="txtright"> <?=number_format(@$total['target']);?> </td>
		<td class="txtright"> <?=number_format(@$total['balance']);?> </td>
		<td class="txtright"> <?=number_format(@$total['admission']);?> </td>
		<td class="txtright"> <?=number_format(@$total['distribution']);?> </td>
		<td class="txtright"> <?=number_format(@$total['remain']);?> </td>
		<!--<td style='display:none;'> <?=number_format(@$total['build']);?> </td>-->
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ
