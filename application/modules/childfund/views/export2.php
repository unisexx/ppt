<h3>รายงาน องค์กรที่ได้รับการสนับสนุนจากกองทุนคุ้มครองเด็ก จำแนกรายจังหวัด ปีงบประมาณ <?php echo $this->uri->segment(3,0)?></h3>

<table class="tbreport" border="1">
<tr>
  <th rowspan="3" class="txtcen" style="border: 1px solid #ccc;">ที่</th>
  <th rowspan="3" class="txtcen" style="border: 1px solid #ccc;">จังหวัด</th>
  <th colspan="12" class="txtcen" style="border: 1px solid #ccc;">ประเภทการสนับสนุน</th>
  <th colspan="12" class="txtcen" style="border: 1px solid #ccc;">งบประมาณที่สนับสนุน (บาท)</th>
  </tr>
<tr>
  <td colspan="5" class="txtcen">โครงการ</td>
  <td colspan="3" class="txtcen">องค์กร</td>
  <td colspan="4" class="txtcen">เด็ก</td>
  <td colspan="5" class="txtcen">โครงการ</td>
  <td colspan="3" class="txtcen">องค์กร</td>
  <td colspan="4" class="txtcen">เด็ก</td>
  </tr>
<tr>
  <td class="txtcen">1</td>
  <td class="txtcen">2</td>
  <td class="txtcen">3</td>
  <td class="txtcen">4</td>
  <td class="txtcen">5</td>
  <td class="txtcen">1</td>
  <td class="txtcen">2</td>
  <td class="txtcen">3</td>
  <td class="txtcen">1</td>
  <td class="txtcen">2</td>
  <td class="txtcen">3</td>
  <td class="txtcen">4</td>
  <td class="txtcen">1</td>
  <td class="txtcen">2</td>
  <td class="txtcen">3</td>
  <td class="txtcen">4</td>
  <td class="txtcen">5</td>
  <td class="txtcen">1</td>
  <td class="txtcen">2</td>
  <td class="txtcen">3</td>
  <td class="txtcen">1</td>
  <td class="txtcen">2</td>
  <td class="txtcen">3</td>
  <td class="txtcen">4</td>
</tr>
<?php foreach($childfunds as $key=>$row):?>
  <tr>
  <td><?php echo $key+1?></td>
  <td><?php echo $row['pv']?></td>
  <td><?php echo number_format($row['typemain1'])?></td>
  <td><?php echo number_format($row['typemain2'])?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><?php echo number_format($row['under_type1'])?></td>
  <td><?php echo number_format($row['under_type3'])?></td>
  <td><?php echo number_format($row['under_type2'])?></td>
  <td><?php echo number_format($row['typechild2'])?></td>
  <td><?php echo number_format($row['typechild1'])?></td>
  <td><?php echo number_format($row['typechild4'])?></td>
  <td>&nbsp;</td>
  <td><?php echo number_format($row['sum_typemain1'])?></td>
  <td><?php echo number_format($row['sum_typemain2'])?></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><?php echo number_format($row['sum_under_type1'])?></td>
  <td><?php echo number_format($row['sum_under_type2'])?></td>
  <td><?php echo number_format($row['sum_under_type3'])?></td>
  <td><?php echo number_format($row['sum_typechild2'])?></td>
  <td><?php echo number_format($row['sum_typechild1'])?></td>
  <td><?php echo number_format($row['sum_typechild4'])?></td>
  <td>&nbsp;</td>
  </tr>
<?php endforeach;?>
</table>

<div id="ref">ที่มา :  สป.พม. : ฐานข้อมูลระบบงานกองทุนคุ้มครองเด็ก</div>

<div id="remark">
<div style="margin-bottom:10px">หมายเหตุ :  </div>
<div style="float:left; padding-right:20px; text-decoration:underline;">ประเภทการสนับสนุน : โครงการ</div>
<div style="float:left;">
1 หมายถึง "การสงเคราะห์"<br />
2 หมายถึง "การคุ้มครองสวัสดิภาพ" <br />
3 หมายถึง "การสนับสนุนสถานรับเลี้ยงเด็ก" <br />
4 หมายถึง "การส่งเสริมความประพฤตินักเรียน/นักศึกษา" <br />
5 หมายถึง "การใช้จ่ายเงินตามคำสั่งศาล"
</div>
<div style="float:left; padding-right:20px; text-decoration:underline;">องค์กร</div>
<div style="float:left;">
1 หมายถึง "ภาครัฐ"<br />
2 หมายถึง "องค์กรสวัสดิการชุมชน" <br />
3 หมายถึง "องค์กรสาธารณประโยชน์"
</div>

<div style="clear:both; padding-top:20px;">
<div style="float:left; padding-right:20px; text-decoration:underline;">เด็ก</div>
<div style="float:left;">
1 หมายถึง "เด็กในชุมชน"<br />
2 หมายถึง "เด็กในโรงเรีงเรียน" <br />
3 หมายถึง "เด็กในสถานรับเลี้ยงเด็ก สถานแรกรับ สถายสงเคราะห์ สถานคุ้มครองสวัสดิภาพและสถานพัฒนาและฟื้นฟู" <br />
4 หมายถึง "การส่งเสริมความประพฤตินักเรียน/นักศึกษา"
</div>
</div>

</div>
