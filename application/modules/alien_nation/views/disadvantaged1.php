<h3>รายงาน คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร จำแนกตามสัญชาติ</h3>
<div id="search">
  <div id="searchBox">
    <form method="get" action="alien_nation/alien_nation_report">
 <?php echo form_dropdown('year', get_year_option(2555, null, 'ALIEN_NATION', 'ALIEN_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> จำนวนคนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร จำแนกตามสัญชาติ
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
  <img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('alien_nation/alien_nation_export'); ?>'" >
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('alien_nation/alien_nation_print'); ?>'">หน่วย:พันคน

</div>




<table class="tbreport">
<tr>
<th>ปี</th>
<th>สัญชาติ</th>
<th>รวม ต่างด้าวเข้าเมืองถูกกฎหมาย</th>
<th>รวม ต่างด้าวเข้าเมืองผิดกฎหมาย</th>
</tr>

<?php 

 $where = "";
 if(!empty($_GET['year']))
 {
		if($_GET['year']!="")
		{
			$sql1 = "select * from alien_nation where alien_year='".$_GET['year']."'";
		}
	}
	else
	{
			$sql1 = 'select * from alien_nation order by id asc';
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

<div id="ref"><b>ที่มา :</b></div>
<div id="remark"><b>หมายเหตุ : </b></div>

