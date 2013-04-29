<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='population/delete/'+hdid;
			}
		})
	})
</script>
<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>ประชากร (คน) </h4>
<?php echo menu::source($menu_id); ?>
<form method="get" enctype="multipart/form-data">
<div id="search">
  <div id="searchBox">
    <?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($_GET['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$_GET['amphur_id'].' order by district_name'), @$_GET['district_id'], null, '-- ทุกตำบล --'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<div id="btnBox">
	<? if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='population/import_form'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='population/form'" class="btn_add"/>
	<? endif;?>
</div>
<!--
<div class="pagebarUTH">&nbsp;<span class="this-page">1</span>
<a href="javascript:;" title="Seite 2">2</a>
<a href="javascript:;" title="Seite 3">3</a>
<a href="javascript:;" title="Seite 4">4</a>

<span class="break">...</span><a href="javascript:;" title="Seite 19">19</a>
<a href="javascript:;" title="Seite 2">Next</a>&nbsp;&nbsp;188 record
</div>
-->	
<?=$pagination;?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>ตำบล(แขวง)/ อำเภอ(เขต) / จังหวัด</th>
  <th>จำนวนประชากรชาย</th>
  <th>จำนวนประชากรหญิง</th>
  <th>จัดการ</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($ppl as $item){
?>
<tr  <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?=$i;?></td>
  <td><?=$item['year_data'];?></td>
  <td>
  	  
  	  <?
  	  $message = $item['district_name'];
  	  $message.= $message!='' ? ' / ' : '';
  	  $message.= $item['amphur_name'];
	  $message.= $message!='' ? ' / ' : '';
  	  $message.= $item['province_name'];
	  echo $message;
  	  ?>
  </td>
  <td><?=number_format($item['sum_male'],0);?></td>
  <td><?=number_format($item['sum_female'],0);?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<? if(menu::perm($menu_id, 'edit')): ?>
  	<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='population/form/<?=$item['id'];?>'" />
  	<? endif;?>
  	<? if(menu::perm($menu_id, 'delete')): ?>
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip"  />
    <? endif;?>
    </td>
</tr>
<? $i++; } ?>
</table>
<?php echo $pagination; ?>
 <script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>