<?php 
		$filename= "alien_summary_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
?>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>รายงาน คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</title>

<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">

</head>
<body>

<h3>รายงาน คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</h3>


<table class="tbreport">
<tr>
  <th rowspan="2">ปี</th>
  <td colspan="3">รวมทั้งสิ้น</td>
  <td>ต่างด้าวเข้าเมืองถูกกฎหมาย</td>
  <td>ต่างด้าวเข้าเมืองผิดกฎหมาย</td>
</tr>
<tr>
  <td>รวม</td>
  <td>ชาย</td>
  <td>หญิง</td>
  <td>รวม</td>
  <td>รวม</td>


</tr>


 <?php 
 
 foreach($result as $key => $item): $key += 1;
  
 ?>  
 
<tr>
  <td class="topic"><?php echo $item['s_year']; ?></td>
  <td><?php echo @number_format($item['a_sum']); ?></td>
  <td><?php echo @number_format($item['s_male']); ?></td>
  <td><?php echo @number_format($item['s_female']); ?></td>
  <td><?php echo @number_format($item['s_in']); ?></td>
  <td><?php echo @number_format($item['s_out']); ?></td>
</tr>

<?php 
 
endforeach;

 ?>
 
 
</table>

<script>window.print();</script>


</body>
</html>