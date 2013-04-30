<?php echo menu::source($menu_id); ?>

<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<?php echo form_open('offense/offense_form'); ?>
<?php endif; ?>
<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('offense_year', get_year_option(2555), $rs['offense_year']); ?></td>
</tr>
<tr>
  <th>เขตจังหวัด &gt; จังหวัด</th>
  <td>
  <?php echo form_dropdown('offense_aumphur', (empty($rs['offense_aumphur'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$rs['offense_aumphur'].' order by amphur_name'), $rs['offense_aumphur'], null, '- เลือกอำเภอ -'); ?>
    &gt; 
    <?php echo form_dropdown('offense_province', get_option('id', 'province', 'provinces', '1=1 order by province'), $rs['offense_province'], null, '- เลือกจังหวัด -'); ?> &gt; 
    </td>
</tr>
<tr>
  <th>ความผิดเกี่ยวกับทรัพย์<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_property', $rs['offense_property']); ?>
    ราย 
    </td>
</tr>
<tr>
  <th>ความผิดเกี่ยวกับชีวิตและร่างกาย<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_body', $rs['offense_body']); ?>
    ราย</td>
</tr>
<tr>
  <th>ความผิดเกี่ยวกับเพศ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_sex', $rs['offense_sex']); ?>
    ราย </td>
</tr>
<tr>
  <th>ความผิดเกี่ยวกับความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_dominance', $rs['offense_dominance']); ?>
    ราย </td>
</tr>
<tr>
  <th>ความผิดเกี่ยวกับยาเสพติดให้โทษ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_drug', $rs['offense_drug']); ?>
    ราย</td>
</tr>
<tr>
  <th>ความผิดเกี่ยวกับอาวุธและวัตถุระเบิด<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_weapon', $rs['offense_weapon']); ?>
    ราย</td>
</tr>
<tr>
  <th>ความผิดอื่น ๆ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('offense_etc', $rs['offense_etc']); ?>
    ราย</td>
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
<script>
    $(function(){
        $('[name=offense_aumphur]').chainedSelect({parent: '[name=offense_province]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>