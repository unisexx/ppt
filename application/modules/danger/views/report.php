<h3>รายงาน จำนวนลูกจ้างและผู้ประสบอันตรายจากการทำงาน ทั้งประเทศ</h3>

<?php if(is_login()): // ถ้าไม่ได้ login จะไม่เห็น?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="window.open('danger/form_import','_blank')" class="btn_import"/>
</div>
<?php endif; ?>

<div style="padding:10px; text-align:right;">
<a href='danger/export'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
  <tr>
    <th rowspan="2" class="txtcen">ปี พ.ศ.</th>
    <th rowspan="2" class="txtcen">จำนวนลูกจ้างในข่ายฯ<br>(ณ 31 ธ.ค.ของทุกปี)</th>
    <th colspan="2" class="txtcen">จำนวนผู้ประสบอันตราย (ราย)</th>
    <th colspan="2" class="txtcen">อัตราการประสบอันตรายต่อลูกจ้าง 1,000 ราย</th>
  </tr>
  <tr>
    <td class="txtcen">ทุกกรณ๊</td>
    <td class="txtcen">เฉพาะกรณ๊ร้ายแรง</td>
    <td class="txtcen">ทุกกรณ๊</td>
    <td class="txtcen">เฉพาะกรณ๊ร้ายแรง</td>
  </tr>
  <?php foreach($dangers as $row):?>
  <tr>
    <td class="topic"><a href="danger/report2/<?php echo $row['budgetyear']?>"><?php echo $row['budgetyear']?></a></td>
    <td class="txtright"><?php echo number_format($row['total'] )?></td>
    <td class="txtright"><?php echo number_format($row['all_case'] )?></td>
    <td class="txtright"><?php echo number_format($row['severe_case'] )?></td>
    <td class="txtright"><?php echo number_format(($row['all_case'] * 1000)/$row['total'] , 2 )?></td>
    <td class="txtright"><?php echo number_format(($row['severe_case'] * 1000)/$row['total'] , 2)?></td>
  </tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : สำนักงานประกันสังคม  : เว็บไซต์สำนักงานประกันสังคม  http://www.sso.go.th</div>
<div>หมายเหตุ : ผู้ประสบอันตรายกรณีร้ายแรง ประกอบด้วย ตาย ทุพพลภาพ สูญเสียอวัยวะบางส่วน และหยุดงานเกิน 3 วัน</div>

