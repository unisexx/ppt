<h3>รหัสงบประมาณ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td><select name="select" id="select">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select></td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td><select name="select2" id="select2">
    <option>-- เลือกช่วงแผนงบประมาณ --</option>
    <option>แผนงบประมาณต้นปี</option>
    <option>แผนงบประมาณระหว่างปี</option>
  </select></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td><select name="select3" id="select3">
    <option>-- เลือกแผนงาน --</option>
  </select></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td><select name="select4" id="select4">
    <option>-- เลือกผลผลิต --</option>
  </select></td>
</tr>
<tr>
  <th>รหัสงบประมาณ / คำอธิบาย <br />
    <br /><input type="button" title="เพิ่มรายการ" value=" " class="btn_addmore" /></th>
  <td>
<div style="padding:5px 0;">
<div style="display:inline; float:left; padding-right:10px;"><input name="textfield" type="text" id="textfield" value="0600274001110010"  maxlength="16" style="width:150px;" /></div>
<div style="display:inline; float:left; padding-right:5px;">คำอธิบาย</div>
<div style="display:inline;"><textarea name="textfield2" cols="60" rows="3" id="textfield2" style="width:400px;" >อุปกรณ์เชื่อมต่อและกระจายสัญญาณเครือข่ายชนิด KVM Switch</textarea></div>
</div>
    </td>
</tr>
</table>
<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="history.back(-1)" class="btn_back"/>
</div>