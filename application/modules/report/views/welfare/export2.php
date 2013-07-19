<link rel="stylesheet" type="text/css" href="../../../themes/ppt/css/style.css"/>

<div id="resultsearch">
	เด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน แสดง 
	<span style='color:#F33;'><?=($_GET['WLIST'] == NULL)?'ทุกสถาบัน':'สถาบัน '.$main_list[0];?></span>, 
	<span style='color:#F33;'><?='ปี '.$_GET['YEAR'];?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	หน่วย : ราย
</div>


<table class="tbreport">
	<tr>
		<th class="txtcen">ชื่อหน่วยงาน</th>
		<th class="txtcen">เป้าหมาย</th>
		<th class="txtcen">ยอดยกมา</th>
		<th class="txtcen">รับเข้า</th>
		<th class="txtcen">จำหน่าย</th>
		<th class="txtcen">คงเหลือ</th>
<!--		<th style='width:200px; display:none;'>สะสม</th> <!---->
	</tr>
	<? 	$total = array('target'=>0, 'balance'=>0, 'admission'=>0, 'distribution'=>0, 'remain'=>0, 'build'=>0);
		foreach($rs as $rs) { 
			$total['target'] += $rs['target'];
			$total['balance'] += $rs['balance'];
			$total['admission'] += $rs['admission'];
			$total['distribution'] += $rs['distribution'];
			$total['remain'] += $rs['remain'];
			$total['build'] += $rs['build'];
	?>
		<tr>
			<td><?=$rs['title'];?></td>
			<td class="txtright"><?=$rs['target'];?></td>
			<td class="txtright"><?=$rs['balance'];?></td>
			<td class="txtright"><?=$rs['admission'];?></td>
			<td class="txtright"><?=$rs['distribution'];?></td>
			<td class="txtright"><?=$rs['remain'];?></td>
<!--			<td style='display:none;'><?=$rs['build'];?></td><!---->
		</tr>
	<? } ?>
	<tr class="total">
		<td>รวม</td>
		<td class="txtright"> <?=number_format(@$total['target']);?> </td>
		<td class="txtright"> <?=number_format(@$total['balance']);?> </td>
		<td class="txtright"> <?=number_format(@$total['admission']);?> </td>
		<td class="txtright"> <?=number_format(@$total['distribution']);?> </td>
		<td class="txtright"> <?=number_format(@$total['remain']);?> </td>
<!--		<td style='display:none;'> <?=number_format(@$total['build']);?> </td> <!---->
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ