<h3>รายงาน การขอรับการสนับสนุนงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ปีงบประมาณ <?=$_GET['year']?></h3>

<table class="tbreport" border="1">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
</tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?foreach($disablefunds as $key=>$row):?>
<tr>
  <td class="txtright"><?=$key+1?></td>
  <td><?=$row['pv']?></td>
  <td class="txtright"><?=nformat($row['people_sum'])?></td>
  <td class="txtright"><?=nformat($row['total_sum'])?></td>
</tr>
<?endforeach;?>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>