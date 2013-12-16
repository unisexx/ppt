<h3>รายงาน ผู้ได้รับผลกระทบจาก<span class="txtcen">ภัยแล้ง</span> จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<table class="tbreport" border="1">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">ราษฎรที่ประสบภัยแล้ง</th>
</tr>
<tr>
  <td class="txtcen">ครัวเรือน</td>
  <td class="txtcen">คน</td>
</tr>
<?php foreach($droughts as $key=>$row):?>
<tr class="txtright">
  <td><?php echo $key+1?></td>
  <td><?php echo $row['province']?></td>
  <td><?php echo number_format($row['household'])?></td>
  <td><?php echo number_format($row['people'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>

