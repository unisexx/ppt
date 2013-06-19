<?php
function clean_url($text)
{	
	setlocale(LC_ALL,"Thai");
	$text=strtolower($text);
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
	$text = str_replace($code_entities_match, $code_entities_replace, $text);
	$text = @ereg_replace('(--)+', '', $text);
	$text = @ereg_replace('(-)$', '', $text);
	return $text;
} 

function curPageURL($param = FALSE) {
 $pageURL = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 if($param)
 {
 	$i = (@ereg('[?]', $pageURL)) ? '&' : '?';
 }
 else
 {
 	$i = null;	
 }
 return $pageURL.$i; 
}
function GetCurrentUrlGetParameter($is_first_parameter=TRUE){
	$parameter = '';
	$pos = strrpos($_SERVER['REQUEST_URI'],'?');
	if($pos > 0){
		$tmp = explode('?',$_SERVER['REQUEST_URI']);
		$parameter = $tmp[1];
		$parameter = $is_first_parameter == FALSE ? '&'.$parameter : '?'.$parameter;
	}
	return $parameter;
}
?>