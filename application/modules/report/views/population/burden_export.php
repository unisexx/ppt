<h3>รายงาน อัตราส่วนการเป็นภาระของประชากร</h3>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> อัตราส่วนการเป็นภาระของประชากร
    <label><?=$province_name;?></label>
</div>
<div style="padding:10px; text-align:right;">
  หน่วย:ราย
</div>

<table width="650" border="1">
    <tr>
        <th>ปี</th>
        <th>ภาพรวม</th>
        <th>วัยเด็ก</th>
        <th>ผู้สูงอายุ</th>
    </tr>
    <?php foreach($result as $key => $item): ?>
    <tr <?php echo cycle($key); ?>>
    	<?
    		@$rate_child = ($item['total_child']/$item['total_work'])*100;
			@$rate_old = ($item['total_old']/$item['total_work'])*100;
			$rate_sum = $rate_child+$rate_old;
    	?>
        <td class="topic txtcen"><?php echo $item['year_data']; ?></td>
        <td class="txtright"><?php echo number_format($rate_sum, 2); ?></td>
        <td class="txtright"><?php echo number_format($rate_child, 2); ?></td>
        <td class="txtright"><?php echo number_format($rate_old, 2); ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="ref">ที่มา : ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
<div id="remark">หมายเหตุ : อัตราส่วนการเป็นภาระ ภาพรวม, วัยเด็ก, ผู้สูงอายุ 	กรุณาดูสูตรการคำนวณในหนังสือสถิติประชากรไทย ปี 2549 หน้า 12</div>
