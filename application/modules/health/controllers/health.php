<?php
Class Health extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('health_model', 'opt');
	}
	

	
	function health_data()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND HEALTH.HEALTH_YEAR = '.$_GET['year'];
        }
		
        $sql = 'SELECT *
			FROM
			HEALTH 
		WHERE 1=1 '.$where.' 
        ORDER BY HEALTH.ID ASC';
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('health_index', $data);
	}
	
	function health_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('health/health_data');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('health_form', $data);
	}

    function health_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('health/health_data');
    }
	
	function import_data()
	{
		$data['menu_id'] = 59; 	
		$this->template->build('health_import_form',$data);	
	}
	
	function health_import()
	{
		
				//-- update info
		$this->load->model('one_info_model', 'opt_info');
		
							$data_info = array(
						  
							   "year" => $this->input->post("year_data"), 
							   "agency_id" => $this->input->post("import_section_id"), 
							   "month_start" => $this->input->post("month_start"),
							   "year_start" => $this->input->post("year_start"),
							   "month_end" => $this->input->post("month_end"),
							   "year_end" => $this->input->post("year_end"),
							   "menu_id" => $this->input->post("menu_id")
							);
							
		$this->opt_info->save($data_info);
		//-----
	
		
		   $ext = pathinfo($_FILES['fl_import']['name'], PATHINFO_EXTENSION);
		   $file_name = 'health_'.date("Y_m_d_H_i_s").'.'.$ext;
		   $uploaddir = 'import_file/health/';
		   $fpicname = $uploaddir.$file_name;
		   move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
		   
				
				$data['file_upload'] = $file_name;
		
		
		$this->template->build('health_import',$data);	
	}
	
	function health_report()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND HEALTH.HEALTH_YEAR = '.$_GET['year'];
        }
		
        $sql = 'SELECT *
			FROM
			HEALTH 
		WHERE 1=1 '.$where.' 
        ORDER BY HEALTH.ID ASC';
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->append_metadata('<link href="media/css/style.css" rel="stylesheet">');
		$this->template->build('disadvantaged1', $data);	
	}
	
	function health_export($year=null)
	{
		
		
		$where = '';

            
        if(!empty($year)) $where .= ' AND HEALTH."HEALTH_YEAR" = '.$year;
      
        $sql = 'SELECT
		*
		FROM
		HEALTH
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
		
		$data['year'] = $year;
		
		$data['result'] = $this->opt->get($sql);
		
		$this->load->view('health_export',$data);
	}
	
	function health_print($year=null)
	{
		$where = '';

            
        if(!empty($year)) $where .= ' AND HEALTH."HEALTH_YEAR" = '.$year;
      
        $sql = 'SELECT
		*
		FROM
		HEALTH
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
		
		$data['year'] = $year;
		
		$data['result_ex'] = $this->opt->get($sql);		
		
		
		$this->load->view('health_print',$data);
		//$this->template->build('poor_print');	
	}

}
?>