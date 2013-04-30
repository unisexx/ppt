<?php echo menu::source($menu_id); ?>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<?php echo form_open('offender/offender_form'); ?>
<?php endif; ?>

<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('offender_year', get_year_option(2555), $rs['offender_year']); ?></td>
</tr>
<tr>
  <th>ป่วยทางจิต<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_mental', $rs['offender_mental']); ?>
    คดี</td>
</tr>
<tr>
  <th>ทะเลาะวิวาท<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_wrangle', $rs['offender_wrangle']); ?>
    คดี</td>
</tr>
<tr>
  <th>สภาพทางเศรษฐกิจ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_social', $rs['offender_social']); ?>
    คดี</td>
</tr>
<tr>
  <th>ผู้อื่นชักจูง/บังคับ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_force', $rs['offender_force']); ?>
    คดี</td>
</tr>
<tr>
  <th>สภาพครอบครัว<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_family', $rs['offender_family']); ?>
    คดี</td>
</tr>
<tr>
  <th>การคบเพื่อน<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_friend', $rs['offender_friend']); ?>
    คดี</td>
</tr>
<tr>
  <th>ความรู้เท่าไม่ถึงการณ์</th>
  <td><?php echo form_input('offender_unknow', $rs['offender_unknow']); ?>
    คดี</td>
</tr>
<tr>
  <th>คึกคะนอง<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_fight', $rs['offender_fight']); ?>
    คดี</td>
</tr>
<tr>
  <th>อื่น ๆ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offender_etc', $rs['offender_etc']); ?>
    คดี</td>
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
