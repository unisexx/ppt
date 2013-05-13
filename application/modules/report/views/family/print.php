<html>
	<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
<body>	
<h3>รายงาน ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : <?=$family_key['title'];?> </h3>

<div id="resultsearch"><b>ผลที่ค้นหา :</b> ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : 
  <?=$family_key['title'];?>
  ปี
  <label><? if(@$_GET['year_data']=='')echo 'ทุกปี'; else echo @$_GET['year_data']; ?></label>  จังหวัด 
  <label><?=$province_name; ?></label>
</div>

<div style="padding:10px; text-align:right;">
หน่วย:คน</div>
<table  border="1">
<tr>
  <th rowspan="3" class="topic">ตัวชี้วัด</th>
  <th colspan="7">ผลการสำรวจระดับครอบครัว (จปฐ)</th>
  </tr>
<tr>
  <td>จำนวนสำรวจ</td>
  <td colspan="2">ไม่ผ่านเกณฑ์</td>
  <td colspan="2">ผ่านเกณฑ์</td>
  <td colspan="2">เทียบเป้าหมาย</td>
  </tr>
<tr>
  <td>ทั้งหมด</td>
  <td colspan="-1">จำนวน</td>
  <td>ร้อยละ</td>
  <td colspan="-1">จำนวน</td>
  <td colspan="-1">ร้อยละ</td>
  <td colspan="-1">ร้อยละ</td>
  <td colspan="-1">ผล</td>
  </tr>
<? 
foreach($value as $item):
?>  
<tr>
  <td class="topic"><?=$item['keyid'].'. '.$item['title'];?>&nbsp;</td>
  <td style="text-align:right;">
  	<?=number_format($item['total'],0);?>
  </td>
  <td colspan="-1"  style="text-align:right;">
  	<?=number_format($item['nopass'],0);?>
  </td>
  <td  style="text-align:right;">
  	<?=number_format($item['p_nopass'],2);?>
  </td>
  <td colspan="-1"  style="text-align:right;">
  	<?=number_format($item['pass'],0);?>
  </td>
  <td colspan="-1"  style="text-align:right;">
  	<?=number_format($item['p_pass'],2);?>
  </td>
  <td colspan="-1"  style="text-align:right;">
  	
  </td>
  <td colspan="-1"  style="text-align:right;">
  	
  </td>
</tr>
<? endforeach;?>
</table>

<div id="ref">ที่มา :</div>
</body>
</html>