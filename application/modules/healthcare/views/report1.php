<h3>รายงาน ผู้เข้าถึงสิทธิหลักประกันสุขภาพทั้งประเทศ</h3>
<div style="padding:10px; text-align:right;">
<a href='healthcare/export1'><img src="themes/thesocial_demo/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/thesocial_demo/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'> หน่วย : คน</div>
<table class="tbreport">
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
    <td class="topic"><a href="healthcare/report3/<?php echo $row['budgetyear']?>"><?php echo $row['budgetyear']?></a></td>
    <td class="txtcen"><?php echo number_format($row['total'])?></td>
    <td class="txtcen"><a href="healthcare/report2/<?php echo $row['budgetyear']?>?type=health"><?php echo number_format($row['health_sum'])?></a></td>
    <td class="txtcen"><a href="healthcare/report2/<?php echo $row['budgetyear']?>?type=noreg"><?php echo number_format($row['noreg_sum'])?></a></td>
    <td class="txtcen"><a href="healthcare/report2/<?php echo $row['budgetyear']?>?type=civil"><?php echo number_format($row['civil_sum'])?></a></td>
    <td class="txtcen"><a href="healthcare/report2/<?php echo $row['budgetyear']?>?type=other"><?php echo number_format($row['other_sum'])?></a></td>
    <td class="txtcen"><a href="healthcare/report2/<?php echo $row['budgetyear']?>?type=right"><?php echo number_format($row['right_sum'])?></a></td>
    <td class="txtcen"><a href="healthcare/report2/<?php echo $row['budgetyear']?>?type=problem"><?php echo number_format($row['total'])?></a></td>
  </tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : สำนักงานหลักประกันสุขภาพแห่งชาติ  (สปสช.)</div>

