<h3>รายงาน องค์กรที่ได้รับการสนับสนุนเงินจากกองทุนส่งเสริมการจัดการสวัสดิการสังคม ทั้งประเทศ</h3>

<div style="padding:10px; text-align:right;">
<a href="promotefund/export1"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th class="txtcen">ปีงบประมาณ</th>
<th class="txtcen">จำนวนองค์กร (แห่ง)</th>
<th class="txtcen">จำนวนเงิน (บาท)</th>
</tr>
<?php foreach($promotefunds as $row):?>
<tr>
  <td class="topic txtright"><a href="promotefund/report2/<?php echo $row['budgetyear']?>"><?php echo $row['budgetyear']?></a></td>
  <td class="txtright"><?php echo number_format($row['org_sum']); ?></td>
  <td class="txtright"><?php echo number_format($row['org_total_sum']); ?></td>
  </tr>
<tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนส่งเสริมการจัดการสวัสดิการสังคม</div>

