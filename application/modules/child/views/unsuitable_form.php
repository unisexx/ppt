<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน (เพิ่ม/แก้ไข)</h2>
<h4>กำพร้า (เด็กที่บิดาและ/หรือมารดาเสียชีวิต) <span class="gray">แบบ อปท.1</span> (2)</h4>
<table class="tbadd">
    <tr>
        <th>ปี <span class="Txt_red_12">*</span></th>
        <td><?php echo form_dropdown('year', get_year_option(2555), $rs['year']); ?></td>
    </tr>
    <tr>
        <th>ดื่มเครื่องดื่มที่มีแอลกอฮอล์  สูบบุหรี่ และติดสารเสพติดร้ายแรง <br />เช่น ยาบ้า ยาอี สารระเหย กัญชา เป็นต้น<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4161_m', number_format($rs['t4161_m']), 'class="input-mini"').' คน &nbsp; หญิง '.form_input('t4161_f', number_format($rs['t4161_f']), 'class="input-mini"'); ?> คน</td>
    </tr>
    <tr>
        <th>มั่วสุมและทำความรำคาญให้กับชาวบ้าน<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4162_m', number_format($rs['t4162_m']), 'class="input-mini"').' คน &nbsp; หญิง '.form_input('t4162_f', number_format($rs['t4162_f']), 'class="input-mini"'); ?> คน</td>
    </tr>
    <tr>
        <th>ติดเกมส์ และเล่นการพนันต่าง ๆ<span class="Txt_red_12"> *</span></th>
        <td><?php echo 'ชาย '.form_input('t4163_m', number_format($rs['t4163_m']), 'class="input-mini"').' คน &nbsp; หญิง '.form_input('t4163_f', number_format($rs['t4163_f']), 'class="input-mini"'); ?> คน</td>
    </tr>
    <tr>
        <th>มีพฤติกรรมทางเพศ<span class="Txt_red_12"> *</span></th>
    <td><?php echo 'ชาย '.form_input('t4164_m', number_format($rs['t4164_m']), 'class="input-mini"').' คน &nbsp; หญิง '.form_input('t4164_f', number_format($rs['t4164_f']), 'class="input-mini"'); ?> คน</td>
    </tr>
    <tr>
        <th>หมายเลข<span class="Txt_red_12"> *</span></th>
        <td><?php echo form_input('number_id', $rs['number_id'], 'class="input-small"'); ?></td>
    </tr>
    <tr>
        <th>จังหวัด &gt; อำเภอ<span class="Txt_red_12"> *</span></th>
        <td><select name="select2" id="select2">
        <option>-- เลือกจังหวัด --</option>
    </select>
    &gt;
    <select name="select4" id="select4">
      <option>-- เลือกอำเภอ --</option>
    </select></td>
    </tr>
    <tr>
        <th>ชื่ออปท. / ขนาด<span class="Txt_red_12"> *</span></th>
        <td><?php echo form_input('opt_name', $rs['opt_name']).'/'.form_dropdown('size', array('เล็ก' => 'เล็ก', 'กลาง' => 'กลาง', 'ใหญ่' => 'ใหญ่'), $rs['size'], 'class="span1"'); ?></td>
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
        <td><?php echo form_dropdown('c_position', get_option('id', 'c_position_name', 'c_positions'), $rs['c_position'], null, '- เลือกตำแหน่ง -'); ?></td>
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
  <td><select name="select6" id="select6">
    <option selected="selected">-- เลือกตำแหน่ง --</option>
    <option>เจ้าหน้าที่พัฒนาชุมชน</option>
    <option>เจ้าหน้าที่วิเคราะห์ฯ</option>
    <option>เจ้าหน้าที่วิชาการศึกษา</option>
  </select></td>
</tr>
<tr>
  <th>หมายเลขโทรศัพท์</th>
  <td><input name="textarea6" type="text" id="textarea7" value="" /></td>
</tr>
<tr>
  <th colspan="2" class="title">อาสาสมัครพัฒนาสังคมและความมั่นคงของมนุษย์ระดับตำบล/ประธานศูนย์พัฒนาครอบครัวในชุมชนระดับตำบล</th>
</tr>
<tr>
  <th>คำนำ <span class="Txt_red_12">*</span></th>
  <td><span>
    <input type="radio" name="radio" id="radio3" value="radio" />
    นาย</span> <span>
      <input type="radio" name="radio" id="radio6" value="radio" />
      นาง</span>
    <input type="radio" name="radio" id="radio6" value="radio" />
    นางสาว </td>
</tr>
<tr>
  <th>ชื่อ-นามสกุล <span class="Txt_red_12">*</span></th>
  <td><input name="textarea7" type="text" id="textarea10" value="" style="width:400px;" /></td>
</tr>
<tr>
  <th>ตำแหน่ง <span class="Txt_red_12">*</span></th>
  <td><select name="select7" id="select7">
    <option selected="selected">-- เลือกตำแหน่ง --</option>
    <option>อาสาสมัครพัฒนาสังคมและความมั่นคงของมนุษย์ระดับตำบ</option>
    <option>ประธานศูนย์พัฒนาครอบครัว</option>
  </select></td>
</tr>
<tr>
  <th>หมายเลขโทรศัพท์</th>
  <td><input name="textarea7" type="text" id="textarea9" value="" /></td>
</tr>
<tr>
  <th colspan="2" class="title">แกนนำเครือข่ายด้านการพัฒนาสังคมระดับตำบล/อื่นๆ</th>
</tr>
<tr>
  <th>คำนำ <span class="Txt_red_12">*</span></th>
  <td><span>
    <input type="radio" name="radio" id="radio7" value="radio" />
    นาย</span> <span>
      <input type="radio" name="radio" id="radio8" value="radio" />
      นาง</span>
    <input type="radio" name="radio" id="radio8" value="radio" />
    นางสาว </td>
</tr>
<tr>
  <th>ชื่อ-นามสกุล <span class="Txt_red_12">*</span></th>
  <td><input name="textarea8" type="text" id="textarea12" value="" style="width:400px;" /></td>
</tr>
<tr>
  <th>ตำแหน่ง <span class="Txt_red_12">*</span></th>
  <td><select name="select8" id="select8">
    <option selected="selected">-- เลือกตำแหน่ง --</option>
    <option>แกนนำเครือข่ายด้านการพัฒนาสังคมระดับตำบล</option>
    <option>อื่นๆ</option>
  </select> 
  อื่นๆ ระบุ
  <input name="textarea9" type="text" id="textarea13" value="" style="width:250px;" /></td>
</tr>
<tr>
  <th>หมายเลขโทรศัพท์</th>
  <td><input name="textarea8" type="text" id="textarea11" value="" /></td>
</tr>
</table>

<div id="btnSave">
<input type="submit" value="บันทึก" class="btn btn-danger">
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
