<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็กและเยาวชน ตามสาเหตุการกระทำความผิด <span class="gray">แบบ กรมพินิจ สาเหตุกระทำความผิด</span></h4>
<div id="search">
  <div id="searchBox">
    <form method="get" action="offender/offender_data">
 <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
   </div>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('offender/offender_form'); ?>'" class="btn_add">
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('offender/import_data'); ?>'" class="btn_import"/></div>


<?php echo $pagination; ?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>ป่วยทางจิต</th>
  <th>ทะเลาะวิวาท</th>
  <th>สภาพทางเศรษฐกิจ</th>
  <th>ผู้อื่นชักจูง/บังคับ</th>
  <th>สภาพครอบครัว</th>
  <th>การคบเพื่อน</th>
  <th>ความรู้เท่าไม่ถึงการณ์</th>
  <th>คึกคะนอง</th>
  <th>อื่น ๆ</th>
  <th>&nbsp;</th>
</tr>

 <?php foreach($result as $key => $item): $key += 1;?>
<tr>
  <td><a href="<?php echo site_url('offender/offender_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('offender/offender_form/'.$item['id']); ?>"><?php echo $item['offender_year']; ?></a></td>
  <td><a href="<?php echo site_url('offender/offender_form/'.$item['id']); ?>"><?php echo @number_format($item['offender_mental']); ?></a></td>
  <td><?php echo @number_format($item['offender_wrangle']); ?></td>
  <td><?php echo @number_format($item['offender_social']); ?></td>
  <td><?php echo @number_format($item['offender_force']); ?></td>
  <td><?php echo @number_format($item['offender_family']); ?></td>
  <td><?php echo @number_format($item['offender_friend']); ?></td>
  <td><?php echo @number_format($item['offender_unknow']); ?></td>
  <td><?php echo @number_format($item['offender_fight']); ?></td>
  <td><?php echo @number_format($item['offender_etc']); ?></td>
<td>
  
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('offender/offender_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('offender/offender_delete/'.$item['id']); ?>';}" />
    
    </td>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>

