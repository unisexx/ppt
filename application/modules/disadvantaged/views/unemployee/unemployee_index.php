<? $m['id'] = 71; ?>
<?=menu::source($m['id']);?>


<form action='' method='get'>
<div id="search">
  <div id="searchBox">
	<?=form_dropdown('YEAR', get_year_option(), @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<?=form_dropdown('PROVINCE', get_option('id', 'province', 'provinces'), @$_GET['PROVINCE'], null, '-- แสดงทั้งหมด --'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<?php if(menu::perm($m['id'], 'add')): ?>
	<div id="btnBox">
		<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='disadvantaged/unemployee_import'" class="btn_import"/>
		<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='disadvantaged/unemployee_form'" class="btn_add"/>
	</div>
<?php endif; ?>


<?=$pagination; ?>

<table class="tblist">
<tr>
  <th style='width:90px;'>ลำดับ</th>
  <th style='width:90px;'>ปี</th>
  <th> จังหวัด</th>
  <th>จำนวน</th>
  
  <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?><th style='width:120px;'>จัดการ</th><?php endif; ?>
</tr>
  <?php foreach($result as $key => $item): $key += 1; ?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td><a href="disadvantaged/unemployee_form/<?=$item['id'];?>"><?=$item['province'];?></a></td>
        <td><?=number_format($item['amount'], 0);?></td>
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
			window.location="disadvantaged/unemployee_delete/<?=$m['id'];?>/"+id;
		}
	}
	else if(type == 'EDIT')
	{
		window.location="disadvantaged/unemployee_form/"+id;
	}
}
</script>

<?=$pagination; ?>
