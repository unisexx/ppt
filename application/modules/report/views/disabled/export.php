<style type='text/css'>
@media print
{
	.hide_print
	{ display:none; }
	
	.head_sideup
	{
		margin-top:-100px;
	}
}
@media screen
{
	.hide_screen
	{ display:none; }
}

table.tbreport
{
	border-bottom:solid 1px #000;
}
table.tbreport td, table.tbreport th
{
	padding:5px;
	line-height:20px;
}
</style>

<h2 class='head_sideup'>รายงานคนพิการอยู่ในความอุปการะของสถาบัน</h2>
<div id="resultsearch" class='print' style='margin:10px;'>
	<strong>ผลที่ค้นหา : </strong>คนพิการที่อยู่ในความอุปการะของ 
	<span style='color:#F33;'><?='ปี '.$_GET['YEAR'];?></span>
</div>


<table class='tbreport' cellpadding="0" cellspacing="0" border='1'>
	<tr>
		<th class="txtcen">ชื่อหน่วยงาน</th>
		<th class="txtcen" style="width:150px;">เป้าหมาย</th>
		<th class="txtcen" style="width:150px;">ยอดยกมา</th>
		<th class="txtcen" style="width:150px;">รับเข้า</th>
		<th class="txtcen" style="width:150px;">จำหน่าย</th>
		<th class="txtcen" style="width:150px;">คงเหลือ</th>
		<th style='display:none;'>สะสม</th>
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
				<!--<a href='report/disability/disabled/index2?WLIST=<?=$rs['id'];?>&YEAR=<?=$_GET['YEAR'];?>' class='hide_print'></a>-->
				<?=$rs['title'];?>
				<span class='hide_screen'><?=$rs['title'];?></span>
			</td>
	 		<td class="txtright"><?=number_format($rs['target'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['balance'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['admission'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['distribution'], 0);?></td>
	 		<td class="txtright"><?=number_format($rs['remain'], 0);?></td>
	 		<td style='display:none;'><?=number_format($rs['build'], 0);?></td>
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
		<td style='display:none;'> <?=number_format(@$total['build']);?> </td>
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ
