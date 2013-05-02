<?php echo menu::source($menu_id); ?>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<form method="post" enctype="multipart/form-data" action="family/older/save">
<?php endif; ?>
<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$item['year_data'], null, '-- ทุกปี --'); ?></td>
</tr>
<tr>
  <th>จังหวัด <span class="Txt_red_12"> *</span></th>
  <td><?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$item['province_id'], null, '-- ทุกจังหวัด --'); ?></td>
</tr>
<tr>
  <th>ผ่านเกณฑ์ / ร้อยละ <span class="Txt_red_12">*</span></th>
  <td><input name="pass" type="text" id="textarea2" value="<?=number_format(@$item['pass'],2);?>"  style="width:70px;text-align: right;" />
    /
    <input name="percentage" type="text" id="textarea7" value="<?=@number_format(@$item['percentage'],2);?>"  style="width:50px;text-align: right;" /></td>
</tr>
<tr>
  <th>เป้าหมาย<span class="Txt_red_12"> *</span></th>
  <td><input name="target" type="text" id="textarea21" value="<?=number_format(@$item['target'],0);?>"  style="width:70px;text-align: right;" /></td>
</tr>
<tr>
  <th>ต่ำกว่าเป้าหมาย (ร้อยละ)</th>
  <td><input name="lower_target" type="text" id="textarea" value="<?=number_format(@$item['lower_target'],2);?>"  style="width:50px;text-align: right;" /></td>
</tr>
<tr>
  <th>จำนวนที่ต้อง<br />
    แก้ไขทั้งหมด</th>
  <td><input name="edit" type="text" id="textarea25" value="<?=number_format(@$item['edit'],2);?>"  style="width:70px;text-align: right;" /></td>
</tr>
</table>

<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<div id="btnSave">
    <?php echo form_hidden('id', $item['id']); ?>
    <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
</form>
<?php else: ?>
<div id="btnSave">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
<?php endif; ?>