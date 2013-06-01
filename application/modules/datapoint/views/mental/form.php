<? $m['id'] = 86; ?>
<?=menu::source($m['id']);?>


<?
	$mental_dtl['year'] = (@$mental_dtl['year'])?$mental_dtl['year']:'';
	$mental_dtl['province_id'] = (@$mental_dtl['province_id'])?$mental_dtl['province_id']:'';
?>
	
<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form ACTION="datapoint/mental/save/<?=$m['id'];?>/" METHOD="POST">
<?php endif; ?>

	<input type='hidden' name='ID' value='<?=(@$id);?>'>
	<table class="tbadd">
	<tr>
	  <th>ปี <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('YEAR', get_year_option(), $mental_dtl['year']); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
	</tr>
	<tr>
	  <th>จังหวัด <span class="Txt_red_12">  *</span></th>
	  <td> <?php echo form_dropdown('PROVINCE_ID', get_option('id', 'province', 'provinces', '1=1 order by province'), $mental_dtl['province_id']); ?> </td>
	</tr>
	<tr>
	  <th>ประชากรกลางปี<span class="Txt_red_12"> *</span></th>
	  <td>จำนวน  <input name="POP_NUMBER" type="text" value="<?=(@$mental_dtl['pop_number'])?$mental_dtl['pop_number']:'';?>"  style="width:70px;" /> ราย  </td>
	</tr>
	<tr>
	  <th>โรคจิต<span class="Txt_red_12"> *</span></th>
	  <td>
	  	จำนวน   <input name="PSY_NUMBER" type="text" value="<?=(@$mental_dtl['psy_number'])?$mental_dtl['psy_number']:'';?>"  style="width:70px;" /> ราย 
	    / อัตรา   <input name="PSY_RATE" type="text" value="<?=(@$mental_dtl['psy_rate'])?$mental_dtl['psy_rate']:'';?>"  style="width:70px;" />
	  </td>
	</tr>
	<tr>
	  	<th>โรควิตกกังวล<span class="Txt_red_12"> *</span></th>
		<td>
		  	จำนวน  <input name="FEAR_NUMBER" type="text" value="<?=(@$mental_dtl['fear_number'])?$mental_dtl['fear_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา  <input name="FEAR_RATE" type="text" value="<?=(@$mental_dtl['fear_rate'])?$mental_dtl['fear_rate']:'';?>"  style="width:70px;" />
		</td>
	</tr>
	<tr>
	  <th>โรคซึมเศร้า<span class="Txt_red_12"> *</span></th>
	  <td>
	  	จำนวน  <input name="DEPRESS_NUMBER" type="text" value="<?=(@$mental_dtl['depress_number'])?$mental_dtl['depress_number']:'';?>"  style="width:70px;" /> ราย 
	    / อัตรา   <input name="DEPRESS_RATE" type="text" value="<?=(@$mental_dtl['depress_rate'])?$mental_dtl['depress_rate']:'';?>"  style="width:70px;" /></td>
	</tr>
	<tr>
	  	<th>ปัญญาอ่อน<span class="Txt_red_12"> *</span></th>
	  	<td>
		  	จำนวน  <input name="RETARDED_NUMBER" type="text" value="<?=(@$mental_dtl['retarded_number'])?$mental_dtl['retarded_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา <input name="RETARDED_RATE" type="text" value="<?=(@$mental_dtl['retarded_rate'])?$mental_dtl['retarded_rate']:'';?>"  style="width:70px;" />
		</td>
	</tr>
	<tr>
	  	<th>โรคลมชัก<span class="Txt_red_12"> *</span></th>
	  	<td>
	  		จำนวน    <input name="APOPLEXY_NUMBER" type="text" value="<?=(@$mental_dtl['apoplexy_number'])?$mental_dtl['apoplexy_number']:'';?>"  style="width:70px;" /> ราย 
	    	/ อัตรา   <input name="APOPLEXY_RATE" type="text" value="<?=(@$mental_dtl['apoplexy_rate'])?$mental_dtl['apoplexy_rate']:'';?>"  style="width:70px;" />
		</td>
	</tr>
	<tr>
	  	<th>ผู้ติดสารเสพติด<span class="Txt_red_12"> *</span></th>
	  	<td>
		  	จำนวน  <input name="DRUGADD_NUMBER" type="text" value="<?=(@$mental_dtl['drugadd_number'])?$mental_dtl['drugadd_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา   <input name="DRUGADD_RATE" type="text" value="<?=(@$mental_dtl['drugadd_rate'])?$mental_dtl['drugadd_rate']:'';?>"  style="width:70px;" />
	    </td>
	</tr>
	<tr>
	  	<th>ปัญหาสุขภาพจิตอื่นๆ<span class="Txt_red_12"> *</span></th>
	  	<td>
		  	จำนวน   <input name="OTHER_NUMBER" type="text" value="<?=(@$mental_dtl['other_number'])?$mental_dtl['other_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา   <input name="OTHER_RATE" type="text" value="<?=(@$mental_dtl['other_rate'])?$mental_dtl['other_rate']:'';?>"  style="width:70px;" />
		</td>
	</tr>
	<tr>
	  	<th>ออติสติก<span class="Txt_red_12"> *</span></th>
	  	<td>
		  	จำนวน   <input name="AUTISM_NUMBER" type="text" value="<?=(@$mental_dtl['autism_number'])?$mental_dtl['autism_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา   <input name="AUTISM_RATE" type="text" value="<?=(@$mental_dtl['autism_rate'])?$mental_dtl['autism_rate']:'';?>"  style="width:70px;" />
		</td>
	</tr>
	<tr>
	  <th colspan="2" class="title">ผู้พยายามฆ่าตัวตายหรือฆ่าตัวตาย</th>
	</tr>
	<tr>
	  	<th>ตายสำเร็จ<span class="Txt_red_12"> *</span></th>
	  	<td>
		  	จำนวน   <input name="SUICIDE_SUCC_NUMBER" type="text" value="<?=(@$mental_dtl['suicide_succ_number'])?$mental_dtl['suicide_succ_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา   <input name="SUICIDE_SUCC_RATE" type="text" value="<?=(@$mental_dtl['suicide_succ_rate'])?$mental_dtl['suicide_succ_rate']:'';?>"  style="width:70px;" />
	    </td>
	</tr>
	<tr>
	  	<th>ไม่สำเร็จ<span class="Txt_red_12"> *</span></th>
	  	<td>
		  	จำนวน    <input name="SUICIDE_UNSUC_NUMBER" type="text" value="<?=(@$mental_dtl['suicide_unsuc_number'])?$mental_dtl['suicide_unsuc_number']:'';?>"  style="width:70px;" /> ราย 
		    / อัตรา   <input name="SUICIDE_UNSUC_RATE" type="text" value="<?=(@$mental_dtl['suicide_unsuc_rate'])?$mental_dtl['suicide_unsuc_rate']:'';?>"  style="width:70px;" />
	    </td>
	</tr>
	</table>
	
	<div id="btnSave">
		<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?><input type="submit" value="บันทึก" class="btn btn-danger"><? } ?>
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" onclick='../mental/'/>
	</div>
<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?></form><? } ?>




<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>
