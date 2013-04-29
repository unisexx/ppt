<? $m['id'] = 86; ?>
<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป (เพิ่ม/แก้ไข)  <a href="import_file/datapoint/mental/example.xls"> <img src="media/images/btn_ex_data.png" style="border:none;"> </a></h2>
<h4>จำนวนและอัตราผู้ป่วยสุภาพจิต </h4>
<?=menu::source($m['id']);?>


<form action='datapoint/mental/upload' method='POST' enctype="multipart/form-data">
	<input type='hidden' name='ID' value='<?=@$result['id'];?>'>
	<input type='hidden' name='MENU_ID' value='<?=$m['id'];?>'>
	<table class="tbadd">
		<tr>
			<th>ปี, ปีงบประมาณ , ปีการศึกษา</th>
			<td><?php echo form_dropdown('YEAR_DATA', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?></td>
		</tr>
		<tr style='display:none;'>
			<th>จังหวัด</th>
			<td><?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?></td>
		</tr>		
		<tr>
			<th colspan="2">แหล่งที่มาของข้อมูล</th>
		</tr>
		<tr>
			<th>ประเภทหน่วยงาน</th>
			<td>
				<select name="section_type" id="section_type">
			  		<option value="">เลือกประเภทหน่วยงาน</option>
			  		<option value="1">หน่วยงานหลัก</option>
			  		<option value="2">หน่วยงานสนับสนุน</option>
			  	</select>
			</td>
		</tr>
		<tr>
			<th>หน่วยงาน</th>
			<td>
				<?=form_dropdown('SECTION_ID',get_option('id','title','section','PID = 0 ORDER BY title '),@$_GET['pid'],'','--ทุกหน่่วยงาน--');?>				
			</td>
		</tr>
		<tr class="tr_workgroup">
			<th>กลุ่มงาน</th>
			<td>
				<?=form_dropdown('WORKGROUP_ID',get_option('id','title','section','PID > 0 ORDER BY title '),@$_GET['pid'],'','--ทุกหน่่วยงาน--');?>				
			</td>
		</tr>
		<tr>
			<th>ข้อมูลระหว่างวันที่</th>
			<td>
				<?=form_dropdown('MONTH_START',get_month(),'','class="span2"','--เลือกเดือน--');?>
				<?=form_dropdown('YEAR_START', get_year_option(2500), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
				ถึง
				<?=form_dropdown('MONTH_END', get_month(),'','class="span2"','--เลือกเดือน--');	?>
				<?=form_dropdown('YEAR_END', get_year_option(2500), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
			</td>
		</tr>
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