<?php
/*$host = "localhost";
$us = "famous_broc";
$pw = "Fa123456";
$db = "famous_broc";*/
    
$host = "localhost";
$us = "root";
$pw = "";
$db = "ppt";

	
$link = mysql_connect($host,$us,$pw)or die ("Could not connect to MySQL");
mysql_select_db($db)or die ("Could not connect to Database");
mysql_query("set character set utf8");
?>