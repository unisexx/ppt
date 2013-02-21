<h3>ตั้งค่า ผู้ใช้งาน</h3>
<div id="btnBox"><input type="button" value="เพิ่มรายการ" onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/></div>

<div id="paging" class="paginationEMP">
<span class="nextprev">&laquo;previous</span>
<span class="current">1</span>
<span><a href="javascript:;">2</a></span>
<span><a href="javascript:;">3</a></span>
<span><a href="javascript:;">4</a></span>
<span><a href="javascript:;">next&raquo;</a></span>        
</div>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อ - สกุล</th>
  <th align="left">หน่วยงาน / กลุ่มงาน</th>
  <th align="left">อีเมล์</th>
  <th align="left">ประเภทผู้ใช้งาน</th>
  <th align="left">ลบ</th>
  </tr>
<tr class="odd cursor" onclick="window.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'">
  <td>1</td>
  <td nowrap="nowrap">นางสาวกานคณิต ปัญญาศิริ</td>
  <td><img src="images/department.png" width="28" height="28" class="vtip" title="ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร (ศทส) <br> กลุ่มการพัฒนาระบบสารสนเทศและการสื่อสาร" /></td>
  <td>karnkanit.p@m-society.go.th</td>
  <td>Super Admin (ศทส.) </td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>2</td>
  <td>นายจำเริญ นิจจรัลกุล</td>
  <td><img src="images/department.png" width="28" height="28" class="vtip" title="ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร (ศทส) &lt;br&gt; กลุ่มการพัฒนาระบบสารสนเทศและการสื่อสาร" /></td>
  <td><span id="toBoxTo">chamroen.n@m-society.go.th</span></td>
  <td>Super Admin (ศทส.) </td>
  <td><input type="submit" name="button2" id="button2" value="x" class="btn_delete" /></td>
  </tr>
<tr class="odd">
  <td>3</td>
  <td>นางสาวปราณี เส้งสีแดง</td>
  <td><img src="images/department.png" width="28" height="28" class="vtip" title="ศูนย์เทคโนโลยีสารสนเทศและการสื่อสาร (ศทส) &lt;br&gt; กลุ่มการพัฒนาระบบสารสนเทศและการสื่อสาร" /></td>
  <td>pranee.s@m-society.go.th</td>
  <td>Admin (ศทส.)</td>
  <td><input type="submit" name="button3" id="button3" value="x" class="btn_delete" /></td>
  </tr>
<tr>
  <td>4</td>
  <td>นางสาวชูจิตต์   กอบโกย</td>
  <td><img src="images/department.png" width="28" height="28" class="vtip" title="สำนักนโยบายและยุทธศาสตร์ (สนย.) &lt;br&gt; กลุ่มงบประมาณ" /></td>
  <td>jit_pig@hotmail.com</td>
  <td>Admin (คำของบประมาณ)</td>
  <td><input type="submit" name="button4" id="button4" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>5</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>Admin (งานการคลัง)</td>
  <td><input type="submit" name="button5" id="button5" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>6</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td class="odd">Admin (ติดตามและประเมินผล)</td>
  <td><input type="submit" name="button6" id="button6" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>7</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>Admin (ตรวจสอบราชการ)</td>
  <td><input type="submit" name="button8" id="button8" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>8</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td><span id="result_box" lang="en" xml:lang="en"><span title="คลิกเพื่อดูคำแปลอื่น"><span id="result_box2" lang="en" xml:lang="en"><span title="คลิกเพื่อดูคำแปลอื่น">Director</span></span> (คำของบประมาณ)</span></span></td>
  <td><input type="submit" name="button7" id="button7" value="x" class="btn_delete" /></td>
</tr>
<tr class="odd">
  <td>9</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>User (คำของบประมาณ)</td>
  <td><input type="submit" name="button9" id="button9" value="x" class="btn_delete" /></td>
</tr>
<tr>
  <td>10</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>User (ติดตามและประเมินผล)</td>
  <td><input type="submit" name="button9" id="button10" value="x" class="btn_delete" /></td>
</tr>
</table>

<div id="paging" class="paginationEMP">
<span class="nextprev">&laquo;previous</span>
<span class="current">1</span>
<span><a href="javascript:;">2</a></span>
<span><a href="javascript:;">3</a></span>
<span><a href="javascript:;">4</a></span>
<span><a href="javascript:;">next&raquo;</a></span>        
</div>