<h2>ตั้งค่าข้อมูลหลัก > ตำบล</h2>
<form method="get" action="setting/set_tumbon">
<div id="search">
  <div id="searchBox">ชื่อตำบล
    <input type="text" name="district_name" style="width:200px;" />
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php if(permission('set_tumbon','add')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/set_tumbon_form'" class="btn_add"/></div>
<?php endif;?>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อตำบล</th>
  <th>อำเภอ</th>
  <th>จังหวัด</th>
  <th width="60">จัดการ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;?>
<?php foreach($tumbons as $tumbon):?>
	<tr>
	  <td><?php echo $i?></td>
	  <td><?php echo $tumbon['district_name']?></td>
	  <td><?php echo $tumbon['amphur_name']?></td>
	  <td><?php echo $tumbon['province']?></td>
	  <td>
	  	<?php if(permission('set_tumbon','edit')):?>
		<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/set_tumbon_form/<?php echo $tumbon['id']?>'" />
		<?php endif;?>
		<?php if(permission('set_tumbon','delete')):?>
		<a class="btn_delete vtip" title="ลบรายการนี้" href="setting/set_tumbon_delete/<?php echo $tumbon['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
		<?php endif;?>
	  </td>
	</tr>
<?php $i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination;?>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
    });
</script>