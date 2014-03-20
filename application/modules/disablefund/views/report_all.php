<h3>รายงาน การขอรับการสนับสนุนเงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ทั้งประเทศ</h3>

<?php if(is_login()): // ถ้าไม่ได้ login จะไม่เห็น?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="window.open('disablefund/form_import','_blank')" class="btn_import"/>
</div>
<?php endif; ?>


<div style="padding:10px; text-align:right;">
<a href="disablefund/export_all"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
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
<?foreach($disablefunds as $row):?>
<tr>
  <td class="topic txtcen"><?=$row['budgetyear']?></td>
  <td class="txtright"><a href="disablefund/report_people1?year=<?=$row['budgetyear']?>" target="_blank"><?=$row['people_sum']?></a></td>
  <td class="txtright"><?=nformat($row['total_sum'])?></td>
  <td class="txtright"><a href="disablefund/report_project1?year=<?=$row['budgetyear']?>" target="_blank"><?=$row['project_sum']?></a></td>
  <td class="txtright"><?=nformat($row['approve_sum'])?></td>
</tr>
<?endforeach;?>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>