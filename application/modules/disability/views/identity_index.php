<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='disability/delete/'+hdid;
			}
		})
	})
</script>
<h2>ข้อมูลกลุ่มเป้าหมาย - คนพิการ</h2>
<h4>คนพิการที่มีบัตรประจำตัวคนพิการ <span class="gray">แบบ nep บัตรคนพิการ</span></h4>
<div id="search">
  <div id="searchBox">
  	<form action="disability/identity">
	    เดือน ปี ที่ข้อมูลอัพเดตล่าสุด
		<?php echo form_dropdown('year',array_combine(range(2009,date('Y')),range(2552,date('Y')+543)),@$_GET['year'],'','-- ทุกปี --'); ?>
	    <?php
	    $month_th = array( 1 =>'มกราคม',2 => 'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฏาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม');
	     echo form_dropdown('month',$month_th,@$_GET['month'],'','-- ทุกเดือน --'); ?>    
	  	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </form>
  </div>
</div>

<div id="btnBox">
	<?php if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='disability/identity_form'" class="btn_add"/>
	<?php endif; ?>
</div>

<?php echo $pagination; ?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ข้อมูล ณ วันที่ ถึง วันที่</th>
  <th>กรุงเทพฯ (ช/ญ)</th>
  <th>ภาคกลางและภาคตะวันออก (ช/ญ)</th>
  <th>ภาคตะวันออกเฉียงเหนือ (ช/ญ)</th>
  <th>ภาคใต้ (ช/ญ)</th>
  <th>ภาคเหนือ (ช/ญ)</th>
  <th>ไม่ระบุ</th>
  <th>จัดการ</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo DB2Date($item['s_date']) ?> - <?php echo DB2Date($item['e_date']) ?></td>
  <td><?php echo number_format($item['bkk_male']) ?> / <?php echo number_format($item['bkk_female']) ?></td>
  <td><?php echo number_format($item['ce_male']) ?>/ <?php echo number_format($item['ce_female']); ?></td>
  <td><?php echo number_format($item['ne_male']) ?> / <?php echo number_format($item['ne_female']) ?></td>
  <td><?php echo number_format($item['s_male']) ?> / <?php echo number_format($item['s_female']) ?></td>
  <td><?php echo number_format($item['n_male']) ?> / <?php echo number_format($item['n_female']) ?></td>
  <td><?php echo number_format($item['i_male']) ?> / <?php echo number_format($item['i_female']) ?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?php echo $item['id'];?>">
  	<?php if(menu::perm($menu_id, 'edit')): ?>
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='disability/identity_form/<?php echo $item['id'] ?>'" /><?php endif; ?>     
   <?php if(menu::perm($menu_id, 'delete')): ?>
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /><?php endif; ?> </td>
</tr>
<?php $i++;endforeach; ?>
<?php echo $pagination; ?>
