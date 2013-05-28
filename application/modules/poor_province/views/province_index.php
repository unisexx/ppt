<h2>ข้อมูลกลุ่มเป้าหมาย - ผู้ด้อยโอกาส</h2>
<h4>คนยากจน (จังหวัด) <span class="gray">แบบ สคช. คนยากจน (จังหวัด)</span></h4>
<div id="search">
  <div id="searchBox">
    <form method="get" action="poor_province/poor_report" id="frm_im" name="frm_im">
 <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
   </div>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('poor_province/province_form'); ?>'" class="btn_add">
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('poor_province/import_data'); ?>'"  class="btn_import"/></div>


<?php echo $pagination; ?>


<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>จังหวัด</th>
  <th>เส้นความยากจน (บาท/คน/เดือน)</th>
  <th>สัดส่วนคนจน (ร้อยละ)</th>
  <th>จำนวนคนจน (พันคน)</th>
  <th>&nbsp;</th>
</tr>

 <?php foreach($result as $key => $item): $key += 1;?>

<tr>
  <td><a href="<?php echo site_url('poor_province/province_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('poor_province/province_form/'.$item['id']); ?>"><?php echo $item['poor_province_year']; ?></a></td>
  <td>
  
  <?php 
  

/*  $sql = 'select * from provinces where id='.$item['poor_province_province'];
  $result1 = $this->opt->get($sql);
  foreach($result1 as $key1 => $item1)
  {
	  echo $item1['province'];
  }*/
  
   echo $item['province'];
   
  ?>
  
  </td>
  <td><?php echo @number_format($item['poor_province_line']); ?></td>
  <td><?php echo @number_format($item['poor_province_percent']); ?></td>
  <td><?php echo @number_format($item['poor_province_qty']); ?></td>
  <td>

            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('poor_province/province_delete/'.$item['id']); ?>';}" />
    
    
    </td>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>
</form>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>