<h3>รายงาน การขอรับการสนับสนุนงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ปีงบประมาณ <?=$_GET['year']?></h3>

<form method="get" action="disablefund/report_project1">
<div id="search">
  <div id="searchBox">
    <select name="year">
      <?foreach($years as $row):?>
      <option value="<?=$row['year_data']?>" <?=($row['year_data'] == $_GET['year'])? 'selected' : '' ;?>><?=$row['year_data']?></option>
      <?endforeach;?>
    </select>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?=$_GET['year']?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href="disablefund/export_project1?year=<?=$_GET['year']?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th colspan="2" class="txtcen">รายโครงการ</th>
</tr>
<tr>
<td class="txtcen">จำนวนโครงการ</td>
<td class="txtcen">จำนวนเงิน (บาท)</td>
</tr>
<tr>
  <td></td>
  <td><a href="disablefund/report_project3?year=<?=$_GET['year']?>&province=">รวมทั้งประเทศ</a></td>
  <td></td>
  <td></td>
</tr>
<?foreach($disablefunds as $key=>$row):?>
<tr>
  <td class="txtright"><?=$key+1?></td>
  <td><a href="disablefund/report_project3?year=<?=$_GET['year']?>&province=<?=$row['pv']?>"><?=$row['pv']?></a></td>
  <td class="txtright"><?=nformat($row['project_sum'])?></td>
  <td class="txtright"><?=nformat($row['approve_sum'])?></td>
</tr>
<?endforeach;?>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>