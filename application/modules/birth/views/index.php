<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='birth/delete/'+hdid;
			}
		})
	})
</script>
<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>ข้อมูลการเกิด <span class="gray">แบบ กรมการปกครอง การเกิด</span></h4>
<form method="get" >
<div id="search">
  <div id="searchBox">
    <?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </div>
</div>
</form>
<div id="btnBox">
	<? if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='birth/import_form'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='birth/form'" class="btn_add"/>
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
  <th>ปี</th>
  <th>จังหวัด</th>
  <th>ชาย</th>
  <th>หญิง</th>
  <th>&nbsp;</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($birth as $item){
?>
<tr  <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?=$i;?></td>
  <td><?=$item['year_data'];?></td>
  <td><?=$item['province_name'];?></td>
  <td><?=number_format($item['birth_male'],0);?></td>
  <td><?=number_format($item['birth_female'],0);?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<? if(menu::perm($menu_id, 'edit')): ?>
  	<input type="button" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='birth/form/<?=$item['id'];?>'" />
  	<? endif;?>
  	<? if(menu::perm($menu_id, 'delete')): ?>
    <input type="button" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" />
    <? endif;?>
    </td>
</tr>
<? $i++; } ?>
</table>
