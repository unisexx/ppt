<? $m['id'] = 91; ?>

<?=menu::source($m['id']);?>


<?
	$pv_list_ = $this->station->get("SELECT STATION FROM CRIME_STATION GROUP BY STATION ORDER BY STATION ASC", true);
	foreach($pv_list_ as $tmp) $pv_list[$tmp['station']] = $tmp['station'];
	
	#echo count($pv_list);
	$station_title = array('บก.น.', 'บก.น. 1', 'บก.น. 2', 'บก.น. 3', 'บก.น. 4', 'บก.น. 5', 'บก.น. 6', 'บก.น. 7', 'บก.น. 8', 'บก.น. 9', 'บช.ก.');
?>
<FORM ACTION='' METHOD='GET'>
<div id="search">
  <div id="searchBox">
    <?php echo form_dropdown('YEAR', $year_list, @$_GET['YEAR'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
    <select name='STATION' id='STATION'>
    	<option VALUE=''>-- ทุกจังหวัด --</option>
		<?
		for($i=0; $i<count($station_title); $i++)
			{ ?><option><?=$station_title[$i];?></option><? }
		foreach($pv_list as $tmp)
			echo "<option>".$tmp."</option>";
		?> 
	</select>
	<script language='javascript'>
		$(function(){
			$('#STATION').val("<?=$_GET['STATION'];?>");
		});
	</script>
  <input type="submit" title="ค้นหา" class="btn_search" /></div>
</div>
</FORM>


<?php if(menu::perm($m['id'], 'add')): ?>
	<div id="btnBox">
		<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='datapoint/crime/import'" class="btn_import"/>
		<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='datapoint/crime/form/'" class="btn_add"/>
	</div>
<?php endif; ?>


<?=$pagination; ?>
<table class="tblist">
<tr>
  <th style='width:60px;'>ลำดับ</th>
  <th>ปี</th>
  <th> จังหวัด</th>
  <th>คคีอุกฉกรรณ์และสะเทือนขวัญ</th>
  <th>ดคีชีวิต ร่างกาย และเพศ</th>
  <th>คดีประทุษร้ายต่อทรัพย์</th>
  <th>คดีน่าสนใจ</th>
  <th>คดีรัฐเป็นผู้เสียหาย</th>
	<?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?> <th style='width:120px;'>จัดการ</th> <?php endif; ?>
</tr>

    <?php foreach($result as $key => $item): $key += 1;
		/*	$stt_list = $this->statistic->limit(60)->get("SELECT * FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$item['id']."'");
			
			for($i=0; $i<count($stt_list); $i++)
			{
				if(@$item_res[$stt_list[$i]['case_id']])
					$item_res[$stt_list[$i]['case_id']] += $stt_list[$i]['notified'];
				else
					$item_res[$stt_list[$i]['case_id']] = $stt_list[$i]['notified'];
			}
		 * 
		 */
		 $item_res[1] = (empty($item['1_noti']))?0:$item['1_noti'];
		 $item_res[2] = (empty($item['2_noti']))?0:$item['2_noti'];
		 $item_res[3] = (empty($item['3_noti']))?0:$item['3_noti'];
		 $item_res[4] = (empty($item['4_noti']))?0:$item['4_noti'];
		 $item_res[5] = (empty($item['5_noti']))?0:$item['5_noti'];
    	?>
    <tr>
        <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?=$item['year']; ?></td>
        <td> <?=$item['station'];?> </td>
        <td><?=number_format($item_res[1], 0);?></td>
        <td><?=number_format($item_res[2], 0);?></td>
        <td><?=number_format($item_res[3], 0);?></td>
        <td><?=number_format($item_res[4], 0);?></td>
        <td><?=number_format($item_res[5], 0);?></td>
        
        <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="js_action('<?=$item['id'];?>', 'EDIT');" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>

        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>

</table>
<?=$pagination; ?>


<script language="javascript">
function js_action(id, type)
{
	if(type=='DELETE')
	{
		if(confirm("กรุณายืนยันการลบข้อมูล"))
		{
			window.location="datapoint/crime/delete/"+id;
		}
	}
	else if(type == 'EDIT')
	{
		window.location='datapoint/crime/form/'+id;
	}
}
</script>