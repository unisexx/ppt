<?php echo menu::source($menu_id); ?>
<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<form method="post" enctype="multipart/form-data" action="population/sixtyup_save">
<?php endif; ?>
<table class="tbadd">
<tr>
  <th>ปี <span class="Txt_red_12">*</span></th>
  <td>
  	<?php echo form_dropdown('year_data', get_year_option(), @$item['year_data'], null, '-- เลือกปี --'); ?>    
	</td>
</tr>
<tr>
  <th>จังหวัด &gt; เขต/อำเภอ &gt; แขวง/ตำบล<span class="Txt_red_12">  *</span></th>
  <td>
    <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$item['province_id'], null, '-- เลือกหจังหวัด --'); ?>
    <?php echo form_dropdown('amphur_id', (empty($item['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$item['province_id'].' order by amphur_name'), @$item['amphur_id'], null, '-- เลือกอำเภอ --'); ?>
    <?php echo form_dropdown('district_id', (empty($item['amphur_id'])) ? array() : get_option('id', 'district_name', 'district', 'amphur_id = '.$item['amphur_id'].' order by district_name'), @$item['district_id'], null, '-- เลือกตำบล --'); ?>
    </td>
</tr>
<tr>
  <th>ประชากรชายอายุ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?
  	for($i=62;$i<=102;$i++):
			switch($i){
			case 1:
				$label = '&lt;1';
				break;
			case 102:
				$label = '>100';
				break;
			default:
				$label = $i-1;
				break;
			}
			$nunit = $this->db->getone("SELECT NUNIT FROM POPULATION_DETAIL WHERE AGE_RANGE_CODE=".$i." AND PID=".$item['id']);
	?>
  	<span class="padd2"><label><?=$label;?></label><input name="male_<?=$i;?>" type="text" id="textarea14" value="<?=$nunit;?>"  style="width:40px;" />  ราย</span>
  	<? endfor;?>
  	<!--
    <span class="padd2"><label>1 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span> 
    <span class="padd2"><label>2 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>3 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>4 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>5 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>6 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>7 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>8 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>9 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>10 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>11 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>12 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>13 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>14 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>15 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>16 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>17 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>18 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>19 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>20 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>21 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>22 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>23 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>24 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>25 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>26 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>27 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>28 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>29 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>30 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>31 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>32 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>33 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>34 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>35 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>36 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>37 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>38 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>39 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>40 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>41 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>42 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>43 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>44 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>45 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>46 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>47 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>48 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>49 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>50 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>51 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>52 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>53 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>54 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>55 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>56 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>57 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>58 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>59 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>60 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>61 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>62 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>63 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>64 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>65 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>66 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>67 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>68 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>69 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>70 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>71 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>72 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>73 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>74 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>75 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>76 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>77 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>78 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>79 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>80 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>81 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>82 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>83 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>84 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>85 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>86 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>87 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>88 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>89 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>90 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>91 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>92 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>93 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>94 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>95 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>96 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>97 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>98 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>99 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>100 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>>100 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
   -->
    </td>
</tr>
<tr>
  <th>ประชากรหญิงอายุ<span class="Txt_red_12"> *</span></th>
  <td>
  	<?
  	for($i=62;$i<=102;$i++):
			switch($i){
			case 1:
				$label = '&lt;1';
				break;
			case 102:
				$label = '>100';
				break;
			default:
				$label = $i-1;
				break;
			}
			$nunit = $this->db->getone("SELECT NUNIT FROM POPULATION_DETAIL WHERE AGE_RANGE_CODE=".($i+102)." AND PID=".$item['id']);
	?>
  	<span class="padd2"><label><?=$label;?></label><input name="female_<?=$i;?>" type="text" id="textarea14" value="<?=$nunit;?>"  style="width:40px;" />  ราย</span>
  	<? endfor;?>
  	<!--
  	<span class="padd2"><label>&lt;1ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span> 
    <span class="padd2"><label>1 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span> 
    <span class="padd2"><label>2 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>3 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>4 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>5 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>6 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>7 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>8 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>9 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>10 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>11 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>12 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>13 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>14 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>15 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>16 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>17 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>18 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>19 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>20 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>21 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>22 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>23 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>24 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>25 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>26 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>27 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>28 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>29 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>30 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>31 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>32 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>33 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>34 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>35 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>36 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>37 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>38 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>39 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>40 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>41 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>42 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>43 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>44 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>45 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>46 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>47 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>48 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>49 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>50 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>51 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>52 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>53 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>54 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>55 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>56 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>57 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>58 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>59 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>60 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>61 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>62 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>63 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>64 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>65 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>66 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>67 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>68 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>69 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>70 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>71 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>72 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>73 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>74 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>75 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>76 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>77 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>78 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>79 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>80 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>81 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>82 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>83 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>84 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>85 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>86 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>87 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>88 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>89 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>90 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>91 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>92 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>93 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>94 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>95 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>96 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>97 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>98 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>99 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>100 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
    <span class="padd2"><label>>100 ปี </label><input name="textarea10" type="text" id="textarea14" value=""  style="width:30px;" />  ราย</span>
   -->
    </td>
</tr>
<tr>
  <th>ประชากรชายเกิดปีจันทรคติ <span class="Txt_red_12">*</span></th>
  <td><input name="lunar_cal_male" type="text" id="textarea5" value="<?=$item['lunar_cal_male'];?>" /> 
    ราย</td>
</tr>
<tr>
  <th>ประชากรหญิงเกิดปีจันทรคติ<span class="Txt_red_12"> *</span></th>
  <td><input name="lunar_cal_female" type="text" id="textarea5" value="<?=$item['lunar_cal_female'];?>" />
    ราย</td>
</tr>
<tr>
  <th>ชายที่มีชื่ออยู่ในทะเบียนบ้านกลาง <span class="Txt_red_12">*</span></th>
  <td><input name="central_hh_male" type="text" id="textarea6" value="<?=$item['central_hh_male'];?>" />
    ราย</td>
</tr>
<tr>
  <th>หญิงที่มีชื่ออยู่ในทะเบียนบ้านกลาง <span class="Txt_red_12">*</span></th>
  <td><input name="central_hh_female" type="text" id="textarea8" value="<?=$item['central_hh_female'];?>" />
    ราย</td>
</tr>
<tr>
  <th>ชายที่มิใช่สัญชาติไทย <span class="Txt_red_12">*</span></th>
  <td><input name="no_thai_male" type="text" id="textarea12" value="<?=$item['no_thai_male'];?>" />
ราย</td>
</tr>
<tr>
  <th>หญิงที่มิใช่สัญชาติไทย <span class="Txt_red_12">*</span></th>
  <td><input name="no_thai_female" type="text" id="textarea7" value="<?=$item['no_thai_female'];?>" />
ราย</td>
</tr>
<tr>
  <th>ชายที่อยู่ระหว่างการย้าย <span class="Txt_red_12">*</span></th>
  <td><input name="in_trans_male" type="text" id="textarea10" value="<?=$item['in_trans_male'];?>" />
ราย</td>
</tr>
<tr>
  <th>หญิงที่อยู่ระหว่างการย้าย <span class="Txt_red_12">*</span></th>
  <td><input name="in_trans_female" type="text" id="textarea13" value="<?=$item['in_trans_female'];?>" />
ราย</td>
</tr>
<tr>
  <th>ประชากรชายทั้งหมด <span class="Txt_red_12">*</span></th>
  <td><input name="sum_male" type="text" id="textarea9" value="<?=$item['sum_male'];?>" />
ราย</td>
</tr>
<tr>
  <th>ประชากรหญิงทั้งหมด <span class="Txt_red_12">*</span></th>
  <td><input name="sum_female" type="text" id="textarea11" value="<?=$item['sum_female'];?>" />
ราย</td>
</tr>
</table>

<?php if(menu::perm($menu_id, 'add') or menu::perm($menu_id, 'edit')): ?>
<div id="btnSave">
    <?php echo form_hidden('id', $item['id']); ?>
    <input type="submit" value="บันทึก" class="btn btn-danger">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
</form>
<?php else: ?>
<div id="btnSave">
    <input type="button" title="ย้อนกลับ"  value="ย้อนกลับ" class="btn" />
</div>
<?php endif; ?>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: 'location/ajax_amphur/report',value: 'id',label: 'text'});
        $('[name=district_id]').chainedSelect({parent: '[name=amphur_id]',url: 'location/ajax_district/report',value: 'id',label: 'text'});
    });
</script>