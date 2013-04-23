<h2>ตั้งค่าข้อมูลหลัก > ตำบล (เพิ่ม/แก้ไข)</h2>
<form class="validate" method="post" action="setting/set_tumbon_save">
<table class="tbadd">
<tr>
  <th>จังหวัด  <span class="Txt_red_12">*</span></th>
  <td>
  	 <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), $rs['province_id'], null, '- เลือกจังหวัด -'); ?>
  </td>
</tr>
<tr>
  <th>อำเภอ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?php echo form_dropdown('amphur_id', (empty($rs['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$rs['province_id'].' order by amphur_name'), $rs['amphur_id'], null, '- เลือกอำเภอ -'); ?>
  </td>
</tr>
<tr>
  <th>ชื่อตำบล<span class="Txt_red_12"> *</span></th>
  <td><input name="district_name" type="text" value="<?php echo $rs['district_name']?>" size="40" /></td>
</tr>
</table>

<div id="btnSave">
	<input type="hidden" value="<?php echo $rs['id']?>">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>