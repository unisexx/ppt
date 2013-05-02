<? $m['id'] = 13; ?>
<?=menu::source($m['id']);?>

<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form action='child/welfare/save' method='POST'>
<?php endif; ?>
	
	<input type='HIDDEN' name='ID' value='<?=$result['id'];?>'>
	<table class="tbadd">
	<tr>
	  <th>ปี <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('YEAR', get_year_option(2552), @$result['year'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
	</tr>
	<tr>
	  <th>หน่วยงาน<span class="Txt_red_12">  *</span></th>
	  <td><? echo form_dropdown('WLIST_ID', get_option('id', 'name', 'welfare_list'), @$result['wlist_id'], null, '-- กรุณาเลือกสถานสงเคราะห์ --'); ?>	</td>
	</tr>
	<?
		$title_ary = array('เป้าหมาย', 'ยอดยกมา', 'รับเข้า', 'จำหน่าย', 'คงเหลือ', 'สะสม');
		$name_ary = array('TARGET', 'BALANCE', 'ADMISSION', 'DISTRIBUTION', 'REMAIN', 'BUILD');
		
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
	<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?> <input type="submit" value="บันทึก" class="btn btn-danger"><?php endif; ?>
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>	
<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
</form>
<?php endif; ?>