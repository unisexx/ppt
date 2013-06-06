<html>
<head>
<title>poor_print_report</title>
<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">
</head>
<body>

<div align="center"><h3>รายงาน คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร</h3></div>

<table class="tbreport">
<tr>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>จังหวัด</th>
  <th>รวมทั้งสิ้น</th>
  <th>&nbsp;</th>
  <th>ต่างด้าวเข้าเมืองถูกกฏหมาย</th>
  <th>ต่างด้าวเข้าเมืองผิดกฏหมาย</th>
  
</tr>
<tr>
  <th>ปี </th>
  <th>&nbsp;</th>
  <th>รวม</th>
  <th>ชาย</th>
  <th>หญิง</th>
  <th>รวม</th>
  <th>รวม</th>
</tr>

<?php 
$this->load->model('alien_model', 'opt');
 
if(isset($_GET['year']))
		{
			$sql1 = "select * from alien where alien_year='".$_GET['year']."'";
		}
	else
	{
		$sql1 = 'select * from alien order by id desc';
	}

$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item)
 {
	 

		 
	
?>

<tr>
  <td><?php echo $item['alien_year']; ?></td>
  <td><?php echo $item['alien_province']; ?></td>
  <td><?php echo @number_format($item['alien_sum']); ?></td>
  <td><?php echo @number_format($item['alien_male']); ?></td>
  <td><?php echo @number_format($item['alien_female']); ?></td>
  <td><?php echo @number_format($item['alien_sum_in']); ?></td>
  <td><?php echo @number_format($item['alien_sum_out']); ?></td>

</tr>

<?php 
 
 		
		
 }

?>


</table>

<script language="javascript">
window.print();
</script>

</body>
</html>