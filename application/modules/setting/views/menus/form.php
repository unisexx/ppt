<h2>ตั้งค่าข้อมูลหลัก > ข้อมูลพื้นฐานและกลุ่มเป้าหมาย (เพิ่ม/แก้ไข)</h2>
<form method="post" action="setting/menus/save">
<table class="tbadd">
    <?php if($rs['parent_id'] > 0): ?>
    <tr>
        <th>ข้อมูลพื้นฐานหรือกลุ่มเป้าหมาย<span class="TxtRed">*</span></th>
        <td><?php echo form_dropdown('parent_id', menu::option(), $rs['parent_id']); ?></td>
    </tr>
    <?php endif; ?>
    <tr>
        <th>ชื่อรายการข้อมูล <span class="TxtRed">*</span></th>
        <td><?php echo form_input('title', $rs['title'], 'class="input-xxlarge"'); ?></td>
    </tr>
    <tr>
        <th>URL</th>
        <td><?php echo form_input('url', $rs['url'], 'class="input-xxlarge"'); ?></td>
    </tr>
    <tr>
        <th>แบบฟอร์มการเก็บข้อมูล</th>
        <td><?php echo form_dropdown('template_id', get_option('id', 'name', 'form_template', '1=1 order by id'), $rs['template_id'], 'class="span3"', '-- เลือกแบบฟอร์มการเก็บข้อมูล --'); ?></td>
    </tr>
    </table>
    <div id="btnSave">
        <input type="hidden" name="id" value="<?php echo $rs['id']?>">
        <input type="submit" value="บันทึก" class="btn btn-danger">
        <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
    </div>
</form>