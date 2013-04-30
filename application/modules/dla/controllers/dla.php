<?php
class Dla extends Public_Controller
{
    public $menu = array(
        17 => array('s' => '(FORM_ALL.T414_M) AS TOTAL_1, (FORM_ALL.T414_F) AS TOTAL_2', 'f' => array('t414_m', 't414_f')),
        18 => array('s' => '(FORM_ALL.T415_M) AS TOTAL_1, (FORM_ALL.T415_F) AS TOTAL_2', 'f' => array('t415_m', 't415_f')),
        19 => array('s' => '(FORM_ALL.T417_M) AS TOTAL_1, (FORM_ALL.T417_F) AS TOTAL_2', 'f' => array('t417_m', 't417_f')),
        20 => array('s' => '(FORM_ALL.T412_M) AS TOTAL_1, (FORM_ALL.T412_F) AS TOTAL_2', 'f' => array('t412_m', 't412_f')),
        21 => array('s' => '(FORM_ALL.T411_M) AS TOTAL_1, (FORM_ALL.T411_F) AS TOTAL_2', 'f' => array('t411_m', 't411_f')),
        22 => array('s' => '(FORM_ALL.T418_M) AS TOTAL_1, (FORM_ALL.T418_F) AS TOTAL_2', 'f' => array('t418_m', 't418_f')),
        23 => array('s' => '(FORM_ALL.T4110_M) AS TOTAL_1, (FORM_ALL.T4110_F) AS TOTAL_2', 'f' => array('t4110_m', 't4110_f')),
        24 => array('s' => '(FORM_ALL.T331_M) AS TOTAL_1, (FORM_ALL.T331_F) AS TOTAL_2', 'f' => array('t331_m', 't331_f')),
        25 => array('s' => '(FORM_ALL.T332_M) AS TOTAL_1, (FORM_ALL.T332_F) AS TOTAL_2', 'f' => array('t332_m', 't332_f')),
        28 => array('s' => '(FORM_ALL.T333_M) AS TOTAL_1, (FORM_ALL.T333_F) AS TOTAL_2', 'f' => array('t333_m', 't333_f')),
        29 => array('s' => '(FORM_ALL.T413_M) AS TOTAL_1, (FORM_ALL.T413_F) AS TOTAL_2', 'f' => array('t413_m', 't413_f')),
        31 => array('s' => '(FORM_ALL.T419_M) AS TOTAL_1, (FORM_ALL.T419_F) AS TOTAL_2', 'f' => array('t419_m', 't419_f')),
        40 => array('s' => '(FORM_ALL.T452_M) AS TOTAL_1, (FORM_ALL.T452_F) AS TOTAL_2', 'f' => array('t452_m', 't452_f')),
        41 => array('s' => '(FORM_ALL.T453_M) AS TOTAL_1, (FORM_ALL.T453_F) AS TOTAL_2', 'f' => array('t453_m', 't453_f')),
        62 => array('s' => '(FORM_ALL.T441_M) AS TOTAL_1, (FORM_ALL.T441_F) AS TOTAL_2', 'f' => array('t441_m', 't441_f')),
        63 => array('s' => '(FORM_ALL.T442_M) AS TOTAL_1, (FORM_ALL.T442_F) AS TOTAL_2', 'f' => array('t442_m', 't442_f')),
        64 => array('s' => '(FORM_ALL.T443_M) AS TOTAL_1, (FORM_ALL.T443_F) AS TOTAL_2', 'f' => array('t443_m', 't443_f')),
        65 => array('s' => '(FORM_ALL.T444_M) AS TOTAL_1, (FORM_ALL.T444_F) AS TOTAL_2', 'f' => array('t444_m', 't444_f')),
        66 => array('s' => '(FORM_ALL.T445_M) AS TOTAL_1, (FORM_ALL.T445_F) AS TOTAL_2', 'f' => array('t445_m', 't445_f')),
        67 => array('s' => '(FORM_ALL.T446_M) AS TOTAL_1, (FORM_ALL.T446_F) AS TOTAL_2', 'f' => array('t446_m', 't446_f')),
        
        79 => array('s' => '(FORM_ALL.T321_M) AS TOTAL_1, (FORM_ALL.T321_F) AS TOTAL_2', 'f' => array('t321_m', 't321_f')),
        80 => array('s' => '(FORM_ALL.T322_M) AS TOTAL_1, (FORM_ALL.T322_F) AS TOTAL_2', 'f' => array('t322_m', 't322_f')),
        81 => array('s' => '(FORM_ALL.T323_M) AS TOTAL_1, (FORM_ALL.T323_F) AS TOTAL_2', 'f' => array('t323_m', 't323_f')),
        82 => array('s' => '(FORM_ALL.T324_M) AS TOTAL_1, (FORM_ALL.T324_F) AS TOTAL_2', 'f' => array('t324_m', 't324_f')),
        83 => array('s' => '(FORM_ALL.T325_M) AS TOTAL_1, (FORM_ALL.T325_F) AS TOTAL_2', 'f' => array('t325_m', 't325_f')),
        84 => array('s' => '(FORM_ALL.T326_M) AS TOTAL_1, (FORM_ALL.T326_F) AS TOTAL_2', 'f' => array('t326_m', 't326_f')),
        85 => array('s' => '(FORM_ALL.T327_M) AS TOTAL_1, (FORM_ALL.T327_F) AS TOTAL_2', 'f' => array('t327_m', 't327_f')),
        
        87 => array('s' => '(FORM_ALL.T341_M) AS TOTAL_1, (FORM_ALL.T341_F) AS TOTAL_2', 'f' => array('t341_m', 't341_f')),
        88 => array('s' => '(FORM_ALL.T342_M) AS TOTAL_1, (FORM_ALL.T342_F) AS TOTAL_2', 'f' => array('t342_m', 't342_f')),
        89 => array('s' => '(FORM_ALL.T343_M) AS TOTAL_1, (FORM_ALL.T343_F) AS TOTAL_2', 'f' => array('t343_m', 't343_f')),
        90 => array('s' => '(FORM_ALL.T351_M) AS TOTAL_1, (FORM_ALL.T351_F) AS TOTAL_2', 'f' => array('t351_m', 't351_f')),
        
        92 => array('s' => '(FORM_ALL.T354_M) AS TOTAL_1, (FORM_ALL.T354_F) AS TOTAL_2', 'f' => array('t354_m', 't354_f')),
        
        94 => array('s' => '(FORM_ALL.T355_M) AS TOTAL_1, (FORM_ALL.T355_F) AS TOTAL_2', 'f' => array('t355_m', 't355_f')),
        95 => array('s' => '(FORM_ALL.T356_M) AS TOTAL_1, (FORM_ALL.T356_F) AS TOTAL_2', 'f' => array('t356_m', 't356_f')),
        
        99 => array('s' => '(FORM_ALL.T461_M) AS TOTAL_1, (FORM_ALL.T461_F) AS TOTAL_2', 'f' => array('t461_m', 't461_f')),
        100 => array('s' => '(FORM_ALL.T462_M) AS TOTAL_1, (FORM_ALL.T462_F) AS TOTAL_2', 'f' => array('t462_m', 't462_f')),
        
        30 => array('s' => '(FORM_ALL.T4161_M + FORM_ALL.T4161_F) AS TOTAL_1,
          (FORM_ALL.T4162_M + FORM_ALL.T4162_F) AS TOTAL_2,
          (FORM_ALL.T4163_M + FORM_ALL.T4163_F) AS TOTAL_3,
          (FORM_ALL.T4164_M + FORM_ALL.T4164_F) AS TOTAL_4,
          (FORM_ALL.T4165_M + FORM_ALL.T4165_F) AS TOTAL_5', 'f' => null),
        36 => array('s' => '(FORM_ALL.T431) AS TOTAL_1', 'f' => 't431'),
        37 => array('s' => '(FORM_ALL.T432) AS TOTAL_1', 'f' => 't432'),
        38 => array('s' => '(FORM_ALL.T433) AS TOTAL_1', 'f' => 't433'),
        46 => array('s' => '(FORM_ALL.T421) AS TOTAL_1', 'f' => 't421'),
        47 => array('s' => '(FORM_ALL.T422) AS TOTAL_1', 'f' => 't422'),
        48 => array('s' => '(FORM_ALL.T423) AS TOTAL_1', 'f' => 't423'),
        49 => array('s' => '(FORM_ALL.T424) AS TOTAL_1', 'f' => 't424'),
        50 => array('s' => '(FORM_ALL.T425) AS TOTAL_1', 'f' => 't425'),
        51 => array('s' => '(FORM_ALL.T311) AS TOTAL_1', 'f' => 't311'),
        52 => array('s' => '(FORM_ALL.T312) AS TOTAL_1', 'f' => 't312'),
        53 => array('s' => '(FORM_ALL.T313) AS TOTAL_1', 'f' => 't313'),
        54 => array('s' => '(FORM_ALL.T314) AS TOTAL_1', 'f' => 't314'),
        
        96 => array('s' => '(FORM_ALL.T361) AS TOTAL_1', 'f' => 't361'),
        97 => array('s' => '(FORM_ALL.T362) AS TOTAL_1', 'f' => 't362'),
        98 => array('s' => '(FORM_ALL.T362) AS TOTAL_1', 'f' => 't363')
    );
	
	public $field = array(
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
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('opt_model', 'opt');
        $this->load->model('info_model','info');
    }
    
    public function index($menu_id)
    {
        // search
        $where = '';
        if(!empty($_GET))
        {
            if(!empty($_GET['keyword']))
            {
                $where .= " AND ( FORM_ALL.NUMBER_ID LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.C_NAME LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.OPT_NAME LIKE '%".$_GET['keyword']."%' )";
            }
            
            if(!empty($_GET['year'])) $where .= ' AND FORM_ALL."YEAR" = '.$_GET['year'];
            if(!empty($_GET['province_id'])) $where .= ' AND FORM_ALL.PROVINCE_ID = '.$_GET['province_id'];
            if(!empty($_GET['amphur_id'])) $where .= ' AND FORM_ALL.AMPHUR_ID = '.$_GET['amphur_id'];
        }
        
        // case menu
        $data['m'] = $this->list_menu->get_row($menu_id);
        $data['m_sub'] = $this->list_menu->get_one('title', $data['m']['parent_id']);
        
        $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          FORM_ALL.NUMBER_ID,
          FORM_ALL.OPT_NAME,
          AMPHUR.AMPHUR_NAME,
          PROVINCES.PROVINCE,
          FORM_ALL."SIZE",
          FORM_ALL.C_TITLE,
          FORM_ALL.C_NAME,
          '.$this->menu[$menu_id]['s'].'
        FROM FORM_ALL 
        LEFT JOIN PROVINCES ON PROVINCES.ID = FORM_ALL.PROVINCE_ID
        LEFT JOIN AMPHUR ON AMPHUR.ID = FORM_ALL.AMPHUR_ID
        WHERE 1=1 '.$where.' 
        ORDER BY FORM_ALL."YEAR" DESC, PROVINCES.PROVINCE, AMPHUR.AMPHUR_NAME, FORM_ALL.OPT_NAME';
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        $this->template->build('index_'.$data['m']['template_id'], $data);
    }
    
    public function form($menu_id, $id = null)
    {
        // case menu
        $data['m'] = $this->list_menu->get_row($menu_id);
        $data['m_sub'] = $this->list_menu->get_one('title', $data['m']['parent_id']);
        
        $data['f'] = $this->menu[$menu_id]['f'];
        
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        $this->template->build('form_'.$data['m']['template_id'], $data);
    }
    
    public function save($menu_id)
    {
        if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));    
        }
        redirect('dla/index/'.$menu_id);
    }
    
    public function delete($menu_id, $id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('dla/index/'.$menu_id);
    }
	
	public function import()
	{
		if(!empty($_FILES['file']['name']))
		{
			set_time_limit(0);
            
            // save info
            $_POST['section_id'] = $_POST['import_workgroup_id']> 0 ? $_POST['import_workgroup_id'] : $_POST['import_section_id'];
            $this->info->save($_POST);
            
            // import from csv
			//header('Content-type: text/html; charset=tis-620');
			$row = 0;
			$total_row = 0;
			
	        $opt_province = $this->db->getassoc('select province, id from provinces order by id');
	        $amphur = $this->db->getarray('select id, province_id, amphur_name from amphur order by province_id, id');
	        $opt_amphur = array();
	        foreach($amphur as $val) $opt_amphur[$val['PROVINCE_ID']][$val['AMPHUR_NAME']] = $val['ID'];
	        
	        $opt_c_position = $this->db->getassoc('select c_position_name, id from c_positions order by id');
	        $opt_o_position = $this->db->getassoc('select o_position_name, id from o_positions order by id');
	        $opt_v_position = $this->db->getassoc('select v_position_name, id from v_positions order by id');
	        $opt_b_position = $this->db->getassoc('select b_position_name, id from b_positions order by id');
	        $temp_name = time().'.csv';
	        if(move_uploaded_file($_FILES["file"]["tmp_name"], 'uploads/'.$temp_name))
	        {
    			if(($handle = fopen('uploads/'.$temp_name, 'r')) !== false)
    			{	    
    			    $header = fgetcsv($handle);
                    
    			    while(($data = fgetcsv($handle)) !== false)
    			    {
    			        $row++;
    			        if(!empty($data[0]))
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
    			                    //echo '<p>'.$c.' | '.$col_title[$c].' | '.$col_title_sub[$c].' | '.$data[$c] . "</p>\n";
    			                    if(in_array($c, array_keys($this->field))) $db[$this->field[$c]] = is_string($data[$c]) ? $data[$c] : $data[$c];                                                                              
    	                            if($c == 1 and in_array($opt_province[$data[$c]], array_values($opt_province))) $db['province_id'] = $opt_province[$data[$c]];
    	                            if($c == 2 and in_array($opt_amphur[$db['province_id']][$data[$c]], array_values($opt_amphur[$db['province_id']]))) $db['amphur_id'] = $opt_amphur[$db['province_id']][$data[$c]];
    	                            if($c == 7 and @in_array($opt_c_position[$data[$c]], @array_values($opt_c_position))) @$db['c_position_id'] = @$opt_c_position[$data[$c]];
    	                            if($c == 11 and @in_array($opt_o_position[$data[$c]], @array_values($opt_o_position))) @$db['o_position_id'] = @$opt_o_position[$data[$c]];
    	                            if($c == 15 and @in_array($opt_v_position[$data[$c]], @array_values($opt_v_position))) @$db['v_position_id'] = @$opt_v_position[$data[$c]];
    	                            if($c == 19 and @in_array($opt_b_position[$data[$c]], @array_values($opt_b_position))) @$db['b_position_id'] = @$opt_b_position[$data[$c]];
    			                }
    			                
    			            }
    						if($db){
    							 $db['year'] = $_POST['year_data'];
    						     //$this->db->debug = true;
    							 $this->opt->save($db, TRUE);
                                 $total_row++;
    						}
    			        }
    			        unset($data);   
    			    }
    			    fclose($handle);
    			}
			}
            set_notify('success', 'Import '.number_format($total_row).' rows');
            redirect('dla/import');
		}
		$this->template->build('import');
	}

    public function download()
    {
        $this->load->helper('download');
        $data = file_get_contents('import_file/dla/sample.csv');
        force_download('sample.csv', $data); 
    }
}