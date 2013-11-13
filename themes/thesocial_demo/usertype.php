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
				include "modules/usertype/query.php";
			break;
			case 'form':
				include "modules/usertype/form.php";
			break;
			default :
				include "modules/usertype/list.php";
 		    break;
	}
?>
</div><!--page-->
</body>
</html>