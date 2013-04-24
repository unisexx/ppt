<?php
Class Poor_age extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('poor_model', 'opt');
	}
	
	
	function allage()
	{
	    $where = '';
        if(!empty($_GET))
        {
/*            if(!empty($_GET['keyword']))
            {
                $where .= " AND ( FORM_ALL.NUMBER_ID LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.C_NAME LIKE '%".$_GET['keyword']."%'";
                $where .= " OR FORM_ALL.OPT_NAME LIKE '%".$_GET['keyword']."%' )";
            }*/
            
            if(!empty($_GET['year'])) $where .= ' AND POOL_AGE_LIST."YEAR" = '.$_GET['year'];
        }
        $sql = 'SELECT
		*
		FROM
		POOL_AGE_LIST
		WHERE 1=1 '.$where.' 
        ORDER BY ID DESC';
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('allage_index', $data);
	}
	
	function allage_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('poor_age/allage');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('allage_form', $data);
	}

    function allage_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('poor_age/allage');
    }
	

	
	
}
?>