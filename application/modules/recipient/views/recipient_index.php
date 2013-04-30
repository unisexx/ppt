<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='recipient/delete/'+hdid;
			}
		})
	})
</script>
<h2>ข้อมูลกลุ่มเป้าหมาย2 - ผู้ด้อยโอกาส(เพิ่ม/แก้ไข)</h2>
<h4>ผู้รับบริการทางสังคม <span class="gray">แบบ ผู้รับบริการทางสังคม</span></h4>
<form action="recipient/index" method="get">
	<div id="search">
	<div id="searchBox">
	<?php echo form_dropdown('year',array_combine(range(2552,date('Y')+543),range(2552,date('Y')+543)),@$_GET['year'],'','-- ทุกปี--'); ?>	
  	
  	<?php 
  	$agency_id=$this->db->GetAssoc("select agency_id,agency from recipient group by agency_id,agency order by agency_id");
	array_walk($agency_id,'dbConvert');
  	echo form_dropdown('agency_id',$agency_id,@$_GET['agency_id'],'style="width:500px;"','--ทุกหน่วยงาน--'); 
   	$help_id=$this->db->GetAssoc("select help_id,help from recipient group by help_id,help order by help_id");
	array_walk($help_id,'dbConvert');
  	echo form_dropdown('help_id',$help_id,@$_GET['help_id'],'style="width:500px;"','--ทุกความช่วยเหลือ--')  	
  	?>
  	
	  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>
<div id="btnBox">
	<?php  //if(menu::perm($menu_id, 'import')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='recipient/import'" class="btn_import"/>	<?php //endif; ?>
	<?php // if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='recipient/form'" class="btn_add"/>	<?php //endif; ?>
</div>

<?php echo $pagination;?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>วันที่ใบคำขอ</th>
  <th>ชื่อหน่วยงาน</th>
  <th>จำนวนรายบริการ</th>
  <th>ความช่วยเหลือ</th>
  <th>จำนวนเงิน</th>
   <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo $i; ?></td>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo $item['year'] ?></td>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo DB2Date($item['s_date']) ?> - <?php echo DB2Date($item['e_date']) ?></td>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo $item['agency']; ?></td>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo number_format($item['service_total'])?></td>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo $item['help'] ?></td>
  <td onclick="window.location='recipient/form/<?php echo $item['id'] ?>'"><?php echo number_format($item['money_total'])?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<?php  //if(menu::perm($menu_id, 'edit')): ?>
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='recipient/form/<?php echo $item['id'] ?>'" />	<?php //endif; ?>
    <?php  //if(menu::perm($menu_id, 'delete')): ?>
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" />	<?php //endif; ?></td>
</tr>
<?php 
$i++;
endforeach; ?>
</table>
<?php echo $pagination; ?>
