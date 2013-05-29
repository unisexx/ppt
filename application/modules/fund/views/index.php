<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='fund/delete/'+hdid;
			}
		})
	})
</script>
<h2>ข้อมูลพื้นฐาน - ทุนทางสังคม</h2>
<h4>กองทุนสวัสดิการชุมชน</h4>
<form method="get" >
<div id="search">
  <div id="searchBox">
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($_GET['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$_GET['amphur_id'].' order by district_name'), @$_GET['district_id'], null, '-- ทุกตำบล --'); ?>    
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </div>
</div>
</form>
<div id="btnBox">
	<? if(menu::perm($menu_id, 'add')): ?>
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='fund/import_form'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='fund/form'" class="btn_add"/>
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
  <th>วันที่ก่อตั้ง</th>
  <th>ชื่อกองทุน</th>
  <th>ที่อยู่</th>
  <th>&nbsp;</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($fund as $item){
  	 $address = '';
?>
<tr  <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?=$i;?></td>
  <td><?=$item['org_create_date'];?></td>
  <td><a href="fund/form/<?=$item['id'];?>"><?=$item['fund_name'];?></a></td>
  <td>
  	<?
  		$address = $item['contact_add_no']!='' ? "<b>เลขที่</b> ".$item['contact_add_no'] : '';
  		$address.= $address !='' ? ' ': '';
		$address.= $item['contact_add_moo']!='' ? "<b>หมู่ </b>".$item['contact_add_moo'] : '';
		$address.= $address !='' ? ' ': '';
		$address.= $item['contact_add_road']!='' ? "<b>ถนน</b> ".$item['contact_add_road']: '';
		$address.= $address !='' ? ' ': '';
		$address.= $item['contact_tumbon_name']!='' ? "<b>แขวง/ตำบล</b> ".$item['contact_tumbon_name'] : '';
		$address.= $address !='' ? ' ': '';
		$address.= $item['contact_amphur_name']!='' ? "<b>เขต/อำเภอ</b> ".$item['contact_amphur_name'] : '';
		$address.= $address !='' ? ' ': '';
		$address.= $item['contact_province_name']!='' ? "<b>จังหวัด</b> ".$item['contact_province_name'] : '';
		$address.= $address !='' ? ' ': '';
		$address.= $item['contact_add_postcode']!='' ? ' '.$item['contact_add_postcode']: '';
		echo $address;
  	?>
  </td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<? if(menu::perm($menu_id, 'edit')): ?>
  	<input type="button" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='fund/form/<?=$item['id'];?>'" />
  	<? endif;?>
  	<? if(menu::perm($menu_id, 'delete')): ?>
    <input type="button" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" />
    <? endif;?>
    </td>
</tr>
<? $i++; } ?>
</table>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>