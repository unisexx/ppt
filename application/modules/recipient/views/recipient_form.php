<script type="text/javascript">
$(document).ready(function(){
	/*$('#province_id').change(function(){
		var province_id=$('#province_id option:selected').val();
		$('#area_number').val(province_id);
	})*/
});
</script>
<h2>ข้อมูลกลุ่มเป้าหมาย2 - ผู้ด้อยโอกาส(เพิ่ม/แก้ไข)</h2>
<h4>ผู้รับบริการทางสังคม <span class="gray">แบบ ผู้รับบริการทางสังคม</span></h4>
<form action="recipient/save" method="post">
<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('year',array_combine(range(2552,date('Y')+543),range(2552,date('Y')+543)),@$rs['year'],'','-- เลือกปี --'); ?>
  </td>
</tr>
<tr><th>วันที่ใบคำขอ(วันที่เริ่มต้น)</th>
	<td><input type="text" name="s_date" class="datepicker" value="<?php echo Date2DB($rs['s_date'])?>"></td>
</tr>
<tr><th>วันที่ใบคำขอ(วันที่สิ้นสุด)</th>
	<td><input type="text" name="e_date" class="datepicker" value="<?php echo Date2DB($rs['e_date'])?>"></td>
</tr>
<tr>
  <th>รหัสหน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td><input name="agency_id" type="text" id="textarea14" value="<?php echo $rs['agency_id'] ?>"  style="width:50px;" /> </td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td><input name="agency" type="text" id="textarea14" value="<?php echo $rs['agency'] ?>"  style="width:480px;" /> </td>
</tr>
<tr>
  <th>จำนวนรายบริการ<span class="Txt_red_12"> *</span></th>
  <td><input name="service_total" type="text" id="textarea14" value="<?php echo $rs['service_total'] ?>"  style="width:50px;" /> ราย </td>
</tr>
<tr>
  <th>รหัสความช่วยเหลือ<span class="Txt_red_12"> *</span></th>
  <td><input name="help_id" type="text" id="textarea14" value="<?php echo $rs['help_id'] ?>"  style="width:50px;" /> </td>
</tr>
<tr>
  <th>ความช่วยเหลือ<span class="Txt_red_12"> *</span></th>
  <td><input name="help_name" type="text" id="textarea14" value="<?php echo $rs['help'] ?>"  style="width:500px;" /> </td>
</tr>
<tr>
  <th>จำนวนเงิน<span class="Txt_red_12"> *</span></th>
  <td><input name="money_total" type="text" id="textarea14" value="<?php echo $rs['money_total'] ?>"  style="width:50px;" /> บาท </td>
</tr>

</table>
<?php 
echo form_hidden('id',@$rs['id']);
echo (!empty($rs['id']))? form_hidden('update',date('Y-m-d')):form_hidden('create',date('Y-m-d')); ?>
<div id="btnSave">	
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>