<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป (เพิ่ม/แก้ไข)</h2>
<h4>การให้บริการรับจำนำ <span class="gray">แบบ สถานธนานุเคราะห์ รับจำนำ</span></h4>
<table class="tbadd">
  <tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><select name="select3" id="select3">
    <option>-- เลือกปี --</option>
    <option>2556</option>
    <option>2555</option>
    <option>2554</option>
    <option>2553</option>
    <option>2552</option>
</select></td>
</tr>
  <tr>
    <th>สถานธนานุเคราะห์</th>
    <td><select name="select" id="select">
      <option>-- เลือกสถานธนานุเคราะห์ --</option>
      <option>st1</option>
      <option>st2</option>
      <option>st3</option>
    </select></td>
  </tr>
  <tr>
  <th>วันที่รับจำนำ<span class="Txt_red_12"> *</span></th>
  <td><input name="textarea10" type="text" id="textarea14" value="" style="width:70px;" />
    <img src="images/ico_cal.png" width="16" height="16" /></td>
</tr>
<tr>
  <th>เลขที่ตั๋วจำนำ<span class="Txt_red_12"> *</span></th>
  <td><input name="textarea" type="text" id="textarea" value=""  style="width:50px;" /></td>
</tr>
<tr>
  <th>PTD_SEQ</th>
  <td><input name="textarea2" type="text" id="textarea2" value=""  style="width:50px;" /></td>
</tr>
<tr>
  <th>PTD_DESC</th>
  <td><input name="textarea9" type="text" id="textarea9" value="" style="width:500px;" /></td>
</tr>
<tr>
  <th>ราคารับจำนำ<span class="Txt_red_12"> *</span></th>
  <td><input name="textarea3" type="text" id="textarea3" value="" /> 
    บาท</td>
</tr>
<tr>
  <th>คำนำหน้า</th>
  <td><input type="radio" name="radio" id="radio" value="radio" />
    นาย
      <input type="radio" name="radio" id="radio2" value="radio" />
นาง
<input type="radio" name="radio" id="radio3" value="radio" />
นางสาว</td>
</tr>
<tr>
  <th>เลขที่บัตร</th>
  <td><input name="textarea12" type="text" id="textarea16" maxlength="13" /></td>
</tr>
<tr>
  <th>อายุ</th>
  <td><input name="textarea8" type="text" id="textarea8" value="" style="width:50px;" /></td>
</tr>
<tr>
  <th>สัญชาติ</th>
  <td><input name="textarea5" type="text" id="textarea5" value="" style="width:100px;" /></td>
</tr>
<tr>
  <th>บ้านเลขที่</th>
  <td><input name="textarea6" type="text" id="textarea6" value="" style="width:50px;" /></td>
</tr>
<tr>
  <th>ถนน</th>
  <td><input name="textarea7" type="text" id="textarea7" value="" style="width:300px;" /></td>
</tr>
<tr>
  <th>จังหวัด &gt; อำเภอ<span class="Txt_red_12">&gt; ตำบล *</span></th>
  <td><select name="select2" id="select2">
    <option>-- เลือกจังหวัด --</option>
  </select>
    &gt;
    <select name="select4" id="select4">
      <option>-- เลือกอำเภอ --</option>
    </select>
    &gt; 
    <select name="select9" id="select9">
      <option>-- เลือกตำบล --</option>
    </select></td>
</tr>
<tr>
  <th>อาชีพ<span class="Txt_red_12"> *</span></th>
  <td><input name="textarea4" type="text" id="textarea4" value="" style="width:300px;" /></td>
</tr>
</table>

<div id="btnSave"><input type="button" title="บันทึก"  value=" บันทึก " class="btn_save"/> 
<input type="button" title="ย้อนกลับ"  value=" ย้อนกลับ " class="btn_back"/>
</div>
