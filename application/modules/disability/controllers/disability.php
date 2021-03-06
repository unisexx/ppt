<?php
Class Disability extends Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('d_identity_model','identity');
	}
	public $menu_id=39;
	function identity(){
		//$this->db->debug=TRUE;			
		$month=(!empty($_GET['month']) && empty($_GET['year']))? " AND  EXTRACT(MONTH FROM E_DATE) ='".$_GET['month']."'":'';
		$year =(!empty($_GET['year']) && empty($_GET['month'])) ? "  and EXTRACT(YEAR FROM E_DATE) ='".$_GET['year']."'":'';	
		$sql="   AND EXTRACT(MONTH FROM E_DATE) ='".@$_GET['month']."' OR EXTRACT(YEAR FROM E_DATE)='".@$_GET['year']."'";
		$all =(!empty($_GET['year']) && !empty($_GET['month'])) ? $sql :'';
		$data['result']=$this->identity->where("1=1 $month $year $all")->get();
		$data['pagination'] =$this->identity->pagination();
		$data['menu_id']=$this->menu_id;
		$this->template->build('identity_index',$data);
	}
	
	function identity_form($id=FALSE){
		$data['menu_id']=$this->menu_id;
		$data['rs'] = $this->identity->get_row($id);			
		$this->template->build('identity_form',$data);
	}
	function identity_save(){
		if(!menu::perm($this->menu_id, 'add') || !menu::perm($this->menu_id,'edit'))redirect('disability/identity');	
		$_POST['s_date']= (!empty($_POST['s_date'])) ? date_to_mysql($_POST['s_date'],TRUE):'';
		$_POST['e_date']= (!empty($_POST['e_date'])) ? date_to_mysql($_POST['e_date'],TRUE):'';
		if($_POST){
			$this->identity->save($_POST);
			 set_notify('success', lang('save_data_complete'));
		}	
		redirect('disability/identity');
	}
	function delete($id){
		if(!empty($id)){
			$this->identity->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('disability/identity');
	}
}
?>