<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='child/drop_delete/'+hdid;
			}
		})
	})
</script>

<?php echo menu::source($menu_id); ?>
<form action="child/drop" method="get">
	<div id="search">
	<div id="searchBox">หมายเลขเขต
	<input type="text" name="area_number" id="area_number" style="width:100px;" value="<?php echo @$_GET['area_number'] ?>"/>
	<?php echo form_dropdown('year',get_year_option(),@$_GET['year'],'','-- ทุกปีการศึกษา --'); ?>
<select name="province" id="province">
 <option value="">-- ทุกจังหวัด --</option>
  <?php 
  $selected="selected='selected'";
  foreach($province as $item){
  	$selected=($item['province']==@$_GET['province'])?"selected='selected'":'';
  	echo '<option value="'.$item['province'].'" '.$selected.'>'.$item['province'].'</option>';
  } ?>
  </select>
	  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>
<div id="btnBox">
	 <?php  if(menu::perm($menu_id, 'import')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='child/drop_import'" class="btn_import"/><?php endif;?>
   <?php  if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='child/drop_form'" class="btn_add"/><?php endif; ?>
</div>

<?php echo $pagination;?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปีการศึกษา</th>
  <th>จังหวัด</th>
  <th><span class="vtip" title="ฐานะยากจน">1</span></th>
  <th><span class="vtip" title="มีปัญหาครอบครัว">2</span></th>
  <th><span class="vtip" title="สมรสแล้ว">3</span></th>
  <th><span class="vtip" title="มีปัญหาในการปรับตัว">4</span></th>
  <th><span class="vtip" title="ต้องคดี/ถูกจับ">5</span></th>
  <th><span class="vtip" title="เจ็บป่วย/อุบัติเหตุ">6</span></th>
  <th><span class="vtip" title="อพยพตามผู้ปรกครอง">7</span></th>
  <th><span class="vtip" title="หาเลี้ยงครอบครัว">8</span></th>
  <th><span class="vtip" title="กรณีอื่นๆ">9</span></th>
  <th>รวม</th>
  <th>จำนวน นร.ต้นปี</th>
  <th>%</th>
  <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $i; ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['year']; ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo anchor('child/drop_form/'.$item['id'], $item['province']); ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['poor'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['family'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['married'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['adapt'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['capture'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['accident'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['migration'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['breadwinner'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $item['other'] ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo $sum=$item['poor']+$item['family']+$item['married']+$item['adapt']
  																																						+$item['capture']+$item['accident']+$item['migration']+$item['breadwinner']+$item['other']; ?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo number_format($item['total'])?></td>
  <td onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'"><?php echo round(($sum*100)/$item['total'],2);?></td>
  
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<?php  if(menu::perm($menu_id, 'edit')): ?>
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'" /><?php endif; ?>
    <?php  if(menu::perm($menu_id, 'delete')): ?>
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /><?php endif; ?>
    </td>
    

</tr>
<?php 
$i++;
endforeach; ?>
</table>
<?php echo $pagination; ?>
