<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน (เพิ่ม/แก้ไข)</h2>
<h4>กำพร้า (เด็กที่บิดาและ/หรือมารดาเสียชีวิต) <span class="gray">แบบ อปท.1 (3)</span> </h4>
<?php echo form_open('dla/save/'.$m['id']); ?>
<table class="tbadd">
    <tr>
        <th>ปี <span class="Txt_red_12">*</span></th>
        <td><?php echo form_dropdown('year', get_year_option(2555), $rs['year']); ?></td>
    </tr>
    <tr>
        <th>ดื่มเครื่องดื่มที่มีแอลกอฮอล์  สูบบุหรี่ และติดสารเสพติดร้ายแรง <br />เช่น ยาบ้า ยาอี สารระเหย กัญชา เป็นต้น<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4161_m', number_format($rs['t4161_m']), 'class="input-mini text-center"').' คน &nbsp;&nbsp; หญิง '.form_input('t4161_f', number_format($rs['t4161_f']), 'class="input-mini text-center"'); ?> คน</td>
    </tr>
    <tr>
        <th>มั่วสุมและทำความรำคาญให้กับชาวบ้าน<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4162_m', number_format($rs['t4162_m']), 'class="input-mini text-center"').' คน &nbsp;&nbsp; หญิง '.form_input('t4162_f', number_format($rs['t4162_f']), 'class="input-mini text-center"'); ?> คน</td>
    </tr>
    <tr>
        <th>ติดเกมส์ และเล่นการพนันต่าง ๆ<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4163_m', number_format($rs['t4163_m']), 'class="input-mini text-center"').' คน &nbsp;&nbsp; หญิง '.form_input('t4163_f', number_format($rs['t4163_f']), 'class="input-mini text-center"'); ?> คน</td>
    </tr>
    <tr>
        <th>มีพฤติกรรมทางเพศ<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4164_m', number_format($rs['t4164_m']), 'class="input-mini text-center"').' คน &nbsp;&nbsp; หญิง '.form_input('t4164_f', number_format($rs['t4164_f']), 'class="input-mini text-center"'); ?> คน</td>
    </tr>
    <tr>
        <th>หมายเลข<span class="Txt_red_12"> *</span></th>
        <td><?php echo form_input('number_id', $rs['number_id'], 'class="input-small text-center"'); ?></td>
    </tr>
    <tr>
        <th>จังหวัด &gt; อำเภอ<span class="Txt_red_12"> *</span></th>
        <td>
            <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), $rs['province_id'], null, '- เลือกจังหวัด -'); ?> &gt; 
            <?php echo form_dropdown('amphur_id', (empty($rs['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$rs['province_id'].' order by amphur_name'), $rs['amphur_id'], null, '- เลือกอำเภอ -'); ?>
        </td>
    </tr>
    <tr>
        <th>ชื่ออปท. / ขนาด<span class="Txt_red_12"> *</span></th>
        <td><?php echo form_input('opt_name', $rs['opt_name']).' / '.form_dropdown('size', array('เล็ก' => 'เล็ก', 'กลาง' => 'กลาง', 'ใหญ่' => 'ใหญ่'), $rs['size'], 'class="span1"'); ?></td>
    </tr>
    
    <tr>
        <th colspan="2" class="title">หัวหน้าสำนักปลัด/นายก(เทศบาล/อบต.)</th>
    </tr>
    <tr>
        <th>คำนำ <span class="Txt_red_12">*</span></th>
        <td>
            <?php echo form_radio('c_title', 'นาย', $rs['c_title']).' นาย'; ?>&nbsp;&nbsp;
            <?php echo form_radio('c_title', 'นาง', $rs['c_title']).' นาง'; ?>&nbsp;&nbsp;
            <?php echo form_radio('c_title', 'นางสาว', $rs['c_title']).' นางสาว'; ?>
        </td>
    </tr>
    <tr>
        <th>ชื่อ-นามสกุล <span class="Txt_red_12">*</span></th>
        <td><?php echo form_input('c_name', $rs['c_name']); ?></td>
    </tr>
    <tr>
        <th>ตำแหน่ง <span class="Txt_red_12">*</span></th>
        <td><?php echo form_dropdown('c_position_id', get_option('id', 'c_position_name', 'c_positions'), $rs['c_position_id'], null, '- เลือกตำแหน่ง -'); ?></td>
    </tr>
    <tr>
        <th>หมายเลขโทรศัพท์</th>
        <td><?php echo form_input('c_tel', $rs['c_tel']); ?></td>
    </tr>
    <tr>
        <th colspan="2" class="title">เจ้าหน้าที่พัฒนาชุมชน/เจ้าหน้าที่วิเคราะห์ฯ/เจ้าหน้าที่วิชาการศึกษา</th>
    </tr>
    <tr>
        <th>คำนำ <span class="Txt_red_12">*</span></th>
         <td>
            <?php echo form_radio('o_title', 'นาย', $rs['o_title']).' นาย'; ?>&nbsp;&nbsp;
            <?php echo form_radio('o_title', 'นาง', $rs['o_title']).' นาง'; ?>&nbsp;&nbsp;
            <?php echo form_radio('o_title', 'นางสาว', $rs['o_title']).' นางสาว'; ?>
        </td>
    </tr>
    <tr>
        <th>ชื่อ-นามสกุล <span class="Txt_red_12">*</span></th>
        <td><?php echo form_input('o_name', $rs['o_name']); ?></td>
    </tr>
    <tr>
        <th>ตำแหน่ง <span class="Txt_red_12">*</span></th>
        <td><?php echo form_dropdown('o_position_id', get_option('id', 'o_position_name', 'o_positions'), $rs['o_position_id'], null, '- เลือกตำแหน่ง -'); ?></td>
    </tr>
    <tr>
        <th>หมายเลขโทรศัพท์</th>
        <td><?php echo form_input('o_tel', $rs['o_tel']); ?></td>
    </tr>
    <tr>
        <th colspan="2" class="title">อาสาสมัครพัฒนาสังคมและความมั่นคงของมนุษย์ระดับตำบล/ประธานศูนย์พัฒนาครอบครัวในชุมชนระดับตำบล</th>
    </tr>
    <tr>
        <th>คำนำ <span class="Txt_red_12">*</span></th>
        <td>
            <?php echo form_radio('v_title', 'นาย', $rs['v_title']).' นาย'; ?>&nbsp;&nbsp;
            <?php echo form_radio('v_title', 'นาง', $rs['v_title']).' นาง'; ?>&nbsp;&nbsp;
            <?php echo form_radio('v_title', 'นางสาว', $rs['v_title']).' นางสาว'; ?>
        </td>
    </tr>
    <tr>
        <th>ชื่อ-นามสกุล <span class="Txt_red_12">*</span></th>
        <td><?php echo form_input('v_name', $rs['v_name']); ?></td>
    </tr>
    <tr>
        <th>ตำแหน่ง <span class="Txt_red_12">*</span></th>
        <td><?php echo form_dropdown('v_position_id', get_option('id', 'v_position_name', 'v_positions'), $rs['v_position_id'], null, '- เลือกตำแหน่ง -'); ?></td>
    </tr>
    <tr>
        <th>หมายเลขโทรศัพท์</th>
        <td><?php echo form_input('v_tel', $rs['v_tel']); ?></td>
    </tr>
    
    <tr>
        <th colspan="2" class="title">แกนนำเครือข่ายด้านการพัฒนาสังคมระดับตำบล/อื่นๆ</th>
    </tr>
    <tr>
        <th>คำนำ <span class="Txt_red_12">*</span></th>
        <td>
            <?php echo form_radio('b_title', 'นาย', $rs['b_title']).' นาย'; ?>&nbsp;&nbsp;
            <?php echo form_radio('b_title', 'นาง', $rs['b_title']).' นาง'; ?>&nbsp;&nbsp;
            <?php echo form_radio('b_title', 'นางสาว', $rs['b_title']).' นางสาว'; ?>
        </td>
    </tr>
    <tr>
        <th>ชื่อ-นามสกุล <span class="Txt_red_12">*</span></th>
        <td><?php echo form_input('b_name', $rs['b_name']); ?></td>
    </tr>
    <tr>
        <th>ตำแหน่ง <span class="Txt_red_12">*</span></th>
        <td><?php echo form_dropdown('b_position_id', get_option('id', 'b_position_name', 'b_positions'), $rs['b_position_id'], null, '- เลือกตำแหน่ง -'); ?></td>
    </tr>
    <tr>
        <th>หมายเลขโทรศัพท์</th>
        <td><?php echo form_input('b_tel', $rs['b_tel']); ?></td>
    </tr>
</table>

<div id="btnSave">
    <?php echo form_hidden('id', $rs['id']); ?>
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>
<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>
