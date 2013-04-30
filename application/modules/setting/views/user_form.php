<script type="text/javascript">
$(document).ready(function(){
		$('[name=division_id]').chainedSelect({parent: '[name=department_id]',url: 'setting/ajax_division',value: 'id',label: 'text'});
        
        $('[name=workgroup_id]').chainedSelect({parent: '[name=division_id]',url: 'setting/ajax_workgroup',value: 'id',label: 'text'});
        
});
</script>

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
	<th>สถานะ <span class="Txt_red_12">*</span></th>
	<td>
		<label class="radio inline">
			<input type="radio" name="status" value="0" <?php if($user['status'] == 0)echo"checked"?>> ปิดการใช้งาน
		</label>
		<label class="radio inline">
			<input type="radio" name="status" value="1" <?php if($user['status'] == 1)echo"checked"?>> เปิดการใช้งาาน
		</label>
	</td>
</tr>
<tr>
  <th>username<span class="Txt_red_12"> *</span></th>
  <td><input name="username" type="text" value="<?php echo $user['username']?>"/></td>
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
  <td class="division">
  	<?php echo form_dropdown('division_id', (empty($user['department_id'])) ? array() : get_option('id', 'division_name', 'division', 'department_id = '.$user['department_id'].' order by division_name'), @$user['division_id'], null, '- กอง / สำนักงาน -'); ?>
  </td>
</tr>
<tr>
  <th>กลุ่ม / ฝ่าย   <span class="Txt_red_12">*</span></th>
  <td class="workgroup">
  <?php echo form_dropdown('workgroup_id', (empty($user['division_id'])) ? array() : get_option('id', 'workgroup_name', 'workgroup', 'division_id = '.$user['division_id'].' order by workgroup_name'), $user['workgroup_id'], null, '- กลุ่ม / ฝ่าย -'); ?>
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