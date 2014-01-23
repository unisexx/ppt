<? $m['id'] = 112; ?>
<?=menu::source($m['id']);?>

<form action='' method='get'>
<div id="search">
  <div id="searchBox"> 
  		<? if(@$_GET['page']) { ?> <input type='hidden' name='page' value='<?=@$_GET['page'];?>'> <? } ?>
		
		<select name="year_data">
	      <?php foreach($years as $row):?>
	      	<option value="<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == @$_GET['year_data'])?"selected":"";?>><?php echo $row['year_data']?></option>
	      <?php endforeach;?>
	    </select>
	    
	    <select name="import_type">
			<option value="1" <?php echo (@$_GET['import_type'] == 1)?"selected":"";?>>บุคคล</option>
			<option value="2" <?php echo (@$_GET['import_type'] == 2)?"selected":"";?>>องค์กร</option>
		</select>
	    
	    <!-- <select name="code">
	    	<option value="">--- เลือกทุกจังหวัด ---</option>
	      <?php foreach($provinces as $row):?>
	      	<option value="<?php echo $row['code']?>" <?php echo ($row['code'] == @$_GET['code'])?"selected":"";?>><?php echo $row['province']?></option>
	      <?php endforeach;?>
	    </select> -->
	    
	  	<input type="submit" title="ค้นหา" value=" " class="btn_search" onclick='action_search();'/>
  </div>
</div>
</form>


<?php if($_GET['import_type'] == '1'):?>
	
<?php if(menu::perm($m['id'], 'add')): ?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='healthcare/form_import'" class="btn_import"/>
	<!-- <input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='danger/form'" class="btn_add"/> -->
</div>
<?php endif; ?>

<table class="tbreport">
<tr>
<th width="9" rowspan="2" class="txtcen" style="border: 1px solid #ccc;">ที่</th>
<th width="76" rowspan="2" class="txtcen" style="border: 1px solid #ccc;">จังหวัด</th>
<th colspan="4" class="txtcen" style="border: 1px solid #ccc;">จำนวนเด็ก (คน)</th>
<th colspan="10" class="txtcen" style="border: 1px solid #ccc;">จำนวนเงินที่สนับสนุน/สงเคราะห์ (บาท)</th>
</tr>
<tr>
<td width="22" class="txtcen">ชาย</td>
<td width="25" class="txtcen">หญิง</td>
<td width="35" class="txtcen">ไม่ระบุ</td>
<td width="20" class="txtcen">รวม</td>
<td width="190" class="txtcen">ค่าเลี้ยงดู</td>
<td width="122" class="txtcen">ค่าใช้จ่ายทางการศึกษา</td>
<td width="92" class="txtcen">ทุนประกอบอาชีพ</td>
<td width="77" class="txtcen">ค่ากายอุปกรณ์</td>
<td width="120" class="txtcen">ค่าเครื่องอุปโภคบริโภค</td>
<td width="142">สงเคราะห์ครอบครัวอุปถัมภ์</td>
<td width="169">ค่าฝึกอบรมเกี่ยวกับวิธีการเลี้ยงดู</td>
<td width="45">ค่าตรวจ DNA</td>
<td width="22">อื่นๆ</td>
<td width="26">รวม</td>
</tr>
<?php foreach($childfunds as $key => $row):?>
<tr>
  <td><?php echo $key+1?></td>
  <td nowrap="nowrap"><?php echo $row['province']?></td>
  <td><?php echo number_format($row['men'])?></td>
  <td><?php echo number_format($row['women'])?></td>
  <td><?php echo number_format($row['unknown'])?></td>
  <td><?php echo number_format($row['peoplesum'])?></td>
  <td><?php echo number_format($row['alimony'])?></td>
  <td><?php echo number_format($row['education'])?></td>
  <td><?php echo number_format($row['job'])?></td>
  <td><?php echo number_format($row['orthotics'])?></td>
  <td><?php echo number_format($row['consumer'])?></td>
  <td><?php echo number_format($row['family'])?></td>
  <td><?php echo number_format($row['training'])?></td>
  <td><?php echo number_format($row['dna'])?></td>
  <td><?php echo number_format($row['other'])?></td>
  <td><?php echo number_format($row['total'])?></td>
</tr>
<?php endforeach;?>
</table>

<?php elseif($_GET['import_type'] == '2'):?>
	<table class="tbreport">
	<tr>
	  <th rowspan="3" class="txtcen" style="border: 1px solid #ccc;">ที่</th>
	  <th rowspan="3" class="txtcen" style="border: 1px solid #ccc;">จังหวัด</th>
	  <th colspan="12" class="txtcen" style="border: 1px solid #ccc;">ประเภทการสนับสนุน</th>
	  <th colspan="12" class="txtcen" style="border: 1px solid #ccc;">งบประมาณที่สนับสนุน (บาท)</th>
	  </tr>
	<tr>
	  <td colspan="5" class="txtcen">โครงการ</td>
	  <td colspan="3" class="txtcen">องค์กร</td>
	  <td colspan="4" class="txtcen">เด็ก</td>
	  <td colspan="5" class="txtcen">โครงการ</td>
	  <td colspan="3" class="txtcen">องค์กร</td>
	  <td colspan="4" class="txtcen">เด็ก</td>
	  </tr>
	<tr>
	  <td class="txtcen">1</td>
	  <td class="txtcen">2</td>
	  <td class="txtcen">3</td>
	  <td class="txtcen">4</td>
	  <td class="txtcen">5</td>
	  <td class="txtcen">1</td>
	  <td class="txtcen">2</td>
	  <td class="txtcen">3</td>
	  <td class="txtcen">1</td>
	  <td class="txtcen">2</td>
	  <td class="txtcen">3</td>
	  <td class="txtcen">4</td>
	  <td class="txtcen">1</td>
	  <td class="txtcen">2</td>
	  <td class="txtcen">3</td>
	  <td class="txtcen">4</td>
	  <td class="txtcen">5</td>
	  <td class="txtcen">1</td>
	  <td class="txtcen">2</td>
	  <td class="txtcen">3</td>
	  <td class="txtcen">1</td>
	  <td class="txtcen">2</td>
	  <td class="txtcen">3</td>
	  <td class="txtcen">4</td>
	</tr>
	<?php foreach($childfunds as $key=>$row):?>
	  <tr>
	  <td><?php echo $key+1?></td>
	  <td><?php echo $row['pv']?></td>
	  <td><?php echo number_format($row['typemain1'])?></td>
	  <td><?php echo number_format($row['typemain2'])?></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><?php echo number_format($row['under_type1'])?></td>
	  <td><?php echo number_format($row['under_type3'])?></td>
	  <td><?php echo number_format($row['under_type2'])?></td>
	  <td><?php echo number_format($row['typechild2'])?></td>
	  <td><?php echo number_format($row['typechild1'])?></td>
	  <td><?php echo number_format($row['typechild4'])?></td>
	  <td>&nbsp;</td>
	  <td><?php echo number_format($row['sum_typemain1'])?></td>
	  <td><?php echo number_format($row['sum_typemain2'])?></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><?php echo number_format($row['sum_under_type1'])?></td>
	  <td><?php echo number_format($row['sum_under_type2'])?></td>
	  <td><?php echo number_format($row['sum_under_type3'])?></td>
	  <td><?php echo number_format($row['sum_typechild2'])?></td>
	  <td><?php echo number_format($row['sum_typechild1'])?></td>
	  <td><?php echo number_format($row['sum_typechild4'])?></td>
	  <td>&nbsp;</td>
	  </tr>
<?php endforeach;?>
</table>
<?php endif;?>