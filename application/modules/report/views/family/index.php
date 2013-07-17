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
    <?
    $_GET['year_data'] = (empty($_GET['year_data']))?2554:$_GET['year_data'];
    echo form_dropdown('year_data', get_year_option(null,null,'family','year_data'), @$_GET['year_data'], null); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>    
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ตัวชี้วัดความจำเป็นขั้นพื้นฐาน(จปฐ) : 
  <?php echo form_dropdown('keydata', get_option('id', 'title', 'family_report_key', '1=1 order by id'), @$_GET['keydata'], null, ''); ?>
  ปี
  <label><? if(@$_GET['year_data']=='')echo 'ทุกปี'; else echo @$_GET['year_data']; ?></label> 
  <label>
  	<?
		echo ($province_name == 'ทุกจังหวัด')?'ทุกจังหวัด':'จังหวัด '.$province_name; 
  	?>
  </label>
</div>
</form>
<div style="padding:10px; text-align:right;">
<a href="report/family/index/export<?=GetCurrentUrlGetParameter();?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="report/family/index/print<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>หน่วย:คน</div>

<table class="tbreport">
<tr>
  <th rowspan="2" class="topic txtcen">ตัวชี้วัดความจำเป็นพื้นฐาน</th>
  <th colspan="2" class="txtcen">ผ่านเกณฑ์</th>
  <th rowspan="2" class="txtcen">เป้าหมาย  <!--ปี <? if(@$_GET['year_data']=='')echo 'ทุกปี'; else echo @$_GET['year_data']; ?>--></th>
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
  <td colspan="-1"  class="txtright">
  	<?=number_format($item['pass'],0);?>
  </td>
  <td colspan="-1"  class="txtright">
  	<?=number_format($item['p_pass'],2);?>
  </td>
  <td colspan="-1"  class="txtright">
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


