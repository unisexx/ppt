<h2>ข้อมูลกลุ่มเป้าหมาย 2 - ผู้ด้อยโอกาส</h2>
<h4>ตำแหน่งคนว่างงาน <span class="gray">แบบ ...</span></h4>


<form action='disadvantaged/vacancy_upload' method='POST' enctype="multipart/form-data">
	<input type='hidden' name='ID' value='<?=@$result['id'];?>'>
	<table class="tbadd">
		<tr>
		  <th>ปี <span class="Txt_red_12">*</span></th>
		  <td><?php echo form_dropdown('YEAR', get_year_option(2552), @$result['year'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
		</tr>
		<tr>
		  <th>ไฟล์<span class="Txt_red_12"> *</span></th>
		  <td><input type='file' name='file_import'></td>
		</tr>
	</table>	
	<div id="btnSave">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>

</form>