<h2>ข้อมูลกลุ่มเป้าหมาย - ผู้ด้อยโอกาส</h2>
<h4>คนยากจน (กลุ่มอายุ) <span class="gray">แบบ สคช. คนยากจน (กลุ่มวัย)</span></h4>

<div id="search">
    <form method="get" action="poor_age/allage">

        <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>

        <input type="submit" title="ค้นหา" value=" " class="btn_search" />
  
    </form>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('poor_age/allage_form'); ?>'" class="btn_add">
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('poor_age/import_data'); ?>'" class="btn_import"/></div>


<?php echo $pagination; ?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>เขตเมือง</th>
  <th>เขตชนบท</th>
  <th>ทั่วประเทศ</th>
  <th>&nbsp;</th>
</tr>
    <?php foreach($result as $key => $item): $key += 1;?>
<tr>
  <td><a href="<?php echo site_url('poor_age/allage_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('poor_age/allage_form/'.$item['id']); ?>"><?php echo $item['year']; ?></a></td>
  <td><?php $township = $item['township_child']+$item['township_work']+$item['township_elderly']; echo @number_format($township); ?></td>
  <td><?php $rural = $item['rural_area_child']+$item['rural_area_work']+$item['rural_area_elderly']; echo @number_format($rural); ?></td>
  <td><?php $country = $item['country_child']+$item['country_work']+$item['country_elderly']; echo @number_format($country); ?></td>
  <td>
  
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('poor_age/allage_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('poor_age/allage_delete/'.$item['id']); ?>';}" />
    
    </td>
</tr>

   <?php endforeach; ?>

</table>

<?php echo $pagination; ?>