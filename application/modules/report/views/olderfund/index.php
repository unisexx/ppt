<style type='text/css'>
@media print
{
	.hide_print,a
	{ display:none; }

	.head_sideup
	{
		margin-top:-100px;
	}

}
@media screen
{
	.hide_screen
	{ display:none; }

}
</style>

<h2 class='head_sideup'>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ ทั่วประเทศ</h2>
<form  method='get' class='hide_print'>
<div id="search">
  <div id="searchBox">
	<?php echo form_dropdown('year', @$set_year, @$_GET['year'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
 </div>
</div>
</form>
<?php if(!empty($_GET['year'])): ?><div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $_GET['year'] ?></div><?php endif; ?>
<div style='line-height:40px; text-align:right;' class='hide_print'>
	<a href='report/olderfund/index/export'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px; cursor:pointer;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>
	หน่วย : ราย
</div>
<?php echo $pagination; ?>
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
  <td class="topic"><a href="report/olderfund/detail?year=<?php echo $item['year'] ?>"><?php echo $item['year'] ?></a><span class="hide_screen"><?php echo $item['year'] ?></span></td>
  <td><?php echo number_format($item['total_person']); ?></td>
  <td><?php echo number_format($item['total_money_person']); ?></td>
  <td><?php echo number_format($item['total_project']); ?></td>
  <td><?php echo number_format($item['total_money_project']); ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php echo $pagination; ?>
<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>


