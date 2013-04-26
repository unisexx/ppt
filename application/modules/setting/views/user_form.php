<h2>ผู้ใช้งาน (เพิ่ม/แก้ไข)</h2>

<form class="validate" method="post" action="setting/user_save">
<table class="tbadd">
<tr>
  <th>สิทธิ์การใช้งาน  <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('user_type_id', get_option('id', 'user_type_name', 'user_type'), $user['user_type_id'], null, '- เลือกสิทธิ์การใช้งาน -'); ?>
  </td>
</tr>
<tr>
  <th>ชื่อ - นามสกุล<span class="Txt_red_12"> *</span></th>
  <td><input name="fullname" type="text" value="<?php echo $user['fullname']?>"/></td>
</tr>
<tr>
  <th>Name <span class="Txt_red_12"> *</span></th>
  <td><input name="name" type="text" value="<?php echo $user['name']?>"/></td>
</tr>
<tr>
  <th>Surname <span class="Txt_red_12">*</span></th>
  <td><input name="surname" type="text" value="<?php echo $user['surname']?>"/></td>
</tr>
<tr>
  <th>กรม  <span class="Txt_red_12">*</span></th>
  <td>
    <?php echo form_dropdown('department_id', get_option('id', 'department_name', 'department'), $user['department_id'], null, '- เลือกกรม -'); ?>
  </td>
</tr>
<tr>
  <th>กอง / สำนักงาน  <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('division_id', get_option('id', 'division_name', 'division'), $user['division_id'], null, '- กอง / สำนักงาน -'); ?>
  </td>
</tr>
<tr>
  <th>กลุ่ม / ฝ่าย   <span class="Txt_red_12">*</span></th>
  <td>
  <?php echo form_dropdown('group_id', get_option('id', 'group_name', 'groups'), $user['group_id'], null, '- กลุ่ม / ฝ่าย -'); ?>
  </td>
</tr>
<tr>
  <th>ประเภทบุคลากร  <span class="Txt_red_12">*</span></th>
  <td>
    <?php echo form_dropdown('person_type_id', get_option('id', 'person_type_name', 'person_type'), $user['person_type_id'], null, '- เลือกประเภทบุคลากร -'); ?>
  </td>
</tr>
<tr>
  <th>บัตรประชาชน  <span class="Txt_red_12">*</span></th>
  <td><input name="id_card" type="text" value="<?php echo $user['id_card']?>"/></td>
</tr>
<tr>
  <th>เบอร์ติดต่อ</th>
  <td><input name="contact_number" type="text" value="<?php echo $user['contact_number']?>" /></td>
</tr>
<tr>
  <th>กลุ่มเป้าหมายที่รับผิดชอบ</th>
  <td>
  	<span style="margin-right:15px;">
  		<?php $arr_target_response = explode(",", $user['target_response']);?>
		<input type="checkbox" name="target_response[]" value="เด็กและเยาวชน" <?php if(in_array('เด็กและเยาวชน', $arr_target_response)) echo 'checked="checked"'; ?>/> เด็กและเยาวชน
		<input type="checkbox" name="target_response[]" value="สตรี" <?php if(in_array('สตรี', $arr_target_response)) echo 'checked="checked"'; ?>/> สตรี
		<input type="checkbox" name="target_response[]" value="ครอบครัว" <?php if(in_array('ครอบครัว', $arr_target_response)) echo 'checked="checked"'; ?>/> ครอบครัว
		<input type="checkbox" name="target_response[]" value="ผู้ด้อยโอกาส" <?php if(in_array('ผู้ด้อยโอกาส', $arr_target_response)) echo 'checked="checked"'; ?>/> ผู้ด้อยโอกาส
		<input type="checkbox" name="target_response[]" value="คนพิการ" <?php if(in_array('คนพิการ', $arr_target_response)) echo 'checked="checked"'; ?>/> คนพิการ
		<input type="checkbox" name="target_response[]" value="ผู้สูงอายุ" <?php if(in_array('ผู้สูงอายุ', $arr_target_response)) echo 'checked="checked"'; ?>/> ผู้สูงอายุ
		<input type="checkbox" name="target_response[]" value="อื่นๆ" <?php if(in_array('อื่นๆ', $arr_target_response)) echo 'checked="checked"'; ?>/> อื่นๆ 
	</span>
  </td>
</tr>
<tr>
  <th>อีเมล์  <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="email" value="<?php echo $user['email']?>" /></td>
</tr>
<tr>
  <th>รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><input id="password" type="text" name="password" value="<?php echo $user['password']?>" /></td>
</tr>
<tr>
  <th>ยืนยันรหัสผ่าน  <span class="Txt_red_12">*</span></th>
  <td><input type="password" name="_password" value="" /></td>
</tr>
</table>

<div id="btnSave">
<input type="hidden" name="id" value="<?php echo $user['id']?>">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>