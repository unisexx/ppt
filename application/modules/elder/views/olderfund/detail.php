<h3>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ รายจังหวัด ปีงบประมาณ 2556</h3>
<form>
<div id="search">
  <div id="searchBox">
  <?=form_dropdown('year', @$set_year, @$_GET['year'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<?php if(!empty($_GET['year'])): ?><div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $_GET['year'] ?></div><?php endif; ?>
	<div id="btnBox">
		<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='elder/olderfund/import'" class="btn_import"/>
		<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='elder/olderfund/form'" class="btn_add"/>
	</div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
<th colspan="2" class="txtcen">รายโครงการ</th>
</tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<tr>
  <td></td>
  <td>รวมทั้งประเทศ</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
<?php //foreach($data as $key=>$item): ?>
<tr>
  <td><?php //echo ++$key ?></td>
  <td><?php //echo $item['province'] ?></td>
  <td><?php //echo $item['total_person'] ?></td>
  <td><?php //echo number_format($item['total_money_person']); ?></td>
  <td><?php //echo $item['total_project'] ?></td>
  <td><?php //echo number_format($item['total_money_project']); ?></td>
  </tr>
<?php //endforeach; ?>
</table>

<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>
