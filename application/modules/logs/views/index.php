<h2>บันทึกการใข้งาน</h2>
<?php echo $pagination; ?>
<table class="tblist">
    <tr>
        <th>ชื่อผู้ใช้</th>
        <th>รายการ</th>
        <th>วันที่</th>
        <th>IP</th>
    </tr>
    <?php foreach($result as $item): ?>
    <tr>
        <td><?php echo $item['username']; ?></td>
        <td><?php echo $item['action']; ?></td>
        <td><?php echo $item['created']; ?></td>
        <td><?php echo $item['ip']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $pagination; ?>