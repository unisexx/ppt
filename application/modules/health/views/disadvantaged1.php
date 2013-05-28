<h3>รายงาน การให้บริการหลักประกันสุขภาพ</h3>
<div id="search">
  <div id="searchBox">
    <form method="get" action="health/health_report">
 <?php echo form_dropdown('year', get_year_option(2550), @$_GET['year'], null, '-- ทุกปี --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> จำนวนประชากร การให้บริการหลักประกันสุขภาพ
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
  <img src="<?php echo base_url(); ?>media/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('health/health_export'); ?>'" >
<img src="<?php echo base_url(); ?>media/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('health/health_print'); ?>'">หน่วย:พันคน</div>


<table class="tbreport">
<tr>

  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th colspan="5">รวม</th>
  <th colspan="5">ชาย</th>
  <th colspan="5">หญิง</th>
   <th colspan="5">ไม่ระบุ</th>
  <th>&nbsp;</th>
</tr>
<tr>

  <th>ช่วงอายุ</th>
  <th>จังหวัด</th>
  <th>ปี</th>
  <th><p>จำนวน<br />
    ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
</tr>

<?php 

 $where = "";
 if(!empty($_GET['year']))
 {
		if($_GET['year']!="")
		{
			$sql1 = "select * from health where health_year='".$_GET['year']."'";
		}
	}
	else
	{
			$sql1 = 'select * from health order by id desc';
	}

$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item)
 {
	 
	 	
		
	
?>

<tr>
  <td><?php echo $item['health_age']; ?></td>
  <td><?php echo $item['health_province']; ?></td>
  <td><?php echo $item['health_year']; ?></td>
  <td><?php echo @number_format($item['health_sum_pop']); ?></td>
  <td><?php echo @number_format($item['health_sum_eli']); ?></td>
  <td><?php echo @number_format($item['health_sum_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_sum_acress']); ?></td>
  <td><?php echo @number_format($item['health_sum_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_male_pop']); ?></td>
  <td><?php echo @number_format($item['health_male_eli']); ?></td>
  <td><?php echo @number_format($item['health_male_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_male_acress']); ?></td>
  <td><?php echo @number_format($item['health_male_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_female_pop']); ?></td>
  <td><?php echo @number_format($item['health_female_eli']); ?></td>
  <td><?php echo @number_format($item['health_female_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_female_acress']); ?></td>
  <td><?php echo @number_format($item['health_female_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_etc_pop']); ?></td>
  <td><?php echo @number_format($item['health_etc_eli']); ?></td>
  <td><?php echo @number_format($item['health_etc_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_etc_acress']); ?></td>
  <td><?php echo @number_format($item['health_etc_acress_percen']); ?></td>
</tr>
<?php 
 
 		
		
 }

?>


</table>

<div id="ref"><b>ที่มา :</b></div>
<div id="remark"><b>หมายเหตุ : </b></div>

