<?php echo menu::source($m['id']); ?>
<div id="search">
    <form method="get" action="dla/index/<?php echo $m['id']; ?>">
    <div id="searchBox">หมายเลข/หัวหน้าสำนักปลัด/อปท.(ตำบล/เทศบาล)
        <input type="text" name="keyword" value="<?php echo @$_GET['keyword']; ?>" style="width:240px;" />
        <?php echo form_dropdown('year', get_year_option(null, null, 'form_all', 'year'), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
        <input type="submit" title="ค้นหา" value=" " class="btn_search" />
    </div>
    </form>
</div>

<div id="btnBox">
    <?php echo menu::perm($m['id'], 'add', 'dla/form/'.$m['id']); ?>
</div>

<?php echo $pagination; ?>
<table class="tblist">
    <tr>
        <th>ลำดับ</th>
        <th>ปี</th>
        <th>จังหวัด</th>
        <th>อำเภอ</th>
        <th>ตำบล/เทศบาล (อปท.)</th>
        <th>ขนาด</th>
        <th width="25">จำนวน</th>
        <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?><th width="60">จัดการ</th><?php endif; ?>
    </tr>
    <?php foreach($result as $key => $item): $key += 1;?>
    <tr>
        <td><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?php echo $item['year']; ?></td>
        <td><?php echo $item['province']; ?></td>
        <td><?php echo $item['amphur_name']; ?></td>
        <td><?php echo anchor('dla/form/'.$m['id'].'/'.$item['id'], $item['opt_name']); ?></td>
        <td><?php echo $item['size']; ?></td>
        <td class="text-right"><?php echo @number_format($item['total_1']); ?></td>
        <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <?php echo menu::perm($m['id'], 'edit', 'dla/form/'.$m['id'].'/'.$item['id']); ?>
            <?php echo menu::perm($m['id'], 'delete', 'dla/delete/'.$m['id'].'/'.$item['id']); ?>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $pagination; ?>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: '<?php echo site_url(); ?>location/ajax_amphur/report',value: 'id',label: 'text'});
    });
</script>