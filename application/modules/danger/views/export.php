<h3>รายงาน จำนวนลูกจ้างและผู้ประสบอันตรายจากการทำงาน ทั้งประเทศ</h3>

<table class="tbreport" border="1">
  <tr>
    <th rowspan="2" class="txtcen">ปี พ.ศ.</th>
    <th rowspan="2">จำนวนลูกจ้างในข่ายฯ</th>
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
    <td class="topic"><?php echo $row['budgetyear']?></td>
    <td><?php echo number_format($row['total'] )?></td>
    <td><?php echo number_format($row['all_case'] )?></td>
    <td><?php echo number_format($row['severe_case'] )?></td>
    <td><?php echo number_format(($row['all_case'] * 1000)/$row['total'] , 2 )?></td>
    <td><?php echo number_format(($row['severe_case'] * 1000)/$row['total'] , 2)?></td>
  </tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : สำนักงานประกันสังคม  : เว็บไซต์สำนักงานประกันสังคม  http://www.sso.go.th</div>
<div>ผู้ประสบอันตรายกรณีร้ายแรง ประกอบด้วย ตาย ทุพพลภาพ สูญเสียอวัยวะบางส่วน และหยุดงานเกิน 3 วัน</div>

