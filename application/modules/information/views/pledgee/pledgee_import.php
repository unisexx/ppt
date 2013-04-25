<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป </h2>
<h4>การให้บริการรับจำนำ <span class="gray">แบบ สถานธนานุเคราะห์</span></h4>


<form action='information/pledgee_upload' method='POST' enctype="multipart/form-data">
	<input type='hidden' name='ID' value='<?=@$result['id'];?>'>
	<table class="tbadd">
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