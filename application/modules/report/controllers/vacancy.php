<?php 
//===== Ref:disadvantaged/vacancy =====//
class Vacancy extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vacancy_model', 'vacancy');
		$this->load->model('province_model', 'province');
	}
	
	function index()
	{
		$data[1] = 1;
		
		$set_y = $this->vacancy->get("SELECT YEAR FROM VACANCY GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i < count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		$data['tbl_head'] = array("ปี", "คนว่างงาน", "คนสมัครงาน", "คนบรรจุงาน");
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }
		/*
		$set_y = $this->vacancy->get("SELECT YEAR FROM VACANCY GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_y); $i++) { $data['set_y'][$set_y[$i]['year']] = $set_y[$i]['year']; }
		for($i=0; $i<count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }

		*/
		
		$this->template->build('vacancy/index', $data);
	}
	
	
}
