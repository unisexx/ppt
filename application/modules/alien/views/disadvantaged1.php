<h3>รายงาน ผู้มีรายได้ต่ำกว่าเส้นความยากจน</h3>
<div id="search">
  <div id="searchBox">
    <form method="get" action="poor_province/poor_report">
 <?php echo form_dropdown('year', get_year_option(2543), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> จำนวนและสัดส่วนคนจนที่อยู่ต่ำกว่าเส้นความยากจน  จังหวัด
<label>

  <?php 
  
        if(isset($_GET['province_id'])!="")
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
				  echo " ทุกปี ";	
		}
  ?>  

</label>

</div>
<div style="padding:10px; text-align:right;">
  <img src="<?php echo base_url(); ?>media/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('poor_province/poor_province_export'); ?>'" >
<img src="<?php echo base_url(); ?>media/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('poor_province/poor_province_print'); ?>'">หน่วย:พันคน</div>


<table class="tbreport">
<tr>
<th>ปี</th>
<th>เส้นความยากจน(บาท/คน/เดือน)</th>
<th>สัดส่วนคนจน(ร้อยละ)</th>
<th>จำนวนคนจน(พันคน)</th>
</tr>

<?php 

 $where = "";
 if(!empty($_GET['year']))
 {
		if($_GET['year']!="")
		{
			$sql1 = "select distinct(poor_province_year) as poor_province_year from pool_province where poor_province_year='".$_GET['year']."'";
		}
	}
	else
	{
		$sql1 = 'select distinct(poor_province_year) as poor_province_year from pool_province order by poor_province_year desc';
	}

$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item1)
 {
	 
	 
		
if(!empty($_GET['province_id']))	
{ 
		if($_GET['province_id']!="")
		{
			$where = " and poor_province_province=".$_GET['province_id'];
		}
	}
	else
	{
		$where = "";
	}
			
		
		$sql2 = "SELECT sum(poor_province_line) as line,sum(poor_province_percent) as percents,sum(poor_province_qty) as qty from pool_province where poor_province_year = '".$item1['poor_province_year']."' ".$where." order by POOR_PROVINCE_YEAR DESC";
		
		
		
		$result2 = $this->opt->get($sql2);
		
		 foreach($result2 as $key2 => $item2)
		 {
		 
	
?>

<tr>
<td class="topic"><?php echo $item1['poor_province_year']; ?></td>
<td><?php echo @number_format($item2['line']); ?></td>
<td><?php echo @number_format($item2['percents']); ?></td>
<td><?php echo @number_format($item2['qty']); ?></td>
</tr>

<?php 
 
 		}
		
 }

?>


</table>

<div id="ref"><b>ที่มา :</b> ข้อมูลจากการสำรวจภาวะเศรษฐกิจและสังคมของครัวเรือน สำนักงานสถิติแห่งชาติ ประมวลผลโดย สำนักพัฒนาฐานข้อมูลและตัวชี้วัดภาวะสังคม สศช.</div>
<div id="remark"><b>หมายเหตุ : </b>สัดส่วนคนจน คำนวณจากจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน หารด้วย จำนวนประชากรทั้งหมด คูณด้วย 100 
จำนวนคนจน หมายถึงจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน</div>
