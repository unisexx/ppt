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
<h2 class='head_sideup'>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ รายจังหวัด <?php echo (!empty($_GET['year'])) ?"ปีงบประมาณ ".$_GET['year']:"ทุกปีงบประมาณ"; ?></h2>
<form class="hide_print">
<div id="search">
  <div id="searchBox">
  <?=form_dropdown('year', @$set_year, @$_GET['year'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php if(!empty($_GET['year'])): ?><div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $_GET['year'] ?></div><?php endif; ?>

<div style='line-height:40px; text-align:right;' class='hide_print'>
	<a href='report/olderfund/detail/export<?=GetCurrentUrlGetParameter();?>'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
	<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px; cursor:pointer;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>
	หน่วย : ราย
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
  <td class="txtright"><?php echo number_format($cnt[0]['total_person']) ?></td>
  <td class="txtright"><?php echo number_format($cnt[0]['total_money_person']) ?></td>
  <td class="txtright"><?php echo number_format($cnt[0]['total_project']) ?></td>
  <td class="txtright"><?php echo number_format($cnt[0]['total_money_project']) ?></td>

  </tr>
<?php foreach($result as $key=>$item):$key += 1; ?>
<tr>
  <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
  <td><?php echo $item['province'] ?></td>
  <td class="txtright"><?php echo number_format($item['total_person']) ?></td>
  <td class="txtright"><?php echo number_format($item['total_money_person']); ?></td>
  <td class="txtright"><?php echo number_format($item['total_project']) ?></td>
  <td class="txtright"><?php echo number_format($item['total_money_project']); ?></td>
  </tr>
<?php endforeach; ?>
</table>

<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>
