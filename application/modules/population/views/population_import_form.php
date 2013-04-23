<h2>ข้อมูลพื้นฐาน - ข้อมูลทั่วไป</h2>
<h4>ประชากร (คน) <span class="gray">แบบ กรมการปกครอง ประชากร</span></h4>
<div id="search">
  <div id="searchBox">  	
    <select name="year_data" id="year_data">
      <option value="">-- เลือกปี --</option>
      <? for($i=-1;$i<=100;$i++){?>
      <option value="<?=$year_data_value;?>"><?=$year_data_value;?></option>
      <? } ?>      
    </select>
    <? echo form_dropdown('province_id',get_option('id','province','provinces'),'','','--เลือกจังหวัด--');?>
    <input type="file" name="fl_import" >
  <input type="submit" name="button9" id="button9" title="นำเข้าข้อมูล" value=" " class="btn_import" /></div>
</div>