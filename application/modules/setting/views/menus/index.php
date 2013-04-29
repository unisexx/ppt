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

<?php if(permission('menus','add')):?>
<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('setting/menus/form'); ?>'" class="btn_add">
</div>
<?php endif;?>

<div class="clear"></div>
<ul id="browser" class="filetree">
    <?php foreach(menu::ls(0) as $cat): ?>
    <li>
        <img src="themes/ppt/images/treeview/museum.png" /> 
        <?php echo $cat['title']?> 
        <span>
        	<?php if(permission('menus','edit')):?>
            <a href="setting/menus/form/<?php echo $cat['id']?>"><img src="themes/ppt/images/ico_edit.png" width="16" height="16" /></a> 
            <?php endif;?>
            <?php if(permission('menus','delete')):?>
            <a href="setting/menus/delete/<?php echo $cat['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><img src="themes/ppt/images/ico_delete.png" width="16" height="16" /></a>
            <?php endif;?>
        </span>
        <ul>
            <?php foreach(menu::ls($cat['id']) as $sub): ?>
            <li>
                <img src="themes/ppt/images/treeview/folder.gif" /> <?php echo $sub['title']?> 
                <span>
                	<?php if(permission('menus','edit')):?>
                    <a href="setting/menus/form/<?php echo $sub['id']?>"><img src="themes/ppt/images/ico_edit.png" width="16" height="16" /></a> 
                    <?php endif;?>
                    <?php if(permission('menus','delete')):?>
                    <a href="setting/menus/delete/<?php echo $sub['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><img src="themes/ppt/images/ico_delete.png" width="16" height="16" /></a>
                    <?php endif;?>
                </span>
                <ul>
                    <?php foreach(menu::ls($sub['id']) as $item): ?>
                    <li>
                        <img src="themes/ppt/images/treeview/file.gif" /> 
                        <?php echo anchor($item['url'], $item['title']); ?> 
                        <span>
                        	<?php if(permission('menus','edit')):?>
                            <a href="setting/menus/form/<?php echo $item['id']?>"><img src="themes/ppt/images/ico_edit.png" width="16" height="16" /></a> 
                            <?php endif;?>
                            <?php if(permission('menus','delete')):?>
                            <a href="setting/menus/delete/<?php echo $item['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><img src="themes/ppt/images/ico_delete.png" width="16" height="16" /></a>
                            <?php endif;?>
                        </span>
                    </li>
                    <?php endforeach;?>
                </ul>
            </li>
            <?php endforeach;?>
        </ul>
    </li>
    <?php endforeach; ?>
</ul>