<? $m['id'] = 110; ?>
<?=menu::source($m['id']);?>		
<form action='' method='get'>
<div id="search">
  <div id="searchBox">
	<?=form_dropdown('YEAR', $set_year, @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<?=form_dropdown('WLIST', get_option('id', 'name', 'disabled_list'), @$_GET['WLIST'], null, '-- แสดงทั้งหมด --'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>	


	<?php if(menu::perm($m['id'], 'add')): ?>
	<div id="btnBox">
		<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='disability/disabled/import'" class="btn_import"/>
		<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='disability/disabled/form'" class="btn_add"/>
	</div>
	<?php endif; ?>


<?=$pagination; ?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th> หน่วยงาน</th>
  <th>เป้าหมาย</th>
  <th>ยอดยกมา</th>
  <th>รับเข้า</th>
  <th>จำหน่าย</th>
  <th>คงเหลือ</th>
  <th>สะสม</th>
	<?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?> <th>จัดการ</th><?php endif; ?>
</tr>
  <?php foreach($result as $key => $item): $key += 1;
		$item_dtl = $this->wflist->get_row($item['wlist_id']);
    	?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td><a href="disability/disabled/form/<?=$item['id'];?>" style="cursor:pointer;"><?=$item_dtl['name'];?> </a></td>
        <td><?=@number_format($item['target'], 0);?></td>
        <td><?=@number_format($item['balance'], 0);?></td>
        <td><?=@number_format($item['admission'], 0);?></td>
        <td><?=@number_format($item['distribution'], 0);?></td>
        <td><?=@number_format($item['remain'], 0);?></td>
        <td><?=@number_format($item['build'], 0);?></td>
        <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <?php echo menu::perm($m['id'], 'edit', 'disability/disabled/form/'.$item['id']); ?>
            <?php echo menu::perm($m['id'], 'delete', 'disability/disabled/delete/'.$item['id']); ?>
        </td>
        <?php endif; ?>

        <td style='display:none;'>
        	
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>

        </td>
    </tr>
    <?php endforeach; ?>

</table>
<script language="javascript">
function js_action(id, type)
{
	if(type=='DELETE')
	{
		if(confirm("กรุณายืนยันการลบข้อมูล"))
		{ window.location="disability/disabled/delete/<?=$m['id'];?>/"+id;}
		
	}
	else if(type == 'EDIT')
	{
		window.location='disability/disabled/form/'+id;
	}
}
</script>

<?=$pagination; ?>