<h2>ข้อมูลประเด็น - คนต่างด้าวที่ได้รับอนุญาติทำงาน    (เพิ่ม/แก้ไข)</h2>
<h4>คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร <span class="gray"></span></h4>


<?php echo form_open('alien/alien_form'); ?>


<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('alien_year', get_year_option(2550), $rs['alien_year']); ?></td>
</tr>
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td> 
    <?php echo form_dropdown('alien_province', get_option('id', 'province', 'provinces', '1=1 order by province'), $rs['alien_province'], null, '- เลือกจังหวัด -'); ?> &gt; 
    </td>
</tr>
<tr>
  <th>รวมทั้งสิ้น<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('alien_sum', $rs['alien_sum']); ?></td>
</tr>
<tr>
  <th>ชาย</th>
  <td><?php echo form_input('alien_male', $rs['alien_male']); ?></td>
</tr>
<tr>
  <th>หญิง</th>
  <td><?php echo form_input('alien_female', $rs['alien_female']); ?></td>
</tr>
<tr>
  <th>รวม ต่างด้าวเข้าเมืองถูกกฎหมาย</th>
  <td><?php echo form_input('alien_sum_in', $rs['alien_sum_in']); ?></td>
</tr>
<tr>
  <th>รวม ต่างด้าวเข้าเมืองผิดกฎหมาย</th>
  <td><?php echo form_input('alien_sum_out', $rs['alien_sum_out']); ?></td>
</tr>
</table>

<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
  <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
