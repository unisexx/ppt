<?php
Class Disability extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('d_identity_model','identity');
	}
	
	function identity(){
		$data['result']=$this->identity->get();
		$data['pagination'] =$this->identity->pagination();
		$this->template->build('identity_index',$data);
	}
	
	function identity_form($id=FALSE){
		
		$data['rs'] = $this->identity->get_row($id);			
		$this->template->build('identity_form',$data);
	}
	function identity_save(){
		$this->db->debug=TRUE;	
		$_POST['s_date']= (!empty($_POST['s_date'])) ? date_to_mysql($_POST['s_date']):'';
		$_POST['e_date']= (!empty($_POST['e_date'])) ? date_to_mysql($_POST['e_date']):'';
		if($_POST){
			$this->identity->save($_POST);
			 set_notify('success', lang('save_data_complete'));
		}	
		redirect('disability/identity');
	}
	function identity_delete($id){
		if(!empty($id)){
			$this->identity->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('disability/identity');
	}
}
?>