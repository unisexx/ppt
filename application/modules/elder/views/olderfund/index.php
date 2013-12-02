<form  method='get'>
<div id="search">
  <div id="searchBox">
	<?=form_dropdown('YEAR', @$set_year, @$_GET['YEAR'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
 </div>
</div>
</form>

	<div id="btnBox">
		<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='elder/olderfund/import'" class="btn_import"/>
		<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='elder/olderfund/form'" class="btn_add"/>
	</div>





<table class="tbreport">
<tr>
  <th rowspan="2" class="txtcen">ปีงบประมาณ</th>
  <th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
  <th colspan="2" class="txtcen">รายโครงการ</th>
  </tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($result as $key=>$item): ?>
<tr>
  <td class="topic"><a href="olderfund/detail/<?php echo $item['id'] ?>"><?php echo $item['YEAR'] ?></a></td>
  <td><?php echo $item['total_person']; ?></td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<?php endforeach; ?>
</table>

<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>


