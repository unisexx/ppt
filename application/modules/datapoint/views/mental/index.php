<? $m['id'] = 86; ?>
<?=menu::source($m['id']);?>


<form action='' method='get'>
<div id="search">
  <div id="searchBox"> 
  		<? if(@$_GET['page']) { ?> <input type='hidden' name='page' value='<?=@$_GET['page'];?>'> <? } ?>
		<?=form_dropdown('year', get_year_option(), @$_GET['year'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
		<?=form_dropdown('province_id', get_option('id', 'province', 'provinces'), @$_GET['province_id'], null, '-- แสดงทั้งหมด --'); ?>
	  	<input type="submit" title="ค้นหา" value=" " class="btn_search" onclick='action_search();'/>
  </div>
</div>
</form>

<?php if(menu::perm($m['id'], 'add')): ?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='datapoint/mental/import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='datapoint/mental/form'" class="btn_add"/>
</div>
<?php endif; ?>

<?=$pagination; ?>

<table class="tblist">
	<tr>
	  <th>ลำดับ</th>
	  <th>ปี</th>
	  <th> จังหวัด</th>
	  <th>โรคจิต</th>
	  <th>โรควิตกกังวล</th>
	  <th>โรคซึมเศร้า</th>
	  <th>ปัญญาอ่อน</th>
	  <th>โรคลมชัก</th>
	  <th>ผู้ติดสารเสพติด</th>
	  <th>ออติสติก</th>
	  <th>อื่นๆ</th>
		<?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?> <th style='width:120px;'>จัดการ</th> <?php endif; ?>
	</tr>
	
    <?php foreach($result as $key => $item): $key += 1;?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td>
        	<?
        		if(!$item['province'])
					{
						if($item['province_id'] == 99) { $item['province'] = 'ต่างชาติ'; }
					}
        		
				echo anchor('datapoint/mental/form/'.$item['id'], $item['province']);
        	?>
        	
        </td>
        <td><?=number_format($item['psy_number']); ?></td>
        <td><?=number_format($item['fear_number']); ?></td>
        <td><?=number_format($item['depress_number']); ?></td>
        <td><?=number_format($item['retarded_number']); ?></td>
        <td><?=number_format($item['apoplexy_number']); ?></td>
        <td><?=number_format($item['drugadd_number']); ?></td>
        <td><?=number_format($item['autism_number']); ?></td>
        <td><?=number_format($item['other_number']); ?></td>
        
        <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('datapoint/mental/form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>

        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>

</table>

<script language="javascript">
function js_action(id, type)
{
	if(type == 'DELETE')
	{
		if(confirm('กรุณายืนยันการลบข้อมูล'))
		{
			window.location="datapoint/mental/delete/<?=$m['id'];?>/"+id;
		}
	}
}
</script>
<?=$pagination; ?>
