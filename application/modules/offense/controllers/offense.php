<?php
Class Offense extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('offense_model', 'opt');
	}
	

	
	function offense_data()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND OFFENSES."OFFENSE_YEAR" = '.$_GET['year'];
            if(!empty($_GET['province_id'])) $where .= ' AND OFFENSES.OFFENSE_PROVINCE = '.$_GET['province_id'];
            if(!empty($_GET['amphur_id'])) $where .= ' AND OFFENSES.OFFENSE_AUMPHUR = '.$_GET['amphur_id'];
        }
        $sql = 'SELECT
		*
		FROM
		OFFENSES
		WHERE 1=1 '.$where.' 
        ORDER BY ID DESC';
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('offense_index', $data);
	}
	
	function offense_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('offense/offense_data');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('offense_form', $data);
	}

    function offense_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('offense/offense_data');
    }
	

}
?>