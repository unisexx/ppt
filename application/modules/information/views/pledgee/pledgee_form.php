<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป </h2>
<h4>การให้บริการรับจำนำ <span class="gray">แบบ สถานธนานุเคราะห์</span></h4>
<form action='information/pledgee_save' method='post'>
	<input type='hidden' name='ID' value='<?=$id;?>'>
	<table class="tbadd">
	<tr>
		<th>วันที่รับจำนำ<span class="Txt_red_12"> *</span></th>
		<td>
			<input name="PTH_TICKET_DATE" type="text" id="textarea14" value="<?=($id)?$pg_dtl['pth_ticket_date']:'';?>" style="width:70px;" />
	    	<img src="images/ico_cal.png" width="16" height="16" />
	   </td>
	</tr>
	<tr>
	  <th>เลขที่ตั๋วจำนำ<span class="Txt_red_12"> *</span></th>
	  <td><input name="PTH_TICKET_NO" type="text" id="textarea" value="<?=($id)?$pg_dtl['pth_ticket_no']:'';?>"  style="width:50px;" /></td>
	</tr>
	<tr>
	  <th>PTD_SEQ</th>
	  <td><input name="PTD_SEQ" type="text" id="textarea2" value="<?=($id)?$pg_dtl['ptd_seq']:'';?>"  style="width:50px;" /></td>
	</tr>
	<tr>
	  <th>PTD_DESC</th>
	  <td><input name="PTD_DESC" type="text" id="textarea9" value="<?=($id)?$pg_dtl['ptd_desc']:'';?>" style="width:500px;" /></td>
	</tr>
	<tr>
	  <th>ราคารับจำนำ<span class="Txt_red_12"> *</span></th>
	  <td><input name="PTH_PAWN_COST" type="text" id="textarea3" value="<?=($id)?$pg_dtl['pth_pawn_cost']:'';?>" /> 
	    บาท</td>
	</tr>
	<tr>
	  	<th>คำนำหน้า</th>
	  	<td>
	  		<input type="radio" name="CTM_TITLE" id="radio" value="นาย" /> นาย
	      	<input type="radio" name="CTM_TITLE" id="radio2" value="นาง" /> นาง
			<input type="radio" name="CTM_TITLE" id="radio3" value="นางสาว" /> นางสาว
			<script language="javascript">
			$(function(){
				var title_set = "<?=($id)?$pg_dtl['ctm_title']:'';?>";
				if(title_set)
				{
					if(title_set == 'นาย')
						{ $('#radio').attr('checked', 'checked'); }
					else if(title_set == 'นาง')
						{ $('#radio2').attr('checked', 'checked'); }
					else if(title_set == 'นางสาว')
						{ $('#radio3').attr('checked', 'checked'); }
				}
			});
			</script>
			
		</td>
	</tr>
	<tr>
	  <th>เลขที่บัตร</th>
	  <td><input name="CTM_CARD_NO" type="text" maxlength="13" value="<?=($id)?$pg_dtl['ctm_card_no']:'';?>"/></td>
	</tr>
	<tr>
	  <th>อายุ</th>
	  <td><input name="CTM_AGE" type="text" value="<?=($id)?$pg_dtl['ctm_age']:'';?>" style="width:50px;" /></td>
	</tr>
	<tr>
	  <th>สัญชาติ</th>
	  <td><input name="CTM_NATIONALITY" type="text" value="<?=($id)?$pg_dtl['ctm_nationality']:'';?>" style="width:100px;" /></td>
	</tr>
	<tr>
	  <th>บ้านเลขที่</th>
	  <td><input name="CTM_HOUSE_NO" type="text" value="<?=($id)?$pg_dtl['ctm_house_no']:'';?>" style="width:50px;" /></td>
	</tr>
	<tr>
	  <th>ถนน</th>
	  <td><input name="CTM_ROAD" type="text" style="width:300px;" value="<?=($id)?$pg_dtl['ctm_road']:'';?>"/></td>
	</tr>
	<tr>
	  <th>จังหวัด &gt; อำเภอ<span class="Txt_red_12">&gt; ตำบล *</span></th>
        <td>
            <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), $rs['province_id']); ?> &gt; 
            <?php echo form_dropdown('amphur_id', (empty($rs['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$rs['province_id'].' order by amphur_name'), $rs['amphur_id']); ?> &gt;
            
            <input name="CTM_TUMBON" type="text" id="textarea4" value="<?=($id)?$pg_dtl['ctm_tumbon']:'';?>" style="width:300px;" />            
        </td>
	</tr>
	<tr>
	  <th>อาชีพ<span class="Txt_red_12"> *</span></th>
	  <td><input name="CTM_OCM_CODE" type="text" id="textarea4" value="<?=($id)?$pg_dtl['ctm_ocm_code']:'';?>" style="width:300px;" /></td>
	</tr>
	</table>
	
	<div id="btnSave">
		<input type="submit" value="บันทึก" class="btn btn-danger">
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>

</form>


<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>