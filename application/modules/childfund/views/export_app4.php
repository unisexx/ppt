<?php $organ_type = array('1'=>'หน่วยงานของรัฐ','2'=>'องค์กรสาธารณประโยชน์','3'=>'องค์กรสวัสดิการชุมชน');?>
<?php $child_type = array('1'=>'เด็กในโรงเรียน','2'=>'เด็กในชุมชน','3'=>'เด็กในชุมชน','4'=>'5 สถาน');?>
<?php $project_type = array('1'=>'สงเคราะห์','2'=>'คุ้มครองสวัสดิภาพ','3'=>'ส่งเสริมความประพฤติ','4'=>'5 สถาน','5'=>'งานวิจัย','6'=>'อื่นๆ');?>

<table border="1" cellspacing="0">
	<tr>
		<!-- <th>ไอดี (project_id)</th> -->
		<th>ปีงบประมาณ (budget_year)</th>
		<th>จังหวัด (province_name)</th>
		<th>ชื่อโครงการ (project_name)</th>
		<th>ประเภทเด็ก (typechild)</th>
		<th>ประเภทโครงการ (typepmain)</th>
		<th>ประเภทองค์กร (under_type)</th>
		<th>ค่าใช้จ่ายที่ได้รับ (cost_get)</th>
		<th>องค์การ (organ_id)</th>
	</tr>
	<?php foreach($app4 as $row):?>
	<tr>
		<!-- <td><?php echo $row['project_id']?></td> -->
		<td><?php echo $row['budget_year']?></td>
		<td><?php echo $row['province_name']?></td>
		<td><?php echo $row['project_name']?></td>
		<!-- <td><?php echo $child_type[$row['typechild']]?></td>
		<td><?php echo $project_type[$row['typepmain']]?></td>
		<td><?php echo $organ_type[$row['under_type']]?></td> -->
		<td><?php echo $row['typechild']?></td>
		<td><?php echo $row['typepmain']?></td>
		<td><?php echo $row['under_type']?></td>
		<td><?php echo $row['cost_get']?></td>
		<td><?php echo $row['organ_id']?></td>
	</tr>
	<?php endforeach;?>
</table>