<h2>ข้อมูลประเด็น - คนต่างด้าวที่ได้รับอนุญาติทำงาน </h2>
<h4>คนต่างด้าวที่ได้รับอนุญาติทำงาน คงเหลือทั้งราชอาณาจักร จำแนกตามสัญชาติ <span class="gray"></span></h4>
<div id="search">
  <div id="searchBox">
    <form method="get" action="alien_nation/alien_nation_data" id="frm_im" name="frm_im">
<?php echo form_dropdown('year', get_year_option(2550), @$_GET['year'], null, '-- ทุกปี --'); ?>
 
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
   </div>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('alien_nation/alien_nation_form'); ?>'" class="btn_add">
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('alien_nation/import_data'); ?>'"  class="btn_import"/></div>


<?php echo $pagination; ?>


<table class="tblist">
<tr>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>สัญชาติ</th>
  <th>ต่างด้าวเข้าเมืองถูกกฏหมาย</th>
  <th>ต่างด้าวเข้าเมืองผิดกฏหมาย</th>
  <th>&nbsp;</th>
</tr>
<tr>
  <th>อันดับ</th>
  <th>ปี </th>
  <th>&nbsp;</th>
  <th>รวม</th>
  <th>รวม</th>
  <th>&nbsp;</th>
</tr>

 <?php foreach($result as $key => $item): $key += 1;?>

<tr>
  <td><a href="<?php echo site_url('alien_nation/alien_nation_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('alien_nation/alien_nation_form/'.$item['id']); ?>"><?php echo $item['alien_year']; ?></a></td>
  <td><a href="<?php echo site_url('alien_nation/alien_nation_form/'.$item['id']); ?>"><?php echo $item['alien_nation']; ?></a><a href="<?php echo site_url('alien_nation/alien_nation_form/'.$item['id']); ?>"></a></td>
  <td><?php echo @number_format($item['alien_in']); ?></td>
  <td><?php echo @number_format($item['alien_out']); ?></td>
  <td>

             <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('alien_nation/alien_nation_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('alien_nation/alien_nation_delete/'.$item['id']); ?>';}" />
    
    
    </td>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>

