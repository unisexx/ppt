<?php
class Olderfund extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_drop_model','drop');
		$this->load->model('pregnant_model','pregnant');
		$this->load->model('province_model','province');
		$this->load->model('amphur_model','amphur');
		$this->load->model('district_model','district');
		$this->load->model('population_model','population');
	}
	public function index()
	{

	}
}