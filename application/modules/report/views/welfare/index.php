<h2>รายงานเด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน</h2>
<form action='' method='get'>
	<div id="search">
	  <div id="searchBox">
		<?=form_dropdown('YEAR', get_year_option(2552), @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
		<?=form_dropdown('WLIST', get_option('id', 'name', 'welfare_list'), @$_GET['WLIST'], null, '-- แสดงทั้งหมด --'); ?>
	  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>

<div style='border:dashed 1px #AAA; line-height:20px; padding:10px; background:#FFC;'>
	<strong>ผลที่ค้นหา : </strong>เด็กและเยาวชนที่อยู่ในความอุปการะของสถาบัน แสดง 
	<span style='color:#F33;'><?=(@$_GET['WLIST'])?'สถาบัน '.$list[0]['name']:'ทุกสถาบัน';?></span>, 
	<span style='color:#F33;'><?=(@$_GET['YEAR'])?'ปี '.$_GET['YEAR']:'ทุกปีงบประมาณ';?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	<input type='button' value='ส่งออกข้อมูล'>
	<input type='button' value='พิมพ์ข้อมูล'>
	หน่วย : ราย
</div>


<table border='1' class='tbreport'>
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
		$total['target'] = $total['balance'] = $total['admission'] = $total['distribution'] = $total['remain'] = $total['build'] = 0;
		for($i=0; $i<count($list); $i++) {
		$welfare_sql = "SELECT * FROM WELFARE_DATA WHERE WLIST_ID LIKE '".$list[$i]['id']."'";
			$welfare_sql .= (@$_GET['YEAR'])?" AND YEAR LIKE '".$_GET['YEAR']."'":"";
		$welfare_dtl = $this->welfare->limit(100)->get($welfare_sql);
		
		$welfare_dtl_['target'] = $welfare_dtl_['balance'] = $welfare_dtl_['admission'] = $welfare_dtl_['distribution'] = $welfare_dtl_['remain'] = $welfare_dtl_['build'] = 0;
		
		for($j=0; $j<count($welfare_dtl); $j++)
		{
			$welfare_dtl_['target'] += $welfare_dtl[$j]['target'];
			$welfare_dtl_['balance'] += $welfare_dtl[$j]['balance'];
			$welfare_dtl_['admission'] += $welfare_dtl[$j]['admission'];
			$welfare_dtl_['distribution'] += $welfare_dtl[$j]['distribution'];
			$welfare_dtl_['remain'] += $welfare_dtl[$j]['remain'];
			$welfare_dtl_['build'] += $welfare_dtl[$j]['build'];
		}
		$total['target'] += @$welfare_dtl_['target']; 
		$total['balance'] += @$welfare_dtl_['balance']; 
		$total['admission'] += @$welfare_dtl_['admission']; 
		$total['distribution'] += @$welfare_dtl_['distribution']; 
		$total['remain'] += @$welfare_dtl_['remain']; 
		$total['build'] += @$welfare_dtl_['build']; 
	?>
	<tr>
		<td><?=$list[$i]['name'];?></td>
		<td> <?=$welfare_dtl_['target'];?> </td>
		<td> <?=$welfare_dtl_['balance'];?> </td>
		<td> <?=$welfare_dtl_['admission'];?> </td>
		<td> <?=$welfare_dtl_['distribution'];?> </td>
		<td> <?=$welfare_dtl_['remain'];?> </td>
		<td> <?=$welfare_dtl_['build'];?> </td>
	</tr>
	<? } ?>
	
	<tr>
		<th>รวม</th>
		<td> <?=number_format($total['target']);?> </td>
		<td> <?=number_format($total['balance']);?> </td>
		<td> <?=number_format($total['admission']);?> </td>
		<td> <?=number_format($total['distribution']);?> </td>
		<td> <?=number_format($total['remain']);?> </td>
		<td> <?=number_format($total['build']);?> </td>
	</tr>
</table>