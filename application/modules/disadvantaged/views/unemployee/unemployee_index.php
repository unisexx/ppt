<h2>ข้อมูลกลุ่มเป้าหมาย 2 - ผู้ด้อยโอกาส</h2>
<h4>จำนวนคนว่างงาน <span class="gray">แบบ ...</span></h4>
<form action='' method='get'>
<div id="search">
  <div id="searchBox">
	<?=form_dropdown('YEAR', get_year_option(2551), @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<?=form_dropdown('PROVINCE', get_option('id', 'province', 'provinces'), @$_GET['PROVINCE'], null, '-- แสดงทั้งหมด --'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='disadvantaged/unemployee_import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='disadvantaged/unemployee_form'" class="btn_add"/>
</div>



<?=$pagination; ?>

<table class="tblist">
<tr>
  <th style='width:90px;'>ลำดับ</th>
  <th style='width:90px;'>ปี</th>
  <th> จังหวัด</th>
  <th>จำนวน</th>
  <th style='width:120px;'>จัดการ</th>
</tr>
  <?php foreach($result as $key => $item): $key += 1;
		$item_dtl = $this->province->get_row($item['province_id']);
    	?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td><?=$item_dtl['province'];?> </td>
        <td><?=number_format($item['amount'], 0);?></td>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="js_action('<?=$item['id'];?>', 'EDIT');" />
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
		{
			window.location="disadvantaged/unemployee_delete/"+id;
		}
	}
	else if(type == 'EDIT')
	{
		window.location='disadvantaged/unemployee_form/'+id;
	}
}
</script>

<?=$pagination; ?>