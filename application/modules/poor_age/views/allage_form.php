<h2>ข้อมูลกลุ่มเป้าหมาย - ผู้ด้อยโอกาส (เพิ่ม/แก้ไข)</h2>
<h4>คนยากจน (กลุ่มอายุ) <span class="gray">แบบ สคช. คนยากจน (กลุ่มวัย)</span></h4>

<?php echo form_open('poor_age/allage_form'); ?>


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

<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
    <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>

