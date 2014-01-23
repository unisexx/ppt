<? $m['id'] = 112; ?>
<?=menu::source($m['id']);?>

<form action='' method='get'>
<div id="search">
  <div id="searchBox"> 
  		<? if(@$_GET['page']) { ?> <input type='hidden' name='page' value='<?=@$_GET['page'];?>'> <? } ?>
		
		<select name="year_data">
			<option value="">--- เลือกทุกปี ---</option>
	      <?php foreach($years as $row):?>
	      	<option value="<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == @$_GET['year_data'])?"selected":"";?>><?php echo $row['year_data']?></option>
	      <?php endforeach;?>
	    </select>
	    
	    <select name="code">
	    	<option value="">--- เลือกทุกจังหวัด ---</option>
	      <?php foreach($provinces as $row):?>
	      	<option value="<?php echo $row['code']?>" <?php echo ($row['code'] == @$_GET['code'])?"selected":"";?>><?php echo $row['province']?></option>
	      <?php endforeach;?>
	    </select>
	    
	  	<input type="submit" title="ค้นหา" value=" " class="btn_search" onclick='action_search();'/>
  </div>
</div>
</form>

<?php if(menu::perm($m['id'], 'add')): ?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='healthcare/form_import'" class="btn_import"/>
	<!-- <input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='danger/form'" class="btn_add"/> -->
</div>
<?php endif; ?>

<?=$pagination; ?>

<table class="tblist">
	<tr>
		<!-- <th>ไอดี (project_id)</th> -->
		<th>ปีงบประมาณ</th>
		<th>จังหวัด</th>
		<th>ชื่อโครงการ</th>
		<th>ประเภทองค์กร</th>
		<th>ค่าใช้จ่ายที่ได้รับ</th>
		<th>องค์การ</th>
	</tr>
	<?php foreach($promotefunds as $row):?>
	<tr>
		<!-- <td><?php echo $row['project_id']?></td> -->
		<td><?php echo $row['year_data']?></td>
		<td><?php echo $row['province']?></td>
		<td><?php echo $row['project_name']?></td>
		<td><?php echo $row['under_type']?></td>
		<td><?php echo $row['cost_get']?></td>
		<td><?php echo $row['organ_id']?></td>
	</tr>
	<?php endforeach;?>
</table>

<?=$pagination; ?>