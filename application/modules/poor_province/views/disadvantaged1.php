<h3>รายงาน ผู้มีรายได้ต่ำกว่าเส้นความยากจน</h3>
<div id="search">
  <div id="searchBox">
    <form method="get" action="poor_province/poor_report">
 <?php echo form_dropdown('year', get_year_option(2555, null, 'POOL_PROVINCE', 'POOR_PROVINCE_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>
 <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> เส้นความยากจน สัดส่วนและจำนวนคนจนเมื่อวัดด้านรายจ่ายเพื่อการอุปโภคบริโภค
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
				  $p_name = $item0['province'];
			  }
		}
		else
		{
				  echo " ทุกจังหวัด ";	
				  $p_name = 'ประเทศ';
		}
		
		
  ?>  

</label>


</div>
<div style="padding:10px; text-align:right;">
  <img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('poor_province/poor_province_export'); ?>'" >
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('poor_province/poor_province_print'); ?>'"></div>


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

<div id="ref"><b>ที่มา :</b> ข้อมูลจากการสำรวจภาวะเศรษฐกิจและสังคมของครัวเรือน สำนักงานสถิติแห่งชาติ ประมวลผลโดย สำนักพัฒนาฐานข้อมูลและตัวชี้วัดภาวะสังคม สศช.</div>
<div id="remark"><b>หมายเหตุ : </b><br>
1.        เส้นความยากจน (Poverty line) เป็นเครื่องมือสำหรับใช้วัดภาวะความยากจน โดยคำนวณจากต้นทุนหรือค่าใช้จ่ายของปัจเจกบุคคลในการได้มาซึ่งอาหารและสินค้าบริการจำเป็นพื้นฐานในการดำรงชีวิต <br>
2.        สัดส่วนคนจน คำนวณจากจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน หารด้วย จำนวนประชากรทั้งหมด คูณด้วย 100 <br>
3.        จำนวนคนจน หมายถึงจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน
</div>

