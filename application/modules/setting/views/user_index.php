<h2>ผู้ใช้งาน</h2>
<div id="search">
  <div id="searchBox">ชื่อ-สกุล
    <input type="text" name="textfield" id="textfield" style="width:200px;" />
    เลขที่บัตรประชาชน
    <input name="data" type="text" id="data" onkeyup="autoTab(this)" />

    <select name="select6" id="select6">
      <option>-- กอง / สำนักงาน --</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
  </select>
    <select name="select" id="select">
      <option>-- กลุ่ม / ฝ่าย --</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<?php if(permission('user','add')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/user_form'" class="btn_add"/></div>
<?php endif;?>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อ - สกุล</th>
  <th>ข้อมูลติดต่อ</th>
  <th>กลุ่ม/ฝ่าย</th>
  <th>กอง/สำนัก</th>
  <th></th>
</tr>
<?php
	$page = (isset($_GET['page']))? $_GET['page']:1;
	$i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
?>
<?php foreach($users as $key=>$user):?>
	<tr <?php alternator('','class="odd"')?>>
	  <td><?php echo $i?></td>
	  <td><?php echo $user['fullname']?></td>
	  <td>
	  	<?php if($user['contact_number']):?>
	  		<img src="themes/ppt/images/phone.png" alt="" width="16" height="16" class="vtip" style="margin-right:10px;" title="<?php echo $user['contact_number']?>"/>
	  	<?php endif;?>
	  	<?php if($user['email']):?>
	  	<img src="themes/ppt/images/email.png" alt="" width="16" height="16" class="vtip" title="<?php echo $user['email']?>" />
	  	<?php endif;?>
	  </td>
	  <td><?php echo $user['group_name']?></td>
	  <td><?php echo $user['division_name']?></td>
	  <td>
	  	
	  	<?php if(permission('user','edit')):?>
	  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/user_form/<?php echo $user['id']?>'" />
	  	<?php endif;?>
	  	
	  	<?php if(permission('user','delete')):?>
	    <a class="btn_delete vtip" title="ลบรายการนี้" href="setting/user_delete/<?php echo $user['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	    <?php endif;?>
	    
	  </td>
	</tr>
<?php $i++?>
<?php endforeach;?>
</table>