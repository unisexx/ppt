<?php
	function findKeys($array,$field,$condition,$value) {
	foreach ($array as $key=>$info) {
	eval('if ($info[$field] '.$condition.' $value) {
	$matches[] = $key;
	}');
	}
	return $matches;
	}
?>