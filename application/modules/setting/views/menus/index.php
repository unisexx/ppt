<h2>ตั้งค่าข้อมูลหลัก > ข้อมูลพื้นฐานและกลุ่มเป้าหมาย</h2>

<div id="search">
    <form method="get" action="setting/menus">
    <div id="searchBox">หมายเลข/หัวหน้าสำนักปลัด
        <input type="text" name="keyword" value="<?php echo @$_GET['keyword']; ?>" style="width:240px;" />
        <?php echo form_dropdown('cat_id', get_option('id', 'title', 'menus', 'parent_id = 0 order by id'), @$_GET['cat_id'], null, '-- ทุกประเภท --'); ?>
        <?php echo form_dropdown('sub_id', (empty($_GET['cat_id'])) ? array() : get_option('id', 'title', 'menus', 'parent_id = '.$_GET['cat_id'].' order by id'), @$_GET['sub_id'], null, '-- ทุกหมวด --'); ?>
        <input type="submit" title="ค้นหา" value=" " class="btn_search" />
    </div>
    </form>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('dla/form'); ?>'" class="btn_add">
</div>

<?php echo $pagination; ?>
<table class="tblist">
    <tr>
        <th>ประเภท</th>
        <th>หมวด</th>
        <th>รายการ</th>
    </tr>
    <?php foreach($result as $key => $item): ?>
    <tr>
        <td><?php echo $item['cat_title']; ?></td>
        <td><?php echo $item['sub_title']; ?></td>
        <td><?php echo $item['title']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $pagination; ?>