<h2>ข้อมูลพื้นฐาน - ทุนทางสังคม (เพิ่ม/แก้ไข)</h2>
<h4><?=get_menu_info($menu_id,'TITLE');?> <?php echo menu::source($menu_id); ?></h4>
<form method="post" enctype="multipart/form-data" action="population/save">
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
</table>

<div id="btnSave">
<input type="hidden" name="id" value="<?=$item['id'];?>">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>