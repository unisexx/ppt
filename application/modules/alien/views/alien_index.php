<? $m['id'] = 91; ?>

<h2>ข้อมูลประเด็น - คนต่างด้าวที่ได้รับอนุญาติทำงาน </h2>
<h4>คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร <span class="gray"></span></h4>


<FORM ACTION='' METHOD='GET'>
	<div id="search">
	  <div id="searchBox">
		<?php echo form_dropdown('year', $year_list, @$_GET['year'], null); ?>
	  <input type="submit" title="ค้นหา" class="btn_search" /></div>
	</div>
</FORM>


<?php if(menu::perm($m['id'], 'add')): ?>
	<div id="btnBox">
	    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('alien/alien_form'); ?>'" class="btn_add">
	    <input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('alien/import_data'); ?>'"  class="btn_import"/>
	</div>
<?php endif; ?>


<?php echo $pagination; ?>


<table class="tblist">
<tr>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>จังหวัด</th>
  <th>รวมทั้งสิ้น</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>ต่างด้าวเข้าเมืองถูกกฏหมาย</th>
  <th>ต่างด้าวเข้าเมืองผิดกฏหมาย</th>
	<?php if(menu::perm($m['id'], 'add')): ?> <th>&nbsp;</th> <?php endif; ?>
</tr>
<tr>
	<th>อันดับ</th>
	<th>ปี </th>
	<th>&nbsp;</th>
	<th>รวม</th>
	<th>ชาย</th>
	<th>หญิง</th>
	<th>รวม</th>
	<th>รวม</th>
	<?php if(menu::perm($m['id'], 'add')): ?> <th>&nbsp;</th> <?php endif; ?>
</tr>

 <?php foreach($result as $key => $item): $key += 1;?>

<tr>
  <td><a href="<?php echo site_url('alien/alien_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('alien/alien_form/'.$item['id']); ?>"><?php echo $item['alien_year']; ?></a></td>
  <td><a href="<?php echo site_url('alien/alien_form/'.$item['id']); ?>"><?php echo $item['alien_province']; ?></a><a href="<?php echo site_url('alien/alien_form/'.$item['id']); ?>"></a></td>
  <td><a href="<?php echo site_url('alien/alien_form/'.$item['id']); ?>"><?php echo @number_format($item['alien_sum']); ?></a></td>
  <td><?php echo @number_format($item['alien_male']); ?></td>
  <td><?php echo @number_format($item['alien_female']); ?></td>
  <td><?php echo @number_format($item['alien_sum_in']); ?></td>
  <td><?php echo @number_format($item['alien_sum_out']); ?></td>
	<?php if(menu::perm($m['id'], 'add')): ?>
		<td>
			<input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('alien/alien_form/'.$item['id']); ?>'" />
			<input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('alien/alien_delete/'.$item['id']); ?>';}" />
		</td>
	<?php endif; ?>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>


