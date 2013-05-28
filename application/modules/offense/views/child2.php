<h3>รายงาน เด็กและเยาวชนในสถานพินิจฯ</h3>
<div id="search">
  <div id="searchBox">
   <form method="get" action="offense/offense_report">
 <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>

    <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
   
  </div>
</div>


<div id="resultsearch"><b>ผลที่ค้นหา :</b> เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็กและเยาวชน 

ปี <label><?php echo @$_GET['year']; ?>

</label> จังหวัด <label>

  <?php 
  
   if(!empty($_GET['province_id']))
   {  
   
		if($_GET['province_id']!="")
		{
		  $sql = 'select * from provinces where id='.$_GET['province_id'];
		  $result1 = $this->opt->get($sql);
			  foreach($result1 as $key1 => $item1)
			  {
				  echo $item1['province'];
			  }
		  
			 }
  		 }
		else
	   {
			echo "ทุกจังหวัด";   
	   }
  ?>  

</label> อำเภอ <label>

  <?php 
   if(!empty($_GET['amphur_id'])){
	   
		if($_GET['amphur_id']!="")
		{
		  $sql = 'select * from amphur where id='.$_GET['amphur_id'];
		  $result1 = $this->opt->get($sql);
		  foreach($result1 as $key1 => $item1)
		  {
			  echo $item1['amphur_name'];
		  }
		}

   }
   else
   {
		echo "ทุกอำเภอ";   
   }
 
  ?>
</label>

</div>
<div style="padding:10px; text-align:right;">
<img src="<?php echo base_url(); ?>media/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('offense/offense_export'); ?>'">
<img src="<?php echo base_url(); ?>media/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('offense/offense_print'); ?>'">หน่วย:ราย</div>


 <?php 
 
 $all_property = 0;
  $all_body = 0;
 $all_sex = 0;
 $all_dominance = 0;
 $all_drug = 0;
 $all_weapon = 0;
 $all_etc = 0;
 $offense_all = 0;
 
 foreach($result as $key => $item): $key += 1;
 
 $all_property = $all_property + $item['offense_property'];
 $all_body = $all_body + $item['offense_body'];
 $all_sex = $all_sex + $item['offense_sex'];
 $all_dominance = $all_dominance + $item['offense_dominance'];
 $all_drug = $all_drug + $item['offense_drug'];
 $all_weapon = $all_weapon + $item['offense_weapon'];
 $all_etc = $all_etc + $item['offense_etc'];
 
 endforeach;
 
 $offense_all = $all_property + $all_body + $all_sex + $all_dominance + $all_drug + $all_weapon + $all_etc;
 
 ?>
 
 
<table class="tbreport">
<tr>
<th>ประเภทฐานความผิด</th>
<th>จำนวน</th>
</tr>
<tr>
<td class="topic">ทรัพย์</td>
<td><?php echo @number_format($all_property); ?></td>
</tr>
<tr>
  <td class="topic">ชีวิตและร่างกาย</td>
  <td><?php echo @number_format($all_body); ?></td>
  </tr>
<tr>
  <td class="topic">เพศ</td>
  <td><?php echo @number_format($all_sex); ?></td>
  </tr>
<tr>
  <td class="topic">ความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง</td>
  <td><?php echo @number_format($all_dominance); ?></td>
  </tr>
<tr>
  <td class="topic">ยาเสพติดให้โทษ</td>
  <td><?php echo @number_format($all_drug); ?></td>
  </tr>
<tr>
  <td class="topic">อาวุธและวัตถุระเบิด</td>
  <td><?php echo @number_format($all_weapon); ?></td>
  </tr>
  
 <tr>
  <td class="topic">อื่น ๆ</td>
  <td><?php echo @number_format($all_etc); ?></td>
  </tr>
   
<tr class="total">
  <td>รวม</td>
  <td><?php echo @number_format($offense_all); ?></td>
  </tr>
</table>

<div id="ref">ที่มา :</div>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>
