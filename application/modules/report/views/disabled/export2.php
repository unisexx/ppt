<h2>รายงานเด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน</h2>


<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>เด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน แสดง 
	<span style='color:#F33;'><?=($_GET['WLIST'] == NULL)?'ทุกสถาบัน':'สถาบัน '.$main_list[0];?></span>, 
	<span style='color:#F33;'><?='ปี '.$_GET['YEAR'];?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	หน่วย : ราย
</div>


<table class='tbreport' border='1'>
	<tr>
		<th style='width:400px;'>ชื่อหน่วยงาน</th>
		<th style='width:200px;'>เป้าหมาย</th>
		<th style='width:200px;'>ยอดยกมา</th>
		<th style='width:200px;'>รับเข้า</th>
		<th style='width:200px;'>จำหน่าย</th>
		<th style='width:200px;'>คงเหลือ</th>
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
			<td><?=$rs['target'];?></td>
			<td><?=$rs['balance'];?></td>
			<td><?=$rs['admission'];?></td>
			<td><?=$rs['distribution'];?></td>
			<td><?=$rs['remain'];?></td>
<!--			<td style='display:none;'><?=$rs['build'];?></td><!---->
		</tr>
	<? } ?>
	<tr class="total">
		<td>รวม</td>
		<td> <?=number_format(@$total['target']);?> </td>
		<td> <?=number_format(@$total['balance']);?> </td>
		<td> <?=number_format(@$total['admission']);?> </td>
		<td> <?=number_format(@$total['distribution']);?> </td>
		<td> <?=number_format(@$total['remain']);?> </td>
<!--		<td style='display:none;'> <?=number_format(@$total['build']);?> </td> <!---->
	</tr>
</table>

<b>แหล่งที่มา : </b>กรมพัฒนาสังคมและสวัสดิการ