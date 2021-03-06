<?php
Class Csv extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('setting/form_all_model','form_all');
	}
    
    public function index()
    {
        $data['file'] = 'data/opt/2555/opt1_2555.csv';
        $this->template->build('index', $data);
    }
    
    public function encode()
    {
        if(!empty($_POST))
        {
            header ('Content-type: text/html; charset=utf-8');
            echo iconv('tis-620', 'utf-8', $_POST['field']);
            //echo mb_detect_encoding($_POST['field']);
            //echo $this->utf8_to_tis620($_POST['field']);
            //echo $_POST['field'];
        }
    }
	
    public function g($id)
    {
        $province = array(81=>'กระบี่',71=>"กาญจนบุรี",46=>"กาฬสินธุ์",62=>"กำแพงเพชร",40=>"ขอนแก่น",22=>"จันทบุรี",24=>"ฉะเชิงเทรา",20=>"ชลบุรี",18=>"ชัยนาท",36=>"ชัยภูมิ",86=>"ชุมพร",92=>"ตรัง",23=>"ตราด",63=>"ตาก",26=>"นครนายก",73=>"นครปฐม",48=>"นครพนม",30=>"นครราชสีมา",80=>"นครศรีธรรมราช",60=>"นครสวรรค์",12=>"นนทบุรี",96=>"นราธิวาส",55=>"น่าน",38=>"บึงกาฬ",31=>"บุรีรัมย์",13=>"ปทุมธานี",77=>"ประจวบคีรีขันธ์",25=>"ปราจีนบุรี",94=>"ปัตตานี",14=>"พระนครศรีอยุธยา",56=>"พะเยา",82=>"พังงา",93=>"พัทลุง",66=>"พิจิตร",65=>"พิษณุโลก",83=>"ภูเก็ต",44=>"มหาสารคาม",49=>"มุกดาหาร",95=>"ยะลา",35=>"ยโสธร",85=>"ระนอง",21=>"ระยอง",70=>"ราชบุรี",45=>"ร้อยเอ็ด",16=>"ลพบุรี",52=>"ลำปาง",51=>"ลำพูน",33=>"ศรีสะเกษ",47=>"สกลนคร",90=>"สงขลา",91=>"สตูล",11=>"สมุทรปราการ",75=>"สมุทรสงคราม",74=>"สมุทรสาคร",19=>"สระบุรี",27=>"สระแก้ว",17=>"สิงห์บุรี",72=>"สุพรรณบุรี",84=>"สุราษฎร์ธานี",32=>"สุรินทร์",64=>"สุโขทัย",43=>"หนองคาย",39=>"หนองบัวลำภู",37=>"อำนาจเจริญ",41=>"อุดรธานี",53=>"อุตรดิตถ์",61=>"อุทัยธานี",34=>"อุบลราชธานี",15=>"อ่างทอง",57=>"เชียงราย",50=>"เชียงใหม่",76=>"เพชรบุรี",67=>"เพชรบูรณ์",42=>"เลย",54=>"แพร่",58=>"แม่ฮ่องสอน");
        //$name = $_GET['p_name'];
        //foreach($province as $id => $name)
        //{
            $url = 'http://cddcenter.cdd.go.th/cddcenter/cdd_report/jbt_r03.php?div_id=0&vill_id='.$id.'&year=2548&excel=1';
            $this->load->helper('download');
            $data = file_get_contents($url);
            force_download($province[$id].'.xls', $data); 
            //sleep(30);
        //}        
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
		
        $opt_province = $this->db->getassoc('select province, id from provinces order by id');
        $amphur = $this->db->getarray('select id, province_id, amphur_name from amphur order by province_id, id');
        $opt_amphur = array();
        foreach($amphur as $val) $opt_amphur[$val['PROVINCE_ID']][$val['AMPHUR_NAME']] = $val['ID'];
        
        $opt_c_position = $this->db->getassoc('select c_position_name, id from c_positions order by id');
        $opt_o_position = $this->db->getassoc('select o_position_name, id from o_positions order by id');
        $opt_v_position = $this->db->getassoc('select v_position_name, id from v_positions order by id');
        $opt_b_position = $this->db->getassoc('select b_position_name, id from b_positions order by id');
        
		if(($handle = fopen(iconv('UTF-8','TIS-620',$csv_path), 'r')) !== false)
		{
		    
		    $header = fgetcsv($handle);
		    
		    while(($data = fgetcsv($handle)) !== false)
		    {
		
		        $row++;
		        if(!empty($data))
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
                                                                                   
                            if($c == 1 and in_array($opt_province[$data[$c]], array_values($opt_province))) $db['province_id'] = $opt_province[$data[$c]];
                            if($c == 2 and in_array($opt_amphur[$db['province_id']][$data[$c]], array_values($opt_amphur[$db['province_id']]))) $db['amphur_id'] = $opt_amphur[$db['province_id']][$data[$c]];
                            if($c == 7 and in_array($opt_c_position[$data[$c]], array_values($opt_c_position))) $db['c_position_id'] = $opt_c_position[$data[$c]];
                            if($c == 11 and in_array($opt_o_position[$data[$c]], array_values($opt_o_position))) $db['o_position_id'] = $opt_o_position[$data[$c]];
                            if($c == 15 and in_array($opt_v_position[$data[$c]], array_values($opt_v_position))) $db['v_position_id'] = $opt_v_position[$data[$c]];
                            if($c == 19 and in_array($opt_b_position[$data[$c]], array_values($opt_b_position))) $db['b_position_id'] = $opt_b_position[$data[$c]];
		                }
		                
		            }
		            //echo '<hr /><pre>';
		            // var_export($db);
		            // print_r($db);
					if($db){
						 $db['year'] = '2555';
						 //$this->db->debug = true;
						 $this->form_all->save($db, TRUE);
					}
		            //if($row > 2) echo '<hr />';
		        }
		        unset($data);
		        
		    }
		
		    fclose($handle);
		}
	}


}