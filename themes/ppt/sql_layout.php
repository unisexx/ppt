<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?php echo base_url(); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $template['title'] ?></title>
	<?php include "_css.php";?>
    <?php include "_script.php";?>
    <?php echo $template['metadata'] ?>
</head>
	<body>
		<div id="container"><?php echo $template['body'] ?></div> 
		<div id="footer">&nbsp;</div> 
	</body>
</html>