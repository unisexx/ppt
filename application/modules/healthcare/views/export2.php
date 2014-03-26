<h3>รายงาน ผู้เข้าถึงสิทธิหลักประกันสุขภาพ ประเภท<?php echo $type[$_GET['type']]?> จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>
<div align="right">หน่วย : คน</div>
<table class="tbreport" border="1">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="4" class="txtcen">รวมสิทธิหลักประกันสุขภาพ</th>
</tr>
<tr>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
</tr>
<?php foreach($healthcares as $key=>$row):?>
	<tr>
	  <td><?php echo $key+1?></td>
	  <td><?php echo $row['pv']?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_men'])?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_women'])?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_none'])?></td>
	  <td class="txtright"><?php echo number_format($row[$_GET['type'].'_sum'])?></td>
	</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สำนักงานหลักประกันสุขภาพแห่งชาติ  (สปสช.)</div>

