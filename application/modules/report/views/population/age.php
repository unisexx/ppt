<h3>รายงาน สถิติประชากรรายอายุ </h3>
<div id="search">
    <form>
    <div id="searchBox">
    	<?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    	<?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
    	<?php echo form_dropdown('district_id', (empty($_GET['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$_GET['amphur_id'].' order by district_name'), @$_GET['district_id'], null, '-- ทุกตำบล --'); ?>
        <input type="submit" title="ค้นหา" class="btn_search" />
    </div>
    </form>
</div>

<div id="resultsearch"><b>ผลที่ค้นหา :</b> สถิติประชากรรายอายุ   จังหวัด
    
<label><? echo empty($_GET['year_data'])? "ทุกปี" : @$_GET['year_data'];?></label> 
  จังหวัด
<label><?php echo empty($_GET['province_id']) ? 'ทุกจังหวัด' : iconv('TIS-620', 'UTF-8', $this->db->getone('select province from provinces where id = '.$_GET['province_id'])); ?></label> 
เขต/อำเภอ <label><?php echo empty($_GET['amphur_id']) ? 'ทุกเขต/อำเภอ' : iconv('TIS-620', 'UTF-8', $this->db->getone('select amphur_name from amphur where id = '.$_GET['amphur_id'])); ?></label> 
แขวง/ตำบล <label><?php echo empty($_GET['district_id']) ? 'ทุกแขวง/ตำบล' : iconv('TIS-620', 'UTF-8', $this->db->getone('select district_name from district where id = '.$_GET['district_id'])); ?></label>    
</div>
<div style="padding:10px; text-align:right;">
  <a href="report/population/age_rate_export<?=GetCurrentUrlGetParameter();?>"><img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
  <a href="report/population/age_rate_print<?=GetCurrentUrlGetParameter();?>" target="_blank"><img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"></a>หน่วย:ราย
</div>

<table class="tbreport">
<tr>
<th class="txtcen">อายุ (ปี)</th>
<th class="txtcen">ชาย</th>
<th class="txtcen">หญิง</th>
<th class="txtcen">รวม</th>
</tr>
<? 
$xtotal_male = 0;
$xtotal_female = 0;
for($i=1;$i<=102;$i++):
	switch($i){
		case 102:
			$age_title = "มากกว่า 100 ปี";	
		break;
		case 1:
		 $age_title =  "น้อยกว่า 1 ปี";
		break;
		default:
			$age_title = ($i -1)." ปี" ;
		break;
	}	
	$condition= @$_GET['year_data']!=''? " AND YEAR_DATA=".$_GET['year_data'] : "";
	$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
	$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : " AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) ";
	$condition.= @$_GET['district_id']!='' ? " AND AMPHUR_ID=".$_GET['district_id'] :  " AND (POPULATION.DISTRICT_ID IS NULL OR POPULATION.DISTRICT_ID = 0) ";
	$sql = "SELECT SUM(NUNIT) FROM POPULATION_DETAIL LEFT JOIN POPULATION ON POPULATION_DETAIL.PID = POPULATION.ID WHERE AGE_RANGE_CODE=".$i.$condition;	
	$sum_male = $this->db->getone($sql);
	$sum_female = $this->db->getone("SELECT SUM(NUNIT) FROM POPULATION_DETAIL LEFT JOIN POPULATION ON POPULATION_DETAIL.PID = POPULATION.ID WHERE AGE_RANGE_CODE=".($i+102).$condition);
	$xtotal_male+= $sum_male;
	$xtotal_female+= $sum_female;
?>
<tr>
<td class="topic"><?=$age_title;?></td>
<td style="text-align:right;"><?=number_format($sum_male,0);?></td>
<td style="text-align:right;"><?=number_format($sum_female,0);?></td>
<td style="text-align:right;"><?=number_format(($sum_male+$sum_female),0);?></td>
</tr>
<? endfor;?>
<tr>
  <td class="topic">&nbsp;</td>
  <td></td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td class="topic">รวมประชากรที่มีสัญชาติไทยและมีชื่ออยู่ในทะเบียนบ้าน</td>
  <td style="text-align:right;"><?=number_format($xtotal_male,0);?></td>
  <td style="text-align:right;"><?=number_format($xtotal_female,0);?></td>
  <td style="text-align:right;"><?=number_format($xtotal_male+$xtotal_female,0);?></td>
</tr>
<?
	$condition= @$_GET['year_data']!=''? " AND YEAR_DATA=".$_GET['year_data'] : "";
	$condition.= @$_GET['province_id']!='' ? " AND PROVINCE_ID=".$_GET['province_id'] : "";
	$condition.= @$_GET['amphur_id']!='' ? " AND AMPHUR_ID=".$_GET['amphur_id'] : " AND (POPULATION.AMPHUR_ID IS NULL OR POPULATION.AMPHUR_ID = 0) ";
	$condition.= @$_GET['district_id']!='' ? " AND AMPHUR_ID=".$_GET['district_id'] :  " AND (POPULATION.DISTRICT_ID IS NULL OR POPULATION.DISTRICT_ID = 0) ";
	$sql = "SELECT SUM(LUNAR_CAL_MALE)SUM_LUNAR_MALE, SUM(LUNAR_CAL_FEMALE)SUM_LUNAR_FEMALE,
	SUM(CENTRAL_HH_MALE)SUM_HH_MALE,SUM(CENTRAL_HH_FEMALE)SUM_HH_FEMALE,
	SUM(NO_THAI_MALE)SUM_NO_THAI_MALE,SUM(NO_THAI_FEMALE)SUM_NO_THAI_FEMALE,
	SUM(IN_TRANS_MALE)SUM_INTRANS_MALE,SUM(IN_TRANS_FEMALE)SUM_INTRANS_FEMALE
	FROM POPULATION  WHERE 1=1 ".$condition;	
	$value = $this->db->getrow($sql);
	$xtotal_male+=$value['SUM_LUNAR_MALE']+$value['SUM_NO_THAI_MALE']+$value['SUM_HH_MALE']+$value['SUM_INTRANS_MALE'];
	$xtotal_female+=$value['SUM_LUNAR_FEMALE']+$value['SUM_NO_THAI_FEMALE']+$value['SUM_HH_FEMALE']+$value['SUM_INTRANS_FEMALE'];
?>
<tr>
  <td class="topic">ประชากรที่เกิดปีจันทรคติ</td>
  <td style="text-align:right;"><?=number_format($value['SUM_LUNAR_MALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_LUNAR_FEMALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_LUNAR_MALE']+$value['SUM_LUNAR_FEMALE'],0);?></td>
</tr>
<tr>
  <td class="topic">ผู้ที่มิใช่ีสัญชาติไทย</td>
  <td style="text-align:right;"><?=number_format($value['SUM_NO_THAI_MALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_NO_THAI_FEMALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_NO_THAI_MALE']+$value['SUM_NO_THAI_FEMALE'],0);?></td>
</tr>
<tr>
  <td class="topic">ผู้ที่มีชื่ออยู่ในทะเบียนบ้านกลาง (ทะเบียนซึ่งผู้อำนวยการทะเบียนกลางกำหนดให้จัดทำขึ้นสำหรับ ลงรายการบุคคลที่ไม่อาจมีชื่อในทะเบียนบ้าน)</td>
  <td style="text-align:right;"><?=number_format($value['SUM_HH_MALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_HH_FEMALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_HH_MALE']+$value['SUM_HH_FEMALE'],0);?></td>
</tr>
<tr>
  <td class="topic">ผู้ที่อยู่ระหว่างการย้าย (ผู้ที่ย้ายออกแต่ยังไม่ได้ย้ายเข้า)</td>
  <td style="text-align:right;"><?=number_format($value['SUM_INTRANS_MALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_INTRANS_FEMALE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_INTRANS_MALE']+$value['SUM_INTRANS_FEMALE'],0);?></td>
</tr>
<tr>
  <td class="topic">รวมประชากรทั้งหมด พ.ศ. <? echo empty($_GET['year_data'])? "ทุกปี" : @$_GET['year_data'];?>.จังหวัด<?php echo empty($_GET['province_id']) ? 'ทุกจังหวัด' : iconv('TIS-620', 'UTF-8', $this->db->getone('select province from provinces where id = '.$_GET['province_id'])); ?></td>
  <td style="text-align:right;"><?=number_format($xtotal_male,0);?></td>
  <td style="text-align:right;"><?=number_format($xtotal_female,0);?></td>
  <td style="text-align:right;"><?=number_format($xtotal_male+$xtotal_female,0);?></td>
</tr>
</table>

<div id="ref">ที่มา :  ประมวลผลจาก ฐานข้อมูล "จำนวนประชากร" สำนักบริหารการทะเบียน กรมการปกครอง </div>
 <script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>