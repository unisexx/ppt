<h2>สิทธิ์การใช้งาน</h2>
<div id="search">
  <div id="searchBox">ชื่อสิทธิ์การใช้งาน
    <input type="text" name="textfield" id="textfield" style="width:200px;" />
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<?php if(permission('usertype','add')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/usertype_form'" class="btn_add"/></div>
<?php endif;?>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <!-- <th>ลำดับ</th> -->
  <th>ระดับการใช้งาน</th>
  <th>สิทธิ์การใช้งาน</th>
  <th>จัดการ</th>
</tr>
<?php foreach($user_types as $key=>$user_type):?>
	<tr>
	  <!-- <td><?php echo $key+1?></td> -->
	  <td><?php echo $user_type['user_type_level']?></td>
	  <td><?php echo $user_type['user_type_name']?></td>
	  <td>
	  	<?php if(permission('usertype','edit')):?>
	  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/usertype_form/<?php echo $user_type['id']?>'" />
	  	<?php endif;?>
	  	<?php if(permission('usertype','delete')):?>
	    <a class="btn_delete vtip" title="ลบรายการนี้" href="setting/usertype_delete/<?php echo $user_type['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	    <?php endif;?>
	  </td>
	</tr>
<?php endforeach;?>
</table>