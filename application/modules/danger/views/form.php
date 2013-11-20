<? $m['id'] = 111; ?>
<?=menu::source($m['id']);?>


<?
	$mental_dtl['year'] = (@$mental_dtl['year'])?$mental_dtl['year']:'';
	$mental_dtl['province_id'] = (@$mental_dtl['province_id'])?$mental_dtl['province_id']:'';
?>
	
<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form ACTION="danger/save" METHOD="POST">
<?php endif; ?>

	<input type='hidden' name='ID' value='<?=(@$id);?>'>
	<table class="tbadd">
	<tr>
	  <th>ปี <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('YEAR_DATA', get_year_option(), $mental_dtl['year']); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
	</tr>
	<tr>
	  <th>จังหวัด <span class="Txt_red_12">  *</span></th>
	  <td>
	  	<select name="CODE">
	  	<?php foreach($provinces as $row):?>
	  		<option value="<?php echo $row['code']?>"><?php echo $row['province']?></option>
	  	<?php endforeach;?>
	  	</select>
	  	
	  	<input type="hidden" name="PROVINCE" value="">
	  </td>
	</tr>
	<tr>
	  <th>จำนวนลูกจ้างในข่าย<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="TOTAL" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th colspan="2" class="title">ความรุนแรง</th>
	</tr>
	<tr>
	  <th>ตาย<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="DEAD" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th>ทุพพลภาพ<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="DISABILITY" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th>สูญเสียอวัยวะบางส่วน<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="LOSE" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th>หยุดงานเกิน 3 วัน<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="STOPMORE3" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th>หยุดงานไม่เกิน 3 วัน<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="STOPLESS3" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th colspan="2" class="title">รวมจำนวนการประสบอันตราย</th>
	</tr>
	<tr>
	  <th>นับทุกกรณี<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="ALL_CASE" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th>นับกรณีร้ายแรง<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="SEVERE_CASE" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th colspan="2" class="title">อัตราการประสบอันตรายต่อลูกจ้าง 1,000 ราย</th>
	</tr>
	<tr>
	  <th>นับทุกกรณี<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="RATE_ALL_CASE" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	<tr>
	  <th>นับกรณีร้ายแรง<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="RATE_SEVERE_CASE" type="text" value=""  style="width:70px;" /> คน  </td>
	</tr>
	</table>
	
	<div id="btnSave">
		<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?><input type="submit" value="บันทึก" class="btn btn-danger"><? } ?>
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" onclick='../danger/'/>
	</div>
<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?></form><? } ?>




<script>
$(function(){
    // $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    $('select[name=CODE]').change(function(){
    	var province_name = $(this).find("option:selected").text();
    	$('input[name=PROVINCE]').val(province_name);
    });
});
</script>
