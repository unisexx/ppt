<?php echo menu::source($menu_id); ?>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<form action="child/pregnant_save" method="post">
<?php endif; ?>
<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('year',get_year_option(),@$rs['year'],'','-- เลือกปี --'); ?></td>
</tr>
<tr>
  <th>เพศเด็ก<span class="Txt_red_12"> *</span></th>
  <td><span>
    <input type="radio" name="sex" id="radio4" value="1"  <?php echo  ($rs['sex']==1)? "checked='checked' ":''; ?> /> 
    ชาย
  </span> <span>
  <input type="radio" name="sex" id="radio5" value="2" <?php echo  ($rs['sex']==2)? "checked='checked' ":''; ?>  /> 
    หญิง
  </span></td>
</tr>
<tr>
  <th>น้ำหนักเด็ก<span class="Txt_red_12"> *</span></th>
  <td><input name="weight" type="text" id="textarea2" value="<?php echo $rs['weight'] ?>"  style="width:80px;" />
    กรัม</td>
</tr>
<tr>
  <th>วันเกิดเด็ก<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="birthday" type="text" id="textarea21" value="<?php echo $rs['birthday'] ?>"  style="width:80px;" class="datepicker" />
  </td>
</tr>
<tr>
  <th>รหัสโรงพยาบาล<span class="Txt_red_12"> *</span></th>
  <td><input name="hospital_code" type="text" id="textarea23" value="<?php echo $rs['hospital_code'] ?>"  style="width:70px;" /></td>
</tr>
<tr>
  <th>รหัสจังหวัด อำเภอ ตำบล หมู่ที่<span class="Txt_red_12"> *</span></th>
  <td><input name="address_code" type="text" id="textarea25" value="<?php echo $rs['address_code'] ?>"  style="width:70px;" /></td>
</tr>
<tr>
  <th>สถานที่เกิด<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="location" type="text" id="textarea10" value="<?php echo $rs['location'] ?>"  style="width:370px;" />
  </td>
</tr>
<tr>
  <th>วันเกิดมารดา</th>
  <td><input name="m_birthday" type="text" id="textarea3" value="<?php echo $rs['m_birthday'] ?>"  style="width:70px;" class="datepicker" /></td>
</tr>
<tr>
  <th>รหัสจังหวัด อำเภอ ตำบล หมู่ที่ ของมารดา</th>
  <td><input name="m_address_code" type="text" id="textarea4" value="<?php echo $rs['m_address_code'] ?>"  style="width:70px;" /></td>
</tr>
<tr>
  <th>เลขบัตรประชาชน ของบิดา</th>
  <td><input name="f_id" type="text" id="textarea" value="<?php echo $rs['f_id'] ?>"  style="width:120px;" /></td>
</tr>
<tr>
  <th>วันเกิดบิดา</th>
  <td><input name="f_birthday" type="text" id="textarea5" value="<?php echo $rs['f_birthday'] ?>"  style="width:70px;" class="datepicker"/></td>
</tr>
<tr>
  <th>รหัสจังหวัด อำเภอ ตำบล หมู่ที่ ของบิดา</th>
  <td><input name="f_address_code" type="text" id="textarea6" value="<?php echo $rs['f_address_code'] ?>"  style="width:70px;" /></td>
</tr>
</table>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<div id="btnSave">
    <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
</form>
<?php else: ?>
<div id="btnSave">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
<?php endif; ?>
