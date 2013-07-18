<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <link rel="stylesheet" type="text/css" href="../../themes/ppt/css/style.css"/>
<title>รายงาน คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</title>

<link href="<?php echo site_url('themes/ppt/css/style.css'); ?>" rel="stylesheet">

</head>
<body>


<div id="resultsearch"><b>ผลที่ค้นหา :</b> คนต่างด้าวได้รับอนุญาตทำงานคงเหลือทั่วราชอาณาจักร <label><?php if(isset($_GET['year'])){echo 'ปี '.$_GET['year'];}else{echo "ทุกปี";} ?></label></div>

<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">สัญชาติ</th>
<th colspan="3" class="txtcen">คนต่างด้าวได้รับอนุญาตทำงาน </th>
</tr>
<tr>
  <td class="txtcen">เข้าเมืองถูกกฎหมาย</td>
  <td class="txtcen">เข้าเมืองผิดกฎหมาย</td>
  <td class="txtcen">รวม</td>
  </tr>
  
  
 <?php 
 $sum_in = '';
 $sum_out = '';
 $sum_all = '';
 
 foreach($result as $key => $item): $key += 1;
  
 ?>  

<tr>
  <td class="topic"><?php echo $item['alien_nation']; ?></td>
  <td class="txtright"><?php echo @number_format($item['alien_in']); ?></td>
  <td class="txtright"><?php echo @number_format($item['alien_out']); ?></td>
  
  <?php $sum = $item['alien_in'] + $item['alien_out']; ?>
  
  <td class="txtright"><?php echo @number_format($sum); ?></td>
  </tr>
  
<?php 


 
 $sum_in = $sum_in + $item['alien_in'];
 $sum_out = $sum_out + $item['alien_out'];
 $sum_all = $sum_all + $sum;
 
 
endforeach;


 ?>

<tr class="total">
  <td>รวม</td>
  <td class="txtright"><?php echo number_format($sum_in,0); ?></td>
  <td class="txtright"><?php echo number_format($sum_out,0); ?></td>
  <td class="txtright"><?php echo number_format($sum_all,0); ?></td>
  </tr>
</table>

<div id="ref">ที่มา : สำนักบริการแรงงานต่างด้าว</div>


<script>window.print();</script>


</body>
</html>

