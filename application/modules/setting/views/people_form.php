<h2>ประชากร</h2>
<form class="validate" method="post" action="setting/people/save">
<table class="tbadd">
<tr>
  <th>ชื่อ - นามสกุล <span class="Txt_red_12">*</span></th>
  <td><input type="text" name="name" value="<?php echo $people['name']?>"></td>
</tr>
<tr>
  <th>บัตรประชาชน</th>
  <td><input name="id_card" type="text" value="<?php echo $people['id_card']?>"/></td>
</tr>
<tr>
  <th>วันเกิด</th>
  <td><input name="birth" type="text"  size="10" class="datepicker" value="<?php echo ($people['birth']!=0)?@Oracle2ThaiDatePicker($people['birth']):""  ?>"/></td>
</tr>
</table>

<div id="btnSave">
	<input type="hidden" name="id" value="<?php echo $people['id']?>">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>