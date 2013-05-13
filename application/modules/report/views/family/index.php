<script type="text/javascript">
$(document).ready(function(){
	$("select[name=keydata]").change(function(){
		$("#fmreport").submit();
	})
})
</script>
<h3>รายงาน ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : <?=$family_key['title'];?> </h3>
<form name="fmreport" id="fmreport" enctype="multipart/form-data" method="get">
<div id="search">
  <div id="searchBox">
    <?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>    
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : 
  <?php echo form_dropdown('keydata', get_option('id', 'title', 'family_report_key', '1=1 order by id'), @$_GET['keydata'], null, ''); ?>
  ปี
  <label><? if(@$_GET['year_data']=='')echo 'ทุกปี'; else echo @$_GET['year_data']; ?></label>  จังหวัด 
  <label><?=$province_name; ?></label>
</div>
</form>
<div style="padding:10px; text-align:right;">
<a href="report/family/export<?=GetCurrentUrlGetParameter();?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="report/family/report_print<?=GetCurrentUrlGetParameter();?>"><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>หน่วย:คน</div>
<table class="tbreport">
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


