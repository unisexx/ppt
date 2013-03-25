<h2>ตั้งค่าข้อมูลหลัก > ข้อมูลพื้นฐานและกลุ่มเป้าหมาย (เพิ่ม/แก้ไข)</h2>
<?php 
	if(empty($set_target['form_template_id'])){
		$sub_target_name = $set_target['name'];
	}else{
		$sub_target_name2 = $set_target['name'];
	}
?>
<form method="post" action="setting/set_target_save">
	<table class="tbadd">
	  <tr>
	    <th>ชนิดข้อมูล <span class="TxtRed">*</span></th>
	    <td>
		    <?php echo form_dropdown('parent_id',get_option('id','name','set_target where parent_id = 0'),$set_target['parent_id'],'','-- เลือกชนิดข้อมูล --');?>
		</td>
	  </tr>
	  <tr>
	    <th>ชื่อข้อมูลพื้นฐานหรือกลุ่มเป้าหมาย  <span class="TxtRed">*</span></th>
	    <td><input name="name" type="text" style="width:450px;" value="<?php echo @$sub_target_name?>" /></td>
	  </tr>
	</table>
	<div id="btnSave">
		<input type="hidden" name="id" value="<?php echo $set_target['id']?>">
		<input type="submit" value="บันทึก" class="btn btn-danger">
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>
</form>

<form method="post" action="setting/set_target_save">
	<h2>ข้อมูลพื้นฐานและกลุ่มเป้าหมาย > รายการข้อมูล (เพิ่ม/แก้ไข)</h2>
	<table class="tbadd">
	<tr>
	  <th>ข้อมูลพื้นฐานหรือกลุ่มเป้าหมาย<span class="TxtRed">*</span></th>
	  <td>
		<select name="parent_id" style="margin-right:20px;">
		    <option>-- เลือกข้อมูลพื้นฐาน --</option>
		    <?php foreach($basics as $basic):?>
		    	<option value="<?php echo $basic['id']?>" <?php echo ($set_target['parent_id'] == $basic['id'])?'selected':'';?>><?php echo $basic['name']?></option>
		    <?php endforeach;?>
		    <option>-- เลือกกลุ่มเป้าหมาย --</option>
		    <?php foreach($targets as $target):?>
		    	<option value="<?php echo $target['id']?>" <?php echo ($set_target['parent_id'] == $target['id'])?'selected':'';?>><?php echo $target['name']?></option>
		    <?php endforeach;?>
		</select>
	  </td>
	</tr>
	<tr>
	  <th>ชื่อรายการข้อมูล <span class="TxtRed">*</span></th>
	  <td><input name="name" type="text" style="width:450px;" value="<?php echo @$sub_target_name2?>" /></td>
	</tr>
	<tr>
	  <th>แบบฟอร์มการเก็บข้อมูล</th>
	  <td>
	  	<select class="span5" name="form_template_id" style="margin-right:20px;">
	    <option selected="form_template_id">-- เลือกแบบฟอร์มการเก็บข้อมุล --</option>
	    <?php foreach($form_templates as $form_template):?>
	    	<option value="<?php echo $form_template['id']?>" <?php echo ($set_target['form_template_id'] == $form_template['id'])?'selected':'';?>>[<?php echo $form_template['codename']?>] <?php echo $form_template['name']?></option>
	    <?php endforeach;?>
	  </select>
	  </td>
	</tr>
	</table>
	<div id="btnSave">
		<input type="hidden" name="id" value="<?php echo $set_target['id']?>">
		<input type="submit" value="บันทึก" class="btn btn-danger">
		<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
	</div>
</form>