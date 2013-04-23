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
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('opt_model', 'opt');
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
        ORDER BY FORM_ALL."YEAR" DESC, FORM_ALL.NUMBER_ID DESC';
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
}