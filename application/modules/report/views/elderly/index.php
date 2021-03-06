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
</style>


<h2 class='head_sideup'>รายงานผู้สูงอายุที่อยู่ในความอุปการะของสถาบัน</h2>
<form action='' method='get' class='hide_print'>
	<div id="search">
	  <div id="searchBox">
		<?=form_dropdown('YEAR', $year_list, @$_GET['YEAR'], null); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>ผู้สูงอายุที่อยู่ในความอุปการะของ
	<span style='color:#F33;'><?='ปี '.$_GET['YEAR'];?></span>
</div>

<?php if(is_login()): // ถ้าไม่ได้ login จะไม่เห็น?>
<div id="btnBox" style="margin:10px 0;">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="window.open('elder/hf_elderly/import','_blank')" class="btn_import"/>
</div>
<?php endif; ?>

<div style='line-height:40px; text-align:right;' class='hide_print'>
	<a href='report/elderly/export?YEAR=<?=@$_GET['YEAR'];?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px; cursor:pointer;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>
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
	 		<td style='text-align:right;'><?=number_format($rs['target'], 0);?></td>
	 		<td style='text-align:right;'><?=number_format($rs['balance'], 0);?></td>
	 		<td style='text-align:right;'><?=number_format($rs['admission'], 0);?></td>
	 		<td style='text-align:right;'><?=number_format($rs['distribution'], 0);?></td>
	 		<td style='text-align:right;'><?=number_format($rs['remain'], 0);?></td>
	 		<td style='display:none;'><?=number_format($rs['build'], 0);?></td>
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
		<td style='display:none;'> <?=number_format(@$total['build']);?> </td>
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ