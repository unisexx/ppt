<h2>ข้อมูลกลุ่มเป้าหมาย - ผู้ด้อยโอกาส (เพิ่ม/แก้ไข)</h2>
<h4>คนยากจน (จังหวัด) <span class="gray">แบบ สคช. คนยากจน (จังหวัด)</span></h4>


<?php echo form_open('poor_province/province_form'); ?>


<table class="tbadd">
<!--<tr>
  <th>เพศ *</th>
  <td><?php echo form_input('poor_province_sex', $rs['poor_province_sex']); ?></td>
</tr>-->
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('poor_province_year', get_year_option(2549), $rs['poor_province_year']); ?></td>
</tr>
<tr>
  <th>จังหวัด<span class="Txt_red_12"> *</span></th>
  <td> 
    <?php echo form_dropdown('poor_province_province', get_option('id', 'province', 'provinces', '1=1 order by province'), $rs['poor_province_province'], null, '- เลือกจังหวัด -'); ?></td>
</tr>
<tr>
  <th>เส้นความยากจน (บาท/คน/เดือน)<span class="Txt_red_12"> *</span></th>
  <td><?php echo form_input('poor_province_line', $rs['poor_province_line']); ?></td>
</tr>
<tr>
  <th>สัดส่วนคนจน (ร้อยละ)</th>
  <td><?php echo form_input('poor_province_percent', $rs['poor_province_percent']); ?></td>
</tr>
<tr>
  <th>จำนวนคนจน</th>
  <td><?php echo form_input('poor_province_qty', $rs['poor_province_qty']); ?>   พันคน</td>
</tr>
</table>

<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
  <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>