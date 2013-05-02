<h2>ตั้งค่าข้อมูลหลัก > อำเภอ (เพิ่ม/แก้ไข)</h2>
<form class="validate" method="post" action="setting/set_amphor_save">
<table class="tbadd">
<tr>
  <th>จังหวัด  <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$amphor['province_id'], null, '-- ทุกจังหวัด --'); ?>
  </td>
</tr>
<tr>
  <th>ชื่ออำเภอ<span class="Txt_red_12"> *</span></th>
  <td><input name="amphur_name" type="text" value="<?php echo $amphor['amphur_name']?>" size="40" /></td>
</tr>
</table>

<div id="btnSave">
	<input type="hidden" name="id" value="<?php echo $amphor['id']?>">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>