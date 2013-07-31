<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>รายงาน เด็กและเยาวชนในสถานพินิจฯ</title>
<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
<?php

/*          $this->load->model('poor_province_model', 'opt');
		  $where = '';
		  
			$sql1 = 'SELECT
			*
			FROM
			OFFENSES
			WHERE 1=1 '.$where.' 
			ORDER BY ID ASC';
	
			  $result = $this->opt->get($sql1);*/


				
				
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

<div align="center"><h3>รายงาน เด็กและเยาวชนในสถานพินิจฯ</h3></div>
<div align="center">

<h3>

ปี <label><?php echo @$year; ?>

</label> จังหวัด <label>

  <?php 
  
   if(!empty($province))
   {  
   
		if($province!="")
		{
		  $sql = 'select * from provinces where id='.$province;
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
	   
	 echo "</label>";  
	   
	 if(@$type!="")
	 {
		  $this->load->model('offense_type_model', 'otm');
		  
		  
		  $sql = 'select * from offense_type where id='.$type;
		  $result1 = $this->otm->get($sql);
			  foreach($result1 as $key1 => $item1)
			  {
				  echo "   ประเภท : <label>".$item1['offense_type_name']."</label>";
			  }
	 }
  ?>  

</h3>

</div>

<table class="tbreport">
<tr>
<th>ประเภทฐานความผิด</th>
<th>จำนวน</th>
</tr>

<?php

if(@$type){

?>

<?php if(@$type==1){ ?>
<tr>
<td class="topic">ทรัพย์</td>
<td><?php echo @number_format($all_property); ?></td>
</tr>
<?php } ?>

<?php if(@$type==2){ ?>
<tr>
  <td class="topic">ชีวิตและร่างกาย</td>
  <td><?php echo @number_format($all_body); ?></td>
  </tr>

<?php } ?>

<?php if(@$type==3){ ?>
<tr>
  <td class="topic">เพศ</td>
  <td><?php echo @number_format($all_sex); ?></td>
  </tr>
<?php } ?>

<?php if(@$type==4){ ?>
<tr>
  <td class="topic">ความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง</td>
  <td><?php echo @number_format($all_dominance); ?></td>
  </tr>
<?php } ?>

<?php if(@$type==5){ ?>
<tr>
  <td class="topic">ยาเสพติดให้โทษ</td>
  <td><?php echo @number_format($all_drug); ?></td>
  </tr>
<?php } ?>

<?php if(@$type==6){ ?>
<tr>
  <td class="topic">อาวุธและวัตถุระเบิด</td>
  <td><?php echo @number_format($all_weapon); ?></td>
  </tr>
<?php } ?>

<?php if(@$type==7){ ?>  
 <tr>
  <td class="topic">อื่น ๆ</td>
  <td><?php echo @number_format($all_etc); ?></td>
  </tr>
 <?php 
 
 		 
 
 	} 
	
}
else
{
 
 
  ?>  

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



<?php } ?>

</table>
<script>window.print();</script>
</body>
</html>