<h2>ข้อมูลกลุ่มเป้าหมาย - เด็กและเยาวชน</h2>
<h4>เด็กและเยาวชนที่มีพฤติกรรมไม่เหมาะสมและพบเห็นได้ในที่สาธารณะ <span class="gray">แบบ อปท.1 (2)</span> </h4>
<div id="search">
  <div id="searchBox">หมายเลข/หัวหน้าสำนักปลัด
    <input type="text" name="textfield" id="textfield" style="width:240px;" />
    <select name="select6" id="select6">
      <option>-- ทุกปี --</option>
      <option>2556</option>
      <option>2555</option>
      <option>2554</option>
    </select>
    <select name="select" id="select">
      <option>-- ทุกจังหวัด --</option>
    </select>
    <select name="select2" id="select2">
      <option>-- ทุกอำเภอ --</option>
    </select>
    <select name="select3" id="select3">
      <option>-- ทุก อปท. --</option>
    </select>
    <select name="select4" id="select4">
      <option>-- ทุกขนาด --</option>
    </select>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="btnBox"><input type="button" title="นำเข้าข้อมูล"  value=" " onclick="document.location='people.php?act=import'" class="btn_import"/><input type="button" title="เพิ่มรายการ"  value=" " onclick="document.location='child/unsuitable_form'" class="btn_add"/></div>

<?php echo $pagination; ?>
<table class="tblist">
    <tr>
        <th>ลำดับ</th>
        <th>ปี</th>
        <th width="90"><span class="vtip" title="ดื่มเครื่องดื่มที่มีแอลกอฮอล์  สูบบุหรี่ และติดสารเสพติดร้ายแรง เช่น ยาบ้า ยาอี สารระเหย กัญชา เป็นต้น">ดื่มเครื่องดื่ม..</span></th>
        <th width="78"><span class="vtip" title="มั่วสุมและทำความรำคาญให้กับชาวบ้าน">มั่วสุมและ..</span></th>
        <th width="100"><span class="vtip" title="ติดเกมส์ และเล่นการพนันต่าง ๆ">ติดเกมส์ และ...</span></th>
        <th width="87"><span class="vtip" title="มีพฤติกรรมทางเพศ">มีพฤติกรรม..</span></th>
        <th width="60">อื่นๆ ระบุ</th>
        <th width="60">หมายเลข</th>
        <th>อปท.</th>
        <th>อำเภอ / จังหวัด</th>
        <th>ขนาด</th>
        <th>หัวหน้าสำนักปลัด</th>
        <th>จัดการ</th>
    </tr>
    <?php foreach($result as $key => $item): $key += 1;?>
    <tr>
        <td><?php echo (empty($_GET['page'])) ? $key : $key + (($_GET['page']-1)*20); ?></td>
        <td><?php echo $item['year']; ?></td>
        <td class="text-right"><?php echo number_format($item['total_1']); ?></td>
        <td class="text-right"><?php echo number_format($item['total_2']); ?></td>
        <td class="text-right"><?php echo number_format($item['total_3']); ?></td>
        <td class="text-right"><?php echo number_format($item['total_4']); ?></td>
        <td class="text-right"><?php echo number_format($item['total_5']); ?></td>
        <td class="text-right"><?php echo $item['number_id']; ?></td>
        <td><?php echo $item['opt_name']; ?></td>
        <td><?php echo $item['amphor'].'/'.$item['province']; ?></td>
        <td><?php echo $item['size']; ?></td>
        <td><?php echo $item['c_title'].$item['c_name']; ?></td>
        <td>
            <input type="submit" title="แก้ไขรายการนี้" value=" " class="btn_edit vtip"  onclick="window.location='<?php echo site_url('child/unsuitable_form/'.$item['id']); ?>'" />
            <input type="submit" title="ลบรายการนี้" value=" " class="btn_delete vtip" />
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php echo $pagination; ?>