<script type="text/javascript">
$(document).ready(function(){
	$('#province_id').change(function(){
		var province_id=$('#province_id option:selected').val();
		$('#area_number').val(province_id);
	})
});
</script>
<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน (เพิ่ม/แก้ไข)</h2>
<h4>เด็กและเยาวชนออกจากโรงเรียนกลางคัน <span class="gray">แบบ ศธ. ออกโรงเรียนกลางคัน</span></h4>
<form action="child/drop_save" method="post">
<table class="tbadd">
<tr>
  <th>ปีการศึกษา <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('year',array_combine(range(2552,date('Y')+543),range(2552,date('Y')+543)),@$rs['year'],'','-- เลือกปีการศึกษา --'); ?>
  </td>
</tr>
<tr>
  <th>จังหวัด &gt; หมายเลขเขต<span class="Txt_red_12"> *</span></th>
  <td>
  <?php echo form_dropdown('province_id',get_option('id','PROVINCE','PROVINCES'),$rs['province_id'],'id="province_id"','-- เลือกจังหวัด --'); ?>
    &gt;
    <input name="area_number" type="text" id="area_number" value="<?php echo $rs['area_number'] ?>"  style="width:50px;" readonly="readonly"/>
  </td>
</tr>
<tr>
  <th>จำนวน นร.ต้นปี <span class="Txt_red_12"> *</span></th>
  <td><input name="total" type="text" id="total" value="<?php echo number_format($rs['total']) ?>" />
    ราย</td>
</tr>
<tr>
  <th>จำนวนตามสาเหตุ<span class="Txt_red_12"> *</span></th>
  <td><span class="padd">
    <label>ฐานะยากจน </label>
    <input name="poor" type="text" id="textarea14" value="<?php echo $rs['poor'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>มีปัญหาครอบครัว</label>
	<input name="family" type="text" id="textarea14" value="<?php echo $rs['family'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>สมรสแล้ว</label>
	<input name="married" type="text" id="textarea14" value="<?php echo $rs['married'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>มีปัญหาในการปรับตัว </label>
	<input name="adapt" type="text" id="textarea14" value="<?php echo $rs['adapt'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>ต้องคดี/ถูกจับ</label>
	<input name="capture" type="text" id="textarea14" value="<?php echo $rs['capture'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>เจ็บป่วย/อุบัติเหตุ</label>
	<input name="accident" type="text" id="textarea14" value="<?php echo $rs['accident'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>อพยพตามผู้ปกครอง</label>
	<input name="migration" type="text" id="textarea14" value="<?php echo $rs['migration'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>หาเลี้ยงครอบครัว</label>
	<input name="breadwinner" type="text" id="textarea14" value="<?php echo $rs['breadwinner'] ?>"  style="width:50px;" /> ราย</span> <span class="padd">
	<label>กรณีอื่นๆ</label>
	<input name="other" type="text" id="textarea14" value="<?php echo $rs['other'] ?>"  style="width:50px;" /> ราย</span></td>
</tr>
</table>
<?php echo (!empty($rs['id']))? form_hidden('update',date('Y-m-d')):form_hidden('create',date('Y-m-d')); ?>
<div id="btnSave">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>