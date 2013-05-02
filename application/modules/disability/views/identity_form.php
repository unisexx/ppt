<!--<h2>ข้อมูลกลุ่มเป้าหมาย1 - คนพิการ (เพิ่ม/แก้ไข)</h2>
<h4>คนพิการที่มีบัตรประจำตัวคนพิการ <span class="gray">แบบ nep บัตรคนพิการ</span></h4>-->
<?php echo menu::source($menu_id); ?>
<form action="disability/identity_save" method="post">
<table class="tbadd">
<tr>
  <th>ข้อมูลตั้งแต่วันที่</th>
  <td>
  	<input name="s_date" type="text" id="s_date"  style="width:80px;" value="<?php echo (!empty($rs['s_date']))? Date2DB($rs['s_date']):'' ?>" class="datepicker" /> -
	<input name="e_date" type="text" id="e_date"  style="width:80px;" value="<?php echo (!empty($rs['e_date'])) ? Date2DB($rs['e_date']):'' ?>" class="datepicker"/></td>
</tr>
<tr>
  <th>กรุงเทพมหานคร <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="bkk_male" type="text" id="textarea15" value="<?php echo @$rs['bkk_male'] ?>"  style="width:50px;" />
    /
    หญิง
  <input name="bkk_female" type="text" id="textarea16" value="<?php echo @$rs['bkk_female'] ?>"  style="width:50px;" />
    ราย</td>
</tr>
<tr>
  <th>ภาคกลางและภาคตะวันออก <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="ce_male" type="text" id="textarea" value="<?php echo @$rs['ce_male'] ?>"  style="width:50px;" />
/
  หญิง
<input name="ce_female" type="text" id="textarea2" value="<?php echo @$rs['ce_female'] ?>"  style="width:50px;" />
ราย</td>
</tr>
<tr>
  <th>ภาคตะวันออกเฉียงเหนือ <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="ne_male" type="text" id="textarea5" value="<?php echo @$rs['ne_male'] ?>"  style="width:50px;" />
/
  หญิง
<input name="ne_female" type="text" id="textarea17" value="<?php echo @$rs['ne_female'] ?>"  style="width:50px;" />
ราย</td>
</tr>
<tr>
  <th>ภาคใต้ <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="s_male" type="text" id="textarea6" value="<?php echo @$rs['s_male'] ?>"  style="width:50px;" />
    /
    หญิง
    <input name="s_female" type="text" id="textarea8" value="<?php echo @$rs['s_female'] ?>"  style="width:50px;" />
    ราย</td>
</tr>
<tr>
  <th>ภาคเหนือ<span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="n_male" type="text" id="textarea3" value="<?php echo @$rs['n_male'] ?>"  style="width:50px;" />
    /
    หญิง
    <input name="n_female" type="text" id="textarea4" value="<?php echo @$rs['n_female'] ?>"  style="width:50px;" />
    ราย</td>
</tr>
<tr>
  <th>ไม่ระบุ <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="i_male" type="text" id="textarea7" value="<?php echo @$rs['i_male'] ?>"  style="width:50px;" />
    /
    หญิง
    <input name="i_female" type="text" id="textarea9" value="<?php echo @$rs['i_female'] ?>"  style="width:50px;" />
    ราย</td>
</tr>
</table>
<?php
echo form_hidden('id',@$rs['id']);
 echo (!empty($rs['id']))? form_hidden('update',date('Y-m-d')):form_hidden('create',date('Y-m-d')); ?>
<div id="btnSave">
<?php  if(menu::perm($menu_id, 'add')): ?>	
<input type="submit" value="บันทึก" class="btn btn-danger"><?php endif; ?>
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>