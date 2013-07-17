<?php
Class Alien_nation extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('alien_nation_model', 'opt');
	}
	

	
	function alien_nation_data()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND ALIEN_NATION.ALIEN_YEAR = '.$_GET['year'];
        }
		
		$tmp_yl = $this->opt->get("SELECT ALIEN_YEAR FROM ALIEN_NATION GROUP BY ALIEN_YEAR ORDER BY ALIEN_YEAR DESC");
		foreach($tmp_yl as $tmp_) $data['year_list'][$tmp_['alien_year']] = $tmp_['alien_year'];

			
        $sql = 'SELECT *
			FROM
			ALIEN_NATION 
		WHERE 1=1 '.$where.' 
        ORDER BY ALIEN_NATION.ID ASC';
        // WHERE (FORM_ALL.T4161_M + FORM_ALL.T4161_F + FORM_ALL.T4162_M + FORM_ALL.T4162_F + FORM_ALL.T4163_M + FORM_ALL.T4163_F + FORM_ALL.T4164_M + FORM_ALL.T4164_F + FORM_ALL.T4165_M + FORM_ALL.T4165_F) > 0
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('alien_nation_index', $data);
	}
	
	function alien_nation_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('alien_nation/alien_nation_data');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('alien_nation_form', $data);
	}

    function alien_nation_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('alien_nation/alien_nation_data');
    }
	
	function import_data()
	{
		$data['menu_id'] = 109; 	
		$this->template->build('alien_nation_import_form',$data);	
	}
	
	function alien_nation_import()
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
		   $file_name = 'alien_nation_'.date("Y_m_d_H_i_s").'.'.$ext;
		   $uploaddir = 'import_file/alien_nation/';
		   $fpicname = $uploaddir.$file_name;
		   move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
		   
				
				$data['file_upload'] = $file_name;
		
		
		$this->template->build('alien_nation_import',$data);	
	}
	
	function alien_nation_report()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND ALIEN_NATION.ALIEN_YEAR = '.$_GET['year'];
        }
		
        $sql = 'SELECT *
			FROM
			ALIEN_NATION 
		WHERE 1=1 '.$where.' 
        ORDER BY ALIEN_NATION.ID ASC';
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->append_metadata('<link href="media/css/style.css" rel="stylesheet">');
		$this->template->build('disadvantaged1', $data);	
	}
	
	function alien_nation_export()
	{
		
		$this->load->view('alien_nation_export');
	}
	
	function alien_nation_print()
	{
		
		$this->load->view('alien_nation_print');
		//$this->template->build('poor_print');	
	}

}
?>