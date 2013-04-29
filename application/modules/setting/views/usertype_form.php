<h2>สิทธิ์การใช้งาน (เพิ่ม/แก้ไข)</h2>
<form action="setting/usertype_save" method="post" >
<table class="tbadd">
<tr>
  <th>ชื่อสิทธิ์การใช้งาน <span class="TxtRed">*</span></th>
  <td><input name="user_type_name" type="text" style="width:300px;" class="alphaonly" value="<?php echo $usertype['user_type_name']?>" /></td>
</tr>
<tr>
  <th>ระดับ <span class="TxtRed">*</span></th>
  <td><input name="user_type_level" type="text" style="width:30px"; value="<?php echo $usertype['user_type_level']?>" /></td>
</tr>

<tr>
  <th colspan="2" style="font-weight:700; color:#333">ตั้งค่าข้อมูล</th>
</tr>

<?php foreach($module as $key => $item): ?>
	<tr>
		<th><?php echo $item['label']; ?></th>
		<td>
			<?php foreach($item['permission'] as $perm): ?>
			<span class="perm form-inline"><label class="checkbox"><input type="checkbox" name="<?php echo 'checkbox['.$key.']['.$perm.']'; ?>" value="1" <?php echo (@$rs_perm[$key][$perm]) ? 'checked' : ''; ?> ><?php echo @$crud[$perm]; ?></label></span>
			<?php endforeach; ?>
		</td>
	</tr>
<?php endforeach; ?>
	<tr>
		<th></th>
		<td></td>
	</tr
	<tr>
		<th colspan="2" style="font-weight:700; color:#333">ข้อมูลกลุ่มเป้าหมาย</th>
		<td></td>
	</tr>
<?php foreach($menus as $menu):?>
	<tr>
		<th><?php echo $menu['title']?></th>
		<td>
			<span class="perm form-inline"><label class="checkbox"><input type="checkbox" name="checkbox[<?php echo $menu['module_name']?>][view]" value="1">ดู</label></span>
			<span class="perm form-inline"><label class="checkbox"><input type="checkbox" name="checkbox[<?php echo $menu['module_name']?>][add]" value="1">เพิ่ม</label></span>
			<span class="perm form-inline"><label class="checkbox"><input type="checkbox" name="checkbox[<?php echo $menu['module_name']?>][edit]" value="1">แก้ไข</label></span>
			<span class="perm form-inline"><label class="checkbox"><input type="checkbox" name="checkbox[<?php echo $menu['module_name']?>][delete]" value="1">ลบ</label></span>
			<span class="perm form-inline"><label class="checkbox"><input type="checkbox" name="checkbox[<?php echo $menu['module_name']?>][import]" value="1">นำเข้าข้อมูล</label></span>
		</td>
	</tr>
<?php endforeach;?>

</table>

<div id="btnSave">
	<input type="hidden" name="user_type_id" value="<?php echo $usertype['id']?>">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>