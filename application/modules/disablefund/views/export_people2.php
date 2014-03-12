<h3>รายงาน การขอรับการสนับสนุนงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ปีงบประมาณ <?=$_GET['year']?> <?=($_GET['province'] != '')? 'จังหวัด '.$_GET['province']:'';?></h3>

<table class="tbreport" border="1">
<tr>
<th class="txtcen">ที่</th>
<th class="txtcen">ประเภทความพิการ</th>
<th class="txtcen">จำนวนราย</th>
<th class="txtcen">จำนวนเงิน (บาท)</th>
</tr>
<?foreach($disablefunds as $key=>$row):?>
<tr>
  <td class="txtright"><?=$key+1?></td>
  <td><?=$row['dis_type']?></td>
  <td class="txtright"><?=nformat($row['people_sum'])?></td>
  <td class="txtright"><?=nformat($row['total_sum'])?></td>
</tr>

<?@$all_people_sum = $all_people_sum + $row['people_sum'];?>
<?@$all_total_sum = $all_total_sum + $row['total_sum'];?>
<?endforeach;?>
<tr class="total">
  <td colspan="2">รวม</td>
  <td class="txtright"><?=nformat($all_people_sum)?></td>
  <td class="txtright"><?=nformat($all_total_sum)?></td>
  </tr>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>

