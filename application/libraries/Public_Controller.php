<?php
class Public_Controller extends Controller
{
	function __construct()
	{
		parent::__construct();	
		
		// check login
		//if(!is_login()) redirect('user/inc_index');
		
		// set theme
		$this->template->set_theme('ppt');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('ระบบฐานข้อมูลทางสังคม สป.พม.');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
		// Set language
		$this->lang->load('admin');
	}
}
?>