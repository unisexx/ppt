<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป </h2>
<h4>การให้บริการรับจำนำ <span class="gray">แบบ สถานธนานุเคราะห์</span></h4>
<form action="" method='get'>
	<div id="search">
	  <div id="searchBox">
	  	<?=form_dropdown('YEAR', get_year_option(2554), @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
		<?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '--แสดงทั้งหมด--'); ?> 
	    <?php echo form_dropdown('amphur_id', (empty($rs['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.@$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- แสดงทั้งหมด --'); ?>
	  	<input type="submit" title="ค้นหา" value=" " class="btn_search" />
	  </div>
	</div>
</form>

<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='people.php?act=import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='information/pledgee_form'" class="btn_add"/>
</div>

<div style='display:none;'>
		<div class="pagebarUTH">&nbsp;<span class="this-page">1</span>
		<a href="javascript:;" title="Seite 2">2</a>
		<a href="javascript:;" title="Seite 3">3</a>
		<a href="javascript:;" title="Seite 4">4</a>
		
		<span class="break">...</span><a href="javascript:;" title="Seite 19">19</a>
		<a href="javascript:;" title="Seite 2">Next</a>&nbsp;&nbsp;188 record
		</div>	
</div>

<?php echo $pagination; ?>

<table class="tblist">
<tr>
  <th style='width:80px;'>ลำดับ</th>
  <th style='width:100px;'>เลขที่ตั๋วจำนำ</th>
  <th style='width:120px;'>วันที่รับจำนำ</th>
  <th style='width:100px;'>ราคารับจำนำ</th>
  <th style='width:100px;'>รหัสลูกค้า</th>
  <th>ชื่อ</th>
  <th style='width:130px;'>เลขที่บัตร</th>
  <th>อายุ</th>
  <th style='width:100px;'>สัญชาติ</th>
  <th style='width:280px;'>ที่อยู่</th>
  <th>อาชีพ</th>
  <th style='width:80px;'>จัดการ</th>
</tr>

    <?php foreach($result as $key => $item): $key += 1;?>
    <tr>
    	<td><? echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
    	<td><?=$item['pth_ticket_no'];?></td> <!-- เลขที่ตั๋วจำนำ -->
    	<td>
    		<? $date['month_th'] = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤศภาคม', 'มิภุนยน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'); ?>
	    		<?=date('d ', strtotime($item['pth_ticket_date']))*1;?>
	    		<?=$date['month_th'][(date('m ', strtotime($item['pth_ticket_date']))*1)-1];?>
	    		<?=date('Y', strtotime($item['pth_ticket_date']))+543;?>
    	</td> <!-- วันที่รับจำนำ -->
    	<td><?=number_format($item['pth_pawn_cost'], 2);?></td> <!-- ราคารับจำนำ -->
    	<td>NULL</td><!-- รหัสลูกค้า-->
    	<td><?=$item['ctm_title'];?></td> <!-- คำนำหน้า-->
    	<td><?=$item['ctm_card_no'];?></td> <!-- เลขที่บัตร -->
    	<td><?=$item['ctm_age'].' ปี';?></td> <!-- อายุ -->
    	<td><?=$item['ctm_nationality'];?></td> <!-- สัญชาติ -->
    	<td>
    		<?=$item['ctm_house_no'];?>
    		<?=($item['ctm_road'])?' ถนน '.$item['ctm_road']:'';?>
    		<?=($item['ctm_tumbon'])?' ตำบล '.$item['ctm_tumbon']:'';?>
    		<?=($item['ctm_pvm_amp_code'])?' อำเภอ '.$item['amphur_name']:'';?>
    		<?=($item['ctm_pvm_pv_code'])?' จังหวัด '.$item['province']:'';?>
    		
    	</td>
    	<td><?=$item['ctm_ocm_code'];?></td> <!-- อาชีพ -->
		<td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip" onclick='window.location="information/pledgee_form/<?=$item['id'];?>";'/>
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick='js_action("<?=$item['id'];?>", "DELETE");'/>

		</td>
    	
    	<td style='display:none;'><?=$item['ptd_seq'];?></td> <!-- ??? -->
    	<td style='display:none;'><?=$item['ptd_desc'];?></td> <!-- ??? -->
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
			window.location="information/pledgee_delete/"+id;
		}
	}
}
</script>
<?php echo $pagination; ?>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>