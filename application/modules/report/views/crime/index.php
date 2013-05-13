<h2>รายงาน การกระทำความผิดที่ละเมิดกฏหมายทางอาญา</h2>
<form action='' method='get'>
	<div id="search">
	  <div id="searchBox">
		<?=form_dropdown('province', $set_province, @$_GET['province'], null, '-- แสดงทุกจังหวัด --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>

<div id="resultsearch">
	<strong>ผลที่ค้นหา : </strong>รายงานการกระทำความผิดที่ละเมิดกฏหมายทางอาญา  
	<span style='color:#F33;'>
		<?=(@$set_province[$_GET['province']])?'สถานีจังหวัด '.$set_province[$_GET['province']]:'ทุกสถานี';?>
	</span>
</div>
<div style='line-height:40px; text-align:right;'>
	<img src="images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
	<img src="images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">
	หน่วย : ราย
</div>

<table class='tbreport'>
	<tr>
		<td style='border:none;'></td>
		<th colspan='<?=count($tbl_head);?>'>ประเภทคดี</th>
	</tr>
	<tr>
		<th style='width:200px;'>ปี</th>
		<? for($i=0; $i<count($tbl_head); $i++) { ?><td style='font-weight:bold;'><?=$tbl_head[$i];?></td><? } ?>
	</tr>
	
	<?
	$total = array(0, 0, 0, 0, 0);
	for($i=0; $i<count($set_year); $i++)
	{
		$notified_ = array(0, 0, 0, 0, 0);
		$crime_station_qry = "SELECT * FROM CRIME_STATION WHERE YEAR LIKE '".$set_year[$i]."' ";
			$crime_station_qry .= (@$_GET['province'])?"AND STATION LIKE '".$set_province[$_GET['province']]."'":'';
			
		$crime_station = $this->crime_station->get($crime_station_qry);
		for($j=0; $j<count($crime_station); $j++)
		{
			$notified_1_ = $this->crime_statistic->get("SELECT SUM(NOTIFIED) NOTIFIED FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$crime_station[$j]['id']."' AND CASE_ID LIKE '1'");
			$notified_2_ = $this->crime_statistic->get("SELECT SUM(NOTIFIED) NOTIFIED FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$crime_station[$j]['id']."' AND CASE_ID LIKE '2'");
			$notified_3_ = $this->crime_statistic->get("SELECT SUM(NOTIFIED) NOTIFIED FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$crime_station[$j]['id']."' AND CASE_ID LIKE '3'");
			$notified_4_ = $this->crime_statistic->get("SELECT SUM(NOTIFIED) NOTIFIED FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$crime_station[$j]['id']."' AND CASE_ID LIKE '4'");
			$notified_5_ = $this->crime_statistic->get("SELECT SUM(NOTIFIED) NOTIFIED FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$crime_station[$j]['id']."' AND CASE_ID LIKE '5'");
			
			$notified_[0] += $notified_1_[0]['notified'];
			$notified_[1] += $notified_2_[0]['notified'];
			$notified_[2] += $notified_3_[0]['notified'];
			$notified_[3] += $notified_4_[0]['notified'];
			$notified_[4] += $notified_5_[0]['notified'];
		}
		$total[0] += $notified_[0];
		$total[1] += $notified_[1];
		$total[2] += $notified_[2];
		$total[3] += $notified_[3];
		$total[4] += $notified_[4];
		?>
		<tr>
			<td class='topic'><?=$set_year[$i];?></td>
			<td><?=number_format($notified_[0]);?></td>
			<td><?=number_format($notified_[1]);?></td>
			<td><?=number_format($notified_[2]);?></td>
			<td><?=number_format($notified_[3]);?></td>
			<td><?=number_format($notified_[4]);?></td>
		</tr>
		<?
	}
	?>


	<?
	/*
	$total['m'] = $total['f'] = $total['sum'] = 0;
	for($i=0; $i<count($set_year); $i++) {
		
		$get_result = $this->inmates->get("SELECT 
			SUM(VALUE1_M) VALUE1_M, 
			SUM(VALUE1_F) VALUE1_F, 
			SUM(VALUE2_M) VALUE2_M, 
			SUM(VALUE2_F) VALUE2_F, 
			SUM(VALUE3_M) VALUE3_M, 
			SUM(VALUE3_F) VALUE3_F
		FROM ELDER_INMATES WHERE YEAR LIKE '".$set_year[$i]."'");
		
		$get_result[0]['m'] = $get_result[0]['value1_m']+$get_result[0]['value2_m']+$get_result[0]['value3_m'];
		$get_result[0]['f'] = $get_result[0]['value1_f']+$get_result[0]['value2_f']+$get_result[0]['value3_f'];
		$get_result[0]['sum'] = $get_result[0]['m']+$get_result[0]['f'];
		
		$total['m'] += $get_result[0]['m'];
		$total['f'] += $get_result[0]['f'];
		$total['sum'] += $get_result[0]['sum'];
	?>
	<tr>
		<td><a href="report/elder_inmates/report2?year=<?=$i;?>" target="_blank"> <?=$set_year[$i];?> </a></td>
		<td><?=number_format($get_result[0]['m']);?></td>
		<td><?=number_format($get_result[0]['f']);?></td>
		<td><?=number_format($get_result[0]['sum']);?></td>
	</tr>
	<?	}	*/ 
	?>
	
	<tr class="total">
		<td>รวม</td>
		<td> <?=number_format(@$total[0]);?> </td>
		<td> <?=number_format(@$total[1]);?> </td>
		<td> <?=number_format(@$total[2]);?> </td>
		<td> <?=number_format(@$total[3]);?> </td>
		<td> <?=number_format(@$total[4]);?> </td>
	</tr>
</table>

<div style='line-height:30px; margin-top:20px;'>
	<div><strong>ที่มา : </strong> ข้อมูลจากการสำรวจภาวะเศรษฐกิจและสังคมของครัวเรือน สำนักงานสถิติแห่งชาติ ประมวลผลโดย สำนักพัฒนาฐานข้อมูลและตัวชี้วัดภาวะสังคม สศช.</div>
	<div><strong>หมายเหตุ : </strong> คดีที่น่าสนใจ ได้แก่ โจรกรรมรถจักรยานยนต์, โจรกรรมรถยนต์, โจรกรรมโค-กระบือ, โจรกรรมเครื่องมือเกษตร, ปล้น-ชิงรถยนต์โดยสาร, ปล้น-ชิงรถยนต์แท็กซี่, ข่มขืนและฆ่า, ลักพาเรียกค่าไถ่, ฉ้อโกง, ยักยอก</div>
</div>