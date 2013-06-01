<html>
<head>
<title>รายงาน คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร จำแนกตามสัญชาติ</title>
<link href="<?php echo base_url(); ?>media/css/style.css" rel="stylesheet">
</head>
<body>

<div align="center"><h3>รายงาน คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร จำแนกตามสัญชาติ</h3></div>

<table class="tbreport">
<tr>
<th>ปี</th>
<th>สัญชาติ</th>
<th>รวม ต่างด้าวเข้าเมืองถูกกฎหมาย</th>
<th>รวม ต่างด้าวเข้าเมืองผิดกฎหมาย</th>
</tr>

<?php 
		$filename= "alien_nation_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		
$this->load->model('alien_nation_model', 'opt');
 
if(isset($_GET['year']))
{
	$sql1 = "select * from alien_nation where alien_year='".$_GET['year']."'";
}
else
{
	$sql1 = 'select * from alien_nation order by id desc';
}

$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item1)
 {
	 

		 
	
?>

<tr>
<td class="topic"><?php echo $item1['alien_year']; ?></td>
<td><?php echo $item1['alien_nation']; ?></td>'
<td><?php echo @number_format($item1['alien_in']); ?></td>
<td><?php echo @number_format($item1['alien_out']); ?></td>
</tr>

<?php 
 
 		
		
 }

?>


</table>

</body>
</html>