<h2>ผู้ใช้งาน (เพิ่ม/แก้ไข)</h2>

<form class="validate" method="post" action="setting/user_save">
<table class="tbadd">
<tr>
  <th>สิทธิ์การใช้งาน  <span class="Txt_red_12">*</span></th>
  <td><select name="user_type_id">
    <option value="">เลือกสิทธิ์การใช้งาน</option>
    <option value="1">Super Admin</option>
    <option value="2">Admin (ศทส.)</option>
    <option value="3">Admin (คำของบประมาณ)</option>
    <option value="4">Director (คำของบประมาณ)</option>
    <option value="5">User (คำของบประมาณ)</option>
  </select></td>
</tr>
<tr>
  <th>ชื่อ - นามสกุล<span class="Txt_red_12"> *</span></th>
  <td><input name="fullname" type="text" value=""/></td>
</tr>
<tr>
  <th>Name <span class="Txt_red_12"> *</span></th>
  <td><input name="name" type="text" value=""/></td>
</tr>
<tr>
  <th>Surname <span class="Txt_red_12">*</span></th>
  <td><input name="surname" type="text" value=""/></td>
</tr>
<tr>
  <th>กรม  <span class="Txt_red_12">*</span></th>
  <td>
  	<select name="department_id">
    <option value="">เลือกกรม</option>
    <option value="1">สำนักงานรัฐมนตรี</option>
    <option value="2">สำนักงานปลัดกระทรวง</option>
    <option value="3">สำนักงานกิจการสตรีและสถานบันครอบครัว</option>
    <option value="4">กรมพัฒนาสังคมและสวัสดิการ</option>
    </select>
  </td>
</tr>
<tr>
  <th>กอง / สำนักงาน  <span class="Txt_red_12">*</span></th>
  <td><select name="division_id">
    <option value="">เลือกกอง/สำนักงาน</option>
    <option value="1">สำนักนโยบายและยุทธศาสตร์</option>
    <option value="2">สำนักมาตรฐานการพัฒนาสังคมและความมั่นคงของมนุษย์</option>
    <option value="3">สำนักบริหารงานกลาง</option>
    <option value="4">สำนักงานเลขานุการคณะกรรมการคุ้มครองเด็กแห่งชาติ</option>
    <option value="5">กลุ่มพัฒนาระบบบริหาร</option>
    <option value="6">สำนักงานเลขานุการป้องกันและปราบปรามการค้ามนุษย์</option>
    <option value="7">ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร</option>
  </select></td>
</tr>
<tr>
  <th>กลุ่ม / ฝ่าย   <span class="Txt_red_12">*</span></th>
  <td><select name="group_id">
    <option value="">เลือกกลุ่ม/ฝ่าย</option>
    <option value="1">111</option>
    <option value="2">222</option>
  </select></td>
</tr>
<tr>
  <th>ประเภทบุคลากร  <span class="Txt_red_12">*</span></th>
  <td><select name="person_type_id">
    <option value="">เลือกประเภทบุคลากร</option>
    <option value="1">ข้าราชการ</option>
    <option value="2">พนักงานราชการ</option>
    <option value="3">ลูกจ้างประจำ</option>
    <option value="4">ลูกจ้างชั่วคราว</option>
    <option value="5">พนักงานของรัฐ</option>
    </select></td>
</tr>
<tr>
  <th>บัตรประชาชน  <span class="Txt_red_12">*</span></th>
  <td><input name="id_card" type="text"/></td>
</tr>
<tr>
  <th>เบอร์ติดต่อ</th>
  <td><input name="contact_number" type="text" value="" /></td>
</tr>
<tr>
  <th>กลุ่มเป้าหมายที่รับผิดชอบ</th>
  <td>
  	<span style="margin-right:15px;">
		<input type="checkbox" name="target_response[]" value="เด็กและเยาวชน"/> เด็กและเยาวชน
		<input type="checkbox" name="target_response[]" value="สตรี"/> สตรี
		<input type="checkbox" name="target_response[]" value="ครอบครัว"/> ครอบครัว
		<input type="checkbox" name="target_response[]" value="ผู้ด้อยโอกาส"/> ผู้ด้อยโอกาส
		<input type="checkbox" name="target_response[]" value="คนพิการ"/> คนพิการ
		<input type="checkbox" name="target_response[]" value="ผู้สูงอายุ"/> ผู้สูงอายุ
		<input type="checkbox" name="target_response[]" value="อื่นๆ"/> อื่นๆ 
	</span>
  </td>
</tr>
<tr>
  <th>อีเมล์  <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="email" value="" /></td>
</tr>
<tr>
  <th>รหัสผ่าน <span class="Txt_red_12">*</span></th>
  <td><input id="password" type="text" name="password" value="" /></td>
</tr>
<tr>
  <th>ยืนยันรหัสผ่าน  <span class="Txt_red_12">*</span></th>
  <td><input type="password" name="_password" value="" /></td>
</tr>
</table>

<div id="btnSave">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>