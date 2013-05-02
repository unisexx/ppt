<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='family/warm/delete/'+hdid;
			}
		})
	})
</script>
<?php echo menu::source($menu_id); ?>
<form method="get">
<div id="search">
  <div id="searchBox">
   	<?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<div id="btnBox">
	<? if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='family/older/import_form'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='family/older/form'" class="btn_add"/>
	<? endif;?>
</div>
<?=$pagination;?>	
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>จังหวัด</th>
  <th>ผ่านเกณฑ์ / ร้อยละ</th>
  <th>เป้าหมาย</th>
  <th>ต่ำกว่าเป้าหมาย (ร้อยละ)</th>
  <th>จำนวนที่ต้อง<br />
แก้ไขทั้งหมด</th>
  <th width="60">&nbsp;</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($data as $item){
?>
<tr  <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?=$i;?></td>
  <td><?=$item['year_data'];?></td>
  <td><?=anchor('family/older/form/'.$item['id'], $item['province_name']);?></td>
  <td><?=number_format($item['pass'],2);?>/ <?=number_format($item['percentage'],2);?></td>
  <td><?=number_format($item['target'],0);?></td>
  <td><?=number_format($item['lower_target'],2);?></td>
  <td><?=number_format($item['edit'],2);?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<? if(menu::perm($menu_id, 'edit')): ?>
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='family/older/form/<?=$item['id'];?>'" />
  	<? endif;?>
  	<?php echo menu::perm($menu_id, 'delete', 'family/older/delete/'.$item['id']); ?>
    </td>
</tr>
<? $i++;} ?>
</table>
<?=$pagination;?>