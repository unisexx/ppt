<html>
<head>
<title>รายงาน การให้บริการหลักประกันสุขภาพ</title>
<link href="<?php echo base_url(); ?>media/css/style.css" rel="stylesheet">
</head>
<body>

<div align="center"><h3>รายงาน การให้บริการหลักประกันสุขภาพ</h3></div>

<table class="tbreport">
<tr>

  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th colspan="5">รวม</th>
  <th colspan="5">ชาย</th>
  <th colspan="5">หญิง</th>
   <th colspan="5">ไม่ระบุ</th>
  <th>&nbsp;</th>
</tr>
<tr>

  <th>ช่วงอายุ</th>
  <th>จังหวัด</th>
  <th>ปี</th>
  <th><p>จำนวน<br />
    ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
</tr>

<?php 
		$filename= "health_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		
$this->load->model('health_model', 'opt');
 
if(isset($_GET['year']))
{
	$sql1 = "select * from health where health_year='".$_GET['year']."'";
}
else
{
	$sql1 = 'select * from health order by id desc';
}


$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item)
 {
	 

		 
	
?>

<tr>
  <td><?php echo $item['health_age']; ?></td>
  <td><?php echo $item['health_province']; ?></td>
  <td><?php echo $item['health_year']; ?></td>
  <td><?php echo @number_format($item['health_sum_pop']); ?></td>
  <td><?php echo @number_format($item['health_sum_eli']); ?></td>
  <td><?php echo @number_format($item['health_sum_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_sum_acress']); ?></td>
  <td><?php echo @number_format($item['health_sum_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_male_pop']); ?></td>
  <td><?php echo @number_format($item['health_male_eli']); ?></td>
  <td><?php echo @number_format($item['health_male_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_male_acress']); ?></td>
  <td><?php echo @number_format($item['health_male_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_female_pop']); ?></td>
  <td><?php echo @number_format($item['health_female_eli']); ?></td>
  <td><?php echo @number_format($item['health_female_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_female_acress']); ?></td>
  <td><?php echo @number_format($item['health_female_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_etc_pop']); ?></td>
  <td><?php echo @number_format($item['health_etc_eli']); ?></td>
  <td><?php echo @number_format($item['health_etc_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_etc_acress']); ?></td>
  <td><?php echo @number_format($item['health_etc_acress_percen']); ?></td>
</tr>

<?php 
 
 		
		
 }

?>


</table>

</body>
</html>