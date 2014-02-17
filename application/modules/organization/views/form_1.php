<?php echo menu::source($menu_id); ?>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<form method="post" enctype="multipart/form-data" action="population/save">
<?php endif; ?>
<table class="tbadd">
<tr>
  <th>ประเภทหน่วยงาน<span class="Txt_red_12">  *</span></th>
  <td>
    <?php echo form_dropdown('under_type', get_option('id', 'title', 'organization_type', '1=1 order by id'), @$item['under_type'], null, '-- ประเภทหน่วยงาน --'); ?>
    <?php echo form_dropdown('under_type_sub', (empty($item['under_type'])) ? array() : get_option('id', 'title', 'organization_type_sub', 'type_id = '.@$item['under_type'].' order by id '), @$item['under_type_sub'], null, '-- เลือกประเภทหน่วยงานรอง --'); ?>
    </td>
</tr>
<tr>
  <th>ทะเบียนเลขที่ <span class="Txt_red_12">*</span></th>
  <td><input name="organ_no" type="text" id="textarea13" value="<?=$item['organ_no'];?>" style="width:150px;" /></td>
</tr>
<tr>
  <th>ชื่อหน่วยงาน (ภาษาไทย) <span class="Txt_red_12">*</span></th>
  <td><input name="organ_name" type="text" id="textarea13" value="<?=$item['organ_name'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>ชื่อหน่วยงาน (ภาษาอังกฤษ) <span class="Txt_red_12">*</span></th>
  <td><input name="organ_name_eng" type="text" id="textarea11" value="<?=$item['organ_name_eng'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>ชื่อหน่วยงาน (ภาษาอังกฤษ) <span class="Txt_red_12">*</span></th>
  <td><input name="organ_name_eng" type="text" id="textarea11" value="<?=$item['organ_name_eng'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>สังกัด  <span class="Txt_red_12">*</span></th>
  <td><input name="under_name" type="text" id="textarea13" value="<?=$item['under_name'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>กระทรวง (ภาษาอังกฤษ) <span class="Txt_red_12">*</span></th>
  <td><input name="ministry_name" type="text" id="textarea11" value="<?=$item['ministry_name'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>หน่วยงานในสังกัด <span class="Txt_red_12">*</span></th>
  <td><input name="organ_inside" type="text" id="textarea11" value="<?=$item['organ_inside'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>วัน/เดือน/ปี ที่ก่อตั้ง <span class="Txt_red_12">*</span></th>
  <td><input name="establish_date" type="text" class="datepicker" id="textarea11" value="<?=$item['establish_date'];?>" style="width:100px;" /></td>
</tr>
<tr>
  <th>สถานที่ตั้ง / สถานที่ติดต่อ <span class="Txt_red_12">*</span></th>
  <td></td>
</tr>
<tr>
  <th>โทรศัพท์<span class="Txt_red_12">*</span></th>
  <td><input name="tel" type="text" id="textarea11" value="<?=$item['tel'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>โทรสาร <span class="Txt_red_12">*</span></th>
  <td><input name="fax" type="text" id="textarea11" value="<?=$item['fax'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>อีเมล์<span class="Txt_red_12">*</span></th>
  <td><input name="email" type="text" id="textarea11" value="<?=$item['email'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>เว็บไซต์ <span class="Txt_red_12">*</span></th>
  <td><input name="website" type="text" id="textarea11" value="<?=$item['website'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>ผู้บริหารองค์กร <span class="Txt_red_12">*</span></th>
  <td><input name="website" type="text" id="textarea11" value="<?=$item['website'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>ผู้ประสานงาน <span class="Txt_red_12">*</span></th>
  <td><input name="website" type="text" id="textarea11" value="<?=$item['website'];?>" style="width:350px;" /></td>
</tr>
<tr>
  <th>สถานที่ตั้ง/สถานที่ติดต่อผู้ประสานงาน <span class="Txt_red_12">*</span></th>
  <td></td>
</tr>
<tr>
  <th>โทรศัพท์ ผู้ประสานงาน<span class="Txt_red_12">*</span></th>
  <td></td>
</tr>
<tr>
  <th>FAX ผู้ประสานงาน<span class="Txt_red_12">*</span></th>
  <td></td>
</tr>
<tr>
  <th>โทรศัพท์มือถือ ผู้ประสานงาน <span class="Txt_red_12">*</span></th>
  <td></td>
</tr>
<tr>
  <th>อีเมล์ ผู้ประสานงาน <span class="Txt_red_12">*</span></th>
  <td></td>
</tr>
<tr>
  <th>จำนวนบุคลากร <span class="Txt_red_12">*</span></th>
  <td>คน</td>
</tr>
<tr>
  <th>จำนวนนักสังคมสงเคราะห์<span class="Txt_red_12">*</span></th>
  <td>คน</td>
</tr>
<tr>
  <th>จำนวนอาสาสมัคร <span class="Txt_red_12">*</span></th>
  <td>ไม่มี    มี  คน</td>
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

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>