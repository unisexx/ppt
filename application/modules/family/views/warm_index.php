<h2>ข้อมูลกลุ่มเป้าหมาย - ครอบครัว</h2>
<h4>ครอบครัวมีความอบอุ่น <?php echo menu::source($menu_id); ?></h4>
<div id="search">
  <div id="searchBox">
    <select name="select6" id="select6">
      <option>-- ทุกปี --</option>
      <option>2556</option>
      <option>2555</option>
      <option>2554</option>
    </select>
    <select name="select2" id="select2">
      <option>-- ทุกจังหวัด --</option>
    </select>
    <select name="select2" id="select3">
      <option>-- ทุกเขต/อำเภอ --</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='people.php?act=import'" class="btn_import"/><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='family/warm_form'" class="btn_add"/></div>

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
  <th>จังหวัด</th>
  <th>เขต/อำเภอ</th>
  <th>ผ่านเกณฑ์ / ร้อยละ</th>
  <th>เป้าหมาย</th>
  <th>ต่ำกว่าเป้าหมาย (ร้อยละ)</th>
  <th>จำนวนที่ต้อง<br />
แก้ไขทั้งหมด</th>
  <th>&nbsp;</th>
</tr>
<tr>
  <td>1</td>
  <td>2555</td>
  <td>กรุงเทพ</td>
  <td>คลองสาน</td>
  <td>15,865 / 99.99</td>
  <td>100</td>
  <td>0.01</td>
  <td>1</td>
  <td><input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<tr class="odd">
  <td>2</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button" id="button" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button" id="button5" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>3</td>
  <td>2555</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><input type="submit" name="button2" id="button2" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
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
  <td><input type="submit" name="button3" id="button3" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
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
  <td><input type="submit" name="button5" id="button8" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button5" id="button10" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
</table>
