<?php
Class Csv extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('setting/form_all_model','form_all');
	}
	
	// แบบ อปท.1 (1)
	function f01(){
		set_time_limit(0);
		$csv_path = 'data/opt/2555/opt1_2555.csv';
		$field = array(
		    0 => 'number_id',
		    1 => 'province',
		    2 => 'amphor',
		    3 => 'opt_name',
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
		    22 => 'male_population',
		    23 => 'female_population',
		    24 => 'household',
		    25 => 't311',
		    26 => 't312',
		    27 => 't313',
		    28 => 't314',
		    29 => 't321_m',
		    30 => 't321_f',
		    31 => 't322_m',
		    32 => 't322_f',
		    33 => 't323_m',
		    34 => 't323_f',
		    35 => 't324_m',
		    36 => 't324_f',
		    37 => 't325_m',
		    38 => 't325_f',
		    39 => 't326_m',
		    40 => 't326_f',
		    41 => 't327_m',
		    42 => 't327_f',
		    43 => 't331_m',
		    44 => 't331_f',
		    45 => 't332_m',
		    46 => 't332_f',
		    47 => 't333_m',
		    48 => 't333_f',
		    49 => 't334_m',
		    50 => 't334_f',
		    51 => 't341_m',
		    52 => 't341_f',
		    53 => 't342_m',
		    54 => 't342_f',
		    55 => 't343_m',
		    56 => 't343_f',
		    57 => 't351_m',
		    58 => 't351_f',
		    59 => 't352_m',
		    60 => 't352_f',
		    61 => 't353_m',
		    62 => 't353_f',
		    63 => 't354_m',
		    64 => 't354_f',
		    65 => 't355_m',
		    66 => 't355_f',
		    67 => 't356_m',
		    68 => 't356_f',
		    69 => 't357_m',
		    70 => 't357_f',
		    71 => 't361',
		    72 => 't362',
		    73 => 't363',
		    74 => 't411_m',
		    75 => 't411_f',
		    76 => 't412_m',
		    77 => 't412_f',
		    78 => 't413_m',
		    79 => 't413_f',
		    80 => 't414_m',
		    81 => 't414_f',
		    82 => 't415_m',
		    83 => 't415_f',
		    84 => 't4161_m',
		    85 => 't4161_f',
		    86 => 't4162_m',
		    87 => 't4162_f',
		    88 => 't4163_m',
		    89 => 't4163_f',
		    90 => 't4164_m',
		    91 => 't4164_f',
		    92 => 't4165_COMMENT',
		    93 => 't4165_m',
		    94 => 't4165_f',
		    95 => 't417_m',
		    96 => 't417_f',
		    97 => 't418_m',
		    98 => 't418_f',
		    99 => 't419_m',
		    100 => 't419_f',
		    101 => 't4110_m',
		    102 => 't4110_f',
		    103 => 't421',
		    104 => 't422',
		    105 => 't423',
		    106 => 't424',
		    107 => 't425',
		    108 => 't431',
		    109 => 't432',
		    110 => 't433',
		    111 => 't441_M',
		    112 => 't441_F',
		    113 => 't442_M',
		    114 => 't442_F',
		    115 => 't443_M',
		    116 => 't443_F',
		    117 => 't444_M',
		    118 => 't444_F',
		    119 => 't445_M',
		    120 => 't445_F',
		    121 => 't446_M',
		    122 => 't446_F',
		    123 => 't4511_M',
		    124 => 't4511_F',
		    125 => 't4512_M',
		    126 => 't4512_F',
		    127 => 't4513_M',
		    128 => 't4513_F',
		    129 => 't4514_M',
		    130 => 't4514_F',
		    131 => 't4515_M',
		    132 => 't4515_F',
		    133 => 't4516_M',
		    134 => 't4516_F',
		    135 => 't452_M',
		    136 => 't452_F',
		    137 => 't453_M',
		    138 => 't453_F',
		    139 => 't454_M',
		    140 => 't454_F',
		    141 => 't461_M',
		    142 => 't461_F',
		    143 => 't462_M',
		    144 => 't462_F',
		    145 => 't463_M',
		    146 => 't463_F',
		    147 => 't464_M',
		    148 => 't464_F',
		    149 => 't465',
		    150 => 't51',
		    151 => 't52',
		    152 => 't661',
		    153 => 't662',
		    154 => 'ds_name',
		    155 => 'ds_position',
		    156 => 'ds_tel'
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
		                    // echo '<p>'.$c.' | '.$col_title[$c].' | '.$col_title_sub[$c].' | '.$data[$c] . "</p>\n";
		                    if(in_array($c, array_keys($field))) $db[$field[$c]] = is_string($data[$c]) ? $data[$c] : $data[$c];
		                }
		                
		            }
		            echo '<hr /><pre>';
		            // var_export($db);
		            // print_r($db);
					if($db){
						// $db['c_title'] = 'กกกก';
						// $this->db->debug = true;
						// $this->form_all->save($db, TRUE);
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