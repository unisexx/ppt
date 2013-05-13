<script type="text/javascript">
$(document).ready(function(){

var td,sum=0;

var sum_all =new Array();
					
			for(var i=1;i<12;i++){	
				for(var j=2;j<20;j++){		
				td_val=$('tr:eq('+j+')').find('td:eq('+i+')').css('background-color','').html();
				sum=sum+parseInt(td_val);
				sum_all[i]=sum;			
			}
			sum = 0;
		}
		$('tr:eq(20)').find('td:eq(1)').html(sum_all[1]);
		$('tr:eq(20)').find('td:eq(2)').html(sum_all[2]);
		$('tr:eq(20)').find('td:eq(3)').html(sum_all[3]);
		$('tr:eq(20)').find('td:eq(4)').html(sum_all[4]);	
		$('tr:eq(20)').find('td:eq(5)').html(sum_all[5]);	
		$('tr:eq(20)').find('td:eq(6)').html(sum_all[6]);	
		$('tr:eq(20)').find('td:eq(7)').html(sum_all[7]);	
		$('tr:eq(20)').find('td:eq(8)').html(sum_all[8]);	
		$('tr:eq(20)').find('td:eq(9)').html(sum_all[9]);	
		$('tr:eq(20)').find('td:eq(10)').html(sum_all[10]);	
		$('tr:eq(20)').find('td:eq(11)').html(sum_all[11]);	
		
		
		
/*
		$('.tbreport tr').each(function(i){
			var tcol = new Array();
			var t = 0;
			var tr = $(this);
			var td = $(this).find('td');
			//alert(tr.index());
			td.each(function(){
				var col = $(this);
				if(tr.index() > 1 && tr.index() <20 ){
					if(col.index() > 0){
						col.css('background-color', 'red');
						//alert(parseInt(col.text()));
					    tcol[parseInt(col.index())] += parseInt(col.text());
				       alert(col.index() + ' ' + tcol[col.index()]);
					}				
				}
				
				if(tr.index() == 20){
					if(col.index() > 0){
						//alert(tcol[col]);
						col.css('background-color', '#eee');
						col.text(tcol[col.index()]);
					     //$('tr:eq(19)').find('td:eq(1)').html(tcol[2]);
					}				
				}
			});
		});	
		*/
})
</script>
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
$ages=array(9=>"9",10=>"10",11=>"11",12=>"12",13=>"13",14=>"14",15=>"15",16=>"16",17=>"17",18=>"18",19=>"19",20=>"20ถึง&lt;25"
					  ,21=>"30ถึง&lt;35",22=>"35ถึง&lt;40",23=>"40ถึง&lt;45",24=>"50ถึง&lt;55",25=>"55ถึง&lt;60",26=>"60 ปีขึ้นไป");

for($i=9;$i<27;$i++){ ?>
<tr>
<td class="topic"><?php echo  ($i==9)? "≤". $ages[$i]:$ages[$i] ?></td>	
<?php	for($j=9;$j<=20;$j++){ ?>
  <td><?php  //echo $i.'-'.$j." ";
  if($j==20){
  	echo  $sumall ;break;
  }   	
  echo $sum=(!empty($val[$i][$j])) ? $val[$i][$j]:0; 
  $all[]=$sum;
   $sumall=$sumall+$sum;
    
  	?></td>
 
<?php } 
	$sumall=0;
?>

</tr>
<?php			}

?>

<tr class="total">
  <td>รวม</td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
</tr>

</table>

<div id="ref">ที่มา :</div>


