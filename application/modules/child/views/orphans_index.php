<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>กำพร้า (เด็กที่บิดาและ/หรือมารดาเสียชีวิต) <span class="gray">แบบ อปท.1 (1)</span></h4>
<div id="search">
    <form method="get" action="child/orphans">
    <div id="searchBox">หมายเลข/หัวหน้าสำนักปลัด
        <input type="text" name="keyword" value="<?php echo @$_GET['keyword']; ?>" style="width:240px;" />
        <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
        <input type="submit" title="ค้นหา" value=" " class="btn_search" />
    </div>
    </form>
</div>

<div id="btnBox">
    <input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?php echo site_url('child/orphans_form'); ?>'" class="btn_add">
</div>

<?php echo $pagination; ?>
<table class="tblist">
    <tr>
        <th>ลำดับ</th>
        <th>ปี</th>
        <th width="25">ชาย</th>
        <th width="25">หญิง</th>
        <th width="40">หมายเลข</th>
        <th>อปท.</th>
        <th>อำเภอ / จังหวัด</th>
        <th>ขนาด</th>
        <th>หัวหน้าสำนักปลัด</th>
        <th>จัดการ</th>
    </tr>
    <?php foreach($result as $key => $item): $key += 1;?>
    <tr>
        <td><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?php echo $item['year']; ?></td>
        <td class="text-right"><?php echo @number_format($item['total_1']); ?></td>
        <td class="text-right"><?php echo @number_format($item['total_2']); ?></td>
        <td class="text-right"><?php echo $item['number_id']; ?></td>
        <td><?php echo $item['opt_name']; ?></td>
        <td><?php echo $item['amphur_name'].'/'.$item['province']; ?></td>
        <td><?php echo $item['size']; ?></td>
        <td><?php echo $item['c_title'].$item['c_name']; ?></td>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('child/orphans_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" onclick="if(confirm('ยืนยันการลบ')){window.location='<?php echo site_url('child/orphans_delete/'.$item['id']); ?>';}" />
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $pagination; ?>
