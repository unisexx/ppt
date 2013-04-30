<script type="text/javascript">
    $(function(){
        $('[name=division_id]').chainedSelect({parent: '[name=department_id]',url: 'setting/ajax_division',value: 'id',label: 'text'});
        
        $('[name=workgroup_id]').chainedSelect({parent: '[name=division_id]',url: 'setting/ajax_workgroup',value: 'id',label: 'text'});
    });
</script>

<h2>ผู้ใช้งาน</h2>
<form action="" method="get">
<div id="search">
  <div id="searchBox">ชื่อ-สกุล
    <input type="text" name="fullname" style="width:200px;" value="<?php echo @$_GET['fullname']?>" />
    <?php echo form_dropdown('department_id', get_option('id', 'department_name', 'department'), @$_GET['department_id'], null, '- เลือกกรม -'); ?>
    <?php echo form_dropdown('division_id', (empty($_GET['department_id'])) ? array() : get_option('id', 'division_name', 'division', 'department_id = '.$_GET['department_id'].' order by division_name'), @$_GET['division_id'], null, '- กอง / สำนักงาน -'); ?>
    <?php echo form_dropdown('workgroup_id', (empty($_GET['division_id'])) ? array() : get_option('id', 'workgroup_name', 'workgroup', 'division_id = '.$_GET['division_id'].' order by workgroup_name'), @$_GET['workgroup_id'], null, '- กลุ่ม / ฝ่าย -'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php if(permission('user','add')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/user_form'" class="btn_add"/></div>
<?php endif;?>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อล็อกอิน</th>
  <th>ชื่อ - สกุล</th>
  <th>ข้อมูลติดต่อ</th>
  <!-- <th>กรม</th>
  <th>กอง/สำนัก</th>
  <th>กลุ่ม/ฝ่าย</th> -->
  <th>สิทธ์การใช้งาน</th>
  <th>จัดการ</th>
</tr>
<?php
	$page = (isset($_GET['page']))? $_GET['page']:1;
	$i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
?>
<?php foreach($users as $key=>$user):?>
	<tr <?php alternator('','class="odd"')?>>
	  <td><?php echo $i?></td>
	  <td><?php echo $user['username']?></td>
	  <td><?php echo $user['fullname']?></td>
	  <td>
	  	<?php if($user['contact_number']):?>
	  		<img src="themes/ppt/images/phone.png" alt="" width="16" height="16" class="vtip" style="margin-right:10px;" title="<?php echo $user['contact_number']?>"/>
	  	<?php endif;?>
	  	<?php if($user['email']):?>
	  	<img src="themes/ppt/images/email.png" alt="" width="16" height="16" style="margin-right:10px;" class="vtip" title="<?php echo $user['email']?>" />
	  	<?php endif;?>
	  	<img src="themes/ppt/images/card_address.png" alt="" width="16" height="16" class="vtip" title="<?php echo 'กรม : '.$user['department_name'].'<br>กอง : '.$user['division_name'].'<br>กลุ่ม : '.$user['workgroup_name']?>" />
	  </td>
	  <!-- <td><?php echo $user['department_name']?></td>
	  <td><?php echo $user['division_name']?></td>
	  <td><?php echo $user['workgroup_name']?></td> -->
	  <td><?php echo $user['user_type_name']?></td>
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