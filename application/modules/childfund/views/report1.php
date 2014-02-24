<h3>รายงาน การให้การสนับสนุนจากกองทุนคุ้มครองเด็กทั้งประเทศ</h3>

<div style="padding:10px; text-align:right;">
<a href='childfund/export1'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ปีงบประมาณ</th>
<th colspan="2" class="txtcen">ประเภทบุคคล</th>
<th colspan="2" class="txtcen">ประเภทองค์กร</th>
</tr>
<tr>
  <td class="txtcen">จำนวนเด็ก (คน)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
  <td class="txtcen">จำนวนองค์กร (แห่ง)</td>
  <td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<?php foreach($childfunds as $row):?>
<tr>
  <td class="topic txtright"><?php echo $row['budgetyear']?></td>
  <td class="txtright">
  	<?php if(number_format($row['people_sum']) != 0):?>
  	<a href="childfund/report3/<?php echo $row['budgetyear']?>" target="_blank"><?php echo number_format($row['people_sum'])?></a>
  	<?php else:?>
  		0
  	<?php endif;?>
  </td>
  <td class="txtright"><?php echo number_format($row['total_sum'])?></td>
  <td class="txtright">
  	<?php if(number_format($row['org_sum']) != 0):?>
  	<a href="childfund/report2/<?php echo $row['budgetyear']?>" target="_blank"><?php echo number_format($row['org_sum'])?></a>
  	<?php else:?>
  		0
  	<?php endif;?>
  </td>
  <td class="txtright"><?php echo number_format($row['org_total_sum'])?></td>
</tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา : สป.พม. : ฐานข้อมูลระบบงานกองทุนคุ้มครองเด็ก  </div>