<table class="tbreport"  border='1'>
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