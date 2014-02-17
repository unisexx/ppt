<h3>รายงาน เด็กที่ได้รับการสนับสนุน/สงเคราะห์จากกองทุนคุ้มครองเด็ก จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>

<table class="tbreport" border="1">
<tr>
<th width="9" rowspan="2" class="txtcen" style="border: 1px solid #ccc;">ที่</th>
<th width="76" rowspan="2" class="txtcen" style="border: 1px solid #ccc;">จังหวัด</th>
<th colspan="4" class="txtcen" style="border: 1px solid #ccc;">จำนวนเด็ก (คน)</th>
<th colspan="10" class="txtcen" style="border: 1px solid #ccc;">จำนวนเงินที่สนับสนุน/สงเคราะห์ (บาท)</th>
</tr>
<tr>
<td width="22" class="txtcen">ชาย</td>
<td width="25" class="txtcen">หญิง</td>
<td width="35" class="txtcen">ไม่ระบุ</td>
<td width="20" class="txtcen">รวม</td>
<td width="190" class="txtcen">ค่าเลี้ยงดู</td>
<td width="122" class="txtcen">ค่าใช้จ่ายทางการศึกษา</td>
<td width="92" class="txtcen">ทุนประกอบอาชีพ</td>
<td width="77" class="txtcen">ค่ากายอุปกรณ์</td>
<td width="120" class="txtcen">ค่าเครื่องอุปโภคบริโภค</td>
<td width="142">สงเคราะห์ครอบครัวอุปถัมภ์</td>
<td width="169">ค่าฝึกอบรมเกี่ยวกับวิธีการเลี้ยงดู</td>
<td width="45">ค่าตรวจ DNA</td>
<td width="22">อื่นๆ</td>
<td width="26">รวม</td>
</tr>
<?php foreach($childfunds as $key => $row):?>
<tr>
  <td><?php echo $key+1?></td>
  <td nowrap="nowrap"><?php echo $row['province']?></td>
  <td><?php echo number_format($row['men'])?></td>
  <td><?php echo number_format($row['women'])?></td>
  <td><?php echo number_format($row['unknown'])?></td>
  <td><?php echo number_format($row['peoplesum'])?></td>
  <td><?php echo number_format($row['alimony'])?></td>
  <td><?php echo number_format($row['education'])?></td>
  <td><?php echo number_format($row['job'])?></td>
  <td><?php echo number_format($row['orthotics'])?></td>
  <td><?php echo number_format($row['consumer'])?></td>
  <td><?php echo number_format($row['family'])?></td>
  <td><?php echo number_format($row['training'])?></td>
  <td><?php echo number_format($row['dna'])?></td>
  <td><?php echo number_format($row['other'])?></td>
  <td><?php echo number_format($row['total'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนคุ้มครองเด็ก</div>

