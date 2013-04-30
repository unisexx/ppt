<h2>ตั้งค่าข้อมูลหลัก - หน่วยงานสนับสนุน (เพิ่ม/แก้ไข)</h2>
<form method="post" enctype="multipart/form-data" action="setting/support_section/save">
<table class="tbadd">

<tr>
  <th>ชื่อหน่วยงานสนับสนุน <span class="Txt_red_12"> *</span></th>
  <td><input name="title" type="text" id="textarea21" value="<?=@$item['title'];?>"  style="width:350px;" /></td>
</tr>
<tr>
  <th>ที่อยู่ <span class="Txt_red_12"> *</span></th>
  <td><input name="address" type="text" id="textarea21" value="<?=@$item['address'];?>"  style="width:350px;" /></td>
</tr>
<tr>
  <th>จังหวัด &gt; เขต/อำเภอ &gt; แขวง/ตำบล<span class="Txt_red_12">  *</span></th>
  <td>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$item['province_id'], null, '-- เลือกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($item['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$item['province_id'].' order by amphur_name'), @$item['amphur_id'], null, '-- เลือกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($item['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$item['amphur_id'].' order by district_name'), @$item['district_id'], null, '-- เลือกตำบล --'); ?>
    </td>
</tr>
<tr>
  <th>รหัสไปรษณีย์ <span class="Txt_red_12"> *</span></th>
  <td><input name="postcode" type="text" id="textarea21" value="<?=@$item['postcode'];?>"  style="width:350px;" /></td>
</tr>
<tr>
  <th>เบอร์โทรศัพท์ <span class="Txt_red_12"> *</span></th>
  <td><input name="tel" type="text" id="textarea21" value="<?=@$item['tel'];?>"  style="width:350px;" /></td>
</tr>
<tr>
  <th>เบอร์โทรสาร <span class="Txt_red_12"> *</span></th>
  <td><input name="fax" type="text" id="textarea21" value="<?=@$item['fax'];?>"  style="width:350px;" /></td>
</tr>

</table>

<div id="btnSave">
<input type="hidden" name="ID" value="<?=@$item['id'];?>">
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