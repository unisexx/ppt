<?php echo menu::source($menu_id); ?>
<form method="post" enctype="multipart/form-data" action="volunteer_inter/birth_import">
<div id="search">
  <div id="searchBox">  	
    <?php echo form_dropdown('year_data', get_year_option(MIN_YEAR_LIST), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <input type="file" name="fl_import" >
    <? if(menu::perm($menu_id, 'add')): ?>
  <input type="submit" name="button9" id="button9" title="นำเข้าข้อมูล" value=" " class="btn_import" />
  	<? endif;?>
  </div>
</div>
</form>