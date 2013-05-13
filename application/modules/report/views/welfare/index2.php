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
	<span style='color:#F33;'><?=(@$_GET['WLIST'])?'สถาบัน '.$list[0]['name']:'ทุกสถาบัน';?></span>, 
	<span style='color:#F33;'><?=(@$ylist)?'ปี '.$ylist:'ทุกปีงบประมาณ';?></span>
</div>

<div style='line-height:40px; text-align:right;'>
	<img src="images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
	<img src="images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">
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
	if((@$main_list[@$_GET['WLIST']]) == NULL) { $wlist = $main_list; }
	else { $wlist[] = $main_list[$_GET['WLIST']]; }
	
	$l=0;
	$total['target'] = $total['balance'] = $total['admission'] = $total['distribution'] = $total['remain'] = $total['build'] = 0;
	for($i=0; $i<count($wlist); $i++)
	{
		$res_['target'] = $res_['balance'] = $res_['admission'] = $res_['distribution'] = $res_['remain'] = $res_['build'] = 0;
		
		$res_list = $this->welfare_list->where("NAME LIKE '%".$wlist[$i]."%'")->limit(1000)->get();
		for($j=0; $j<count($res_list); $j++)
		{
			$res_qry = "SELECT * FROM WELFARE_DATA WHERE WLIST_ID LIKE '".$res_list[$j]['id']."'";
			$res_qry .= ($ylist)?"AND YEAR LIKE '".$ylist."'":'';
			$res_tmp = $this->welfare->limit(1000)->get($res_qry);
			for($k=0; $k<count($res_tmp); $k++)
			{
				$res_['target'] += $res_tmp[$k]['target'];
				$res_['balance'] += $res_tmp[$k]['balance'];
				$res_['admission'] += $res_tmp[$k]['admission'];
				$res_['distribution'] += $res_tmp[$k]['distribution'];
				$res_['remain'] += $res_tmp[$k]['remain'];
				$res_['build'] += $res_tmp[$k]['build'];
				
				$res_list_dtl = $this->welfare_list->get_row($res_tmp[$k]['wlist_id']);
				$result[$l] = array(
					'name'=>$res_list_dtl['name'],
					'year'=>$res_tmp[$k]['year'],
					'target'=>$res_tmp[$k]['target'],
					'balance'=>$res_tmp[$k]['balance'],
					'admission'=>$res_tmp[$k]['admission'],
					'distribution'=>$res_tmp[$k]['distribution'],
					'remain'=>$res_tmp[$k]['remain'],
					'build'=>$res_tmp[$k]['build']
				);
				$result_tmp[$l] = $res_list_dtl['name'];
				
				?>
				<tr style='display:none;'>
					<td><?=$res_list_dtl['name'];?> ( ปี <?=$res_tmp[$k]['year'];?> )</td>
					<td><?=number_format($res_tmp[$k]['target']);?></td>
					<td><?=number_format($res_tmp[$k]['balance']);?></td>
					<td><?=number_format($res_tmp[$k]['admission']);?></td>
					<td><?=number_format($res_tmp[$k]['distribution']);?></td>
					<td><?=number_format($res_tmp[$k]['remain']);?></td>
					<td><?=number_format($res_tmp[$k]['build']);?></td>
				</tr>
				<?
				$l++;
			}
		}

		$total['target'] += @$res_['target'];
		$total['balance'] += @$res_['balance'];
		$total['admission'] += @$res_['admission'];
		$total['distribution'] += @$res_['distribution'];
		$total['remain'] += @$res_['remain'];
		$total['build'] += @$res_['build'];
	}
	?>
	
	<?
	$ary_count = count($result_tmp);
	if($_GET['YEAR']) { $result_tmp = array_unique($result_tmp); }
	
	for($i=0; $i<$ary_count; $i++)
	{
		if(@$result_tmp[$i])
		{
		?>
		<tr>
			<td><?=$result_tmp[$i];?> <?=(!@$_GET['YEAR'])?'( ปี '.$result[$i]['year'].' )':'';?></td>
			<td><?=$result[$i]['target'];?></td>
			<td><?=$result[$i]['balance'];?></td>
			<td><?=$result[$i]['admission'];?></td>
			<td><?=$result[$i]['distribution'];?></td>
			<td><?=$result[$i]['remain'];?></td>
			<td><?=$result[$i]['build'];?></td>
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