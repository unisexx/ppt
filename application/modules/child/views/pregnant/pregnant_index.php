<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='child/pregnant_delete/'+hdid;
			}
		})
	})
</script>
<?php echo menu::source($menu_id); ?>
<div id="search">
  <div id="searchBox">
  	<form action="child/pregnant" method="get">
	    โรงพยาบาล
	      <input type="text" name="location" id="textfield" style="width:250px;"  value="<?php echo @$_GET['location']; ?>"/>
	    <?php echo form_dropdown('year',get_year_option(null, null, 'c_pregnant', 'year'),@$_GET['year'],'','-- ทุกปี --'); ?>
	    <select name="sex" id="select">
	      <option value="">-- ทุกเพศ --</option>
	      <option value="1" <?php echo  (@$_GET['sex']==1)? "checked='checked' ":''; ?>>ชาย</option>
	       <option value="2" <?php echo  (@$_GET['sex']==2)? "checked='checked' ":''; ?>>หญิง</option>
	    </select>
		<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
	</form>
	</div>
</div>

<div id="btnBox">
	<?php  if(menu::perm($menu_id, 'import')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='child/pregnant_import'" class="btn_import"/><?php endif;?>
	<?php  if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='child/pregnant_form'" class="btn_add"/><?php endif;?>
</div>

<?php echo $pagination; ?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>เพศเด็ก</th>
  <th>รหัสโรงพยาบาล</th>
  <th>สถานที่เกิด</th>
  <th width="180">เลขบัตรประชาชน ของบิดา</th>
    <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
</tr>
<?php 
 $sex =array(1=>'ชาย',2=>'หญิง');
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td onclick="window.location='child/pregnant_form/<?php echo $item['id'] ?>'"><?php echo $i; ?></td>
  <td onclick="window.location='child/pregnant_form/<?php echo $item['id'] ?>'"><?php echo $item['year'] ?></td>
  <td onclick="window.location='child/pregnant_form/<?php echo $item['id'] ?>'"><?php echo $sex[$item['sex']] ?></td>
  <td onclick="window.location='child/pregnant_form/<?php echo $item['id'] ?>'"><?php echo $item['hospital_code'] ?></td>
  <td onclick="window.location='child/pregnant_form/<?php echo $item['id'] ?>'"><?php echo $item['location'] ?></td>
  <td><?php echo anchor('child/pregnant_form/'.$item['id'], $item['f_id']); ?></td>
  <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?php echo $item['id'];?>">
  	 <?php  if(menu::perm($menu_id, 'edit')): ?>
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='child/pregnant_form/<?php echo $item['id'] ?>'" /><?php endif; ?>
     <?php  if(menu::perm($menu_id, 'delete')): ?>
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /><?php endif; ?>
  </td>
  <?php endif; ?>
</tr>
<?php ++$i;endforeach; ?>
</table>
<?php echo $pagination; ?>