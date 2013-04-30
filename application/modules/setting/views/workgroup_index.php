<script type="text/javascript">
	$(document).ready(function(){
		$(".btn_delete").click(function(){
			if(confirm('ลบรายการนี้ ? ')){
				var hdid = $(this).closest('td').find('#hdid').val();
				window.location='setting/section/workgroup_delete/'+hdid;
			}
		})
	})
</script>
<h2>ตั้งค่าข้อมูลหลัก - หน่วยงานหลัก - ฝ่าย/กลุ่มงาน</h2>
<h4><?=$section_name;?></h4>
<form method="get" >
<div id="search">
  <div id="searchBox">
  	<?=form_dropdown('pid',get_option('id','title','section','PID = 0 ORDER BY title '),@$_GET['pid'],'','--ทุกหน่่วยงาน--');?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($_GET['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$_GET['amphur_id'].' order by district_name'), @$_GET['district_id'], null, '-- ทุกตำบล --'); ?>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </div>
</div>
</form>
<div id="btnBox">
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/section/workgroup_form?pid=<?=@$_GET['pid'];?>'" class="btn_add"/>
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
  <th>ชื่อ</th>
  <th>ที่อยู่</th>
  <th>เบอร์โทรศัพท์</th>
  <th>เบอร์โทรสาร</th>
  <th>&nbsp;</th>
</tr>
<?php 
  $rowStyle = '';
  $page = (isset($_GET['page']))? $_GET['page']:1;
  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
  foreach($data as $item){
?>
<tr  <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?>>
  <td><?=$i;?></td>
  <td><?=$item['title'];?></td>
  <td>
  	<?=$item['address'];?>
  	<?
  		$district_name = $this->db->getone("SELECT DISTRICT_NAME FROM DISTRICT WHERE ID=".$item['district_id']);
  		$amphur_name = $this->db->getone("SELECT AMPHUR_NAME FROM AMPHUR WHERE ID=".$item['amphur_id']);
  		$province_name = $this->db->getone("SELECT PROVINCE FROM PROVINCES WHERE ID=".$item['province_id']);
  		if($district_name!='')echo  'แขวง/ตำบล  '.iconv("tis-620","utf-8",$district_name).'  ';
  		if($amphur_name!='')echo  'เขต/อำเภอ  '.iconv("tis-620","utf-8",$amphur_name).'  ';
  		if($province_name!='') echo 'แขวง/จังหวัด  '.iconv("tis-620","utf-8",$province_name).' ';
		echo $item['postcode'];
  	?>
  </td>
  <td><?=$item['tel']?></td>
  <td><?=$item['fax'];?></td>
  <td>
  	<input type="hidden" name="hdid[]" id="hdid" class="hdid" value="<?=$item['id'];?>">
  	<input type="button" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/section/workgroup_form/<?=$item['id'];?>'" />
    <input type="button" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<? $i++; } ?>
</table>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>
