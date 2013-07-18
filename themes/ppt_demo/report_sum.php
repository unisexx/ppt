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
			case 'child1':
				include "modules/report_sum/child1.php";
			break;
			case 'child1_1':
				include "modules/report_sum/child1_1.php";
			break;
			case 'child2':
				include "modules/report_sum/child2.php";
			break;
			case 'child3':
				include "modules/report_sum/child3.php";
			break;
			case 'child4':
				include "modules/report_sum/child4.php";
			break;
			case 'child5':
				include "modules/report_sum/child5.php";
			break;
			case 'child5_1':
				include "modules/report_sum/child5_1.php";
			break;
			case 'women1':
				include "modules/report_sum/women1.php";
			break;
			case 'disabled1':
				include "modules/report_sum/disabled1.php";
			break;
			case 'family1':
				include "modules/report_sum/family1.php";
			break;
			case 'older1':
				include "modules/report_sum/older1.php";
			break;
			case 'older2':
				include "modules/report_sum/older2.php";
			break;
			case 'older2_1':
				include "modules/report_sum/older2_1.php";
			break;
			case 'older3':
				include "modules/report_sum/older3.php";
			break;
			case 'disadvantaged1':
				include "modules/report_sum/disadvantaged1.php";
			break;
			case 'issue1':
				include "modules/report_sum/issue1.php";
			break;
			case 'issue2':
				include "modules/report_sum/issue2.php";
			break;
			case 'issue3':
				include "modules/report_sum/issue3.php";
			break;
			case 'issue4':
				include "modules/report_sum/issue4.php";
			break;
			case 'issue5':
				include "modules/report_sum/issue5.php";
			break;
			case 'issue6':
				include "modules/report_sum/issue6.php";
			break;
			case 'issue7':
				include "modules/report_sum/issue7.php";
			break;
			case 'issue8':
				include "modules/report_sum/issue8.php";
			break;
			case 'issue9':
				include "modules/report_sum/issue9.php";
			break;
			case 'issue10':
				include "modules/report_sum/issue10.php";
			break;
			case 'issue10_1':
				include "modules/report_sum/issue10_1.php";
			break;
			case 'issue11':
				include "modules/report_sum/issue11.php";
			break;
			case 'basic1':
				include "modules/report_sum/basic1.php";
			break;
			case 'basic2':
				include "modules/report_sum/basic2.php";
			break;
			case 'basic3':
				include "modules/report_sum/basic3.php";
			break;
			case 'basic4':
				include "modules/report_sum/basic4.php";
			break;
			case 'basic4_1':
				include "modules/report_sum/basic4_1.php";
			break;
			default :
				include "modules/report_sum/list.php";
 		    break;
	}
?>
</div><!--page-->
</body>
</html>