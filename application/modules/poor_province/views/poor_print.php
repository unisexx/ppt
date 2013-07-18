<html>
<head>
<title>poor_print_report</title>
<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">
</head>
<body>

<div id="resultsearch">เส้นความยากจน สัดส่วนและจำนวนคนจนเมื่อวัดด้านรายจ่ายเพื่อการอุปโภคบริโภค
<label>

  <?php 
  
        if(isset($_GET['year'])!="")
        {

				  echo $_GET['year'];
			  
		}
		else
		{
				  echo " ทุกปี ";	
		}
  ?>  

</label>
<label>

<?php 
  
        if(!empty($_GET))
        {
			  $sql0 = 'select * from provinces where id='.$_GET['province_id'];
			  $result0 = $this->opt->get($sql0);
			  foreach($result0 as $key0 => $item0)
			  {
				  echo $item0['province'];
			  }
		}
		else
		{
				  echo " ทุกจังหวัด ";	
		}
  ?>  

</label>


</div>

<table class="tbreport">
<tr>

<th class="txtcen">ปี</th>
<th class="txtcen">เส้นความยากจน(บาท/คน/เดือน)</th>
<th class="txtcen">สัดส่วนคนจน(ร้อยละ)</th>
<th class="txtcen">จำนวนคนจน(พันคน)</th>
</tr>

<?php 
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

<td class="topic txtcen"><?php echo $item1['poor_province_year']; ?></td>
<td class="txtright"><?php echo @number_format($item2['line'],2); ?></td>
<td class="txtright"><?php echo @number_format($item2['percents'],2); ?></td>
<td class="txtright"><?php echo @number_format($item2['qty'],2); ?></td>
</tr>

<?php 
 
 		}
		
 }

?>


</table>

<div id="ref">ที่มา : ข้อมูลจากการสำรวจภาวะเศรษฐกิจและสังคมของครัวเรือน สำนักงานสถิติแห่งชาติ ประมวลผลโดย สำนักพัฒนาฐานข้อมูลและตัวชี้วัดภาวะสังคม สศช.</div>
<div id="remark">หมายเหตุ : <br>
1.        เส้นความยากจน (Poverty line) เป็นเครื่องมือสำหรับใช้วัดภาวะความยากจน โดยคำนวณจากต้นทุนหรือค่าใช้จ่ายของปัจเจกบุคคลในการได้มาซึ่งอาหารและสินค้าบริการจำเป็นพื้นฐานในการดำรงชีวิต <br>
2.        สัดส่วนคนจน คำนวณจากจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน หารด้วย จำนวนประชากรทั้งหมด คูณด้วย 100 <br>
3.        จำนวนคนจน หมายถึงจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน
</div>

</body>
</html>