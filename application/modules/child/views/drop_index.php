<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>เด็กและเยาวชนออกจากโรงเรียนกลางคัน <span class="gray">แบบ ศธ. ออกโรงเรียนกลางคัน</span></h4>
<form action="child/drop" method="get">
	<div id="search">
	<div id="searchBox">หมายเลขเขต
	<input type="text" name="area_number" id="area_number" style="width:100px;" value="<?php echo @$_GET['area_number'] ?>"/>
	<?php echo form_dropdown('year',array_combine(range(2552,date('Y')+543),range(2552,date('Y')+543)),@$_GET['year'],'','-- เลือกปีการศึกษา --'); ?>
	<?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
	  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
	</div>
</form>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='child/drop_import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='child/drop_form'" class="btn_add"/>
</div>

<?php echo $pagination;?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปีการศึกษา</th>
  <th>จังหวัด</th>
  <th>หมายเลขเขต</th>
  <th>จำนวน นร.ต้นปี</th>
  <th>จัดการ</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?php echo $i; ?></td>
  <td><?php echo $item['year']; ?></td>
  <td><?php echo $item['province']?></td>
  <td><?php echo $item['area_number'] ?></td>
  <td><?php echo number_format($item['total'])?></td>
  <td>
  	
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='child/drop_form/<?php echo $item['id'] ?>'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<?php 
$i++;
endforeach; ?>
</table>
<?php echo $pagination; ?>
