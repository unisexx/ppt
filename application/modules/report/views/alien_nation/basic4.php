<h3>รายงาน คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</h3>
<a href="report/alien_nation_r/alien_nation_report" target="_blank"><div style="padding:10px; background:#EAEAEA; border:1px solid #ccc; font-weight:700; width:130px; float:right">จำแนกตามสัญชาติ</div></a>
<div id="search">
  <div id="searchBox">
<form method="get" action="report/alien_nation_r/index" id="frm_im" name="frm_im">
 
 <?php echo form_dropdown('year', get_year_option(2554, null, 'ALIEN', 'ALIEN_YEAR', TRUE), @$_GET['year'], null, '-- ทุกปี --'); ?>

  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  
  </form>
  
  </div>
</div>
<div id="resultsearch"><b>ผลที่ค้นหา :</b> คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน 
<label><?php if(isset($_GET['year'])){echo $_GET['year'];}else{echo "ทุกปี";} ?></label></div>
<div style="padding:10px; text-align:right;">


<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล"
 onclick="document.location='<?php echo site_url('report/alien_nation_r/basic4_export/'.@$_GET['year'].''); ?>'">
 
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล"
 onclick="document.location='<?php echo site_url('report/alien_nation_r/basic4_print/'.@$_GET['year'].''); ?>'">



</div>
<table class="tbreport">
<tr>
  <th rowspan="2" class="txtcen">ปี</th>
  <th colspan="5" class="txtcen">คนต่างด้าวที่ได้รับอนุญาตให้ทำงาน</th>
</tr>
<tr>
  <td class="txtcen">ทั้งหมด</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ต่างด้าวเข้าเมืองถูกกฎหมาย</td>
  <td class="txtcen">ต่างด้าวเข้าเมืองผิดกฎหมาย</td>


</tr>


 <?php 
 
 foreach($result as $key => $item): $key += 1;
  
 ?>  
 
<tr>
  <td class="topic txtcen"><?php echo $item['s_year']; ?></td>
  <td class="txtright"><?php echo @number_format($item['a_sum']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_male']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_female']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_in']); ?></td>
  <td class="txtright"><?php echo @number_format($item['s_out']); ?></td>
</tr>

<?php 
 
endforeach;

 ?>
 
 
</table>

<div id="ref">ที่มา : สำนักบริการแรงงานต่างด้าว</div>


