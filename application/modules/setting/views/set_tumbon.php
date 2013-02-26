<h2>ตั้งค่าข้อมูลหลัก > ตำบล</h2>
<form method="get" action="setting/set_tumbon">
<div id="search">
  <div id="searchBox">ชื่อตำบล
    <input type="text" name="tumbon_name" style="width:200px;" />
    <?php echo form_dropdown('province_id',get_option('id','province_name','province'),@$_GET['province_id'],'','-- จังหวัด --');?>
    <?php echo form_dropdown('amphor_id',get_option('id','amphor_name','amphor'),@$_GET['amphor_id'],'','-- อำเภอ --');?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/set_tumbon_form'" class="btn_add"/></div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อตำบล</th>
  <th>อำเภอ</th>
  <th>จังหวัด</th>
<th>จัดการ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;?>
<?php foreach($tumbons as $tumbon):?>
	<tr>
	  <td><?php echo $i?></td>
	  <td><?php echo $tumbon['tumbon_name']?></td>
	  <td><?php echo $tumbon['amphor_name']?></td>
	  <td><?php echo $tumbon['province_name']?></td>
	<td><input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/set_tumbon_form/<?php echo $tumbon['id']?>'" />
	  <a class="btn_delete vtip" title="ลบรายการนี้" href="setting/set_tumbon_delete/<?php echo $tumbon['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	  </td>
	</tr>
<?php $i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination;?>
