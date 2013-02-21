<h2>ข้อมูลประชากร -</h2>
<h4>เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็กและเยาวชน</h4>
<div id="search">
  <div id="searchBox">ชื่อประเด็นย่อย
    <input type="text" name="textfield" id="textfield" style="width:300px;" />
    <select name="select6" id="select6">
      <option>-- ทุกกลุ่มเป้าหมาย --</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
  </select>
    <select name="select" id="select">
      <option>-- ทุกประเด็นหลัก --</option>
      <option>1</option>
      <option>2</option>
      <option>3</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=import'" class="btn_import"/><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form2'" class="btn_add"/></div>

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
  <th>ปี</th>
  <th>ฐานความผิด</th>
  <th>สาเหตุการกระทำความผิด</th>
  <th>อายุ (ปี)</th>
  <th>เพศ</th>
  <th>จำนวน (คน)</th>
<th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
  <td>2555</td>
  <td>ความผิดเกี่ยวกับทรัพย์</td>
  <td>ป่วยทางจิต</td>
  <td>0 - 7</td>
  <td>ชาย</td>
  <td>23</td>
  <td><input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<tr class="odd">
  <td>2</td>
  <td>2555</td>
  <td>ความผิดเกี่ยวกับชีวิตและร่างกาย</td>
  <td>ทะเลาะวิวาท</td>
  <td>8 - 14</td>
  <td>ชาย</td>
  <td>19</td>
  <td><input type="submit" name="button" id="button" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button" id="button5" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>3</td>
  <td>2555</td>
  <td>ความผิดเกี่ยวกับเพศ</td>
  <td>สภาพทางเศรษฐกิจ</td>
  <td>15 - 18</td>
  <td>ชาย</td>
  <td>41</td>
  <td><input type="submit" name="button2" id="button2" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button2" id="button6" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr class="odd">
  <td>4</td>
  <td>2555</td>
  <td>ความผิดเกี่ยวกับความสงบสุข เสรีภาพชื่อเสียงและการปกครอง</td>
  <td>สภาพทางเศรษฐกิจ</td>
  <td>0 - 7</td>
  <td>หญิง</td>
  <td>32</td>
  <td><input type="submit" name="button3" id="button3" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button3" id="button7" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td height="26">5</td>
  <td>2555</td>
  <td>ความผิดเกี่ยวกับยาเสพติดให้โทษ</td>
  <td>สภาพทางเศรษฐกิจ</td>
  <td>8 - 14</td>
  <td>หญิง</td>
  <td>22</td>
  <td><input type="submit" name="button5" id="button8" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button5" id="button10" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
</table>
