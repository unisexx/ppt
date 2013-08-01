<h3>รายงาน คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</h3>
<a href="report/alien_nation_r/alien_nation_report" target="_blank"><div style="padding:10px; background:#EAEAEA; border:1px solid #ccc; font-weight:700; width:130px; float:right">จำแนกตามสัญชาติ</div></a>
<div id="search">
  <div id="searchBox">
<form method="get" action="report/alien_nation_r/index" id="frm_im" name="frm_im">
 
  <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>

  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  
  </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน 

<label>

<?php //if(isset($_GET['year'])){echo $_GET['year'];}else{echo "ทุกปี";} ?>

<?php

        if(!empty($_GET))
        {
			if($_GET['province_id']!="")
			{
			  $sql0 = 'select * from provinces where id='.$_GET['province_id'];
			  $result0 = $this->opt->get($sql0);
			  foreach($result0 as $key0 => $item0)
			  {
				  echo "จังหวัด :".$item0['province'];
				  $p_name = $item0['province'];
			  }
			}
			else
			{
				  echo " ทุกจังหวัด ";	
				  $p_name = 'รวม';	
			}
		}
		else
		{
				  echo " ทุกจังหวัด ";	
				  $p_name = 'รวม';
		}
		
?>

</label>

</div>
<div style="padding:10px; text-align:right;">


<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"
 onclick="document.location='<?php echo site_url('report/alien_nation_r/basic4_export/'.@$_GET['year'].''); ?>'">
 
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"
 onclick="document.location='<?php echo site_url('report/alien_nation_r/basic4_print/'.@$_GET['year'].''); ?>'">



</div>
<table class="tbreport">
<tr>
  <th rowspan="2" class="txtcen">ปี</th>
  <th colspan="5" class="txtcen">คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</th>
</tr>
<tr>
  <td class="txtcen">ทั้งหมด</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ต่างด้าวเข้าเมืองถูกกฎหมาย</td>
  <td class="txtcen">ต่างด้าวเข้าเมืองผิดกฎหมาย</td>


</tr>


 <?php 
 
$where = "";

$sql1 = 'select distinct(alien_year) from alien order by alien_year desc';


$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item1)
 {
	 

		$sql2 = "SELECT * from alien where alien_year = '".$item1['alien_year']."' and alien_province LIKE '%".$p_name."%' ";
	
		
		$result2 = $this->opt->get($sql2);
		
		 foreach($result2 as $key2 => $item2)
		 {
		 
  
 ?>  
 
<tr>
  <td class="topic txtcen"><?php echo $item2['alien_year']; ?></td>
  <td class="txtright"><?php echo @number_format($item2['alien_sum']); ?></td>
  <td class="txtright"><?php echo @number_format($item2['alien_male']); ?></td>
  <td class="txtright"><?php echo @number_format($item2['alien_female']); ?></td>
  <td class="txtright"><?php echo @number_format($item2['alien_sum_in']); ?></td>
  <td class="txtright"><?php echo @number_format($item2['alien_sum_out']); ?></td>
</tr>

<?php 
 
		} 
	}

 ?>
 
 
</table>

<div id="ref">ที่มา : สำนักบริการแรงงานต่างด้าว</div>


