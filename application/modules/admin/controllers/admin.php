<?php
Class Admin extends  Public_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->load->view('login_page');
	}
	
	function login($id=FALSE)
	{	   
		//$this->db->debug = true;
		if($_POST)
		{		
			if(login(trim($_POST['username']), trim($_POST['password'])))
			{
				//time_login_update($this->session->userdata('id'));
				set_notify('success', "ยินดีต้อนรับเข้าสู่ระบบ");
				redirect('home');
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
				
				set_notify('error', LOGIN_FAIL);
				redirect('admin');	
			}	
		}
		redirect('admin');
	}
	
	function logout()
	{
		logout();
		set_notify('error', "ออกจากระบบเรียบร้อย");
		redirect('home');
	}
}
?>