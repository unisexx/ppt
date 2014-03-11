<h3>รายงาน ผู้ได้รับผลกระทบจากสาธารณภัยทั้งประเทศ  </h3>

<?php if(is_login()): // ถ้าไม่ได้ login จะไม่เห็น?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="window.open('publicdanger/form_import','_blank')" class="btn_import"/>
</div>
<?php endif; ?>

<div style="padding:10px; text-align:right;">
<a href='publicdanger/export_all'><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'>หน่วย : ราย</div>
<table class="tbreport">
  <tr>
    <th rowspan="2" class="txtcen">ปี พ.ศ.</th>
    <th colspan="6" class="txtcen"> ประเภทสาธารณภัย</th>
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
	    <td class="txtright">
	    	<a href="publicdanger/report_traffic/<?php echo $row['year_data']?>">
	    		<?php echo number_format($this->db->getone("SELECT sum(COUNTER) FROM PUBLICDANGER_TRAFFIC WHERE YEAR_DATA = ".$row['year_data']));?>
	    	</a>
	    </td>
	    <td class="txtright">
	    	<a href="publicdanger/report_drought/<?php echo $row['year_data']?>">
	    		<?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_DROUGHT WHERE YEAR_DATA = ".$row['year_data']));?>
	    	</a>
	    </td>
	    <td class="txtright">
	    	<a href="publicdanger/report_cold/<?php echo $row['year_data']?>">
	    		<?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_COLD WHERE YEAR_DATA = ".$row['year_data']));?>
	    	</a>
	    </td>
	    <td class="txtright">
	    	<a href="publicdanger/report_storm/<?php echo $row['year_data']?>">
	    		<?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_STORM WHERE YEAR_DATA = ".$row['year_data']));?>
	    	</a>
	    </td>
	    <td class="txtright">
	    	<a href="publicdanger/report_flood?year_data=<?php echo $row['year_data']?>&no=1">
	    		<?php echo number_format($this->db->getone("SELECT sum(PEOPLE) FROM PUBLICDANGER_FLOOD WHERE YEAR_DATA = ".$row['year_data']));?>
	    	</a>
	    </td>
	</tr>
  <?php endforeach;?>
</table>
<div id="ref">ที่มา : กรมป้องกันและบรรเทาสาธารณะภัย  http://www.disaster.go.th</div>

