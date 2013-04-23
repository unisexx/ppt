<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>เด็กและเยาวชนที่อยู่ในความอุปการะของสถานสงเคราะห์/สถานคุ้มครอง/สถานพัฒนาและฟื้นฟู/ศูนย์ฝึกอาชีพ/บ้านพักเด็กและครอบครัว  <span class="gray">แบบ พส. สถานสงเคราะห์</span></h4>
<form action='' method='get'>
<div id="search">
  <div id="searchBox">
	<?=form_dropdown('YEAR', get_year_option(2552), @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<?=form_dropdown('WLIST', get_option('id', 'name', 'welfare_list'), @$_GET['WLIST'], null, '-- แสดงทั้งหมด --'); ?>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='people.php?act=import'" class="btn_import"/><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='child/welfare_form'" class="btn_add"/></div>



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
  <th>จัดการ</th>
</tr>
  <?php foreach($result as $key => $item): $key += 1;
		$item_dtl = $this->wflist->get_row($item['wlist_id']);
    	?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td><?=$item_dtl['name'];?> </td>
        <td><?=number_format($item['target'], 0);?></td>
        <td><?=number_format($item['balance'], 0);?></td>
        <td><?=number_format($item['admission'], 0);?></td>
        <td><?=number_format($item['distribution'], 0);?></td>
        <td><?=number_format($item['remain'], 0);?></td>
        <td><?=number_format($item['build'], 0);?></td>
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
			window.location="child/welfare_delete/"+id;
		}
	}
	else if(type == 'EDIT')
	{
		window.location='child/welfare_form/'+id;
	}
}
</script>

<?=$pagination; ?>
