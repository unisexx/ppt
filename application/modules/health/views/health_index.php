<h2>ผู้สงอายุ - การให้บริการหลักประกันสุขภาพ  </h2>
<h4>การให้บริการหลักประกันสุขภาพ<span class="gray"></span></h4>
<div id="search">
  <div id="searchBox">
    <form method="get" action="health/health_data" id="frm_im" name="frm_im">
<?php echo form_dropdown('year', get_year_option(2555, null, 'HEALTH', 'HEALTH_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>
 
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
   </div>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('health/health_form'); ?>'" class="btn_add">
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('health/import_data'); ?>'"  class="btn_import"/></div>


<?php echo $pagination; ?>


<table class="tblist">
<tr>
  <th height="21">&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th>&nbsp;</th>
  <th colspan="5">รวม</th>
  <th colspan="5">ชาย</th>
  <th colspan="5">หญิง</th>
   <th colspan="5">ไม่ระบุ</th>
  <th>&nbsp;</th>
</tr>
<tr>
  <th height="98">อันดับ</th>
  <th>ช่วงอายุ</th>
  <th>จังหวัด</th>
  <th>ปี</th>
  <th><p>จำนวน<br />
    ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวน</p>
    <p>ประชากร</p>
    <p>(คน)</p></th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพ(คน)</p></th>
  <th>ร้อยละ</th>
  <th><p>จำนวนผู้มีสิทธิ<br />
    หลักประกัน</p>
    <p>สุขภาพถ้วนหน้า(คน)</p></th>
  <th>ร้อยละ</th>
  <th>&nbsp;</th>
</tr>

 <?php foreach($result as $key => $item): $key += 1;?>

<tr>
  <td><a href="<?php echo site_url('health/health_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('health/health_form/'.$item['id']); ?>"><?php echo $item['health_age']; ?></a></td>
  <td><a href="<?php echo site_url('health/health_form/'.$item['id']); ?>"><?php echo $item['health_province']; ?></a></td>
  <td><?php echo $item['health_year']; ?></td>
  <td><?php echo @number_format($item['health_sum_pop']); ?></td>
  <td><?php echo @number_format($item['health_sum_eli']); ?></td>
  <td><?php echo @number_format($item['health_sum_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_sum_acress']); ?></td>
  <td><?php echo @number_format($item['health_sum_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_male_pop']); ?></td>
  <td><?php echo @number_format($item['health_male_eli']); ?></td>
  <td><?php echo @number_format($item['health_male_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_male_acress']); ?></td>
  <td><?php echo @number_format($item['health_male_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_female_pop']); ?></td>
  <td><?php echo @number_format($item['health_female_eli']); ?></td>
  <td><?php echo @number_format($item['health_female_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_female_acress']); ?></td>
  <td><?php echo @number_format($item['health_female_acress_percen']); ?></td>
  <td><?php echo @number_format($item['health_etc_pop']); ?></td>
  <td><?php echo @number_format($item['health_etc_eli']); ?></td>
  <td><?php echo @number_format($item['health_etc_eli_percen']); ?></td>
  <td><?php echo @number_format($item['health_etc_acress']); ?></td>
  <td><?php echo @number_format($item['health_etc_acress_percen']); ?></td>
  <td>

             <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('health/health_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('health/health_delete/'.$item['id']); ?>';}" />
    
    
    </td>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>


