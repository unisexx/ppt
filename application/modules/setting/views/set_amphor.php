<h2>ตั้งค่าข้อมูลหลัก > อำเภอ</h2>
<form method="get" action="setting/set_amphor">
<div id="search">
  <div id="searchBox">ชื่ออำเภอ
    <input type="text" name="amphor_name" value="<?php echo @$_GET['amphor_name']?>" style="width:200px;" />
    <?php echo form_dropdown('province_id',get_option('id','province_name','province'),@$_GET['province_id'],'','-- จังหวัด --');?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/set_amphor_form'" class="btn_add"/></div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่ออำเภอ</th>
  <th>จังหวัด</th>
  <th>จัดการ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;?>
<?php foreach($amphors as $amphor):?>
	<tr>
	  <td><?php echo $i;?></td>
	  <td><?php echo $amphor['amphor_name']?></td>
	  <td><?php echo $amphor['province_name']?></td>
	  <td>
	  	<input type="button" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/set_amphor_form/<?php echo $amphor['id']?>'" />
	    <a class="btn_delete vtip" title="ลบรายการนี้" href="setting/set_amphor_delete/<?php echo $amphor['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	  </td>
	</tr>
<?php $i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination;?>