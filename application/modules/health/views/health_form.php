<h2>ผู้สงอายุ - การให้บริการหลักประกันสุขภาพ   (เพิ่ม/แก้ไข)</h2>
<h4>การให้บริการหลักประกันสุขภาพ<span class="gray"></span></h4>


<?php echo form_open('health/health_form'); ?>


<table class="tbadd">
<tr>
  <th>&nbsp;</th>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('health_year', get_year_option(2550), $rs['health_year']); ?></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <th>อายุ<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('health_age', $rs['health_age']); ?></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <th>จังหวัด</th>
  <td><?php echo form_input('health_province', $rs['health_province']); ?></td>
</tr>
<tr>
  <th rowspan="5">รวม</th>
  <th>จำนวนประชากร(คน)</th>
  <td>&nbsp;<?php echo form_input('health_sum_pop', $rs['health_sum_pop']); ?></td>
</tr>
<tr>
  <th>จำนวนผู้มีสิทธิหลักประกันสุขภาพ</th>
  <td>&nbsp;<?php echo form_input('health_sum_eli', $rs['health_sum_eli']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_sum_eli_percen', $rs['health_sum_eli_percen']); ?></td>
</tr>
<tr>
  <th>จำนวนผู็มีสิทธหลักประกนสุขภาพถ้วนหน้า</th>
  <td>&nbsp;<?php echo form_input('health_sum_acress', $rs['health_sum_acress']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_sum_acress_percen', $rs['health_sum_acress_percen']); ?></td>
</tr>
<tr>
  <th rowspan="5">ชาย</th>
  <th>จำนวนประชากร(คน)</th>
  <td>&nbsp;<?php echo form_input('health_male_pop', $rs['health_male_pop']); ?></td>
</tr>
<tr>
  <th>จำนวนผู้มีสิทธิหลักประกันสุขภาพ</th>
  <td>&nbsp;<?php echo form_input('health_male_eli', $rs['health_male_eli']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_male_eli_percen', $rs['health_male_eli_percen']); ?></td>
</tr>
<tr>
  <th>จำนวนผู็มีสิทธหลักประกนสุขภาพถ้วนหน้า</th>
  <td>&nbsp;<?php echo form_input('health_male_acress', $rs['health_male_acress']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_male_acress_percen', $rs['health_male_acress_percen']); ?></td>
</tr>
<tr>
  <th rowspan="5">หญิง</th>
  <th>จำนวนประชากร(คน)</th>
  <td>&nbsp;<?php echo form_input('health_female_pop', $rs['health_female_pop']); ?></td>
</tr>
<tr>
  <th>จำนวนผู้มีสิทธิหลักประกันสุขภาพ</th>
  <td>&nbsp;<?php echo form_input('health_female_eli', $rs['health_female_eli']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_female_eli_percen', $rs['health_female_eli_percen']); ?></td>
</tr>
<tr>
  <th>จำนวนผู็มีสิทธหลักประกนสุขภาพถ้วนหน้า</th>
  <td>&nbsp;<?php echo form_input('health_female_acress', $rs['health_female_acress']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_female_acress_percen', $rs['health_female_acress_percen']); ?></td>
</tr>
<tr>
  <th rowspan="5">อื่น ๆ</th>
  <th>จำนวนประชากร(คน)</th>
  <td>&nbsp;<?php echo form_input('health_etc_pop', $rs['health_etc_pop']); ?></td>
</tr>
<tr>
  <th>จำนวนผู้มีสิทธิหลักประกันสุขภาพ</th>
  <td>&nbsp;<?php echo form_input('health_etc_eli', $rs['health_etc_eli']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_etc_eli_percen', $rs['health_etc_eli_percen']); ?></td>
</tr>
<tr>
  <th>จำนวนผู็มีสิทธหลักประกนสุขภาพถ้วนหน้า</th>
  <td>&nbsp;<?php echo form_input('health_etc_acress', $rs['health_etc_acress']); ?></td>
</tr>
<tr>
  <th>ร้อยละ</th>
  <td>&nbsp;<?php echo form_input('health_etc_acress_percen', $rs['health_etc_acress_percen']); ?></td>
</tr>
</table>

<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
<input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
