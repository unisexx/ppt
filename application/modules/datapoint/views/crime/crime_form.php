<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป (เพิ่ม/แก้ไข)</h2>
<h4>ความผิดทางคดีอาญา  <span class="gray">แบบ สตช. คดีอาญา</span></h4>
<?
	$pv_list = $this->province->limit(80)->get('SELECT * FROM PROVINCES WHERE ID != 1');
	$station_title = array('บช.น.', 'บช.น. 1', 'บช.น. 2', 'บช.น. 3', 'บช.น. 4', 'บช.น. 5', 'บช.น. 6', 'บช.น. 7', 'บช.น. 8', 'บช.น. 9', 'บช.ก.');
	$monthth_array = array('มกราคม', "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
?>
<form action="datapoint/crime_save" method="post">
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
						  	รับแจ้ง    <input name="<?=($i+1).'_NOTIFIED';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['notified'];?>"  style="width:70px;" /> ราย 
						    / จับ   <input name="<?=($i+1).'_CATCH';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['catch'];?>"  style="width:70px;" /> ราย	
					  	<? } 
					  	else { ?>
						  	จับ    <input name="<?=($i+1).'_NOTIFIED';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['notified'];?>"  style="width:70px;" /> ราย 
						    / จับ   <input name="<?=($i+1).'_CATCH';?>[<?=$case_id[$j];?>]" type="text" value="<?=@$result[0]['catch'];?> "  style="width:70px;" /> ราย	
					  	<? } ?>
					  	
					  </td>

					</tr>
				<? }
			} 
		?>	
	</table>
	<div id="btnSave">
		<input type="submit" value="บันทึก" class="btn btn-danger">
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>

</form>


<script language='javascript'>
$(function(){
	$('#STATION').val("<?=$station[0]['station'];?>");
});
</script>