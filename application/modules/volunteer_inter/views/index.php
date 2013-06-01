<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='volunteer_inter/delete/'+hdid;
			}
		})
	})
</script>
<?php echo menu::source($menu_id); ?>
<form method="get" >
<div id="search">
  <div id="searchBox">
    <?php //echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($_GET['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$_GET['amphur_id'].' order by district_name'), @$_GET['district_id'], null, '-- ทุกตำบล --'); ?>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </div>
</div>
</form>
<div id="btnBox">
	<!--<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='birth/import_form'" class="btn_import"/>-->
	<? if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='volunteer_inter/form'" class="btn_add"/>
	<? endif;?>
</div>
<!--
<div class="pagebarUTH">&nbsp;<span class="this-page">1</span>
<a href="javascript:;" title="Seite 2">2</a>
<a href="javascript:;" title="Seite 3">3</a>
<a href="javascript:;" title="Seite 4">4</a>
<span class="break">...</span><a href="javascript:;" title="Seite 19">19</a>
<a href="javascript:;" title="Seite 2">Next</a>&nbsp;&nbsp;188 record
</div>	
-->
<?=$pagination;?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่ออาสาสมัคร</th>
  <th>ที่อยู่</th>
  <th>โทรศัพท์</th>
  <th>โทรสาร</th>
  <th>&nbsp;</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($data as $item){
?>
<tr  <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?=$i;?></td>
  <td><?=anchor('volunteer_inter/form/'.$item['id'], $item['fname'].' '.$item['lname']);?></td>
  <td>
	<?if ($item["home_no"]!="") echo $item['home_no'].'&nbsp;'; ?>
    <?if ($item["moo"]!="")echo "หมู่ที่".$item['moo'].'&nbsp;'; ?>
    <?if($item['moo_ban']!="") echo "อาคาร/หมู่บ้าน".$item['moo_ban'].'&nbsp;'; ?>
    <?if ($item['soi']!="")echo "ซ.".$item['soi'].'&nbsp;'; ?>
    <?if ($item['road']!="")echo "ถ.".$item['road'].'&nbsp;'; ?>        
    <? if($item['v_district_name']!='')echo 'แขวง/ตำบล '.$item['v_district_name'].'&nbsp;';?>
    <? if($item['v_amphur_name']!='')echo 'เขต/อำเภอ '.$item['v_amphur_name'].'&nbsp;';?>
    <? if($item['v_province_name']!='')echo 'จังหวัด '.$item['v_province_name'].'&nbsp;';?>
    <? if($item['post_code']!='')echo ' '.$item['post_code'];?>    
  </td>
  <td><?=$item['tel'];?></td>
  <td><?=$item['fax'];?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<? if(menu::perm($menu_id, 'edit')): ?>
  	<input type="button" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='volunteer_inter/form/<?=$item['id'];?>'" />
  	<? endif;?>
  	<?php echo menu::perm($menu_id, 'delete', 'volunteer_inter/delete/'.$item['id']); ?>
    </td>
</tr>
<? $i++; } ?>
</table>
 <script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>