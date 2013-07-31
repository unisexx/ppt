<?php
Class Poor_province extends Public_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('poor_province_model', 'opt');
	}
	

	
	function province_data()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND POOL_PROVINCE."POOR_PROVINCE_YEAR" = '.$_GET['year'];
        }
        $sql = 'SELECT
*
FROM
POOL_PROVINCE
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
		
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('province_index', $data);
	}
	
	function province_form($id = null){
	    if($_POST)
        {
            $this->opt->save($_POST);
            set_notify('success', lang('save_data_complete'));
            redirect('poor_province/province_data');
        }
        $data['rs'] = $this->opt->get_row($id);
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('province_form', $data);
	}

    function province_delete($id)
    {
        if(!empty($id))
        {
            $this->opt->delete($id);
            set_notify('success', lang('delete_data_complete'));
        }
        redirect('poor_province/province_data');
    }
	
	function import_data()
	{
		$data['menu_id'] = 73; 	
		$this->template->build('population_import_form',$data);	
	}
	
	function poor_province_import()
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
		   $file_name = 'poor_province_'.date("Y_m_d_H_i_s").'.'.$ext;
		   $uploaddir = 'import_file/poor_province/';
		   $fpicname = $uploaddir.$file_name;
		   move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
		   
				
				$data['file_upload'] = $file_name;
		
		
		$this->template->build('province_import',$data);	
	}
	
	function poor_report()
	{
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND POOR_PROVINCE_YEAR = '.$_GET['year'];
        }
        $sql = 'SELECT
		*
		FROM
		POOL_PROVINCE
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
        $data['result'] = $this->opt->get($sql,TRUE);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->append_metadata('<link href="media/css/style.css" rel="stylesheet">');
		$this->template->build('disadvantaged1', $data);	
	}
	
	function poor_province_export()
	{
		
		$this->load->view('poor_export');
	}
	
	function poor_province_print()
	{
		
		$this->load->view('poor_print');
		//$this->template->build('poor_print');	
	}

}
?>