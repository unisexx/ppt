<h2>ตั้งค่าข้อมูลหลัก > จังหวัด (เพิ่ม/แก้ไข)</h2>

<form class="validate" method="post" action="setting/set_province_save">
<table class="tbadd">
<tr>
  <th>ชื่อจังหวัด<span class="Txt_red_12"> *</span></th>
  <td><input name="province" type="text" id="textarea7" value="<?php echo $province['province']?>" size="40" /></td>
</tr>
</table>

<div id="btnSave">
<input type="hidden" name="id" value="<?php echo $province['id']?>">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>