<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="media/js/jquery-1.4.2.min.js" ></script> 
    <script>
        $(function(){
            
               //alert($(this).val());
               var ls = [81,71,46,62,40,22,24,20,18,36,86,92,23,63,26,73,48,30,80,60,12,96,55,38,31,13,77,25,94,14,56,82,93,66,65,83,44,49,95,35,85,21,70,45,16,52,51,33,47,90,91,11,75,74,19,27,17,72,84,32,64,43,39,37,41,53,61,34,15,57,50,76,67,42,54,58];
               var i = 1;
               /*
               $('#prov option').each(function(){
                   $('#ls').append($(this).val()+',');
               })
               */
               /*
               setInterval(function() {
                   //alert(ls[i])
                   $('#g').attr('action', 'http://localhost/ppt/csv/g/'+ls[i]);
                   $('#submit').click();
                   i++;
               }, 5000);
               */
               
            

        });
    </script>
</head>
<body>
<div id="ls"></div>
<form method="get" action="ppt/csv/" id="g">
    <input id="submit" type="submit" value="submit" />
</form>
<form id="tools" name="tools" action="" method="get">
    <table width="100%">
        <colgroup>
            <col width="33%">
            <col width="33%">
            <col width="33%">
        </colgroup>
        <tbody><tr style="vertical-align:top;">
            <td>
                <table class="area_selector">
                    <tbody><tr>
                        <td>ภาค :</td>
                        <td>
                            <select name="div_id" onchange="setvill(0);submit();">
                                <option value="0" selected="selected">ภาพรวมทั้งประเทศ</option>
                                <option value="1">ภาคกลาง</option>
                                <option value="2">ภาคตะวันออกเฉียงเหนือ</option>
                                <option value="3">ภาคเหนือ</option>
                                <option value="4">ภาคใต้</option>
                            </select>
                        </td>
                    </tr>
                    <tr><td>พื้นที่ :</td><td><span id="ajaxlist_province"><select id="prov" onchange="setvill(this.value);submit();"><option value="0">(โปรดเลือก)</option><option value="81">กระบี่</option><option value="71">กาญจนบุรี</option><option value="46">กาฬสินธุ์</option><option value="62">กำแพงเพชร</option><option value="40">ขอนแก่น</option><option value="22">จันทบุรี</option><option value="24">ฉะเชิงเทรา</option><option value="20">ชลบุรี</option><option value="18">ชัยนาท</option><option value="36">ชัยภูมิ</option><option value="86">ชุมพร</option><option value="92">ตรัง</option><option value="23">ตราด</option><option value="63">ตาก</option><option value="26">นครนายก</option><option value="73">นครปฐม</option><option value="48">นครพนม</option><option value="30">นครราชสีมา</option><option value="80">นครศรีธรรมราช</option><option value="60">นครสวรรค์</option><option value="12">นนทบุรี</option><option value="96">นราธิวาส</option><option value="55">น่าน</option><option value="38">บึงกาฬ</option><option value="31">บุรีรัมย์</option><option value="13">ปทุมธานี</option><option value="77">ประจวบคีรีขันธ์</option><option value="25">ปราจีนบุรี</option><option value="94">ปัตตานี</option><option value="14">พระนครศรีอยุธยา</option><option value="56">พะเยา</option><option value="82">พังงา</option><option value="93">พัทลุง</option><option value="66">พิจิตร</option><option value="65">พิษณุโลก</option><option value="83">ภูเก็ต</option><option value="44">มหาสารคาม</option><option value="49">มุกดาหาร</option><option value="95">ยะลา</option><option value="35">ยโสธร</option><option value="85">ระนอง</option><option value="21">ระยอง</option><option value="70">ราชบุรี</option><option value="45">ร้อยเอ็ด</option><option value="16">ลพบุรี</option><option value="52">ลำปาง</option><option value="51">ลำพูน</option><option value="33">ศรีสะเกษ</option><option value="47">สกลนคร</option><option value="90">สงขลา</option><option value="91">สตูล</option><option value="11">สมุทรปราการ</option><option value="75">สมุทรสงคราม</option><option value="74">สมุทรสาคร</option><option value="19">สระบุรี</option><option value="27">สระแก้ว</option><option value="17">สิงห์บุรี</option><option value="72">สุพรรณบุรี</option><option value="84">สุราษฎร์ธานี</option><option value="32">สุรินทร์</option><option value="64">สุโขทัย</option><option value="43">หนองคาย</option><option value="39">หนองบัวลำภู</option><option value="37">อำนาจเจริญ</option><option value="41">อุดรธานี</option><option value="53">อุตรดิตถ์</option><option value="61">อุทัยธานี</option><option value="34">อุบลราชธานี</option><option value="15">อ่างทอง</option><option value="57">เชียงราย</option><option value="50">เชียงใหม่</option><option value="76">เพชรบุรี</option><option value="67">เพชรบูรณ์</option><option value="42">เลย</option><option value="54">แพร่</option><option value="58" selected="selected">แม่ฮ่องสอน</option></select></span></td></tr>
                    <tr><td>&nbsp;</td><td><span id="ajaxlist_amphur"><select onchange="setvill(this.value);submit();"><option value="0">(โปรดเลือก)</option><option value="5801">เมืองแม่ฮ่องสอน</option><option value="5802">ขุนยวม</option><option value="5803">ปาย</option><option value="5804">แม่สะเรียง</option><option value="5805">แม่ลาน้อย</option><option value="5806">สบเมย</option><option value="5807">ปางมะผ้า</option></select></span></td></tr>
                    <tr><td>&nbsp;</td><td><span id="ajaxlist_tambon"><select onchange="setvill(this.value);submit();"><option value="0">(โปรดเลือก)</option></select></span></td></tr>
                    <tr><td>&nbsp;</td><td><span id="ajaxlist_village"><select onchange="setvill(this.value);submit();"><option value="0">(โปรดเลือก)</option></select></span></td></tr>
                    <tr>
                        <td>
                            <input type="hidden" id="vill_id" name="vill_id" value="58">
                        </td>
                        <td>
                            <input style="width:150px;" type="submit" name="search" value="ค้นหา">
                        </td>
                    </tr>
                    <tr>
                               <td> </td>
                               <td> <font color="red">*การเลือกข้อมูลระดับพื้นที่ กรุณาเลือกภาคก่อน* </font> </td>
                    </tr>
                </tbody></table>
            </td>
            <td>
                <table>
                    <tbody><tr><td>ปีงบประมาณ :</td><td><select id="year" name="year" onchange="submit();"><option value="2545">2545</option><option value="2546">2546</option><option value="2547">2547</option><option value="2548" selected="selected">2548</option><option value="2549">2549</option><option value="2550">2550</option><option value="2551">2551</option><option value="2552">2552</option><option value="2553">2553</option><option value="2554">2554</option></select></td></tr>
                </tbody></table>
            </td>
            <td>
                <table>
                    <tbody><tr><td><input style="width:150px;" type="button" name="print" value="พิมพ์หน้านี้" onclick="window.print();"></td></tr>
                    <tr><td><input style="width:150px;" type="submit" name="excel" value="ส่งออก Excel"></td></tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</form>
</body>
</html>