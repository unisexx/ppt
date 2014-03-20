<h3>รายงาน การขอรับการสนับสนุนงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ปีงบประมาณ <?=$_GET['year']?></h3>

<form method="get" action="disablefund/report_project3">
<div id="search">
  <div id="searchBox">
    <select name="province">
      <option value="">-- ทั้งประเทศ --</option>
      <?foreach($provinces as $row):?>
      <option value="<?=$row['province']?>" <?=($row['province'] == $_GET['province'])? 'selected' : '' ;?>><?=$row['province']?></option>
      <?endforeach;?>
    </select>
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
<a href="disablefund/export_project3?year=<?=$_GET['year']?>&province=<?=$_GET['province']?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">ที่</th>
<th rowspan="2" class="txtcen">ชื่อโครงการ</th>
<th rowspan="2" class="txtcen">ชื่อองค์กร</th>
<th colspan="2" class="txtcen">จำนวนเงิน</th>
<th rowspan="2" class="txtcen">ครั้งที่</th>
<th rowspan="2" class="txtcen">วันที่</th>
</tr>
<tr>
  <td>เสนอขอ</td>
  <td>อนุมัติ</td>
  </tr>
<tr>
  <td colspan="7"><?=($_GET['province'] == "")? 'รวมทั้งประเทศ' : 'จังหวัด'.$_GET['province'] ;?></td>
</tr>
<?foreach($disablefunds as $key=>$row):?>
<tr>
  <td><?=$key+1?></td>
  <td><?=$row['project']?></td>
  <td><?=$row['organization']?></td>
  <td><?=nformat($row['request'])?></td>
  <td><?=nformat($row['approve'])?></td>
  <td><?=$row['no']?>/<?=$row['year']?></td>
  <td><?=$row['date']?></td>
</tr>
<?endforeach;?>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>

