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
  <th rowspan="2" class="txtcen">ปี</th>
  <td colspan="3" class="txtcen">รวมทั้งสิ้น</td>
  <td class="txtcen">ต่างด้าวเข้าเมืองถูกกฎหมาย</td>
  <td class="txtcen">ต่างด้าวเข้าเมืองผิดกฎหมาย</td>
</tr>
<tr>
<td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">รวม</td>



</tr>


 <?php 
 
 foreach($result as $key => $item): $key += 1;
  
 ?>  
 
<tr>
  <td class="topic txtcen"><?php echo $item['s_year']; ?></td>
  <td class="txtright"><?php echo @number_format($item['a_sum']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_male']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_female']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_in']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_out']); ?></td>
</tr>

<?php 
 
endforeach;

 ?>
 
 
</table>
<div id="ref">ที่มา : สำนักบริการแรงงานต่างด้าว</div>

<script>window.print();</script>


</body>
</html>