<?php 
class Report extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->template->build('index');
	}
}
