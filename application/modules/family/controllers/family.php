<?php
Class Family extends Public_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('opt_model', 'opt');
	}
	
	function warm(){
		$this->template->build('warm_index');
	}
	
	function warm_form(){
		$this->template->build('warm_form');
	}
	
	function violence()
	{
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
        $sql = 'SELECT 
          FORM_ALL."ID",
          FORM_ALL."YEAR",
          (FORM_ALL.T422) AS TOTAL_1,
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
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('violence_index', $data);
	}
	
	function violence_form($id = null)
	{
	    if($_POST)
        {
            //$this->db->debug = true;
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('family/violence');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('violence_form', $data);
	}
    
    function violence_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('family/violence');
    }
}
?>