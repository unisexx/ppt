<h3>รายงาน การขอรับการสนับสนุนเงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ทั้งประเทศ</h3>

<table class="tbreport" border="1">
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
<?foreach($disablefunds as $row):?>
<tr>
  <td class="topic txtcen"><?=$row['budgetyear']?></td>
  <td class="txtright"><?=$row['people_sum']?></td>
  <td class="txtright"><?=nformat($row['total_sum'])?></td>
  <td class="txtright"><?=$row['project_sum']?></td>
  <td class="txtright"><?=nformat($row['approve_sum'])?></td>
</tr>
<?endforeach;?>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>