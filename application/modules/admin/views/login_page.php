<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?php echo base_url(); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ระบบฐานข้อมูลทางสังคม สป.พม.</title>
	<?php include "themes/ppt/_css.php";?>
</head>
<body>
	<style type="text/css">
      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 30px auto;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
		h2{color:#DA4F49;}
    </style>
    
<div class="container">
	<center><h1>ระบบฐานข้อมูลทางสังคม สป.พม.</h1></center>
      <form class="form-signin" method="post" action="admin/login">
        <h2 class="form-signin-heading">กรุณาเข้าสู่ระบบ</h2>
        <input type="text" class="input-block-level" placeholder="Username" name="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password">
        <button class="btn btn-large btn-danger" type="submit">เข้าสู่ระบบ</button>
      </form>
</div> <!-- /container -->
</body>
</html>