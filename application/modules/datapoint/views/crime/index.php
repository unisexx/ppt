<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>ความผิดทางคดีอาญา  <span class="gray">แบบ สตช. คดีอาญา</span></h4>

<?
	$pv_list = $this->province->limit(80)->get('SELECT * FROM PROVINCES WHERE ID != 1');
	$station_title = array('บก.น.', 'บก.น. 1', 'บก.น. 2', 'บก.น. 3', 'บก.น. 4', 'บก.น. 5', 'บก.น. 6', 'บก.น. 7', 'บก.น. 8', 'บก.น. 9', 'บช.ก.');
?>
<FORM ACTION='' METHOD='GET'>
<div id="search">
  <div id="searchBox">
    <?php echo form_dropdown('YEAR', get_year_option(2553), @$_GET['YEAR'], null, '-- กรุณาเลือกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
    <select name='STATION' id='STATION'>
    	<option VALUE=''>-- ทุกจังหวัด --</option>
		<?
		for($i=0; $i<count($station_title); $i++)
			{ ?><option><?=$station_title[$i];?></option><? }
		for($i=0; $i<count($pv_list); $i++)
			{ ?><option><?=$pv_list[$i]['province'];?></option><? }
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

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='datapoint/crime/import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='datapoint/crime/form/'" class="btn_add"/></div>


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
  <th>จัดการ</th>
</tr>

    <?php foreach($result as $key => $item): $key += 1;
			$stt_list = $this->statistic->limit(60)->get("SELECT * FROM CRIME_STATISTIC WHERE STATION_ID LIKE '".$item['id']."'");
			
			for($i=0; $i<count($stt_list); $i++)
			{
				if(@$item_res[$stt_list[$i]['case_id']])
					$item_res[$stt_list[$i]['case_id']] += $stt_list[$i]['notified'];
				else
					$item_res[$stt_list[$i]['case_id']] = $stt_list[$i]['notified'];
			}	
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
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="js_action('<?=$item['id'];?>', 'EDIT');" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>

        </td>
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