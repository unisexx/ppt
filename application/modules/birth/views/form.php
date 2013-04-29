<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน (เพิ่ม/แก้ไข)</h2>
<h4>ข้อมูลการเกิด <span class="gray">แบบ กรมการปกครอง การเกิด</span></h4>
<form method="post" enctype="multipart/form-data" action="birth/save">
<table class="tbadd">
<tr>
  <th>ปี พ.ค.<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$item['year_data'], null, '-- ทุกปี --'); ?>
  </td>
</tr>
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$item['province_id'], null, '-- เลือกจังหวัด --'); ?>
  </td>
</tr>
<tr>
  <th>จำนวนการเกิด เพศชาย <span class="Txt_red_12"> *</span></th>
  <td><input name="birth_male" type="text" id="textarea21" value="<?=@$item['birth_male'];?>"  style="width:100px;" /></td>
</tr>
<tr>
  <th>จำนวนการเกิด เพศหญิง<span class="Txt_red_12"> *</span></th>
  <td><input name="birth_female" type="text" id="textarea23" value="<?=@$item['birth_female'];?>"  style="width:100px;" /></td>
</tr>
</table>

<div id="btnSave">
<input type="hidden" name="ID" value="<?=@$item['id'];?>">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>