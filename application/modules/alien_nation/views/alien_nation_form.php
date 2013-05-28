<h2>ข้อมูลประเด็น - คนต่างด้าวที่ได้รับอนุญาติทำงาน    (เพิ่ม/แก้ไข)</h2>
<h4>คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร จำแนกตามสัญชาติ <span class="gray"></span></h4>


<?php echo form_open('alien_nation/alien_nation_form'); ?>


<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('alien_year', get_year_option(2550), $rs['alien_year']); ?></td>
</tr>
<tr>
  <th>สัญชาติ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('alien_nation', $rs['alien_nation']); ?></td>
</tr>
<tr>
  <th>รวม ต่างด้าวเข้าเมืองถูกกฎหมาย</th>
  <td><?php echo form_input('alien_in', $rs['alien_in']); ?></td>
</tr>
<tr>
  <th>รวม ต่างด้าวเข้าเมืองผิดกฎหมาย</th>
  <td><?php echo form_input('alien_out', $rs['alien_out']); ?></td>
</tr>
</table>

<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
  <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
