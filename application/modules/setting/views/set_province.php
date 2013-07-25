<h2>ตั้งค่าข้อมูลหลัก > จังหวัด</h2>

<form method="get" action="">
<div id="search">
  <div id="searchBox">ชื่อจังหวัด
    <input type="text" name="province" value="<?php echo @$_GET['province']?>" style="width:200px;" />
  <input type="submit" name="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php if(permission('set_province','add')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/set_province_form'" class="btn_add"/></div>
<?php endif;?>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>เขตตรวจราชการ</th>
  <th>ชื่อจังหวัด</th>
  <th width="60">จัดการ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;?>
<?php foreach($provinces as $province):?>
	<tr>
	  <td><?php echo $i?></td>
	  <td><?php echo $province['area_name']?></td>
	  <td><?php echo $province['province']?></td>
	  <td>
	  	<?php if(permission('set_province','edit')):?>
	  	<input type="button" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/set_province_form/<?php echo $province['id']?>'" />
	  	<?php endif;?>
	  	<?php if(permission('set_province','delete')):?>
	    <a class="btn_delete vtip" title="ลบรายการนี้" href="setting/set_province_delete/<?php echo $province['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	    <?php endif;?>
	  </td>
	</tr>
<?php $i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination;?>