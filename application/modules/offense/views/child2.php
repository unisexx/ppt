<h3>รายงาน เด็กและเยาวชนในสถานพินิจฯ</h3>
<div id="search">
  <div id="searchBox">
   <form method="get" action="offense/offense_report">
 <?php echo form_dropdown('year', get_year_option(2554, null, 'OFFENSES', 'OFFENSE_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
		<?php //echo form_dropdown('offense_type_id', get_option('id', 'offense_type_name', 'offense_type', '1=1 order by id'), @$_GET['offense_type_id'], null, '-- ทุกประเภท --'); ?>
    <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
   
  </div>
</div>


<div id="resultsearch"><b>ผลที่ค้นหา :</b> เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็ก จำแนกตามฐานความผิด 

<label>
<?php 

if(!isset($_GET['year']) || $_GET['year']=="")
{
 echo 'ทุกปี';
}
else
{
 echo 'ปี '.@$_GET['year']; 
}


?>
</label> 
<label>

  <?php 
  
   if(!empty($_GET['province_id']))
   {  
   
		if($_GET['province_id']!="")
		{
		  $sql = 'select * from provinces where id='.$_GET['province_id'];
		  $result1 = $this->opt->get($sql);
			  foreach($result1 as $key1 => $item1)
			  {
				  echo 'จังหวัด '.$item1['province'];
			  }
		  
			 }
  		 }
		else
	   {
			echo "ทุกจังหวัด";   
	   }
	   
	 echo "</label>";  
	   
	 if(@$_GET['offense_type_id'])
	 {
		  $this->load->model('offense_type_model', 'otm');
		  
		  
		  $sql = 'select * from offense_type where id='.$_GET['offense_type_id'];
		  $result1 = $this->otm->get($sql);
			  foreach($result1 as $key1 => $item1)
			  {
				  echo "   ประเภท : <label>".$item1['offense_type_name']."</label>";
			  }
	 }
  ?>  




</div>
<div style="padding:10px; text-align:right;">
<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล" onclick="document.location='<?php echo site_url('offense/offense_export/'.@$_GET['year'].'/'.@$_GET['province_id'].'/'.@$_GET['offense_type_id'].''); ?>'">
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick="document.location='<?php echo site_url('offense/offense_print/'.@$_GET['year'].'/'.@$_GET['province_id'].'/'.@$_GET['offense_type_id'].''); ?>'">หน่วย:ราย</div>


 <?php 
 
 $all_property = 0;
  $all_body = 0;
 $all_sex = 0;
 $all_dominance = 0;
 $all_drug = 0;
 $all_weapon = 0;
 $all_etc = 0;
 $offense_all = 0;
 
 $i=1;
 
 		// new liat data
//$result1 = $this->opt->query("SELECT * FROM OFFENSES ORDER BY OFFENSE_YEAR DESC");

/*        $sql = 'SELECT * FROM OFFENSES ORDER BY OFFENSE_YEAR DESC';
        $result1 = $this->opt->get($sql);*/
		
/* $sql0 = 'SELECT * FROM OFFENSES';
 $result10 = $this->opt->get($sql0,TRUE);*/
		  
 foreach($result as $key => $item): $key += 1;
 
 $all_property = $all_property + $item['offense_property'];
 $all_body = $all_body + $item['offense_body'];
 $all_sex = $all_sex + $item['offense_sex'];
 $all_dominance = $all_dominance + $item['offense_dominance'];
 $all_drug = $all_drug + $item['offense_drug'];
 $all_weapon = $all_weapon + $item['offense_weapon'];
 $all_etc = $all_etc + $item['offense_etc'];
 
 $i++;
 
 
 endforeach;
 
 $offense_all = $all_property + $all_body + $all_sex + $all_dominance + $all_drug + $all_weapon + $all_etc;
 
 ?>
 
 
<table class="tbreport">
<tr>
<th class="txtcen">ประเภทฐานความผิด</th>
<th class="txtcen">จำนวน</th>
</tr>

<?php

if(@$_GET['offense_type_id']){

?>

<?php if(@$_GET['offense_type_id']==1){ ?>
<tr>
<td class="topic">ทรัพย์</td>
<td class="txtright"><?php echo @number_format($all_property); ?></td>
</tr>
<?php } ?>

<?php if(@$_GET['offense_type_id']==2){ ?>
<tr>
  <td class="topic">ชีวิตและร่างกาย</td>
  <td class="txtright"><?php echo @number_format($all_body); ?></td>
  </tr>

<?php } ?>

<?php if(@$_GET['offense_type_id']==3){ ?>
<tr>
  <td class="topic">เพศ</td>
  <td class="txtright"><?php echo @number_format($all_sex); ?></td>
  </tr>
<?php } ?>

<?php if(@$_GET['offense_type_id']==4){ ?>
<tr>
  <td class="topic">ความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง</td>
  <td class="txtright"><?php echo @number_format($all_dominance); ?></td>
  </tr>
<?php } ?>

<?php if(@$_GET['offense_type_id']==5){ ?>
<tr>
  <td class="topic">ยาเสพติดให้โทษ</td>
  <td class="txtright"><?php echo @number_format($all_drug); ?></td>
  </tr>
<?php } ?>

<?php if(@$_GET['offense_type_id']==6){ ?>
<tr>
  <td class="topic">อาวุธและวัตถุระเบิด</td>
  <td class="txtright"><?php echo @number_format($all_weapon); ?></td>
  </tr>
<?php } ?>

<?php if(@$_GET['offense_type_id']==7){ ?>  
 <tr>
  <td class="topic">อื่น ๆ</td>
  <td class="txtright"><?php echo @number_format($all_etc); ?></td>
  </tr>
 <?php 
 
 		 
 
 	} 
	
}
else
{
 
 
  ?>  

<tr>
<td class="topic">ทรัพย์</td>
<td class="txtright"><?php echo @number_format($all_property); ?></td>
</tr>

<tr>
  <td class="topic">ชีวิตและร่างกาย</td>
  <td class="txtright"><?php echo @number_format($all_body); ?></td>
  </tr>

<tr>
  <td class="topic">เพศ</td>
  <td class="txtright"><?php echo @number_format($all_sex); ?></td>
  </tr>

<tr>
  <td class="topic">ความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง</td>
  <td class="txtright"><?php echo @number_format($all_dominance); ?></td>
  </tr>

<tr>
  <td class="topic">ยาเสพติดให้โทษ</td>
  <td class="txtright"><?php echo @number_format($all_drug); ?></td>
  </tr>

<tr>
  <td class="topic">อาวุธและวัตถุระเบิด</td>
  <td class="txtright"><?php echo @number_format($all_weapon); ?></td>
  </tr>

 <tr>
  <td class="topic">อื่น ๆ</td>
  <td class="txtright"><?php echo @number_format($all_etc); ?></td>
  </tr>
 
<tr class="total">
  <td>รวม</td>
  <td class="txtright"><?php echo @number_format($offense_all); ?></td>
  </tr>

<!--<tr class="total">
  <td>จำนวน</td>
  <td><?php echo @number_format($i); ?></td>
  </tr>-->

<?php } ?>

</table>

<div id="ref">ที่มา : ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร  กรมพินิจและคุ้มครองเด็กและเยาวชน</div>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>
