<h3>รายงาน ผู้ได้รับผลกระทบจากสาธารณภัยทั้งประเทศ  </h3>
หน่วย : ราย
<table class="tbreport" border="1">
  <tr>
    <th rowspan="2" class="txtcen">ปี พ.ศ.</th>
    <th colspan="5" class="txtcen"> ประเภทสาธารณภัย</th>
  </tr>
  <tr>
    <td class="txtcen">ภัยจราจร</td>
    <td class="txtcen">ภัยแล้ง</td>
    <td class="txtcen">ภัยหนาว</td>
    <td class="txtcen">วาตภัย</td>
    <td class="txtcen">อุทกภัย</td>
  </tr>
  <?php foreach($years as $row):?>
	<tr>
	    <td class="topic"><?php echo $row['year_data']?></td>
	    <td class="txtcen"><?php echo number_format($this->db->getone("SELECT sum(COUNTER) FROM PUBLICDANGER_TRAFFIC WHERE YEAR_DATA = ".$row['year_data']));?></a></td>
	    <td class="txtcen"><?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_DROUGHT WHERE YEAR_DATA = ".$row['year_data']));?></td>
	    <td class="txtcen"><?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_COLD WHERE YEAR_DATA = ".$row['year_data']));?></td>
	    <td class="txtcen"><?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_STORM WHERE YEAR_DATA = ".$row['year_data']));?></td>
	    <td class="txtcen"><?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_FLOOD WHERE YEAR_DATA = ".$row['year_data']));?></td>
	</tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>

