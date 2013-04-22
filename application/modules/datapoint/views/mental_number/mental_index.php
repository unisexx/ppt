<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>จำนวนและอัตราผู้ป่วยสุภาพจิต <span class="gray">แบบ กรมสุขภาพจิต</span></h4>

<div id="search">
  <div id="searchBox"> 
  		<? if(@$_GET['page']) { ?> <input type='hidden' name='page' value='<?=@$_GET['page'];?>'> <? } ?>
		<select name='year' id='year'>
			<option value='NA'>แสดงทุกปี</option>
			<? for($i=(date('Y')+543); $i>=2554; $i--) { ?> <option><?=$i;?></option> <? } ?>
		</select>
		
		<select name='province_id' id='province_id'>
			<option value='NA'>แสดงทั้งหมด</option>
			<? for($i=0; $i<count($province); $i++) { ?> <option value='<?=$province[$i]['id'];?>'><?=$province[$i]['province'];?></option> <? } ?>
		</select>
		<script language="javascript">
			$('#year').val("<?=$_POST['year'];?>");
			$('#province_id').val("<?=$_POST['province_id'];?>");
		</script>
		
	  	<input type="button" title="ค้นหา" value=" " class="btn_search" onclick='action_search();'/>
		<script language="javascript">
			function action_search()
			{
				year = $('#year').val();
				province_id = $('#province_id').val();
				
				if(year == 'NA' && province_id == 'NA') { urllink = 'datapoint/mental'; }
				else { urllink = "datapoint/mental/"+$("#year").val()+"/"+$("#province_id").val(); }

				window.location = urllink; 
			}
		</script>
  </div>
</div>

<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='people.php?act=import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='datapoint/mental_form'" class="btn_add"/>
</div>
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
	  <th>จัดการ</th>
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
        		
				echo $item['province'];
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
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('datapoint/mental_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>

        </td>
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
			window.location="datapoint/mental_delete/"+id;
		}
	}
}
</script>
<?=$pagination; ?>
