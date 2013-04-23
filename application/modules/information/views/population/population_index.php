<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>ประชากร (คน) <span class="gray">แบบ กรมการปกครอง ประชากร</span></h4>
<div id="search">
  <div id="searchBox">
    <select name="select6" id="select6">
      <option>-- ทุกปี --</option>
      <option>2556</option>
      <option>2555</option>
      <option>2554</option>
    </select>
   <? echo form_dropdown('province_id',get_option('id','province','provinces'),'','','--เลือกจังหวัด--');?>
    <select name="select2" id="select2">
      <option>-- ทุกอำเภอ --</option>
    </select>
    <select name="select3" id="select3">
      <option>-- ทุกตำบล --</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='information/population_import_form'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='information/population_form'" class="btn_add"/>
</div>

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
  <th>ตำบล(แขวง)/ อำเภอ(เขต) / จังหวัด</th>
  <th>จำนวนประชากรชาย</th>
  <th>จำนวนประชากรหญิง</th>
  <th>จัดการ</th>
</tr>
<?
foreach($ppl as $item){
?>
<tr>
  <td><?=$i;?></td>
  <td><?=$item['year_data'];?></td>
  <td>พระบรมมหาราชวัง / พระนคร / กรุงเทพฯ</td>
  <td>26995</td>
  <td>29888</td>
  <td><input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button4" id="button4" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
</tr>
<? } ?>
<tr class="odd">
  <td>2</td>
  <td>2555</td>
  <td>วังบูรพาภิรมย์ / พระนคร / กรุงเทพฯ</td>
  <td>14029</td>
  <td>22903</td>
  <td><input type="submit" name="button" id="button" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button" id="button5" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr>
  <td>3</td>
  <td>2555</td>
  <td>วัดราชบพิธ / พระนคร / กรุงเทพฯ</td>
  <td>12490</td>
  <td>19802</td>
  <td><input type="submit" name="button2" id="button2" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button2" id="button6" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
<tr class="odd">
  <td>4</td>
  <td>2555</td>
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
  <td><input type="submit" name="button5" id="button8" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='people.php?act=form'" />
    <input type="submit" name="button5" id="button10" title="ลบรายการนี้" value=" " class="btn_delete vtip" /></td>
  </tr>
</table>