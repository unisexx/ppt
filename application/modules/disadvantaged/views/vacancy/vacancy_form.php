<? $m['id'] = 104; ?>
<h2>ข้อมูลกลุ่มเป้าหมาย 2 - ผู้ด้อยโอกาส</h2>
<h4>ตำแหน่งคนว่างงาน </h4>
<?=menu::source($m['id']);?>


<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form action='disadvantaged/vacancy_save' method='POST'>
<?php endif; ?>


	<input type='hidden' name='ID' value='<?=@$result['id'];?>'>
	<table class="tbadd">
	<tr>
	  <th>ปี <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('YEAR', get_year_option(2552), @$result['year'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
	</tr>
	<tr>
	  <th>จังหวัด<span class="Txt_red_12">  *</span></th>
	  <td><?=form_dropdown('PROVINCE_ID', get_option('id', 'province', 'provinces'), @$result['province_id'], null, '-- แสดงทั้งหมด --'); ?></td>
	</tr>
	<?
		$title_ary = array('จำนวนตำแหน่งงานว่าง(ตำแหน่ง)', 'จำนวนผู้สมัครงาน(คน)','จำนวนผู้บรรจุงาน(คน)');
		$name_ary = array('VACANCIES', 'CANDIDATES', 'ACTIVE');
		
		for($i=0; $i<count($title_ary); $i++)
		{
			?>
			<tr>
			  <th><?=$title_ary[$i];?><span class="Txt_red_12"> *</span></th>
			  <td><input name="<?=$name_ary[$i];?>" type="text" value="<?=@$result[strtolower($name_ary[$i])]; ?>"  style="width:70px;" />
			    ราย 
			    </td>
			</tr>
			<?		
		}
	?>
	</table>
	
	<div id="btnSave">
	<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?><input type="submit" value="บันทึก" class="btn btn-danger"><? } ?>
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>

<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?></form><? } ?>