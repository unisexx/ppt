<h3>รายงาน คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร</h3>
<div id="search">
  <div id="searchBox">
    <form method="get" action="alien/alien_report">
 <?php echo form_dropdown('year', get_year_option(2550), @$_GET['year'], null, '-- ทุกปี --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> จำนวนคนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร
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

</div>
<div style="padding:10px; text-align:right;">
  <img src="<?php echo base_url(); ?>media/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('alien/alien_export'); ?>'" >
<img src="<?php echo base_url(); ?>media/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('alien/alien_print'); ?>'">หน่วย:พันคน</div>


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

 $where = "";
 if(!empty($_GET['year']))
 {
		if($_GET['year']!="")
		{
			$sql1 = "select * from alien where alien_year='".$_GET['year']."'";
		}
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

<div id="ref"><b>ที่มา :</b></div>
<div id="remark"><b>หมายเหตุ :</b></div>

