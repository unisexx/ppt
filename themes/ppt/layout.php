<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?php echo base_url(); ?>" />
    <title><?php echo $template['title'] ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="th"> 
	<meta name="robots" content="index, follow">
    <?php echo $template['metadata'] ?>
	<?php include "_css.php";?>
    <?php include "_script.php";?>
    <link rel="icon" type="image/ico" href="http://dbmso.m-society.go.th/favicon.ico"/>
</head>
<body>
	<div class="container-fluid">
		<?php include "_header.php";?>
		<?php include "_menu.php";?>
		<div id="page">
			<!-- <div style="color:red">***อยู่ระหว่างการปรับปรุงข้อมูล***</div> -->
			<?php echo $template['body'] ?>
		</div>
		<?php include "_footer.php";?>
	</div>
</body>
</html>