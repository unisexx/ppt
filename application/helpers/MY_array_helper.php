<?php
	function findKeys($array,$field,$condition,$value) {
	foreach ($array as $key=>$info) {
	eval('if ($info[$field] '.$condition.' $value) {
	$matches[] = $key;
	}');
	}
	return $matches;
	}
    
    function csv_to_array($filename='', $col = null, $delimiter=',')
    {
        if(!file_exists($filename) || !is_readable($filename))
            return FALSE;
    
        $header = NULL;
        $data = array();
        
        if (($handle = fopen($filename, 'r')) !== FALSE)
        { 
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header){
                    $header = $row;
                }else{
                    $cols = is_array($col) ? $col : $header;
                    $data[] = array_combine($cols, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
?>