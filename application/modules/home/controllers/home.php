<?php
Class Home extends  Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->set_layout('login_page');
		$this->template->build('index');
	}
	
	function login($id=FALSE)
	{	   
		//$this->db->debug = true;
		if($_POST)
		{		
			if(login(trim($_POST['username']), trim($_POST['password'])))
			{
				//time_login_update($this->session->userdata('id'));
				redirect('setting/user');
			}
			else
			{
				//echo "AA";
				//$this->db->debug=true;
				//$status = $this->db->GetOne("select status from users where email = '".$_POST['email']."' and password = '".$_POST['password']."'");
				//if($status == 1){
//					set_notify('error', "คุณได้มีการใช้งานอยู่ในขณะนี้");
				//	redirect('user');
				//}else{
					//set_notify('error', LOGIN_FAIL);
					//redirect('user');	
				//}
			}	
		}
		redirect('home');
	}
	
	function logout()
	{
		logout();
		redirect('user');
	}
}
?>