<?php
Class Offense extends Public_Controller{
    
    public $menu_id = 14;
    
	function __construct(){
		parent::__construct();
        $this->load->model('offense_model', 'opt');
		$this->load->model('province_model', 'pmd');
		
		//$this->load->database();
	}
	

	
	function offense_data()
	{
	   $data['menu_id'] = $this->menu_id;
        $where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND OFFENSES."OFFENSE_YEAR" = '.$_GET['year'];
			
			if(!empty($_GET['province_id']))
			{
				$tbpro = $this->pmd->get("select * from provinces where id=".$_GET['province_id']);
			    foreach($tbpro as $key1 => $item1)
			  	{
				  $name_pro = $item1['province'];
				  
				}
				
				
				$where .= " AND OFFENSES.OFFENSE_PROVINCE = '".$name_pro."' ";		
			}
			
        }
        $sql = 'SELECT *
        FROM OFFENSES
        WHERE 1=1 '.$where.'         
        ORDER BY OFFENSE_YEAR DESC';
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
        $data['menu_id'] = $this->menu_id;
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
	
	function import_data()
	{
		$data['menu_id'] = 14; 	
		$this->template->build('population_import_form',$data);	
	}
	
	function offense_import()
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
		   $file_name = 'offense_'.date("Y_m_d_H_i_s").'.'.$ext;
		   $uploaddir = 'import_file/offense/';
		   $fpicname = $uploaddir.$file_name;
		   move_uploaded_file($_FILES['fl_import']['tmp_name'], $fpicname);
		   
				
				$data['file_upload'] = $file_name;
				
		$this->template->build('child_offense_import',$data);	
	}
	
	function offense_report()
	{
		$where = '';
        if(!empty($_GET))
        {
            
            if(!empty($_GET['year'])) $where .= ' AND OFFENSES."OFFENSE_YEAR" = '.$_GET['year'];
            //if(!empty($_GET['province_id'])) $where .= ' AND OFFENSES.OFFENSE_PROVINCE = '.$_GET['province_id'];
			
			if(!empty($_GET['province_id']))
			{
				$tbpro = $this->pmd->get("select * from provinces where id=".$_GET['province_id']);
			    foreach($tbpro as $key1 => $item1)
			  	{
				  $name_pro = $item1['province'];
				  
				}
				
				$where .= " AND OFFENSES.OFFENSE_PROVINCE = '".$name_pro."' ";	
			}
			
			
        }
        $sql = 'SELECT
		*
		FROM
		OFFENSES
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
        $data['result'] = $this->opt->get($sql,TRUE);
        //$data['pagination'] = $this->opt->pagination;
		$this->template->append_metadata('<script type="text/javascript" src="media/js/jquery.chainedSelect.min.js"></script>');
		$this->template->append_metadata('<link href="media/css/style.css" rel="stylesheet">');
		$this->template->build('xchild2', $data);	
	}
	
	function offense_export($year=null,$province=null,$type=null)
	{
		
		$where = '';

            
        if(!empty($year)) $where .= ' AND OFFENSES."OFFENSE_YEAR" = '.$year;
        if(!empty($province)) $where .= ' AND OFFENSES.OFFENSE_PROVINCE = '.$province;
      
        $sql = 'SELECT
		*
		FROM
		OFFENSES
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
		
		$data['year'] = $year;
		$data['province'] = $province;
		$data['type'] = $type;
		
		$data['result'] = $this->opt->get($sql);
	
		$this->load->view('offense_export',$data);
	}
	

	function offense_print($year=null,$province=null,$type=null)
	{
		
		$where = '';

            
        if(!empty($year)) $where .= ' AND OFFENSES."OFFENSE_YEAR" = '.$year;
        if(!empty($province)) $where .= ' AND OFFENSES.OFFENSE_PROVINCE = '.$province;
      
        $sql = 'SELECT
		*
		FROM
		OFFENSES
		WHERE 1=1 '.$where.' 
        ORDER BY ID ASC';
		
		$data['year'] = $year;
		$data['province'] = $province;
		$data['type'] = $type;
		
		$data['result'] = $this->opt->get($sql);
		$this->load->view('offense_print',$data);	
	}


}
?>