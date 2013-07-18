<html>
	<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" type="text/css" href="../../themes/ppt/css/style.css"/>
	</head>
<body>	

<div id="resultsearch">ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : 
  <?=$family_key['title'];?>
  ปี
  <label><? if(@$_GET['year_data']=='')echo 'ทุกปี'; else echo @$_GET['year_data']; ?></label> 
  <label>
  	<?
		echo ($province_name == 'ทุกจังหวัด')?'ทุกจังหวัด':'จังหวัด '.$province_name; 
  	?>
  </label>
</div>

<div style="padding:10px; text-align:right;">
หน่วย:คน</div>
<table class='tbreport'>
<tr>
  <th rowspan="2" class="topic txtcen">ตัวชี้วัดความจำเป็นพื้นฐาน</th>
  <th colspan="2" class="txtcen">ผ่านเกณฑ์</th>
  <th rowspan="2" class="txtcen">เป้าหมาย </th>
  <th rowspan="2" class="txtcen">ต่ำกว่าเป้าหมาย(ร้อยละ)</th>
  <th rowspan="2" class="txtcen">จำนวนที่ต้องแก้ไขทั้งหมด</th>
</tr>
<tr>
  <th class="txtcen">จำนวน</th>
  <th class="txtcen">ร้อยละ</th>
</tr>
<? 
foreach($value as $item):
?>  
<tr>
  <td class="topic"><?=$item['keyid'].'. '.$item['title'];?>&nbsp;</td>
  <td colspan="-1" class="txtright">
  	<?=number_format($item['pass'],0);?>
  </td>
  <td colspan="-1" class="txtright">
  	<?=number_format($item['p_pass'],2);?>
  </td>
  <td colspan="-1" class="txtright">
  	<?=number_format($item['target'],2);?>
  </td>
  <td class="txtright">
  	<?=number_format($item['p_nopass'],2);?>
  </td>
  <td class="txtright">
  	<?=number_format($item['edit'],0);?>
  </td>  
</tr>
<? endforeach;?>
</table>

<div id="ref">ที่มา : กรมพัฒนาชุมชน กระทรวงมหาดไทย</div>
<div>ประมวลผลโดย : ระบบฐานข้อมูลทางสังคม</div>
<script>window.print();</script>
</body>
</html>