<h2>ข้อมูลพื้นฐาน - ข้อมูลประเด็น (เพิ่ม/แก้ไข)</h2>
<h4>ประชาชนได้รับอุบัติเหตุจากยานพาหนะ <span class="gray">แบบ สตช. อุบัติเหตุยานพาหนะ</span></h4>
<form action="datapoint/vehicle_save" method="post">
<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td><?php echo form_dropdown('year',array_combine(range(2552,date('Y')+543),range(2552,date('Y')+543)),@$rs['year'],'','-- เลือกปี --'); ?></td>
</tr>
<tr>
  <th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
  <td><input type="text" name="agency" value="<?php echo $rs['agency'] ?>"></td>
</tr>
<tr>
  <th>รับแจ้ง <span class="Txt_red_12"> *</span></th>
  <td><input name="notice" type="text" id="textarea3" value="<?php echo $rs['notice'] ?>" />
    ราย</td>
</tr>
<tr>
  <th>ประเภท<span class="Txt_red_12"> *</span></th>
  <td><span class="padd">
    <label>คนเดินเท้า </label>
    <input name="walk" type="text" id="textarea14" value="<?php echo  $rs['walk'] ?>"  style="width:50px;" />
    ราย</span> <span class="padd">
      <label>รถจักรยาน</label>
      <input name="bicycle" type="text" id="textarea14" value="<?php echo $rs['bicycle'] ?>"  style="width:50px;" />
      ราย</span> <span class="padd">
        <label>รถสามล้อ</label>
        <input name="threewheel" type="text" id="textarea14" value="<?php echo $rs['threewheel'] ?>"  style="width:50px;" />
        ราย</span> <span class="padd">
          <label>รถจักรยานยนต์ </label>
          <input name="motorcycle" type="text" id="textarea14" value="<?php echo $rs['motorcycle'] ?>"  style="width:50px;" />
          ราย</span> <span class="padd">
            <label>รถสามล้อเครื่อง</label>
            <input name="motor_tricycle" type="text" id="textarea14" value="<?php echo $rs['motor_tricycle'] ?>"  style="width:50px;" />
            ราย</span> <span class="padd">
              <label>รถยนต์นั่ง</label>
              <input name="car" type="text" id="textarea14" value="<?php echo $rs['car'] ?>"  style="width:50px;" />
              ราย</span> <span class="padd">
                <label>รถโดยสารเล็ก (ตู้</label>
                <input name="minibus" type="text" id="textarea14" value="<?php echo $rs['minibus'] ?>"  style="width:50px;" />
                ราย</span> <span class="padd">
                  <label>รถบรรทุกเล็ก (ปิกอัพ</label>
                  <input name="pickup" type="text" id="textarea14" value="<?php echo $rs['pickup'] ?>"  style="width:50px;" />
                  ราย</span> <span class="padd">
                    <label>รถโดยสารขนาดใหญ่</label>
                    <input name="bus" type="text" id="textarea14" value="<?php echo $rs['bus'] ?>"  style="width:50px;" />
                    ราย</span> <span class="padd">
                      <label>รถบรรทุก 6 ล้อ</label>
                      <input name="sixwheel" type="text" id="textarea14" value="<?php echo $rs['sixwheel'] ?>"  style="width:50px;" />
                      ราย</span> <span class="padd">
                        <label>รถบรรทุก 10 ล้อ</label>
                        <input name="tenwheel" type="text" id="textarea14" value="<?php echo $rs['tenwheel'] ?>"  style="width:50px;" />
                        ราย</span> <span class="padd">
                          <label>รถอีแต๋น</label>
                          <input name="etan" type="text" id="textarea14" value="<?php echo $rs['etan'] ?>"  style="width:50px;" />
                          ราย</span> <span class="padd">
                            <label>รถแท๊กซี่</label>
                            <input name="taxi" type="text" id="textarea14" value="<?php echo $rs['taxi'] ?>"  style="width:50px;" />
                            ราย</span> <span class="padd">
                              <label>รถอื่นๆ</label>
                              <input name="other" type="text" id="textarea14" value="<?php echo $rs['other']?>"  style="width:50px;" />
                              ราย</span></td>
</tr>
<tr>
  <th>มูลค่าทรัพย์สินเสียหายรวม</th>
  <td><input name="total" type="text" id="textarea4" value="<?php echo $rs['total'] ?>" />
    บาท</td>
</tr>
<tr>
  <th colspan="2" class="title">ความเสียหายที่เกิดขึ้นกับบุคคล</th>
</tr>
<tr>
  <th>ตาย <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="die_male" type="text" id="textarea15" value="<?php echo $rs['die_male'] ?>"  style="width:30px;" />
/
  หญิง
<input name="die_female" type="text" id="textarea16" value="<?php echo $rs['die_female'] ?>"  style="width:30px;" />
คน</td>
</tr>
<tr>
  <th>บาดเจ็บสาหัส <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="coma_male" type="text" id="textarea" value="<?php echo $rs['coma_male'] ?>"  style="width:30px;" />
/
  หญิง
<input name="coma_female" type="text" id="textarea2" value="<?php echo $rs['coma_female'] ?>"  style="width:30px;" />
คน</td>
</tr>
<tr>
  <th>บาดเจ็บเล็กน้อย <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="pain_male" type="text" id="textarea5" value="<?php echo $rs['pain_male'] ?>"  style="width:30px;" />
/
  หญิง
<input name="pain_female" type="text" id="textarea17" value="<?php echo $rs['pain_female'] ?>"  style="width:30px;" />
คน</td>
</tr>
<tr>
  <th colspan="2" class="title">ผู้ต้องหา</th>
</tr>
<tr>
  <th>จับกุม <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="catch_male" type="text" id="textarea18" value="<?php echo $rs['catch_male']?>"  style="width:30px;" />
    /
    หญิง
    <input name="catch_female" type="text" id="textarea19" value="<?php echo $rs['catch_female'] ?>"  style="width:30px;" />
    คน</td>
</tr>
<tr>
  <th>หลบหนี <span class="Txt_red_12">*</span></th>
  <td>ชาย
    <input name="escape_male" type="text" id="textarea6" value="<?php echo $rs['escape_male'] ?>"  style="width:30px;" />
    /
    หญิง
    <input name="escape_female" type="text" id="textarea8" value="<?php echo $rs['escape_female'] ?>"  style="width:30px;" />
    คน</td>
</tr>
<tr>
  <th>ไม่รู้ตัว <span class="Txt_red_12">*</span></th>
  <td>
    <input name="involuntary" type="text" id="textarea7" value="<?php echo $rs['involuntary'] ?>"  style="width:50px;" />
ราย</td>
</tr>
</table>
<?php 
 			echo form_hidden('id',$rs['id']);
 ?>
<div id="btnSave">
<?php  if(menu::perm($menu_id, 'add')): ?>		
<input type="submit" value="บันทึก" class="btn btn-danger"><?php endif; ?>
<input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn"/>
</div>
</form>