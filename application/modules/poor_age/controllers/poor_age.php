<?php
Class Poor_age extends Public_Controller{
    
    public $menu_id = 73;
    
	function __construct(){
		parent::__construct();
        $this->load->model('poor_model', 'opt');
	}
	
	
	function allage()
	{
	    $data['menu_id'] = $this->menu_id;
	    $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND POOL_AGE_LIST."YEAR" = '.$_GET['year'];
        }
        $sql = 'SELECT
		*
		FROM
		POOL_AGE_LIST
		WHERE 1=1 '.$where.' 
        ORDER BY YEAR DESC';
        $data['result'] = $this->opt->get($sql);
        $data['pagination'] = $this->opt->pagination;
        $this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->build('allage_index', $data);
	}
	
	function allage_form($id = null){
	    $data['menu_id'] = $this->menu_id;
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
	
	
	
	function import_data()
	{
		$data['menu_id'] = $this->menu_id;
		$this->template->build('population_import_form',$data);	
	}
	
	function pool_age_import()
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
		   $file_name = 'poor_age_'.date("Y_m_d_H_i_s").'.'.$ext;
		   $uploaddir = 'import_file/poor_age/';
		   $fpicname = $uploaddir.$file_name;
		   move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
		   
				
				$data['file_upload'] = $file_name;
		
		$this->template->build('pool_age_import',$data);	
	}
	
	
}
?>