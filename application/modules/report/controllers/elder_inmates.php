<?php 
//===== Ref:child/welfare =====//
class Elder_inmates extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('elder_inmates_model', 'inmates');
		$this->load->model('elder_inmateslist_model', 'inmateslist');
		$this->load->model('province_model', 'province');
	}
	
	function index()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		
		$this->template->build('elder_inmates/index', $data);
	}
	
	
	function report2()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		$this->template->build('elder_inmates/index2', $data);
	}
}
