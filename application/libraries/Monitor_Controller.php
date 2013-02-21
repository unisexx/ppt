<?php
class Monitor_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		
		// set theme
		$this->template->set_theme('monitor');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('ระบบบงานริหารราชการ ระบบงานติดตามและประเมินผล (Monitoring System) กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
	}
	
}
?>