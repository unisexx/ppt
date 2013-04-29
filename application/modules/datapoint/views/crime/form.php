<? $m['id'] = 86; ?>
<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป (เพิ่ม/แก้ไข)</h2>
<h4>ความผิดทางคดีอาญา  </h4>
<?=menu::source($m['id']);?>


<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')): ?>
<form action="datapoint/crime/save" method="post">
<?php endif; ?>
	<input type='hidden' name='ID' value='<?=@$id;?>'>
	<table class="tbadd">
		<tr>
		  <th>ปี <span class="Txt_red_12">*</span></th>
		  <td><?php echo form_dropdown('YEAR', get_year_option(2553), @$station[0]['year']); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?></td>
		</tr>
		<tr>
			<th>จังหวัด <span class="Txt_red_12">  *</span></th>
			<td>
				
				<BR>
				
				<select name='STATION' id='STATION'>
					<?
					for($i=0; $i<count($station_title); $i++)
						{ ?><option><?=$station_title[$i];?></option><? }
					for($i=0; $i<count($pv_list); $i++)
						{ ?><option><?=$pv_list[$i]['province'];?></option><? }
					?> 
				</select>
				
			</td>
		</tr>
		<? 
			for($i=0; $i<count($monthth_array); $i++)
			{ ?>
				<tr> <th colspan="2" class="title"><?=$monthth_array[$i];?></th> </tr>
				<?
				for($j=0; $j<count($case_title);$j++)
				{ ?>
				<? if(@$id) { $result = $this->statistic->limit(1)->get("SELECT NOTIFIED, CATCH FROM CRIME_STATISTIC WHERE STATION_ID = ".$id." AND MONTH = ".($i+1)." AND CASE_ID = ".$case_id[$j]); } ?>
					<tr>
					  <th><?=$case_title[$j];?><span class="Txt_red_12"> *</span></th>
					  <td>
					  	<? if($case_id[$j] != 5) { ?>
						  	รับแจ้ง    <input name="<?=($i+1).'_NOTIFIED';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['notified'];?><?=(@$_GET['debug'])?rand(0,100):'';?>"  style="width:70px;" /> ราย 
						    / จับ   <input name="<?=($i+1).'_CATCH';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['catch'];?><?=(@$_GET['debug'])?rand(0,100):'';?>"  style="width:70px;" /> ราย	
					  	<? } 
					  	else { ?>
						  	จับ    <input name="<?=($i+1).'_NOTIFIED';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['notified'];?><?=(@$_GET['debug'])?rand(0,100):'';?>"  style="width:70px;" /> ราย 
						    / จับ   <input name="<?=($i+1).'_CATCH';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['catch'];?><?=(@$_GET['debug'])?rand(0,100):'';?>"  style="width:70px;" /> ราย	
					  	<? } ?>
					  	
					  </td>

					</tr>
				<? }
			} 
		?>	
	</table>
	<div id="btnSave">
		<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?><input type="submit" value="บันทึก" class="btn btn-danger"><? } ?>
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" onclick='window.location="";'/>
	</div>

<?php if(menu::perm($m['id'], 'add') or menu::perm($m['id'], 'edit')) { ?></form><? } ?>


<script language='javascript'>
$(function(){
	$('#STATION').val("<?=$station[0]['station'];?>");
});
</script>
