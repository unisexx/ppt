<link rel="stylesheet" type="text/css" href="../../../themes/ppt/css/style.css"/>
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
  <th rowspan="2" class="topic">ตัวชี้วัดความจำเป็นพื้นฐาน</th>
  <th colspan="2">ผ่านเกณฑ์</th>
  <th rowspan="2">เป้าหมาย  ปี <? if(@$_GET['year_data']=='')echo 'ทุกปี'; else echo @$_GET['year_data']; ?></th>
  <th rowspan="2">ต่ำกว่าเป้าหมาย(ร้อยละ)</th>
  <th rowspan="2">จำนวนที่ต้องแก้ไขทั้งหมด</th>
</tr>
<tr>
  <th>จำนวน</th>
  <th>ร้อยละ</th>
</tr>
<? 
foreach($value as $item):
?>  
<tr>
  <td class="topic"><?=$item['keyid'].'. '.$item['title'];?>&nbsp;</td>
  <td colspan="-1"  style="text-align:right;">
  	<?=number_format($item['pass'],0);?>
  </td>
  <td colspan="-1"  style="text-align:right;">
  	<?=number_format($item['p_pass'],2);?>
  </td>
  <td colspan="-1"  style="text-align:right;">
  	<?=number_format($item['target'],2);?>
  </td>
  <td  style="text-align:right;">
  	<?=number_format($item['p_nopass'],2);?>
  </td>
  <td  style="text-align:right;">
  	<?=number_format($item['edit'],0);?>
  </td>  
</tr>
<? endforeach;?>
</table>

<div id="ref">ที่มา :</div>


