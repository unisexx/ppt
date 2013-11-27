<? $m['id'] = 111; ?>
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
	<input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='danger/form_import'" class="btn_import"/>
	<!-- <input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='danger/form'" class="btn_add"/> -->
</div>
<?php endif; ?>

<?=$pagination; ?>

<table class="tblist">
<tr>
<th rowspan="2" class="txtcen">ลำดับที่</th>
<th rowspan="2" class="txtcen">ปีงบประมาณ</th>
<th rowspan="2" class="txtcen">จังหวัด</th>
<th rowspan="2" class="txtcen" style="word-wrap: break-word;">จำนวนลูกจ้างในข่ายฯ (ณ 31 ธ.ค.ของทุกปี)</th>
<th colspan="5" class="txtcen">ความรุนแรงจากอันตรายที่ประสบ</th>
<th colspan="2" class="txtcen">จำนวนประสบอันตราย</th>
<th colspan="2" class="txtcen">อัตราการประสบอันตรายต่อลูกจ้าง 1,000 ราย</th>
<!--<?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?> <th style='width:120px;'>จัดการ</th> <?php endif; ?>-->
</tr>
<tr>
  <td class="txtcen">ตาย</td>
  <td class="txtcen">ทุพพลภาพ</td>
  <td class="txtcen">สูญเสียอวัยวะบางส่วน</td>
  <td class="txtcen">หยุดงานเกิน 3 วัน</td>
<td class="txtcen">หยุดงานไม่เกิน 3 วัน</td>
<td class="txtcen">นับทุกกรณี</td>
<td class="txtcen">นับกรณีร้ายแรง</td>
<td class="txtcen">นับทุกกรณี</td>
<td class="txtcen">นับกรณีร้ายแรง</td>
<!-- <td></td> -->
</tr>
<?php foreach($dangers as $key=>$row): $key += 1;?>
	<tr>
	  <td><?=(empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
	  <td><?php echo $row['year_data']?></td>
	  <td><?php echo $row['province']?></td>
	  <td class="txtright"><?php echo number_format($row['total'])?></td>
	  <td class="txtright"><?php echo number_format($row['dead'])?></td>
	  <td class="txtright"><?php echo number_format($row['disability'])?></td>
	  <td class="txtright"><?php echo number_format($row['lose'])?></td>
	  <td class="txtright"><?php echo number_format($row['stopmore3'])?></td>
	  <td class="txtright"><?php echo number_format($row['stopless3'])?></td>
	  <td class="txtright"><?php echo number_format($row['all_case'])?></td>
	  <td class="txtright"><?php echo number_format($row['severe_case'])?></td>
	  <td class="txtright"><?php echo number_format($row['rate_all_case'], 2)?></td>
	  <td class="txtright"><?php echo number_format($row['rate_severe_case'], 2)?></td>
	  <!-- <?php if(menu::perm($m['id'], 'edit') && menu::perm($m['id'], 'delete')): ?>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('dangers/form/'.$row['id']); ?>'" />
            <a href="danger/delete/<?php echo $row['id']?>"><input type="button" title="ลบรายการนี้" value=" " class="btn_delete vtip"/></a>
        </td>
        <?php endif; ?> -->
	</tr>
<?php endforeach;?>
</table>

<?=$pagination; ?>