<?php echo menu::source($menu_id,'import_file/population/population_sample.xls'); ?>
<!-- <form method="post" enctype="multipart/form-data" action="population/population_import"> -->
	<form method="post" enctype="multipart/form-data" action="population/dear_import">
	<table class="tbadd">
		<tr>
			<th>ปี, ปีงบประมาณ , ปีการศึกษา</th>
			<td><?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?></td>
		</tr>
		<!-- <tr>
			<th>จังหวัด</th>
			<td><?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?></td>
		</tr>	 -->	
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
				<?=form_dropdown('import_section_id',get_option('id','title','section','PID = 0 ORDER BY title '),@$_GET['pid'],'','--ทุกหน่่วยงาน--');?>				
			</td>
		</tr>
		<tr class="tr_workgroup">
			<th>กลุ่มงาน</th>
			<td>
				<?=form_dropdown('import_workgroup_id',get_option('id','title','section','PID > 0 ORDER BY title '),@$_GET['pid'],'','--ทุกหน่่วยงาน--');?>				
			</td>
		</tr>
		<tr>
			<th>ข้อมูลระหว่างวันที่</th>
			<td>
				<?
				echo form_dropdown('month_start',get_month(),'','class="span2"','--เลือกเดือน--');
				?>
				<?php echo form_dropdown('year_start', get_year_option(2500), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
				ถึง
				<?
				echo form_dropdown('month_end',get_month(),'','class="span2"','--เลือกเดือน--');
				?>
				<?php echo form_dropdown('year_end', get_year_option(2500), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
			</td>
		</tr>
		<tr>
		  <th>ไฟล์<span class="Txt_red_12"> *</span></th>
		  <td><input type="file" name="fl_import" ></td>
		</tr>
	</table>	
	<div id="btnSave">
	<input type="hidden" name="menu_id" value="<?=$menu_id;?>">
	<? if(menu::perm($menu_id, 'add')): ?>
	<input type="submit" value="บันทึก" class="btn btn-danger">
	<? endif;?>
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>
</form>
<script>
    $(function(){
    	$('[name=section_type]').live('change',function(){
    		if($(this).val()==1){
    			$(".tr_workgroup").show();
    		}else{
    			$(".tr_workgroup").hide();
    		}
    	})
        $('[name=import_section_id]').chainedSelect({parent: '[name=section_type]',url: 'setting/section/ajax_section/report',value: 'id',label: 'text'});
        $('[name=import_workgroup_id]').chainedSelect({parent: '[name=import_section_id]',url: 'setting/section/ajax_workgroup/report',value: 'id',label: 'text'});        
    });
</script>