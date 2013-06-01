<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็กและเยาวชน ตามฐานความผิด <span class="gray">แบบ กรมพินิจ ฐานความผิด</span></h4>
<div id="search">
  <div id="searchBox">
    <form method="get" action="offense/offense_data">
 <?php echo form_dropdown('year', get_year_option(2555, null, 'OFFENSES', 'OFFENSE_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
 
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  </div>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('offense/offense_form'); ?>'" class="btn_add">
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?php echo site_url('offense/import_data'); ?>'" class="btn_import"/></div>


<?php echo $pagination; ?>

<table class="tblist">
<tr>
  <th rowspan="2">ลำดับ</th>
  <th rowspan="2">ปี</th>
  <th rowspan="2"> จังหวัด</th>
  <th colspan="8" style="font-weight:700">ฐานความผิดเกี่ยวกับ</th>
  </tr>
<tr>
  <th>ทรัพย์</th>
  <th>ชีวิตและร่างกาย</th>
  <th>เพศ</th>
  <th>ความสงบสุข เสรีภาพ ชื่อเสียง และการปกครอง</th>
  <th>ยาเสพติดให้โทษ</th>
  <th>อาวุธและวัตถุระเบิด</th>
  <th>อื่น ๆ</th>
  <th>จัดการ</th>
</tr>
 <?php foreach($result as $key => $item): $key += 1;?>
<tr>
  <td><a href="<?php echo site_url('offense/offense_form/'.$item['id']); ?>"><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></a></td>
  <td><a href="<?php echo site_url('offense/offense_form/'.$item['id']); ?>"><?php echo $item['offense_year']; ?></a></td>
  <td>
  
  <a href="<?php echo site_url('offense/offense_form/'.$item['id']); ?>">
  
  <?php 
  
  //echo $item['offense_province'];
  $sql = 'select * from provinces where id='.$item['offense_province'];
  $result1 = $this->opt->get($sql);
  foreach($result1 as $key1 => $item1)
  {
	  echo $item1['province'];
  }
  ?>
  
  </a>
  
  </td>
  <td><?php echo @number_format($item['offense_property']); ?></td>
  <td><?php echo @number_format($item['offense_body']); ?></td>
  <td><?php echo @number_format($item['offense_sex']); ?></td>
  <td><?php echo @number_format($item['offense_dominance']); ?></td>
  <td><?php echo @number_format($item['offense_drug']); ?></td>
  <td><?php echo @number_format($item['offense_weapon']); ?></td>
  <td><?php echo @number_format($item['offense_etc']); ?></td>
<td>
  
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('offense/offense_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('offense/offense_delete/'.$item['id']); ?>';}" />
    
    </td>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>