<?php
class Admin_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		
		// check login
		//if(!is_login()) redirect('user/login');
		
		/*if(is_login()==FALSE){
			redirect('user');
		}else{
			$this->load->model('user/user_model');		
			$this->load->library('session');
			$this->usertype =login_data('usertypes.name');
			$this->usertypeid=login_data('usertypes.id');	
			$this->id = $this->session->userdata('id');
		    $this->session->set_userdata('usertypeid',$this->usertypeid);
			
		
		}*/
		
		
		
		// check department
		///if(login_data('dpc_id')!=1) redirect('user/profile');
		
		// set theme
		$this->template->set_theme('bo');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('ระบบบงานริหารราชการ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
	}
	
}
?>