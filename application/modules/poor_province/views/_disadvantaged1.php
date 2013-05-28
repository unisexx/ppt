<h3>รายงาน ผู้มีรายได้ต่ำกว่าเส้นความยากจน</h3>
<div id="search">
  <div id="searchBox">
    <form method="get" action="poor_province/poor_report">
 <?php echo form_dropdown('year', get_year_option(2555), @$_GET['year'], null, '-- ทุกปี --'); ?>
        <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
        <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
        
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
   </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> จำนวนและสัดส่วนคนจนที่อยู่ต่ำกว่าเส้นความยากจน  จังหวัด
<label>

  <?php 
  
        if(!empty($_GET))
        {
			  $sql0 = 'select * from provinces where id='.$_GET['province_id'];
			  $result0 = $this->opt->get($sql0);
			  foreach($result0 as $key0 => $item0)
			  {
				  echo $item0['province'];
			  }
		}
		else
		{
				  echo " ทุกปี ";	
		}
  ?>  

</label>

</div>
<div style="padding:10px; text-align:right;">
  <img src="<?php echo base_url(); ?>media/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
<img src="<?php echo base_url(); ?>media/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">หน่วย:พันคน</div>


 <?php 
 
 
 
 $all_year = array();
 $all_line = array();
  $all_percent = array();
 $all_qty = array();
 $i=0;
 
 
$sql1 = 'select distinct(poor_province_year) as y from pool_province order by poor_province_year desc';
$result1 = $this->opt->get($sql1);

 foreach($result1 as $key1 => $item1)
 {

		$all_year[$i] = $item1['y'];
		 
		$sql2 = "SELECT sum(poor_province_line) as line,sum(poor_province_percent) as percents,sum(poor_province_qty) as qty from pool_province where poor_province_year = '".$item1['y']."' order by POOR_PROVINCE_YEAR DESC";
		$result2 = $this->opt->get($sql2);
		
		 foreach($result2 as $key2 => $item2)
		 {
		 
		 
		 $all_line[$i] = $all_line[$i] + $item2['line'];
		 $all_percent[$i] = $all_percent[$i] + $item2['percents'];
		 $all_qty[$i] = $all_qty[$i] + $item2['qty'];
		
		
		 
 		}
 		
		$i++;
		
 }
 
 
 ?>

<table class="tbreport">
<tr>
<th>ปี</th>
<th>เส้นความยากจน(บาท/คน/เดือน)</th>
<th>สัดส่วนคนจน(ร้อยละ)</th>
<th>จำนวนคนจน(พันคน)</th>
</tr>

<?php for($i=0;$i<count($all_year);$i++) { ?>

<tr>
<td class="topic"><?php echo $all_year[$i]; ?></td>
<td><?php echo @number_format($all_line[$i]); ?></td>
<td><?php echo @number_format($all_percent[$i]); ?></td>
<td><?php echo @number_format($all_qty[$i]); ?></td>
</tr>

<?php } ?>


</table>

<div id="ref"><b>ที่มา :</b> ข้อมูลจากการสำรวจภาวะเศรษฐกิจและสังคมของครัวเรือน สำนักงานสถิติแห่งชาติ ประมวลผลโดย สำนักพัฒนาฐานข้อมูลและตัวชี้วัดภาวะสังคม สศช.</div>
<div id="remark"><b>หมายเหตุ : </b>สัดส่วนคนจน คำนวณจากจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน หารด้วย จำนวนประชากรทั้งหมด คูณด้วย 100 
จำนวนคนจน หมายถึงจำนวนประชากรที่มีรายจ่ายเพื่อการบริโภคต่ำกว่าเส้นความยากจน</div>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur',value: 'id',label: 'text'});
    });
</script>