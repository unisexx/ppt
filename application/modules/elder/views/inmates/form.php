<? $m['id'] = 61; ?>
<?=menu::source($m['id']);?>


<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form action='elder/inmates/save' method='POST'>
<?php endif; ?>


	<input type='hidden' name='ID' value='<?=@$result['id'];?>'>
	<table class="tbadd">
	<tr>
	  <th>ปี <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('YEAR', get_year_option(2552), @$result['year'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
	</tr>
	<tr>
	  <th>สถานสงเคราะห์<span class="Txt_red_12">  *</span></th>
	  <td><?=form_dropdown('INMATESLIST_ID', get_option('id', 'name', 'elder_inmates_list'), @$result['inmateslist_id'], null, '-- แสดงทั้งหมด --'); ?></td>
	</tr>
	<?
		$title_ary = array('อายุ 60-69', 'อายุ 70-79','อายุ 80');
		$name_ary = array('VALUE1', 'VALUE2', 'VALUE3');
		
		for($i=0; $i<count($title_ary); $i++)
		{
			?>
			<tr>
			  <th><?=$title_ary[$i];?><span class="Txt_red_12"> *</span></th>
			  <td>
			  	ชาย <input name="<?=$name_ary[$i];?>_M" type="text" value="<?=@$result[strtolower($name_ary[$i].'_M')]; ?>"  style="width:70px;" /> ราย / 
			  	หญิง<input name="<?=$name_ary[$i];?>_F" type="text" value="<?=@$result[strtolower($name_ary[$i].'_F')]; ?>"  style="width:70px;" /> ราย 
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