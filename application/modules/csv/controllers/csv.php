<?php
Class Csv extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('setting/f01_model','f01');
	}
	
	// แบบ อปท.1 (1)
	function f01(){
		$csv_path = 'data/อปท1/ปี2555/อปท.1ปี2555.csv';
		$field = array(
		    0 => 'number',
		    1 => 'province',
		    2 => 'amphor',
		    3 => 'name',
		    4 => 'size',
		    5 => 'c_title',
		    6 => 'c_name',
		    7 => 'c_position',
		    8 => 'c_tel',
		    9 => 'o_title',
		    10 => 'o_name',
		    11 => 'o_position',
		    12 => 'o_tel',
		    13 => 'v_title',
		    14 => 'v_name',
		    15 => 'v_position',
		    16 => 'v_tel',
		    17 => 'b_title',
		    18 => 'b_name',
		    19 => 'b_position',
		    20 => 'b_other',
		    21 => 'b_tel',
		    22 => 'male',
		    23 => 'female',
		    24 => 'household'
		);
		
		$this->csv_export($csv_path,$field);
	}

	// csv_export
	function csv_export($csv_path,$field){
		header('Content-type: text/html; charset=tis-620');
		$row = 0;
		
		if(($handle = fopen(iconv('UTF-8','TIS-620',$csv_path), 'r')) !== false)
		{
		    
		    $header = fgetcsv($handle);
		    
		    while(($data = fgetcsv($handle)) !== false)
		    {
		
		        $row++;
		        if($row <= 3)
		        {
		            $num = count($data);
		
		            $db = array();
		            for ($c=0; $c < $num; $c++) {
		                if($row == 1)
		                {
		                    $col_title[$c] = $data[$c];
		                }
		                else if($row == 2)
		                {
		                    $col_title_sub[$c] = $data[$c];
		                }
		                else 
		                {
		                    echo '<p>'.$c.' | '.$col_title[$c].' | '.$col_title_sub[$c].' | '.$data[$c] . "</p>\n";
		                    if(in_array($c, array_keys($field))) $db[$field[$c]] = is_string($data[$c]) ? $data[$c] : $data[$c];
		                }
		                
		            }
		            echo '<hr /><pre>';
		            var_export($db);
					if($db){
						// $db['c_title'] = 'กกกก';
						// $this->db->debug = true;
						// $this->f01->save($db, TRUE);
					}
		            if($row > 2) echo '<hr />';
		        }
		        unset($data);
		        
		    }
		
		    fclose($handle);
		}
	}


}
?>