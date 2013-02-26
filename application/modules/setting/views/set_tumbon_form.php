<h2>ตั้งค่าข้อมูลหลัก > ตำบล (เพิ่ม/แก้ไข)</h2>
<form class="validate" method="post" action="setting/set_tumbon_save">
<table class="tbadd">
<tr>
  <th>จังหวัด  <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('province_id',get_option('id','province_name','province'),$tumbon['province_id'],'','-- เลือกจังหวัด --');?>
  </td>
</tr>
<tr>
  <th>อำเภอ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('amphor_id',get_option('id','amphor_name','amphor'),$tumbon['amphor_id'],'','-- เลือกอำเภอ --');?>
  </td>
</tr>
<tr>
  <th>ชื่อตำบล<span class="Txt_red_12"> *</span></th>
  <td><input name="tumbon_name" type="text" value="<?php echo $tumbon['tumbon_name']?>" size="40" /></td>
</tr>
</table>

<div id="btnSave">
	<input type="hidden" value="<?php echo $tumbon['id']?>">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>