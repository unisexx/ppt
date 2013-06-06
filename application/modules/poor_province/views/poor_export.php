<html>
<head>
<title>รายงาน ผู้มีรายได้ต่ำกว่าเส้นความยากจน</title>
<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">
</head>
<body>

<div align="center"><h3>รายงาน ผู้มีรายได้ต่ำกว่าเส้นความยากจน</h3></div>

<table class="tbreport">
<tr>

<th>ปี</th>
<th>เส้นความยากจน(บาท/คน/เดือน)</th>
<th>สัดส่วนคนจน(ร้อยละ)</th>
<th>จำนวนคนจน(พันคน)</th>
</tr>

<?php 
		$filename= "poor_province_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		
$this->load->model('poor_province_model', 'opt');
 $where = "";
 if(!empty($_GET['year']))
 {
		if($_GET['year']!="")
		{
			$sql1 = "select distinct(poor_province_year) as poor_province_year,poor_province_sex from pool_province where poor_province_year='".$_GET['year']."'";
		}
	}
	else
	{
		$sql1 = 'select distinct(poor_province_year) as poor_province_year,poor_province_sex from pool_province order by poor_province_year desc';
	}

$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item1)
 {
	 
	 	
		
		$sql2 = "SELECT sum(poor_province_line) as line,sum(poor_province_percent) as percents,sum(poor_province_qty) as qty from pool_province where poor_province_year = '".$item1['poor_province_year']."' and poor_province_sex='".$item1['poor_province_sex']."' order by POOR_PROVINCE_YEAR DESC";
		
		
		
		$result2 = $this->opt->get($sql2);
		
		 foreach($result2 as $key2 => $item2)
		 {
		 
	
?>

<tr>

<td class="topic"><?php echo $item1['poor_province_year']; ?></td>
<td><?php echo @number_format($item2['line'],2); ?></td>
<td><?php echo @number_format($item2['percents'],2); ?></td>
<td><?php echo @number_format($item2['qty'],2); ?></td>
</tr>

<?php 
 
 		}
		
 }

?>


</table>

</body>
</html>