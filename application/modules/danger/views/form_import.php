<?php echo menu::source($menu_id,'import_file/population/population_sample.xls'); ?>
<!-- <form method="post" enctype="multipart/form-data" action="population/population_import"> -->
	<form method="post" enctype="multipart/form-data" action="danger/import">
	<table class="tbadd">
		<tr>
			<th>ปี, ปีงบประมาณ , ปีการศึกษา</th>
			<td><?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?></td>
		</tr>
		<tr>
		  <th>ไฟล์<span class="Txt_red_12"> *</span></th>
		  <td><input type="file" name="fl_import" ></td>
		</tr>
	</table>	
	<div id="btnSave">
	<input type="hidden" name="menu_id" value="<?=$menu_id;?>">
	<? // if(menu::perm($menu_id, 'add')): ?>
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<? // endif;?>
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>
</form>