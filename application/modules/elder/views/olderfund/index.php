<? $m['id'] = 57; ?>
<?=menu::source($m['id']);?>
<h3>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ ทั่วประเทศ</h3>
<form  method='get'>
<div id="search">
  <div id="searchBox">
	<?php echo form_dropdown('year', @$set_year, @$_GET['year'], null, '-- แสดงทุกปี --'); #ถ้ามีค่าเก่าให้ใส่ , $value เลย  ?>
	<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
 </div>
</div>
</form>
<?php if(!empty($_GET['year'])): ?><div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?php echo $_GET['year'] ?></div><?php endif; ?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='elder/olderfund/import'" class="btn_import"/>
	<input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='elder/olderfund/form'" class="btn_add"/>
</div>




<?=$pagination; ?>
<table class="tbreport">
<tr>
  <th rowspan="2" class="txtcen">ปีงบประมาณ</th>
  <th rowspan="2">จังหวัด</th>
  <th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
  <th colspan="2" class="txtcen">รายโครงการ</th>
 <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?> <th rowspan="2">จัดการ</th><?php endif; ?>
  </tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($result as $key=>$item): ?>
<tr>
  <td class="topic"><?php echo $item['year'] ?></td>
  <td class="topic"><?php echo $item['province'] ?></td>
  <td><?php echo number_format($item['total_person']); ?></td>
  <td><?php echo number_format($item['total_money_person']); ?></td>
  <td><?php echo number_format($item['total_project']); ?></td>
  <td><?php echo number_format($item['total_money_project']); ?></td>
	<?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
	<td>
	    <?php echo menu::perm($m['id'], 'edit', 'elder/olderfund/form/'.$item['id']); ?>
	    <?php echo menu::perm($m['id'], 'delete', 'elder/olderfund/delete/'.$m['id'].'/'.$item['id']); ?>
	</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
</table>
<?=$pagination; ?>
<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>


