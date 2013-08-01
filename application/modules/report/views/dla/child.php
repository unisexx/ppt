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
     <?php echo form_dropdown('year', get_year_option(null, null, 'form_all', 'year'), @$_GET['year'], null); ?>
     <?php echo form_dropdown('area_id', get_option('id', 'area_name', 'area'), @$_GET['area_id'], null, '-- ทุกเขตตรวจราชการ --'); ?>
     <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
     <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
     <?php echo form_dropdown('opt', array(), @$_GET['opt'], null, '-- ทุกตำบล --'); ?>
     <input type="submit" title="ค้นหา" value=" " class="btn_search" />
     </form>
  </div>
</div>
<?php endif; ?>

<div id="resultsearch"><b>ผลที่ค้นหา :</b>  สภาพ<?php echo $report_title; ?> ปี 
<label><?php echo empty($_GET['year']) ? '2555' : $_GET['year'] ?></label> 
เขตตรวจราชการ <label><?php echo empty($_GET['area_id']) ? 'ทุกเขตตรวจราชการ' : get_one('area_name', 'area', $_GET['area_id']); ?></label> 
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
	</a> หน่วย : ราย
</div>
<?php endif; ?>

<table class="tbreport">
<tr>
<th rowspan="2" class="txtcen">สภาพ<?php echo $report_title; ?></th>
<th colspan="3" class="txtcen">จำนวน (ราย)</th>
</tr>
<tr>
<td class="txtcen">ชาย</td>
<td class="txtcen">หญิง</td>
<td class="txtcen">รวม</td>
</tr>
<tr>
  <td class="topic">เด็กขาดอุปการะ  (เช็คหัวข้อ 4.1.1 รายการหายไป)</td>
  <td class="text-right"><?php echo @nformat($rs['total411_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total411_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total411_s']); ?></td>
  </tr>
<tr>
  <td class="topic">เด็กถูกทอดทิ้ง</td>
  <td class="text-right"><?php echo @nformat($rs['total412_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total412_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total412_s']); ?></td>
  </tr>
<tr>
  <td class="topic">เด็กไม่ได้รับการเตรียมความพร้อมก่อนวัยเรียน</td>
  <td class="text-right"><?php echo @nformat($rs['total413_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total413_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total413_s']); ?></td>
  </tr>
<tr>
  <td class="topic">เด็กกำพร้า</td>
  <td class="text-right"><?php echo @nformat($rs['total414_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total414_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total414_s']); ?></td>
  </tr>
<tr>
  <td class="topic">เยาวชนในครอบครัวยากจนที่ไม่มีทุนการศึกษาต่อ (เช็คหัวข้อ 4.1.5 รายการหายไป)</td>
  <td class="text-right"><?php echo @nformat($rs['total415_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total415_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total415_s']); ?></td>
</tr>
<tr>
  <td class="topic">เด็กและเยาวชนที่มีพฤติกรรมไม่เหมาะสมและพบเห็นได้ในที่สาธารณะ</td>
  <td colspan="3"></td>
</tr>
<tr>
    <td class="topic">&nbsp;&nbsp;- ดื่มเครื่องดื่มที่มีแอลกอฮอล์ สูบบุหรี่ และติดสารเสพติดร้ายแรง เช่น ยาบ้า ยาอี สารระเหย กัญญชา เป็นต้น</td>
    <td class="text-right"><?php echo @nformat($rs['total4161_m']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4161_f']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4161_s']); ?></td>
</tr>
<tr>
    <td class="topic">&nbsp;&nbsp;- มั่วสุมและทำความรำคาญให้ชาวบ้าน</td>
    <td class="text-right"><?php echo @nformat($rs['total4162_m']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4162_f']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4162_s']); ?></td>
</tr>
<tr>
    <td class="topic">&nbsp;&nbsp;- ติดเกม และเล่นการพนันต่างๆ</td>
    <td class="text-right"><?php echo @nformat($rs['total4163_m']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4163_f']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4163_s']); ?></td>
</tr>
<tr>
    <td class="topic">&nbsp;&nbsp;- มีพฤติกรรมทางเพศ</td>
    <td class="text-right"><?php echo @nformat($rs['total4164_m']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4164_f']); ?></td>
    <td class="text-right"><?php echo @nformat($rs['total4164_s']); ?></td>
</tr>
<tr>
  <td class="topic">เด็กและเยาวชนเร่รอน ขอทาน</td>
  <td class="text-right"><?php echo @nformat($rs['total417_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total417_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total417_s']); ?></td>
</tr>
<tr>
  <td class="topic">เด็กและเยาวชนที่ไม่มีชื่อในทะเบียนบ้าน (เช็คหัวข้อ 4.1.8 รายการหายไป)</td>
  <td class="text-right"><?php echo @nformat($rs['total418_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total418_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total418_s']); ?></td>
</tr>
<tr>
  <td class="topic">เด็กและเยาวชนที่เลี้ยงดูบุตรตามลำพัง</td>
  <td class="text-right"><?php echo @nformat($rs['total419_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total419_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total419_s']); ?></td>
</tr>
<tr>
  <td class="topic">เด็กและเยาวชนต่างด้าว</td>
  <td class="text-right"><?php echo @nformat($rs['total4110_m']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total4110_f']); ?></td>
  <td class="text-right"><?php echo @nformat($rs['total4110_s']); ?></td>
  </tr>
</table>

<div id="ref">ที่มา : สำนักตรวจและประเมินผล สำนักงานปลัดกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์</div>

<?php if(!empty($_GET['export'])): ?>
</body>
</html>
<?php else: ?>
	<script>
    $(function(){
        $('[name=province_id]').chainedSelect({parent: '[name=area_id]',url: '<?php echo site_url(); ?>location/ajax_province/report',value: 'id',label: 'text'});
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
