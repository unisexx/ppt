<html>
<head>
<title>poor_print_report</title>
<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">
</head>
<body>

<div align="center"><h3>รายงาน ผู้มีรายได้ต่ำกว่าเส้นความยากจน  


<label>

<?php 
  

			if($pid != "")
			{
			
			  $sql0 = 'select * from provinces where id='.$pid;
			  $result0 = $this->opt->get($sql0);
			  foreach($result0 as $key0 => $item0)
			  {
				  echo $item0['province'];
				  $p_name = $item0['province'];
			  }
			}else{
			
				  echo " ทุกจังหวัด ";	
				  $p_name = 'ประเทศ';	
				
			}

		
		
  ?>  

</label>

</h3></div>

<table class="tbreport">
<tr>
<!--<th>เพศ</th>-->
<th>ปี</th>
<th>เส้นความยากจน(บาท/คน/เดือน)</th>
<th>สัดส่วนคนจน(ร้อยละ)</th>
<th>จำนวนคนจน(พันคน)</th>
</tr>

<?php 

$where = "";

$sql1 = 'select distinct(poor_province_year) as poor_province_year from pool_province order by poor_province_year desc';


$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item1)
 {
	 

			$sql2 = "SELECT * from pool_province where poor_province_year = '".$item1['poor_province_year']."' and poor_province_province LIKE '%".$p_name."%' ";
	
		
		
		
		
		
		$result2 = $this->opt->get($sql2);
		
		 foreach($result2 as $key2 => $item2)
		 {
		 
	
?>

<tr>

<td class="topic"><?php echo $item2['poor_province_year']; ?></td>
<td><?php echo @number_format($item2['poor_province_line'],2); ?></td>
<td><?php echo @number_format($item2['poor_province_percent'],2); ?></td>
<td><?php echo @number_format($item2['poor_province_qty'],2); ?></td>

</tr>

<?php 
 
 		}
		
 }

?>


</table>
<script>window.print();</script>
</body>
</html>