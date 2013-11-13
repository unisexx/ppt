<h2>ตั้งค่าข้อมูล > หน่วยงานสนับสนุน</h2>
<div id="search">
  <div id="searchBox">ชื่อหน่วยงานสนับสนุน
    <input type="text" name="textfield" id="textfield" style="width:200px;" />
    <select name="select6" id="select6">
      <option>-- หน่วยงานหลัก --</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/></div>

<div class="pagebarUTH">&nbsp;<span class="this-page">1</span>
<a href="javascript:;" title="Seite 2">2</a>
<a href="javascript:;" title="Seite 3">3</a>
<a href="javascript:;" title="Seite 4">4</a>

<span class="break">...</span><a href="javascript:;" title="Seite 19">19</a>
<a href="javascript:;" title="Seite 2">Next</a>&nbsp;&nbsp;188 record
</div>	
<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อหน่วยงานสนับสนุน</th>
  <th>หน่วยงานหลัก</th>
  <th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
  <td>หน่วยงานสนับสนุน ก</td>
  <td>หน่วยงานหลัก A</td>
  <td><input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<tr class="odd">
  <td>2</td>
  <td>หน่วยงานสนับสนุน ข</td>
  <td>หน่วยงานหลัก A</td>
  <td><input type="submit" name="button" id="button" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button" id="button5" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>3</td>
  <td> หน่วยงานสนับสนุน ค</td>
  <td>หน่วยงานหลัก B</td>
  <td><input type="submit" name="button2" id="button2" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button2" id="button6" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr class="odd">
  <td>4</td>
  <td> หน่วยงานสนับสนุน ง</td>
  <td>หน่วยงานหลัก B</td>
  <td><input type="submit" name="button3" id="button3" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button3" id="button7" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>5</td>
  <td>หน่วยงานสนับสนุน จ</td>
  <td>หน่วยงานหลัก C</td>
  <td><input type="submit" name="button5" id="button8" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button5" id="button10" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
</table>
