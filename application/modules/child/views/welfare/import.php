<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน (เพิ่ม/แก้ไข)</h2>
<h4>เด็กและเยาวชนที่อยู่ในความอุปการะของสถานสงเคราะห์/สถานคุ้มครอง/สถานพัฒนาและฟื้นฟู/ศูนย์ฝึกอาชีพ/บ้านพักเด็กและครอบครัว </h4>
<?=menu::source(13);?>

<form action='child/welfare/upload' method='POST' enctype="multipart/form-data">
	<input type='hidden' name='ID' value='<?=@$result['id'];?>'>
	<table class="tbadd">
		<tr>
		  <th>ไฟล์<span class="Txt_red_12"> *</span></th>
		  <td><input type='file' name='file_import'></td>
		</tr>
	</table>	
	<div id="btnSave">
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" onclick='window.location="";'/>
	</div>

</form>