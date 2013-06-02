<h3>รายงาน ปัญหาเด็กและเยาวชนในท้องถิ่น</h3>
<div id="search">
  <div id="searchBox">
     <form method="get">
     <?php echo form_dropdown('year', get_year_option(null, null, 'form_all', 'year'), @$_GET['year'], null, '-- ทุกปี --'); ?>
     <?php echo form_dropdown('province_id', get_option('id', 'province', 'provinces', '1=1 order by province'), @$_GET['province_id'], null, '-- ทุกจังหวัด --'); ?>
     <?php echo form_dropdown('amphur_id', (empty($_GET['province_id'])) ? array() : get_option('id', 'amphur_name', 'amphur', 'province_id = '.$_GET['province_id'].' order by amphur_name'), @$_GET['amphur_id'], null, '-- ทุกอำเภอ --'); ?>
     <?php echo form_dropdown('opt', array(), @$_GET['opt'], null, '--ทุกตำบล--'); ?>
     <input type="submit" title="ค้นหา" value=" " class="btn_search" />
     </form>
  </div>
</div>

<div id="resultsearch"><b>ผลที่ค้นหา :</b>  สภาพปัญหาเด็กและเยาวชนในท้องถิ่น ปี 
<label>ทุกปี</label> จังหวัด <label>ทุกจังหวัด</label> อำเภอ <label>ทุกอำเภอ</label> ตำบล <label>ทุกตำบล</label></div>
<div style="padding:10px; text-align:right;">
<img src="themes/ppt/images/excel.png" width="32" height="32" style="margin-bottom:-6px" class="vtip" title="ส่งออกข้อมูล">
<img src="themes/ppt/images/print.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="พิมพ์ข้อมูล">หน่วย:ราย</div>
<table class="tbreport">
<tr>
<th rowspan="2">สภาพปัญหาเด็กและเยาวชน</th>
<th colspan="3">จำนวน (ราย)</th>
</tr>
<tr>
<td class="text-right">ชาย</td>
<td class="text-right">หญิง</td>
<td class="text-right">รวม</td>
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

<div id="ref">ที่มา :</div>

<script>
    $(function(){
        $('[name=amphur_id]').chainedSelect({parent: '[name=province_id]',url: '<?php echo site_url(); ?>location/ajax_amphur/report',value: 'id',label: 'text'})
        .change(function(){
			$.get('<?php echo site_url('location/ajax_opt/report'); ?>', {province_id:$('[name=province_id]').val(),amphur_id:$('[name=amphur_id]').val(), opt:"<?php echo empty($_GET['opt']) ? 0 : $_GET['opt']; ?>"}, function(data){
				$('[name=opt]').html(data);
			});
        });
        
    });
</script>