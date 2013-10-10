<h3>รายงาน สถิติประชากรรายอายุ </h3>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> สถิติประชากรรายอายุ   จังหวัด
    
<label><? echo empty($_GET['year_data'])? "ทุกปี" : @$_GET['year_data'];?></label> 
  จังหวัด
<label><?php echo empty($_GET['province_id']) ? 'ทุกจังหวัด' : iconv('TIS-620', 'UTF-8', $this->db->getone('select province from provinces where id = '.$_GET['province_id'])); ?></label> 
เขต/อำเภอ <label><?php echo empty($_GET['amphur_id']) ? 'ทุกเขต/อำเภอ' : iconv('TIS-620', 'UTF-8', $this->db->getone('select amphur_name from amphur where id = '.$_GET['amphur_id'])); ?></label> 
แขวง/ตำบล <label><?php echo empty($_GET['district_id']) ? 'ทุกแขวง/ตำบล' : iconv('TIS-620', 'UTF-8', $this->db->getone('select district_name from district where id = '.$_GET['district_id'])); ?></label>    
</div>
<div style="padding:10px; text-align:right;">
 หน่วย:ราย
</div>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
<th class="txtcen">อายุ (ปี)</th>
<th class="txtcen">ชาย</th>
<th class="txtcen">หญิง</th>
<th class="txtcen">รวม</th>
</tr>
<? 
$xtotal_male = 0;
$xtotal_female = 0;
for($i=0;$i<=101;$i++):
	switch($i){
		case 101:
			$age_title = "มากกว่า 100 ปี";	
		break;
		case 0:
		 $age_title =  "น้อยกว่า 1 ปี";
		break;
		default:
			$age_title = ($i)." ปี" ;
		break;
	}	
	
	$condition = '';
	$condition.= $_GET['year_data'] !='' ? " AND YEAR_DATA=".$_GET['year_data'] : "";
	if($_GET['province_id']=='' && $_GET['amphur_id']=='' && $_GET['tumbon_id']==''){
			$condition.=" AND LEVEL_CODE = 1 ";
	}else if($_GET['province_id']!='' && $_GET['amphur_id']=='' && $_GET['district_id']==''){
			$province_code = $this->db->getone('SELECT code FROM PROVINCES WHERE id='.$_GET['province_id']);
			$condition.=" AND LEVEL_CODE = 3 AND PROVINCE_CODE=".$province_code;
	}else if($_GET['province_id']!='' && $_GET['amphur_id']!='' && $_GET['district_id']==''){
			$province_code = $this->db->getone('SELECT code FROM PROVINCES WHERE id='.$_GET['province_id']);
			$amphur_code = $this->db->getone(" SELECT amphur_code FROM AMPHUR WHERE province_id = ".$_GET['province_id']." AND id=".$_GET['amphur_id']);
			$condition.=" AND LEVEL_CODE = 4 AND PROVINCE_CODE=".$province_code." AND DISTRICT_CODE=".$amphur_code;
	}else if($_GET['province_id']!='' && $_GET['amphur_id']!='' && $_GET['district_id']!=''){
			$province_code = $this->db->getone('SELECT code FROM PROVINCES WHERE id='.$_GET['province_id']);
			$amphur_code = $this->db->getone(" SELECT amphur_code FROM AMPHUR WHERE province_id = ".$_GET['province_id']." AND id=".$_GET['amphur_id']);
			$tumbon_code = $this->db->getone(" SELECT district_name FROM district WHERE province_id = ".$_GET['province_id']." AND amphur_id=".$_GET['amphur_id']." AND id=".$_GET['district_id']);
			$condition.=" AND LEVEL_CODE = 5 AND PROVINCE_CODE=".$province_code." AND DISTRICT_CODE=".$amphur_code." AND TUMBOL_name='".trim($tumbon_code)."'";
	}
	
	
	$sql = " SELECT SUM(MALE".$i.")SUM_MALE, SUM(FEMALE".$i.")SUM_FEMALE FROM POPULATION_DATA WHERE 1=1 ".$condition;
	$population = $this->db->getrow($sql);
	$sum_male = $population['SUM_MALE'];
	$sum_female = $population['SUM_FEMALE'];
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
	$sql = "SELECT 
	SUM(MALE_BORN)SUM_MALE_BORN, SUM(FEMALE_BORN)SUM_FEMALE_BORN,
	SUM(MALE_NO_THAI)SUM_MALE_NO_THAI,SUM(FEMALE_NO_THAI)SUM_FEMALE_NO_THAI,
	SUM(MALE_IN_HOME)SUM_MALE_IN_HOME,SUM(FEMALE_IN_HOME)SUM_FEMALE_IN_HOME,
	SUM(MALE_MOVE)SUM_MALE_MOVE,SUM(FEMALE_MOVE)SUM_FEMALE_MOVE
	FROM POPULATION_DATA  WHERE 1=1 ".$condition;	
	$value = $this->db->getrow($sql);
	$xtotal_male+=$value['SUM_MALE_BORN']+$value['SUM_MALE_NO_THAI']+$value['SUM_MALE_IN_HOME']+$value['SUM_MALE_MOVE'];
	$xtotal_female+=$value['SUM_FEMALE_BORN']+$value['SUM_FEMALE_NO_THAI']+$value['SUM_FEMALE_IN_HOME']+$value['SUM_FEMALE_MOVE'];
?>
<tr>
  <td class="topic">ประชากรที่เกิดปีไทย (ปีจันทรคติ )</td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_BORN'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_FEMALE_BORN'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_BORN']+$value['SUM_FEMALE_BORN'],0);?></td>
</tr>
<tr>
  <td class="topic">ผู้ที่มิใช่ีสัญชาติไทย</td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_NO_THAI'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_FEMALE_NO_THAI'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_NO_THAI']+$value['SUM_FEMALE_NO_THAI'],0);?></td>
</tr>
<tr>
  <td class="topic">ผู้ที่มีชื่ออยู่ในทะเบียนบ้านกลาง (ทะเบียนซึ่งผู้อำนวยการทะเบียนกลางกำหนดให้จัดทำขึ้นสำหรับ ลงรายการบุคคลที่ไม่อาจมีชื่อในทะเบียนบ้าน)</td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_IN_HOME'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_FEMALE_IN_HOME'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_IN_HOME']+$value['SUM_FEMALE_IN_HOME'],0);?></td>
</tr>
<tr>
  <td class="topic">ผู้ที่อยู่ระหว่างการย้าย (ผู้ที่ย้ายออกแต่ยังไม่ได้ย้ายเข้า)</td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_MOVE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_FEMALE_MOVE'],0);?></td>
  <td style="text-align:right;"><?=number_format($value['SUM_MALE_MOVE']+$value['SUM_FEMALE_MOVE'],0);?></td>
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