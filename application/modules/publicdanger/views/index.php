<? $m['id'] = 112; ?>
<?=menu::source($m['id']);?>

<form action='' method='get'>
<div id="search">
  <div id="searchBox"> 
  		<? if(@$_GET['page']) { ?> <input type='hidden' name='page' value='<?=@$_GET['page'];?>'> <? } ?>
		
		<select name="year_data">
			<option value="">--- เลือกทุกปี ---</option>
	      <?php foreach($years as $row):?>
	      	<option value="<?php echo $row['year_data']?>" <?php echo ($row['year_data'] == @$_GET['year_data'])?"selected":"";?>><?php echo $row['year_data']?></option>
	      <?php endforeach;?>
	    </select>
	    
	    <select name="code">
	    	<option value="">--- เลือกทุกจังหวัด ---</option>
	      <?php foreach($provinces as $row):?>
	      	<option value="<?php echo $row['code']?>" <?php echo ($row['code'] == @$_GET['code'])?"selected":"";?>><?php echo $row['province']?></option>
	      <?php endforeach;?>
	    </select>
	    
	  	<input type="submit" title="ค้นหา" value=" " class="btn_search" onclick='action_search();'/>
  </div>
</div>
</form>

<?php if(menu::perm($m['id'], 'add')): ?>
<div id="btnBox">
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='healthcare/form_import'" class="btn_import"/>
	<!-- <input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='danger/form'" class="btn_add"/> -->
</div>
<?php endif; ?>

<?=$pagination; ?>

<table class="tblist">
<tr>
<th rowspan="2" class="txtcen">สำดับที่</th>
<th rowspan="2" class="txtcen">ปีงบประมาณ</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th rowspan="2" class="txtcen">อายุ</th>
<th colspan="4" class="txtcen">สิทธิประกันสุขภาพถ้วนหน้า</th>
<th colspan="4" class="txtcen">บุคคลที่ยังไม่ได้รับการลงทะเบียน</th>
<th colspan="4" class="txtcen">สิทธิข้าราชการ/สิทธิรัฐวิสาหกิจ</th>
<th colspan="4" class="txtcen">สิทธิและสถานะอื่นๆ</th>
<th colspan="4" class="txtcen">สิทธิประกันสังคม</th>
<th colspan="4" class="txtcen">บุคคลผู้มีปัญหาสถานะและสิทธิ</th>
</tr>
<tr>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
  <td class="txtcen">ชาย</td>
  <td class="txtcen">หญิง</td>
  <td class="txtcen">ไม่ระบุ</td>
  <td class="txtcen">รวม</td>
</tr>
<?php foreach($healthcares as $key=>$row): $key += 1;?>
	<tr>
	  <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
	  <td><?php echo $row['year_data']?></td>
	  <td><?php echo $row['province']?></td>
	  <td><?php echo $row['age']?></td>
	  <td class="txtright"><?php echo number_format($row['health_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['health_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['health_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['health_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['noreg_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['civil_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['other_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['right_sum'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_men'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_women'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_none'])?></td>
	  <td class="txtright"><?php echo number_format($row['problem_sum'])?></td>
	  <!-- <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('danger/form/'.$row['id']); ?>'" />
            <a href="danger/delete/<?php echo $row['id']?>"><input type="button" title="ลบรายการนี้" value=" " class="btn_delete vtip"/></a>
        </td>
        <?php endif; ?> -->
	</tr>
<?php endforeach;?>
</table>

<?=$pagination; ?>