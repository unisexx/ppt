<h2>ตั้งค่าข้อมูลหลัก > ข้อมูลพื้นฐานและกลุ่มเป้าหมาย</h2>
<div id="search">
  <div id="searchBox">
    <select name="select2" id="select2">
      <option selected="selected">-- ไม่ระบุ --</option>
      <option>ข้อมูลพื้นฐาน</option>
      <option>ข้อมูลกลุ่มเป้าหมาย</option>
    </select>
    <select name="select6" id="select6">
      <option>-- ทุกกลุ่มเป้าหมาย --</option>
      <option>เด็กและเยาวชน </option>
      <option>สตรี </option>
      <option>ครอบครัว </option>
      <option>ผู้ด้อยโอกาส </option>
    </select>
    <select name="select" id="select">
      <option>-- ทุกประเด็นหลัก --</option>
    </select>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='setting/set_target_form'" class="btn_add"/></div>


<div class="clear"></div>
<ul id="browser" class="filetree">
	<?php 
		$set_targets = $this->set_target->where('parent_id = 0')->get(false,true);
		foreach($set_targets as $set_target):
	?>
		<li><img src="themes/ppt/images/treeview/museum.png" /> <?php echo $set_target['name']?> <span><a href="setting/set_target_form/<?php echo $set_target['id']?>"><img src="themes/ppt/images/ico_edit.png" width="16" height="16" /></a> <a href="setting/set_target_delete/<?php echo $set_target['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><img src="themes/ppt/images/ico_delete.png" width="16" height="16" /></a></span>
			<ul>
				<?php 
					$sub_targets = $this->set_target->where('parent_id = '.$set_target['id'])->get(false,true);
					foreach($sub_targets as $sub_target):
				?>
					<li><img src="themes/ppt/images/treeview/folder.gif" /> <?php echo $sub_target['name']?> <span><a href="setting/set_target_form/<?php echo $sub_target['id']?>"><img src="themes/ppt/images/ico_edit.png" width="16" height="16" /></a> <a href="setting/set_target_delete/<?php echo $sub_target['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><img src="themes/ppt/images/ico_delete.png" width="16" height="16" /></a></span>
						<ul>
							<?php 
								$sub_targets2 = $this->set_target->where('parent_id = '.$sub_target['id'])->get(false,true);
								foreach($sub_targets2 as $sub_target2):
							?>
								<li><img src="themes/ppt/images/treeview/file.gif" /> <?php echo $sub_target2['name']?> <span><a href="setting/set_target_form/<?php echo $sub_target2['id']?>"><img src="themes/ppt/images/ico_edit.png" width="16" height="16" /></a> <a href="setting/set_target_delete/<?php echo $sub_target2['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><img src="themes/ppt/images/ico_delete.png" width="16" height="16" /></a></span></li>
							<?php endforeach;?>
						</ul>
					</li>
				<?php endforeach;?>
			</ul>
		</li>
	<?php endforeach;?>
</ul>