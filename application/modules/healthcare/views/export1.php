<h3>รายงาน ผู้เข้าถึงสิทธิหลักประกันสุขภาพทั้งประเทศ</h3>
 หน่วย : คน
<table class="tbreport" border="1">
  <tr>
    <th rowspan="2" class="txtcen">ปีงบประมาณ</th>
    <th colspan="7" class="txtcen"> ประเภทสิทธิ์หลักประกันสุขภาพ</th>
  </tr>
  <tr>
    <td class="txtcen">รวม</td>
    <td class="txtcen">สิทธิประกันสุขภาพถ้วนหน้า</td>
    <td class="txtcen">บุคคลที่ยังไม่ได้รับการลงทะเบียน</td>
    <td class="txtcen">สิทธิข้าราชการ/สิทธิรัฐวิสาหกิจ</td>
    <td class="txtcen">สิทธิและสถานะอื่นๆ</td>
    <td class="txtcen">สิทธิประกันสังคม</td>
    <td class="txtcen">บุคคลผู้มีปัญหาสถานะและสิทธิ</td>
  </tr>
  <?php foreach($healthcares as $row):?>
  <tr>
    <td class="topic"><?php echo $row['budgetyear']?></td>
    <td class="txtcen"><?php echo number_format($row['total'])?></td>
    <td class="txtcen"><?php echo number_format($row['health_sum'])?></td>
    <td class="txtcen"><?php echo number_format($row['noreg_sum'])?></td>
    <td class="txtcen"><?php echo number_format($row['civil_sum'])?></td>
    <td class="txtcen"><?php echo number_format($row['other_sum'])?></td>
    <td class="txtcen"><?php echo number_format($row['right_sum'])?></td>
    <td class="txtcen"><?php echo number_format($row['total'])?></td>
  </tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : สำนักงานหลักประกันสุขภาพแห่งชาติ  (สปสช.)</div>

