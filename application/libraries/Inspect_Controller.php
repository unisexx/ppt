<?php
class Inspect_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		
		// set theme
		$this->template->set_theme('inspect');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('ระบบบงานริหารราชการ ระบบงานตรวจราชการ (Inspecting System) กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
	}
	
}
?>