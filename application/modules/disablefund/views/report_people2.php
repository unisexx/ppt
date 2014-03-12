<h3>รายงาน การขอรับการสนับสนุนงินกองทุนส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการ ปีงบประมาณ <?=$_GET['year']?> <?=($_GET['province'] != '')? 'จังหวัด '.$_GET['province']:'';?></h3>

<form method="get" action="disablefund/report_people2">
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

<div id="resultsearch"><b>ผลที่ค้นหา :</b> ปีงบประมาณ <?=$_GET['year']?> <?=($_GET['province'] != '')? 'จังหวัด '.$_GET['province']:'';?>
  <label></label>
</div>
<div style="padding:10px; text-align:right;">
<a href="disablefund/export_people2?year=<?=$_GET['year']?>&province=<?=$_GET['province']?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล" onclick='window.print();'></div>
<table class="tbreport">
<tr>
<th class="txtcen">ที่</th>
<th class="txtcen">ประเภทความพิการ</th>
<th class="txtcen">จำนวนราย</th>
<th class="txtcen">จำนวนเงิน (บาท)</th>
</tr>
<?foreach($disablefunds as $key=>$row):?>
<tr>
  <td class="txtright"><?=$key+1?></td>
  <td><?=$row['dis_type']?></td>
  <td class="txtright"><?=nformat($row['people_sum'])?></td>
  <td class="txtright"><?=nformat($row['total_sum'])?></td>
</tr>

<?@$all_people_sum = $all_people_sum + $row['people_sum'];?>
<?@$all_total_sum = $all_total_sum + $row['total_sum'];?>
<?endforeach;?>
<tr class="total">
  <td colspan="2">รวม</td>
  <td class="txtright"><?=nformat($all_people_sum)?></td>
  <td class="txtright"><?=nformat($all_total_sum)?></td>
  </tr>
</table>

<div id="ref">ที่มา : พก. : เว็บไซต์สำนักงานส่งเสริมและพัฒนาคุณภาพชีวิตคนพิการแห่งชาติ  http://www.nep.go.th/index.php?mod=tmpstat</div>

