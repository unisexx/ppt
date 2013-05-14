<h2>ประชากร</h2>
<form method="get" action="setting/people">
<div id="search">
  <div id="searchBox">
  	ชื่อ - สกุล <input type="text" name="name" value="<?php echo @$_GET['name']?>">
  	<select name="age">
  		<option value="">- ช่่วงอายุ -</option>
  		<option value="1" <?php echo (@$_GET['age']==1)?'selected':'';?>>เด็ก (0 - 18)</option>
  		<option value="2" <?php echo (@$_GET['age']==2)?'selected':'';?>>เยาวชน (18 - 25)</option>
  		<option value="3" <?php echo (@$_GET['age']==3)?'selected':'';?>>วัยทำงาน (25 - 60)</option>
  		<option value="4" <?php echo (@$_GET['age']==4)?'selected':'';?>>ผู้สูงวัย (60 ขึ้นไป)</option>
  	</select>
  <input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>


<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/people/form'" class="btn_add"/></div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th>ชื่อ - สกุล</th>
  <th>อายุ</th>
  <th>เลขบัตรประชาชน</th>
  <th width="60">จัดการ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;?>
<?php foreach($peoples as $people):?>
	<tr>
	  <td><?php echo $i?></td>
	  <td><?php echo $people['name']?></td>
	  <td><?php echo getAgefromThaidate($people['birth'])?></td>
	  <td><?php echo $people['id_card']?></td>
	  <td>
		<input type="submit" name="button9" id="button9" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='setting/people/form/<?php echo $people['id']?>'" />
		<a class="btn_delete vtip" title="ลบรายการนี้" href="setting/people/delete/<?php echo $people['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')">ลบ</a>
	  </td>
	</tr>
<?php $i++;?>
<?php endforeach;?>
</table>

<?php echo $pagination;?>