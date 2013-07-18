<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" type="text/css" href="../../themes/ppt/css/style.css"/>

<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">

</head>
<body>

<div id="resultsearch" style="margin-bottom: 20px;">คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน จังหวัด 
<label><?php if(isset($_GET['year'])){echo $_GET['year'];}else{echo "ทุกปี";} ?></label></div>


<table class="tbreport">
<tr>
  <th rowspan="2" class="txtcen">ปี</th>
  <th colspan="3" class="txtcen">รวมทั้งสิ้น</th>
  <th class="txtcen">ต่างด้าวเข้าเมืองถูกกฎหมาย</th>
  <th class="txtcen">ต่างด้าวเข้าเมืองผิดกฎหมาย</th>
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