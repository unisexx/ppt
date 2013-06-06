<?php if(!empty($_GET['export'])): ?>
	<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
		<head>
			<base href="<?php echo site_url(); ?>" />
			<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
			<link rel="stylesheet" type="text/css" href="media/bootstrap/css/bootstrap.min.css"/>
			<link rel="stylesheet" type="text/css" href="media/bootstrap/css/bootstrap-responsive.min.css"/>
			<link rel="stylesheet" type="text/css" href="themes/ppt/css/template.css"/>
			<link rel="stylesheet" type="text/css" href="themes/ppt/css/skins/red.css" />
		</head>
		<body>
<?php endif; ?>

<h3>รายงาน <?php echo $report_title ?></h3>
<?php if(empty($_GET['export'])): ?>
<div id="search">
  <div id="searchBox">
     <form method="get">
     <?php echo form_dropdown('year', get_year_option(null, null, 'form_all', 'year'), @$_GET['year'], null, '-- ทุกปี --'); ?>
     <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
     <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
     <?php echo form_dropdown('opt', array(), @$_GET['opt'], null, '-- ทุกตำบล --'); ?>
     <input type="submit" title="ค้นหา" value=" " class="btn_search" />
     </form>
  </div>
</div>
<?php endif; ?>

<div id="resultsearch"><b>ผลที่ค้นหา :</b>  สภาพ<?php echo $report_title; ?> ปี 
<label><?php echo empty($_GET['year']) ? 'ทุกปี' : $_GET['year'] ?></label> 
จังหวัด <label><?php echo empty($_GET['province_id']) ? 'ทุกจังหวัด' : get_one('province', 'provinces', $_GET['province_id']); ?></label> 
อำเภอ <label><?php echo empty($_GET['amphur_id']) ? 'ทุกอำเภอ' : get_one('amphur_name', 'amphur', $_GET['amphur_id']); ?></label> 
ตำบล <label><?php echo empty($_GET['opt']) ? 'ทุกตำบล' : $_GET['opt']; ?></label></div>

<?php if(empty($_GET['export'])): ?>
<div id="tool-info" style="padding:10px; text-align:right;">
	<a href="<?php echo curPageURL(TRUE).'export=excel'; ?>">
		<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
	</a>
	<a href="javascript:print();">
		<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">
	</a>หน่วย:ราย
</div>
<?php endif; ?>

<table class="tbreport">
<tr>
<th rowspan="2">สภาพ<?php echo $report_title; ?></th>
<th colspan="3">จำนวน (ราย)</th>
</tr>
<tr>
<td class="text-right">ชาย</td>
<td class="text-right">หญิง</td>
<td class="text-right">รวม</td>
</tr>
<tr>
  <td class="topic">เด็กที่ไม่สามารถเข้าศึกษาต่อตามภาคบังคับได้</td>
  <td class="text-right"><?php echo @nformat($rs['total331_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total331_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total331_s']); ?></td>
  </tr>
  <tr>
  <td class="topic">เด็กที่ออกเรียนกลางคันในภาคการศึกษาบังคับ</td>
  <td class="text-right"><?php echo @nformat($rs['total332_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total332_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total332_s']); ?></td>
  </tr>
  <tr>
  <td class="topic">เยาวชนที่จบการศึกษาระดับปริญญาตรี/การศึกษาสายอาชีพ แล้วไม่มีงานทำ ในรอบ 1 ปี ที่จบการศึกษา</td>
  <td class="text-right"><?php echo @nformat($rs['total333_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total333_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total333_s']); ?></td>
  </tr>
  <tr>
  <td class="topic">คนที่จบการศึกษาชั้นประถม แต่ไม่สามารถอ่านออกเขียนได้</td>
  <td class="text-right"><?php echo @nformat($rs['total334_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total334_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total334_s']); ?></td>
  </tr>
</table>

<div id="ref">ที่มา :</div>

<?php if(!empty($_GET['export'])): ?>
</body>
</html>
<?php else: ?>
	<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: '<?php echo site_url(); ?>location/ajax_amphur/report',value: 'id',label: 'text'})
        .change(function(){
        	$('[name=opt]').attr('readonly', true);
			$.get('<?php echo site_url('location/ajax_opt/report'); ?>', {
				province_id:$('[name=province_id]').val(),
				amphur_id:$('[name=amphur_id]').val(), 
				opt:"<?php echo empty($_GET['opt']) ? 0 : $_GET['opt']; ?>"
			}, function(data){
				$('[name=opt]').html(data).removeAttr('readonly');
			});
        });
        
    });
</script>
<?php endif; ?>
