<style>
.num {
  mso-number-format:General;
}
.text{
  mso-number-format:"\@";/*force text*/
}
</style>

<h3>รายงาน การขอรับการสนับสนุนงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ปีงบประมาณ <?=$_GET['year']?></h3>

<table class="tbreport" border="1">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">ชื่อโครงการ</th>
<th rowspan="2" class="txtcen">ชื่อองค์กร</th>
<th colspan="2" class="txtcen">จำนวนเงิน</th>
<th rowspan="2" class="txtcen">ครั้งที่</th>
<th rowspan="2" class="txtcen">วันที่</th>
</tr>
<tr>
  <td>เสนอขอ</td>
  <td>อนุมัติ</td>
  </tr>
<tr>
  <td colspan="7">จังหวัด <?=$_GET['province']?></td>
</tr>
<?foreach($disablefunds as $key=>$row):?>
<tr>
  <td><?=$key+1?></td>
  <td><?=$row['project']?></td>
  <td><?=$row['organization']?></td>
  <td><?=nformat($row['request'])?></td>
  <td><?=nformat($row['approve'])?></td>
  <td class="text"><?=$row['no']?>/<?=$row['year']?></td>
  <td><?=$row['date']?></td>
</tr>
<?endforeach;?>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>

