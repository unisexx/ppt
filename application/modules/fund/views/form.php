<h2>ข้อมูลพื้นฐาน - ทุนทางสังคม (เพิ่ม/แก้ไข)</h2>
<h4>กองทุนสวัสดิการชุมชน</h4>
<form method="post" enctype="multipart/form-data" action="fund/save">
<table class="tbadd">
<tr>
  <th>รหัสกองทุน<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="org_id" type="text" id="org_id" value="<?=@$item['org_id'];?>" />
  </td>
</tr>
<tr>
  <th>ชื่อกองทุน<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="fund_name" type="text" id="fund_name" value="<?=@$item['fund_name'];?>" style="width:500px;" />
  </td>
</tr>
<tr>
  <th>วันที่ก่อตั้ง<span class="Txt_red_12"> *</span></th>
  <td>
  	<input name="org_create_date" type="text" id="org_create_date" value="<?=@$item['org_create_date'];?>" class="datepicker" />
  </td>
</tr>
<tr>
  <th>ชื่อผู้ติดต่อ <span class="Txt_red_12">*</span></th>
  <td>
  	<input name="contact_int" type="text" id="contact_int" value="<?=@$item['contact_int'];?>" style="width:80px;" />
  	<input name="contact_name" type="text" id="contact_name" value="<?=@$item['contact_name'];?>" style="width:200px;" />
  	<input name="contact_lastname" type="text" id="contact_lastname" value="<?=@$item['contact_lastname'];?>" style="width:200px;" />
  </td>
</tr>
<tr>
  <th>ที่อยู่สำหรับติดต่อ <span class="Txt_red_12">*</span></th>
  <td>
  	เลขที่<input name="contact_add_no" type="text" id="contact_add_no" value="<?=@$item['contact_add_no'];?>" style="width:80px;" />
  	หมู่ที่<input name="contact_add_moo" type="text" id="contact_add_moo" value="<?=@$item['contact_add_moo'];?>" style="width:80px;" />
  	ถนน<input name="contact_add_road" type="text" id="contact_add_road" value="<?=@$item['contact_add_road'];?>" style="width:150px;" />
  </td>
</tr>
<tr>
  <th>จังหวัด &gt; เขต/อำเภอ &gt; แขวง/ตำบล<span class="Txt_red_12">  *</span></th>
  <td>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$item['contact_province_id'], null, '-- เลือกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($item['contact_province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$item['contact_province_id'].' order by amphur_name'), @$item['contact_amphur_id'], null, '-- เลือกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($item['contact_amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$item['contact_amphur_id'].' order by district_name'), @$item['contact_tumbon_id'], null, '-- เลือกตำบล --'); ?>
    </td>
</tr>
<tr>
  <th>รหัสไปรษณีย์ <span class="Txt_red_12">*</span></th>
  <td>
  	<input name="contact_add_postcode" type="text" id="contact_add_postcode" value="<?=@$item['contact_add_postcode'];?>" style="width:80px;" />
  </td>
</tr>
<tr>
  <th>เบอร์โทรศัพท์<span class="Txt_red_12"> *</span></th>
  <td><input name="contact_add_tel" type="text" id="contact_add_tel" value="<?=@$item['contact_add_tel'];?>"  style="width:350px;" /></td>
</tr>
<tr>
  <th>เบอร์โทรสาร<span class="Txt_red_12"> *</span></th>
  <td><input name="contact_add_fax" type="text" id="contact_add_fax" value="<?=@$item['contact_add_fax'];?>"  style="width:100px;" /></td>
</tr>
<tr>
  <th>จำนวนสมาชิก<span class="Txt_red_12"> *</span></th>
  <td><input name="cur_member_no" type="text" id="cur_member_no" value="<?=@number_format($item['cur_member_no']);?>"  style="width:100px;text-align:right;" /> คน</td>
</tr>
<tr>
  <th>จำนวนเงิน<span class="Txt_red_12"> *</span></th>
  <td><input name="cur_amount" type="text" id="cur_amount" value="<?=@number_format($item['cur_amount']);?>"  style="width:100px;text-align:right;" /> บาท</td>
</tr>
</table>

<div id="btnSave">
<input type="hidden" name="ID" value="<?=@$item['id'];?>">
<? if(menu::perm($menu_id, 'add')): ?>
<input type="submit" value="บันทึก" class="btn btn-danger">
<? endif;?>
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>