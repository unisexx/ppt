<?php 

if(!function_exists('set_notify'))
{
	function set_notify($type,$msg)
	{
		$config = array(
			'notify' => TRUE,
			'type' => $type,
			'msg' => $msg
		);
		$CI =& get_instance();
		$CI->session->set_flashdata($config);
	}
}

if(!function_exists('get_one'))
{
	function get_one($field,$table,$id='id',$value)
	{
		$CI =& get_instance();
		$result = $CI->db->getone('select '.$field.' from '.$table.' where '.$id.' = ?',$value);
		dbConvert($result);
		return $result;
	}
}

if(!function_exists('notify'))
{
	function js_notify()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('notify'))
		{
			$js = '<link rel="stylesheet" href="js/jquery.notifyBar.css" type="text/css" media="screen" />';
		    $js .= '<script type="text/javascript" src="js/jquery.notifyBar.js"></script>';
		    $js .= '<script type="text/javascript">
		    				$(function () {
						  		$.notifyBar({
						  			cls:"'.$CI->session->flashdata('type').'",
						    		html: "'.$CI->session->flashdata('msg').'",
						    		delay: 2000,
						    		animationSpeed: "normal"
						  		});  
							});
						</script>';
			return $js; 
		}
	}
}
//$type -> attention information success error
if(!function_exists('set_caution'))
{
	function set_caution($type,$msg,$selector=".block_content",$position="prepend")
	{
		$config = array(
			'caution' => TRUE,
			'type' => $type,
			'msg' => $msg,
			'position' => $position,
			'selector' => $selector
		);
		$CI =& get_instance();
		$CI->session->set_flashdata($config);
	}
}

if(!function_exists('caution'))
{
	function caution()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('caution'))
		{
		    $js = '<div class="notification '.$CI->session->flashdata('type').' png_bg"><div>'.$CI->session->flashdata('msg').'</div></div>';
			return $js; 
		}
	}
}

if(!function_exists('js_caution'))
{
	function js_caution()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('caution'))
		{
		    $html = "<div class='notification ".$CI->session->flashdata('type')." png_bg'><div>".$CI->session->flashdata('msg')."</div></div>";
			$js = '<script type="text/javascript">
		    				$(function () {
						  		$("'.$CI->session->flashdata('selector').'").'.$CI->session->flashdata('position').'("'.$html.'") 
							});
						</script>';
			return $js; 
		}
	}
}

if(!function_exists('menu_active'))
{
	function menu_active($module,$controller = FALSE,$class='active')
	{
		$CI =& get_instance();
		if($controller)
		{
			return ($CI->router->fetch_module() == $module && $CI->router->fetch_class() == $controller) ? 'class='.$class : '';	
		}
		else
		{
			return ($CI->router->fetch_module() == $module) ? 'class='.$class : '';	
		}
	}
}

function cycle($key,$odd = 'odd',$even = '')
{
	return ($key&1) ? 'class="'.$even.'"' : 'class="'.$odd.'"';
}

function get_option($value,$text,$table,$where = FALSE)
{
	$CI =& get_instance();
	$where = ($where) ? 'where '.$where : '';
	$result = $CI->db->GetAssoc('select '.$value.','.$text.' from '.$table.' '.$where);
	array_walk($result,'dbConvert');
	return $result;
}

function pagebreak($content){
	$break = '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
	return substr("$content",0,strpos($content,$break)+strlen($break));
	//return    strstr($content, '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>',TRUE); // for PHP 5.3.0
}

function getIP(){
    $ip = (getenv(HTTP_X_FORWARDED_FOR))
    ?  getenv(HTTP_X_FORWARDED_FOR)
    :  getenv(REMOTE_ADDR);
    return $ip;
}

function currency_rate($price)
{
	$CI =& get_instance();
	$CI->load->model('currency/currency_model');
	$currency = $CI->currency_model->get_active_rate($CI->session->userdata('currency'));
	return number_format(($price * $currency['rate']),2).' '.$currency['currency'];
}

// js syntaghighlight
function js_syntax()
{
	return '<script type="text/javascript" src="js/sysntaxhighilight/scripts/shCore.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushBash.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushCpp.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushCSharp.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushCss.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushDelphi.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushDiff.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushGroovy.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushJava.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushJScript.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushPhp.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushPlain.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushPython.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushRuby.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushScala.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushSql.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushVb.js"></script>
			<script type="text/javascript" src="js/sysntaxhighilight/scripts/shBrushXml.js"></script>
			<link type="text/css" rel="stylesheet" href="js/sysntaxhighilight/styles/shCore.css"/>
			<link type="text/css" rel="stylesheet" href="js/sysntaxhighilight/styles/shThemeDefault.css"/>
			<script type="text/javascript">
				SyntaxHighlighter.config.clipboardSwf = "js/sysntaxhighilight/scripts/clipboard.swf";
				SyntaxHighlighter.all();
			</script>';
}

function js_validate()
{
	return '<script type="text/javascript" src="js/jquery.validate.min.js"></script>';
}

function js_ckeditor()
{
	return '<script type="text/javascript" src="ckeditor/ckeditor.js"></script>';
}

function js_checkbox()
{
	$CI =& get_instance();
	return '<link rel="stylesheet" href="js/checkbox/jquery.checkbox.css" />
		<script type="text/javascript" src="js/checkbox/jquery.checkbox.min.js"></script>
		<script>
			$(function(){
				$("input:checkbox").checkbox({empty:"js/checkbox/empty.png"});
				$("input:checkbox").click(function(){
					var value = this.checked ? 0 : 1;
					$.post("'.$CI->router->fetch_module().'/admin/'.$CI->router->fetch_module().'/save",{id:this.value ,active:value}); 
				});
			});
		</script>';
}


if (!function_exists('json_encode'))
{
 function json_encode($a=false)
 {
 if (is_null($a)) return 'null';
 if ($a === false) return 'false';
 if ($a === true) return 'true';
 if (is_scalar($a))
 {
 if (is_float($a))
 {
 // Always use "." for floats.
 return floatval(str_replace(",", ".", strval($a)));
 }

 if (is_string($a))
 {
 static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
 return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
 }
 else
 return '"'.$a.'"';
 }
 $isList = true;
 for ($i = 0, reset($a); $i < count($a); $i++, next($a))
 {
 if (key($a) !== $i)
 {
 $isList = false;
 break;
 }
 }
 $result = array();
 if ($isList)
 {
 foreach ($a as $v) $result[] = json_encode($v);
 return '[' . join(',', $result) . ']';
 }
 else
 {
 foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
 return '{' . join(',', $result) . '}';
 }
 }
}


function dbConvert(&$value,$key = null,$output='UTF-8')
{
	$encode = array('UTF-8'=>'TIS-620','TIS-620'=>'UTF-8');
	if(is_array($value))
	{
		$value = array_change_key_case($value);
		array_walk($value,'dbConvert',$output);
	}
	else
	{
		$value = iconv($encode[$output],$output,$value);
	}
}
?>