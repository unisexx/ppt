<? include "include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title;?></title>
<? include '_script.php'?>
</head>

<body>
<? include '_header.php'?>
<? include '_menu.php'?>
<div id="page">

<? switch($_GET['act'])
	{
			case 'query':
				include "modules/people/query.php";
			break;
			case 'localgov_form':  //อปท.1-1
				include "modules/people/localgov_form.php";
			break;
			case 'localgov_list':
				include "modules/people/localgov_list.php";
			break;
			case 'localgov2_form':  //อปท.1-2
				include "modules/people/localgov2_form.php";
			break;
			case 'localgov2_list':
				include "modules/people/localgov2_list.php";
			break;
			case 'localgov3_form':   //อปท.1-3
				include "modules/people/localgov3_form.php";
			break;
			case 'localgov3_list':
				include "modules/people/localgov3_list.php";
			break;
			case 'police_traffic_form':   //สตช. ประชาชนได้รับอุบัติเหตุจากยานพาหนะ
				include "modules/people/police_traffic_form.php";
			break;
			case 'police_traffic_list':
				include "modules/people/police_traffic_list.php";
			break;
			case 'edu_drop_form':   //ศธ. เด็กและเยาวชนออกจากโรงเรียนกลางคัน 
				include "modules/people/edu_drop_form.php";
			break;
			case 'edu_drop_list':
				include "modules/people/edu_drop_list.php";
			break;
			case 'cripple_card_form':   //nep คนพิการที่มีบัตรประจำตัวคนพิการ
				include "modules/people/cripple_card_form.php";
			break;
			case 'cripple_card_list':
				include "modules/people/cripple_card_list.php";
			break;
			case 'population_form':   //กรมการปกครอง ประชากร (คน)
				include "modules/people/population_form.php";
			break;
			case 'population_list':
				include "modules/people/population_list.php";
			break;
			case 'disadvantaged_form':   //สท. ผู้ด้อยโอกาสทางสังคม
				include "modules/people/disadvantaged_form.php";
			break;
			case 'disadvantaged_list':
				include "modules/people/disadvantaged_list.php";
			break;
			case 'mental_patients_form':    //กรมสุขภาพจิต จำนวนและอัตราผู้ป่วยสุภาพจิต
				include "modules/people/mental_patients_form.php";
			break;
			case 'mental_patients_list':
				include "modules/people/mental_patients_list.php";
			break;
			case 'criminal_offense_form':   //สตช. ความผิดทางคดีอาญา 
				include "modules/people/criminal_offense_form.php";
			break;
			case 'criminal_offense_list':
				include "modules/people/criminal_offense_list.php";
			break;
			case 'child_care_welfare_form': //พส. เด็กและเยาวชนที่อยู่ในความอุปการะของสถานสงเคราะห์/สถานคุ้มครอง/สถานพัฒนาและฟื้นฟู/ศูนย์ฝึกอาชีพ
				include "modules/people/child_care_welfare_form.php";
			break;
			case 'child_care_welfare_list':
				include "modules/people/child_care_welfare_list.php";
			break;
			case 'child_offense_form': //กรมพินิจ  เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็กและเยาวชน ตามฐานความผิด
				include "modules/people/child_offense_form.php";
			break;
			case 'child_offense_list':
				include "modules/people/child_offense_list.php";
			break;
			case 'child_cause_offense_form': //กรมพินิจ  เด็กและเยาวชนที่ถูกดำเนินคดีในสถานพินิจและคุ้มครองเด็กและเยาวชน ตามสาเหตุการกระทำความผิด
				include "modules/people/child_cause_offense_form.php";
			break;
			case 'child_cause_offense_list':
				include "modules/people/child_cause_offense_list.php";
			break;
			case 'teen_pregnant_form': //กรมการปกครอง  เด็กและเยาวชนตั้งครรภ์ก่อนวัยอันควร
				include "modules/people/teen_pregnant_form.php";
			break;
			case 'teen_pregnant_list':
				include "modules/people/teen_pregnant_list.php";
			break;
			case 'birth_form': //กรมการปกครอง  ข้อมูลการเกิด
				include "modules/people/birth_form.php";
			break;
			case 'birth_list':
				include "modules/people/birth_list.php";
			break;
			case 'family_warm_form': //มท.  ครอบครัวมีความอบอุ่น จปฐ.21
				include "modules/people/family_warm_form.php";
			break;
			case 'family_warm_list':
				include "modules/people/family_warm_list.php";
			break;
			case 'poor_province_form': //สคช.  คนยากจน (จังหวัด)
				include "modules/people/poor_province_form.php";
			break;
			case 'poor_province_list':
				include "modules/people/poor_province_list.php";
			break;
			case 'poor_age_form': //สคช.  คนยากจน (กลุ่มวัย)
				include "modules/people/poor_age_form.php";
			break;
			case 'poor_age_list':
				include "modules/people/poor_age_list.php";
			break;
			default :
				include "modules/people/list.php";
 		    break;
			
	}
?>
</div><!--page-->
</body>
</html>