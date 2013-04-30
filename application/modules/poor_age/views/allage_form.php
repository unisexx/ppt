<?php echo menu::source($menu_id); ?>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<?php echo form_open('poor_age/allage_form'); ?>
<?php endif; ?>

<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td>
		<?php echo form_dropdown('year', get_year_option(2555), $rs['year']); ?>
  </td>
</tr>
<tr>
  <th colspan="2" class="title">เขตเมือง</th>
</tr>
<tr>
  <th>วัยเด็ก (&lt; 15 ปี) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('township_child', $rs['township_child']); ?>
พันคน</td>
</tr>
<tr>
  <th>วัยแรงงาน (15-59 ปี) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('township_work', $rs['township_work']); ?>
    พันคน</td>
</tr>
<tr>
  <th>ผู้สูงอายุ (60 ปี+) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('township_elderly', $rs['township_elderly']); ?>
    พันคน</td>
</tr>
<tr>
  <th colspan="2" class="title">เขตชนบท</th>
</tr>
<tr>
  <th>วัยเด็ก (&lt; 15 ปี) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('rural_area_child', $rs['rural_area_child']); ?>
    พันคน</td>
</tr>
<tr>
  <th>วัยแรงงาน (15-59 ปี) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('rural_area_work', $rs['rural_area_work']); ?>
    พันคน</td>
</tr>
<tr>
  <th>ผู้สูงอายุ (60 ปี+) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('rural_area_elderly', $rs['rural_area_elderly']); ?>
    พันคน</td>
</tr>
<tr>
  <th colspan="2" class="title">ทั่วประเทศ</th>
</tr>
<tr>
  <th>วัยเด็ก (&lt; 15 ปี) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('country_child', $rs['country_child']); ?>
    พันคน</td>
</tr>
<tr>
  <th>วัยแรงงาน (15-59 ปี) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('country_work', $rs['country_work']); ?>
    พันคน</td>
</tr>
<tr>
  <th>ผู้สูงอายุ (60 ปี+) <span class="Txt_red_12">*</span></th>
  <td><?php echo form_input('country_elderly', $rs['country_elderly']); ?>
    พันคน</td>
</tr>
</table>

<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
    <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
</form>
<?php else: ?>
<div id="btnSave">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
<?php endif; ?>

