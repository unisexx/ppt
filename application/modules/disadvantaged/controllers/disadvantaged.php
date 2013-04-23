<?php
Class Disadvantaged extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('province_model', 'province');
		
		$this->load->model('unemployee_model', 'unemployee');
		$this->load->model('vacancy_model', 'vacancy');
	}
	//========== UNEMPLOYEE ==========//
	function unemployee(){
		$sql = 'SELECT * FROM UNEMPLOYEE WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->unemployee->get($sql);
    	$data['pagination'] = $this->unemployee->pagination;
		
		$this->template->build('unemployee/unemployee_index', $data);
	}
	
	function unemployee_form($id=FALSE){
		$wlist = $this->db->execute('SELECT * FROM UNEMPLOYEE');
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->unemployee->get_row($id);
		}
		
		$this->template->build('unemployee/unemployee_form', $data);
	}
		function unemployee_save()
		{
			$this->unemployee->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/unemployee');
		}
	function unemployee_delete($id=FALSE)
	{
		if($id)
		{
			$this->unemployee->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/unemployee');
		}
		
	}
	//========== UNEMPLOYEE ==========//

	
	
	//========== VACANCY ==========//
	function vacancy(){
		$sql = 'SELECT * FROM VACANCY WHERE 1=1 ';
			if(@$_GET['YEAR']) $sql .= "AND YEAR = ".$_GET['YEAR'].' ';
			if(@$_GET['PROVINCE']) $sql .= "AND PROVINCE_ID = ".$_GET['PROVINCE'].' ';
		$sql .= 'ORDER BY YEAR DESC, PROVINCE_ID ASC';
		
		$data['result'] = $this->vacancy->get($sql);
    	$data['pagination'] = $this->vacancy->pagination;
		
		$this->template->build('vacancy/vacancy_index', $data);
	}	
	function vacancy_form($id=FALSE){
		$data['id'] = @$id;
		if(@$id)
		{
			$data['result'] = $this->vacancy->get_row($id);
		}
		
		$this->template->build('vacancy/vacancy_form', $data);
	}
		function vacancy_save()
		{
			$this->vacancy->save($_POST);
			set_notify('success', lang('save_data_complete'));
			redirect('disadvantaged/vacancy');
		}
	function vacancy_delete($id=FALSE)
	{
		if($id)
		{
			$this->vacancy->delete($id);
            set_notify('success', lang('delete_data_complete'));
			redirect('disadvantaged/vacancy');
		}
		
	}
	//========== VACANCY ==========//
				
	function social(){
		$this->template->build('social_index');
	}
	
	function social_form(){
		$this->template->build('social_form');
	}
	
	function province(){
		$this->template->build('province_index');
	}
	
	function province_form(){
		$this->template->build('province_form');
	}
	
	function allage(){
		$this->template->build('allage_index');
	}
	
	function allage_form(){
		$this->template->build('allage_form');
	}
}
?>