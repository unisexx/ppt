<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>ประชากร (คน) <span class="gray">แบบ กรมการปกครอง ประชากร</span></h4>
<form method="post" enctype="multipart/form-data" action="population/population_import">
<div id="search">
  <div id="searchBox">  	
    <?php echo form_dropdown('year_data', get_year_option(2555), @$_GET['year_data'], null, '-- ทุกปี --'); ?>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
    <input type="file" name="fl_import" >
  <input type="submit" name="button9" id="button9" title="นำเข้าข้อมูล" value=" " class="btn_import" /></div>
</div>
</form>