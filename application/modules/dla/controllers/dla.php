<?php
class Dla extends Public_Controller
{
    public $menu = array(
        17 => '(FORM_ALL.T414_M) AS TOTAL_1, (FORM_ALL.T414_F) AS TOTAL_2'
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
        //$menu = $this->menu->get_row($menu_id);
        $template_id = $this->db->getone('select template_id from menus where id = '.$menu_id);
        
        $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          (FORM_ALL.T414_M) AS TOTAL_1,
          (FORM_ALL.T414_F) AS TOTAL_2,
          FORM_ALL.NUMBER_ID,
          FORM_ALL.OPT_NAME,
          AMPHUR.AMPHUR_NAME,
          PROVINCES.PROVINCE,
          FORM_ALL."SIZE",
          FORM_ALL.C_TITLE,
          FORM_ALL.C_NAME
        FROM FORM_ALL 
        LEFT JOIN PROVINCES ON PROVINCES.ID = FORM_ALL.PROVINCE_ID
        LEFT JOIN AMPHUR ON AMPHUR.ID = FORM_ALL.AMPHUR_ID
        WHERE 1=1 '.$where.' 
        ORDER BY FORM_ALL."YEAR" DESC, FORM_ALL.NUMBER_ID DESC';
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        $this->template->build('index_'.$template_id, $data);
    }
    
    public function form($menu_id, $id = null)
    {
        // case menu
        $template_id = $this->db->getone('select template_id from menus where id = '.$menu_id);
        
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
        $this->template->build('form_'.$template_id, $data);
    }
    
    public function save($menu_id)
    {
        if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));    
        }
        redirect('dla/index_'.$menu_id);
    }
    
    public function delete($menu_id, $id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('dla/index_'.$menu_id);
    }
}