<h3>รายงาน การขอรับการสนับสนุนเงินกองทุนผู้สูงอายุ รายจังหวัด ปีงบประมาณ 2556</h3>
<div id="search">
  <div id="searchBox">
    <select name="select2" id="select2">
      <option>2556</option>
      <option>2555</option>
    </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ 2556
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
  <img src="images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
<img src="images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">รายบุคคล (การกู้ยืม)</th>
<th colspan="2" class="txtcen">รายโครงการ</th>
</tr>
<tr>
<td class="txtcen">จำนวนคน</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<tr>
  <td></td>
  <td>รวมทั้งประเทศ</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  </tr>
<?php foreach($data as $key=>$item): ?>
<tr>
  <td><?php echo ++$key ?></td>
  <td><?php echo $item['province'] ?></td>
  <td><?php echo $item['total_person'] ?></td>
  <td><?php echo number_format($item['total_money_person']); ?></td>
  <td><?php echo $item['total_project'] ?></td>
  <td><?php echo number_format($item['total_money_project']); ?></td>
  </tr>
<?php endforeach; ?>
</table>

<div id="ref">ที่มา : สท. : เว็บไซต์กองทุนผู้สูงอายุ  http://olderfund.opp.go.th</div>
