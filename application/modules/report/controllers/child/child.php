<?php 
class Child extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_drop_model','drop');
	}
	
	public function drop()
	{
		$this->template->build('child/drop_index');
	}
}
?>