<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>การให้บริการรับจำนำ <span class="gray">แบบ สถานธนานุเคราะห์ รับจำนำ</span></h4>
<div id="search">
  <div id="searchBox">เลขที่ตั๋วจำนำ/เลขบัตรประชาชน
    <input type="text" name="textfield" id="textfield" style="width:240px;" />
    <select name="select6" id="select6">
      <option>-- ทุกปี --</option>
      <option>2556</option>
      <option>2555</option>
      <option>2554</option>
    </select>
    <select name="select" id="select">
      <option>-- ทุกจังหวัด --</option>
    </select>
    <select name="select2" id="select2">
      <option>-- ทุกอำเภอ --</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=import'" class="btn_import"/><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=pledgee_form'" class="btn_add"/></div>

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
  <th>สถานธนานุเคราะห์</th>
  <th>วันที่รับจำนำ</th>
  <th>เลขที่ตั๋วจำนำ</th>
  <th>ราคารับจำนำ</th>
  <th>เลขบัตรประชาชน</th>
  <th>อายุ</th>
  <th>ที่อยู่</th>
  <th>จัดการ</th>
</tr>
<tr>
  <td>1</td>
  <td>2555</td>
  <td>st1</td>
  <td>4/1/2011</td>
  <td>153</td>
  <td>14700</td>
  <td>1100800253733</td>
  <td>26</td>
  <td>ม.4 ต.บ้านเลน อ.พระประแดง จ. สมุทรปราการ</td>
  <td><input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<tr class="odd">
  <td>2</td>
  <td>2555</td>
  <td>st1</td>
  <td>4/1/2011</td>
  <td>180</td>
  <td>2500</td>
  <td>3540600421228</td>
  <td>33</td>
  <td>21 ม.6 ต.ไทรม้า อ.บางคล้า จ.ฉะเชิงเทรา</td>
  <td><input type="submit" name="button" id="button" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button" id="button5" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>3</td>
  <td>2555</td>
  <td>st2</td>
  <td>4/1/2011</td>
  <td>144</td>
  <td>7000</td>
  <td>1100800507751</td>
  <td>45</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button2" id="button2" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button2" id="button6" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr class="odd">
  <td>4</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button3" id="button3" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button3" id="button7" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>5</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button5" id="button8" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
    <input type="submit" name="button5" id="button10" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
</table>
