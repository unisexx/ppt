<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
	Function: allow_query_string
	Overrides CIs default behaviour of destroying $_GET

	Install:
		Put this function in hooks/allow_query_string.php

		Enable hooks in config/config.php
		> $config['enable_hooks'] = TRUE;
	
		Define the hook in config/hooks.php
		> $hook['post_controller_constructor'] = array(
		> 	'function' => 'allow_query_string',
		> 	'filename' => 'allow_query_string.php',
		> 	'filepath' => 'hooks'
		> );
*/
function allow_query_string() {
    parse_str($_SERVER['QUERY_STRING'], $_GET);
    $_CI =& get_instance();
    foreach ($_GET as $key=>$val) {
		$_GET[$key] = $_CI->input->xss_clean($val);
	}
}
?>