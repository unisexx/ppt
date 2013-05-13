<html>
<head>
<title>รายงาน เด็กและเยาวชนในสถานพินิจฯ</title>
<link href="<?php echo base_url(); ?>media/css/style.css" rel="stylesheet">
</head>
<body>
<?php
		$filename= "offense_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);

          $this->load->model('poor_province_model', 'opt');
		  $where = '';
		  
			$sql1 = 'SELECT
			*
			FROM
			OFFENSES
			WHERE 1=1 '.$where.' 
			ORDER BY ID ASC';
	
			  $result = $this->opt->get($sql1);


				
				
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
  <td>เพศ</td>
  <td><?php echo @number_format($all_sex); ?></td>
  </tr>
<tr>
  <td>ความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง</td>
  <td><?php echo @number_format($all_dominance); ?></td>
  </tr>
<tr>
  <td>ยาเสพติดให้โทษ</td>
  <td><?php echo @number_format($all_drug); ?></td>
  </tr>
<tr>
  <td>อาวุธและวัตถุระเบิด</td>
  <td><?php echo @number_format($all_weapon); ?></td>
  </tr>
  
 <tr>
  <td>อื่น ๆ</td>
  <td><?php echo @number_format($all_etc); ?></td>
  </tr>
   
<tr class="total">
  <td>รวม</td>
  <td><?php echo @number_format($offense_all); ?></td>
  </tr>
</table>
</body>
</html>