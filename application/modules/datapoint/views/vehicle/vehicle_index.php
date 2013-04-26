<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='datapoint/vehicle_delete/'+hdid;
			}
		})
	})
</script>
<h2>ข้อมูลพื้นฐาน - ข้อมูลประเด็น</h2>
<h4>ประชาชนได้รับอุบัติเหตุจากยานพาหนะ <span class="gray">แบบ สตช. อุบัติเหตุยานพาหนะ</span></h4>
<div id="search">
  <div id="searchBox">
  	<form action="datapoint/vehicle">
		    <?php echo form_dropdown('year',array_combine(range(2552,date('Y')+543),range(2552,date('Y')+543)),@$_GET['year'],'','-- ทุกปี --'); ?>
		   <?php echo form_dropdown('agency_id',get_option('id','agency','agency order by id'),@$_GET['agency_id'],'','-- ทุกหน่วยงาน --') ;?>
		  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </form>
  </div>
</div>

<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='datapoint/vehicle_import'" class="btn_import"/>
<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='datapoint/vehicle_form'" class="btn_add"/></div>

<div class="pagebarUTH">&nbsp;<span class="this-page">1</span>
<a href="javascript:;" title="Seite 2">2</a>
<a href="javascript:;" title="Seite 3">3</a>
<a href="javascript:;" title="Seite 4">4</a>

<span class="break">...</span><a href="javascript:;" title="Seite 19">19</a>
<a href="javascript:;" title="Seite 2">Next</a>&nbsp;&nbsp;188 record
</div>	
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>หน่วยงาน</th>
  <th>รับแจ้ง</th>
  <th>ตาย (ช/ญ)</th>
  <th>บาดเจ็บสาหัส (ช/ญ)</th>
  <th>บาดเจ็บเล็กน้อย (ช/ญ)</th>
  <th>มูลค่าทรัพย์สินเสียหายรวม</th>
  <th>จัดการ</th>
</tr>

<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($result as $item):
?>
<tr <?php if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?php echo $i ?></td>
  <td><?php echo $item['year'] ?></td>
  <td><?php echo $item['agency'] ?></td>
  <td><?php echo number_format($item['notice']) ?></td>
  <td><?php echo number_format($item['die_male']) ?> / <?php echo number_format($item['die_female']) ?></td>
  <td><?php echo number_format($item['coma_male']) ?> / <?php echo number_format($item['coma_male']) ?></td>
  <td><?php echo number_format($item['pain_male']) ?> / <?php echo number_format($item['pain_male']) ?></td>
  <td><?php echo number_format($item['total']) ?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='datapoint/vehicle_form/<?php echo $item['id'] ?>'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<?php  ++$i; endforeach; ?>
</table>
