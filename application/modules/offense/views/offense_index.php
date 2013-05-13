<?php echo menu::source($menu_id); ?>
<div id="search">
  <div id="searchBox">
    <form method="get" action="offense/offense_data">
 <?php echo form_dropdown('year', get_year_option(), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  </div>
</div>

<div id="btnBox">
    <?php echo menu::perm($menu_id, 'import', 'offense/import_data'); ?>
    <?php echo menu::perm($menu_id, 'add', 'offense/offense_form'); ?>
</div>

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
  <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
</tr>
 <?php foreach($result as $key => $item): $key += 1;?>
<tr>
  <td><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
  <td><?php echo $item['offense_year']; ?></td>
  <td><?php echo anchor('offense/offense_form/'.$item['id'], $item['province']); ?></td>
  <td><?php echo @number_format($item['offense_property']); ?></td>
  <td><?php echo @number_format($item['offense_body']); ?></td>
  <td><?php echo @number_format($item['offense_sex']); ?></td>
  <td><?php echo @number_format($item['offense_dominance']); ?></td>
  <td><?php echo @number_format($item['offense_drug']); ?></td>
  <td><?php echo @number_format($item['offense_weapon']); ?></td>
  <td><?php echo @number_format($item['offense_etc']); ?></td>
  <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?>
    <td>
        <?php echo menu::perm($menu_id, 'edit', 'offense/offense_form/'.$item['id']); ?>
        <?php echo menu::perm($menu_id, 'delete', 'offense/offense_delete/'.$item['id']); ?>
    </td>
    <?php endif; ?>
</tr>

<?php endforeach; ?>
</table>
<?php echo $pagination; ?>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>