<? $m['id'] = 61; ?>
<?=menu::source($m['id']);?>

<form action='' method='get'>
<div id="search">
  <div id="searchBox">
	<?=form_dropdown('YEAR', get_year_option(2551), @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<?=form_dropdown('PROVINCE', get_option('id', 'province', 'provinces'), @$_GET['PROVINCE'], null, '-- แสดงทั้งหมด --'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<?php if(menu::perm($m['id'], 'add')): ?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='elder/inmates/import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='elder/inmates/form'" class="btn_add"/>
</div>
<?php endif; ?>



<?=$pagination; ?>

<table class="tblist">
<tr>
	<th style='width:90px;'>ลำดับ</th>
	<th style='width:90px;'>ปี</th>
	<th>จังหวัด</th>
	<th>อายุ 60-69</th>
	<th>อายุ 70-79</th>
	<th>อายุ 80</th>
	
	<?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?> <th style='width:120px;'>จัดการ</th> <?php endif; ?>
</tr>
  <?php foreach($result as $key => $item): $key += 1;
		$item_dtl = $this->province->get_row($item['province_id']);
    	?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td><a href="disadvantaged/vacancy_form/<?=$item['id'];?>"><?=$item_dtl['province'];?></a> </td>
        <td><?=number_format($item['value1'], 0);?></td>
        <td><?=number_format($item['value2'], 0);?></td>
        <td><?=number_format($item['value3'], 0);?></td>
        
        <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="js_action('<?=$item['id'];?>', 'EDIT');" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>

</table>
<script language="javascript">
function js_action(id, type)
{
	if(type=='DELETE')
	{
		if(confirm("กรุณายืนยันการลบข้อมูล"))
		{
			window.location="elder/inmates/delete/"+id;
		}
	}
	else if(type == 'EDIT')
	{
		window.location='elder/inmates/form/'+id;
	}
}
</script>

<?=$pagination; ?>
