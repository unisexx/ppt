<?php echo menu::source($menu_id); ?>

<div id="search">
    <form method="get" action="poor_age/allage">

        <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>

        <input type="submit" title="ค้นหา" value=" " class="btn_search" />
  
    </form>
</div>

<div id="btnBox">
    <?php echo menu::perm($menu_id, 'import', 'poor_age/import_data'); ?>
    <?php echo menu::perm($menu_id, 'add', 'poor_age/allage_form'); ?>
</div>

<?php echo $pagination; ?>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ปี</th>
  <th>เขตเมือง</th>
  <th>เขตชนบท</th>
  <th>ทั่วประเทศ</th>
  <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
</tr>
    <?php foreach($result as $key => $item): $key += 1;?>
<tr>
  <td><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
  <td><a href="<?php echo site_url('poor_age/allage_form/'.$item['id']); ?>"><?php echo $item['year']; ?></a></td>
  <td><?php $township = $item['township_child']+$item['township_work']+$item['township_elderly']; echo @number_format($township); ?></td>
  <td><?php $rural = $item['rural_area_child']+$item['rural_area_work']+$item['rural_area_elderly']; echo @number_format($rural); ?></td>
  <td><?php $country = $item['country_child']+$item['country_work']+$item['country_elderly']; echo @number_format($country); ?></td>
  <?php if(menu::perm($menu_id, 'edit') && menu::perm($menu_id, 'delete')): ?>
    <td>
        <?php echo menu::perm($menu_id, 'edit', 'poor_age/allage_form/'.$item['id']); ?>
        <?php echo menu::perm($menu_id, 'delete', 'poor_age/allage_delete/'.$item['id']); ?>
    </td>
    <?php endif; ?>
</tr>

   <?php endforeach; ?>

</table>

<?php echo $pagination; ?>