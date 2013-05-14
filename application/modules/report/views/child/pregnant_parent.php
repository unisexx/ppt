<h3>รายงาน สถานการณ์การมีบุตรของวัยรุ่นไทย (ทารกที่เกิดจากมารดาวัยรุ่น)</h3>
<div id="search">
  <div id="searchBox">
  	<form action="report/child/pregnant_parent">
  <?php echo form_dropdown('year',get_year_option(),@$_GET['year'],'','-- ทุกปี --'); ?>
  <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '- ทุกจังหวัด -'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  </form>
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> ทารกที่เกิดจากมารดาวัยรุ่น ปี 
  <label><?php echo (!empty($_GET['year'])) ? $_GET['year'] : "ทุกปี" ?></label>
จังหวัด
<label><?php echo (!empty($_GET['province_id'])) ? $province : "ทุกจังหวัด" ?></label>
</div>
<div style="padding:10px; text-align:right;">
<a href="report/child/pregnant_parent/export" >
<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"></a>
<a href="report/child/pregnant_parent/print" >
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">
</a>หน่วย:คน</div>

<table class="tbreport">
<tr>
<th rowspan="2">อายุบิดา (ปี)</th>
<th colspan="12">อายุมารดา (ปี)</th>
</tr>
<tr>
  <td>≤9</td>
  <td>10</td>
  <td>11</td>
  <td>12</td>
  <td>13</td>
  <td>14</td>
  <td>15</td>
  <td>16</td>
  <td>17</td>
  <td>18</td>
  <td>19</td>
  <td>รวม</td>
</tr>


<?php 

$sum=0;$sumall=0;
$ages=array(9=>"9",10=>"10",11=>"11",12=>"12",13=>"13",14=>"14",15=>"15",16=>"16",17=>"17",18=>"18",19=>"19"
					,20=>"20ถึง&lt;25",21=>"25ถึง&lt;30",22=>"30ถึง&lt;35",23=>"35ถึง&lt;40",24=>"40ถึง&lt;45"
					,25=>"45ถึง&lt;50",26=>"50 ถึง&lt;55",27=>"55ถึง&lt;60",28=>"60 ปีขึ้นไป");

for($i=9;$i<29;$i++){ ?>
<tr>
<td class="topic"><?php echo  ($i==9)? "≤". $ages[$i]:$ages[$i] ?></td>	
<?php	for($j=9;$j<=20;$j++){ ?>
 <td>
  	<?php  //echo $i.'-'.$j." ";
 	 if($j==20){
 	 	 echo  number_format($sumall );break; 
 	 } 	  	
  	$sum=(!empty($val[$i][$j])) ? $val[$i][$j]:0; 
	$shw_sum=$sum;
	echo number_format($shw_sum);
  	$all[]=$sum;
   $sumall=$sumall+$sum;  
  	?>
 </td>
 
<?php } 
	$sumall=0;
?>

</tr>
<?php		} ?>

<tr class="total">
  <td>รวม</td>
  <td><?php echo number_format($val[29][9]) ?></td>
  <td><?php echo number_format($val[29][10]) ?></td>
  <td><?php echo number_format($val[29][11]) ?></td>
  <td><?php echo number_format($val[29][12]) ?></td>
  <td><?php echo number_format($val[29][13]) ?></td>
  <td><?php echo number_format($val[29][14]) ?></td>
  <td><?php echo number_format($val[29][15]) ?></td>
  <td><?php echo number_format($val[29][16]) ?></td>
  <td><?php echo number_format($val[29][17]) ?></td>
  <td><?php echo number_format($val[29][18]) ?></td>
  <td><?php echo number_format($val[29][19]) ?></td>
  <td><?php echo number_format($val[29][20]) ?></td>
</tr>

</table>

<div id="ref">ที่มา :</div>


