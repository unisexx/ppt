<?php echo menu::source($menu_id); ?>
<div id="search">
    <div id="searchBox">
        <form method="get" action="poor_province/province_data">
            <?php echo form_dropdown('year', get_year_option(2555, null, 'pool_province', 'poor_province_year', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>
            <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
            <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
            <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
        </form>
    </div>
</div>

<div id="btnBox">
    <?php echo menu::perm($menu_id, 'import', 'poor_province/import_data'); ?>
    <?php echo menu::perm($menu_id, 'add', 'poor_province/province_form'); ?>
</div>

<?php echo $pagination; ?>
<table class="tblist">
    <tr>
      <th>ลำดับ</th>
      <th>ปี</th>
      <th>จังหวัด</th>
      <th>เส้นความยากจน (บาท/คน/เดือน)</th>
      <th>สัดส่วนคนจน (ร้อยละ)</th>
      <th>จำนวนคนจน (พันคน)</th>
      <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
    </tr>

 <?php foreach($result as $key => $item): $key += 1;?>

<tr>
  <td><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
  <td><?php echo $item['poor_province_year']; ?></td>
  <td><?php echo anchor('poor_province/province_form/'.$item['id'], $item['province']); ?></td>
  <td><?php echo @number_format($item['poor_province_line']); ?></td>
  <td><?php echo @number_format($item['poor_province_percent']); ?></td>
  <td><?php echo @number_format($item['poor_province_qty']); ?></td>
  
    <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?>
    <td>
        <?php echo menu::perm($menu_id, 'edit', 'poor_province/province_form/'.$item['id']); ?>
        <?php echo menu::perm($menu_id, 'delete', 'poor_province/province_delete/'.$item['id']); ?>
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