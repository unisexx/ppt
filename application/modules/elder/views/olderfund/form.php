<? $m['id'] = 57; ?>
<?=menu::source($m['id']);?>

<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form action='elder/olderfund/save/<?=$m['id'];?>/' method='POST'>
<?php endif; ?>


	<input type='HIDDEN' name='ID' value='<?=@$result['id'];?>'>
	<table class="tbadd">
	<tr>
	  <th>ปี <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('YEAR', get_year_option(), @$result['year'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
	</tr>
	<tr><th>จังหวัด <span class="Txt_red_12">*</span></th>
		<td><?php echo form_dropdown('province',get_option('province as id','province','provinces ORDER BY province asc'),$rs['province'],'','เลือกจังหวัด') ?></td>
	</tr>
	<tr>
	  <th>จำนวนคน <span class="Txt_red_12">*</span></th>
	  <td><input type="text" name="total_person" value="<?php echo $rs['total_person'] ?>"></td>
	</tr>
	<tr>
	  <th>จำนวนเงิน (บาท)<span class="Txt_red_12">*</span></th>
	  <td><input type="text" name="total_money_person" value="<?php echo $rs['total_money_person'] ?>"></td>
	</tr>
	<tr>
	  <th>จำนวนโครงการ<span class="Txt_red_12">*</span></th>
	  <td><input type="text" name="total_project" value="<?php echo $rs['total_project'] ?>"></td>
	</tr>
	<tr>
	  <th>จำนวนเงิน(บาท) <span class="Txt_red_12">*</span></th>
	  <td><input type="text" name="total_money_project" value="<?php echo $rs['total_money_project'] ?>"></td>
	</tr>
	</table>


	<div id="btnSave">
	<?php //if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?> <input type="submit" value="บันทึก" class="btn btn-danger"><?php //endif; ?>
	<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>
<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
</form>
<?php endif; ?>