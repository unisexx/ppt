<h2>ข้อมูลพื้นฐาน - ทุนทางสังคม (เพิ่ม/แก้ไข)</h2>
<h4>ข้อมูลอาสาสมัครต่างประเทศ<span class="gray"></span></h4>
<form method="post" enctype="multipart/form-data" action="birth/save">
<table class="tbadd">
<tr>
  <th>เลขที่บัตรประชาชน/เลขที่หนังสือเดินทาง<span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="text" name="id_card" style="width:250px;">
  </td>
</tr>
<tr>
  <th>คำนำหน้าชื่อ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?=form_dropdown('title_id',get_option('id','tname','title_name order by tname'),@$item['title_id'],'','--เลือกคำนำหน้าชื่อ--');?>
  </td>
</tr>
<tr>
  <th>ชื่อ<span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="text" name="fname" value="<?=@$item['fname'];?>" style="width:250px;">
  </td>
</tr>
<tr>
  <th>นามสกุล<span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="text" name="lname" value="<?=@$item['lname'];?>" style="width:250px;">
  </td>
</tr>
<tr>
  <th>เพศ<span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="radio" name="sex" value="M" <? if(@$item['sex']=='M')echo 'checked="checked"';?>>ชาย
  	<input type="radio" name="sex" value="F" <? if(@$item['sex']=='F')echo 'checked="checked"';?>>หญิง
  </td>
</tr>
<tr>
  <th>วัน/เดือน/ปี เกิด<span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="text" name="lname" value="<?=@$item['lname'];?>" style="width:250px;">
  </td>
</tr>
<tr>
  <th>สัญชาติ<span class="Txt_red_12"> *</span></th>
  <td>
  	<input type="text" name="national" value="<?=@$item['national'];?>" style="width:250px;">
  </td>
</tr>
<tr>
  <th>ศาสนา<span class="Txt_red_12"> *</span></th>
  <td>
  	<?=form_dropdown('religion',get_option('id','rname','religion order by rname'),@$item['religion'],'','--เลือกศาสนา--');?>
  </td>
</tr>
<tr>
  <th>ประเทศ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?=form_dropdown('country_id',get_option('country_id','country_name','admin_country order by country_name'),@$item['country_id'],'','--เลือกประเทศ--');?>
  </td>
</tr>
<tr>
	<th>สถานที่ทำงาน/สถานที่ติดต่อ</th>
	<td>
		บ้านเลขที่  <input type="text" name="home_no" value="<?=@$item['home_no'];?>" style="width:250px;">    
		หมู่ <input type="text" name="moo" value="<?=@$item['moo'];?>" style="width:250px;">    
		อาคาร/หมู่บ้าน     <input type="text" name="moo_ban" value="<?=@$item['moo_ban'];?>" style="width:250px;"><br>
		ตรอก/ซอย <input type="text" name="soi" value="<?=@$item['soi'];?>" style="width:250px;">     
		ถนน <input type="text" name="road" value="<?=@$item['road'];?>" style="width:250px;"><br>
		<?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$item['province_id'], null, '-- เลือกจังหวัด --'); ?>
	    <?php echo form_dropdown('amphur_id', (empty($item['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$item['province_id'].' order by amphur_name'), @$item['amphur_id'], null, '-- เลือกอำเภอ --'); ?>
    	<?php echo form_dropdown('district_id', (empty($item['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$item['amphur_id'].' order by district_name'), @$item['district_id'], null, '-- เลือกตำบล --'); ?>
		รหัสไปรษณีย์ <input type="text" name="post_code" value="<?=@$item['post_code'];?>">    
	</td>
</tr>
<tr>
	<th>เบอร์โทรศํพท์</th>
	<td>
		<input type="text" name="tel" value="<?=@$item['tel'];?>">
	</td>
</tr>
<tr>
	<th>โทรสาร</th>
	<td>
		<input type="text" name="fax" value="<?=@$item['fax'];?>">
	</td>
</tr>
<tr>
	<th>โทรศัพท์มือถือ</th>
	<td>
		<input type="text" name="phone" value="<?=@$item['phone'];?>">
	</td>
</tr>
<tr>
	<th>เว็บไซต์</th>
	<td>
		<input type="text" name="website" value="<?=@$item['website'];?>">
	</td>
</tr>
<tr>
	<th>ระดับการศึกษา</th>
	<td>
		<?=form_dropdown('education_id',get_option('id','ename','education order by seq'),@$item['education_id'],'','--เลือกระดับการศึกษา--');?>
	</td>
</tr>
<tr>
	<th>อาชีพ</th>
	<td>
		<?=form_dropdown('occupation_id',get_option('id','oname','occupation order by seq'),@$item['occupation_id'],'','--เลือกประเภทอาสาสมัคร--');?>
	</td>
</tr>
<tr>
	<th>ประเภทอาสาสมัคร</th>
	<td>
		<?=form_dropdown('status_type_id',get_option('id','vtype_name','volunteer_type order by seq'),@$item['status_type_id'],'','--เลือกประเภทอาสาสมัคร--');?>
	</td>
</tr>
<tr>
	<th>ระยะเวลาที่ปฏิบัติงาน</th>
	<td>
		<input type="text" name="work_time" value="<?=@$item['work_time'];?>" style="width:100px;">	ปี
	</td>
</tr>
<tr>
	<th>พื้นที่ปฏิบัติงาน</th>
	<td>
		
	</td>
</tr>
<tr>
	<th>ประสบการณ์/ความสามารถพิเศษ</th>
	<td>
		<textarea name="experience" cols="50" rows="5" style="width:250px;"><?=@$item['experience'];?></textarea>
	</td>
</tr>
<tr>
	<th>ประกาศเกียรติคุณที่ได้รับ</th>
	<td>
		<textarea name="notice" cols="50" rows="5" style="width:250px;"><?=@$item['notice'];?></textarea>
	</td>
</tr>
<tr>
	<th>หมายเหตุ</th>
	<td>
		<textarea name="note" cols="50" rows="5" style="width:250px;"><?=@$item['note'];?></textarea>
	</td>
</tr>
</table>

<div id="btnSave">
<input type="hidden" name="ID" value="<?=@$item['id'];?>">
<? if(menu::perm($menu_id, 'add')||menu::perm($menu_id,'edit')): ?>
<input type="submit" value="บันทึก" class="btn btn-danger">
<? endif;?>
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>