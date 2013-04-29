<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	<div class="container-fluid">
		<?php include "_header.php";?>
		<?php include "_menu.php";?>
		<div id="page">
			<?php echo $template['body'] ?>
		</div>
	</div>
</body>
</html>