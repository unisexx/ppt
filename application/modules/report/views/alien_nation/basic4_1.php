<h3>รายงาน คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน (จำแนกตามสัญชาติ)</h3>
<div id="search">
  <div id="searchBox">

<form method="get" action="report/alien_nation_r/alien_nation_report" id="frm_im" name="frm_im">
 
 <?php echo form_dropdown('year', get_year_option(2554, null, 'ALIEN_NATION', 'ALIEN_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>

  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  
  </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> คนต่างด้าวได้รับอนุญาตทำงานคงเหลือทั่วราชอาณาจักร (จำแนกตามสัญชาติ)<label><?php if(isset($_GET['year'])){echo 'ปี '.$_GET['year'];}else{echo "ทุกปี";} ?></label></div>
<div style="padding:10px; text-align:right;">


<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"
 onclick="document.location='<?php echo site_url('report/alien_nation_r/alien_nation_export/'.@$_GET['year'].''); ?>'">
 
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"
 onclick="document.location='<?php echo site_url('report/alien_nation_r/alien_nation_print/'.@$_GET['year'].''); ?>'">

หน่วย:คน


</div>
<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">สัญชาติ</th>
<th colspan="3" class="txtcen">คนต่างด้าวได้รับอนุญาตทำงาน </th>
</tr>
<tr>
  <td class="txtcen">เข้าเมืองถูกกฎหมาย</td>
  <td class="txtcen">เข้าเมืองผิดกฎหมาย</td>
  <td class="txtcen">รวม</td>
  </tr>
  
  
 <?php 
 $sum_in = '';
 $sum_out = '';
 $sum_all = '';
 
 foreach($result as $key => $item): $key += 1;
  
 ?>  

<tr>
  <td class="topic"><?php echo $item['alien_nation']; ?></td>
  <td class="txtright"><?php echo @number_format($item['alien_in']); ?></td>
  <td class="txtright"><?php echo @number_format($item['alien_out']); ?></td>
  
  <?php $sum = $item['alien_in'] + $item['alien_out']; ?>
  
  <td class="txtright"><?php echo @number_format($sum); ?></td>
  </tr>
  
<?php 


 
 $sum_in = $sum_in + $item['alien_in'];
 $sum_out = $sum_out + $item['alien_out'];
 $sum_all = $sum_all + $sum;
 
 
endforeach;


 ?>

<tr class="total">
  <td>รวม</td>
  <td class="txtright"><?php echo number_format($sum_in,0); ?></td>
  <td class="txtright"><?php echo number_format($sum_out,0); ?></td>
  <td class="txtright"><?php echo number_format($sum_all,0); ?></td>
  </tr>
</table>

<div id="ref">ที่มา : สำนักบริการแรงงานต่างด้าว</div>


