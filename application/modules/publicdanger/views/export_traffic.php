<h3>รายงาน ผู้ได้รับผลกระทบจากภัยจราจร  จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<table class="tbreport" border="1">
<tr>
<th rowspan="3" class="txtcen">ที่</th>
<th rowspan="3" class="txtcen">จังหวัด</th>
<th rowspan="3" class="txtcen">จำนวนครั้ง</th>
<th colspan="3" class="txtcen">ผลกระทบต่อราษฎร (ราย)</th>
</tr>
<tr>
  <td rowspan="2" class="txtcen">เสียชีวิต</td>
  <td colspan="2" class="txtcen">บาดเจ็บ</td>
</tr>
<tr>
  <td class="txtcen">สาหัส</td>
  <td class="txtcen">เล็กน้อย</td>
</tr>
<?php foreach($traffics as $key=>$row):?>
<tr class="txtright">
  <td><?php echo $key+1?></td>
  <td><?php echo $row['province']?></td>
  <td><?php echo number_format($row['counter'])?></td>
  <td><?php echo number_format($row['death'])?></td>
  <td><?php echo number_format($row['serious_injury'])?></td>
  <td><?php echo number_format($row['minor_injury'])?></td>
</tr>	
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>

