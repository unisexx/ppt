<?php 
//===== Ref:datapoint/Mental =====//
class Mental extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mental_model', 'mental');
		$this->load->model('province_model', 'province');
	}
	
	function index()
	{
		$data[1] = 1;
		$data['tbl_head'] = array("โรคจิต", "โรควิตกกังวล และเพศ", "โรคซึมเศร้า", "ปัญญาอ่อน", "โรคลมชัก", "ผู้ติดสารเสพติด", "ปัญหาสุขภาพจิตอื่น ๆ", "ผู้พยายามฆ่าตัวตายหรือฆ่าตัวตาย", "ออติสติก", "รวมทั้งหมด");
		$set_y = $this->mental->get("SELECT YEAR FROM MENTAL_NUMBER GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_y); $i++) { $data['set_y'][$set_y[$i]['year']] = $set_y[$i]['year']; }
		for($i=0; $i<count($set_y); $i++) { $data['year_list'][] = $set_y[$i]['year']; }
		
		if(@$_GET['province']) { $data['province_'] = $this->province->get("SELECT * FROM PROVINCES WHERE ID LIKE '".$_GET['province']."'"); }
		#$data['set_year'] = $this->mental->get("SELECT YEAR FROM MENTAL_NUMBER GROUP BY YEAR ORDER BY YEAR DESC");
		
		
		#for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		/*
				
		$set_province = $this->crime_station->limit(1000)->get("SELECT STATION FROM CRIME_STATION GROUP BY STATION ORDER BY STATION ASC");
		for($i=0; $i<count($set_province); $i++) { $data['set_province'][] = $set_province[$i]['station']; }
		*/
		
		
		$this->template->build('mental/index', $data);
	}
	
	
	function report2()
	{
		$set_year = $this->inmates->get("SELECT YEAR FROM ELDER_INMATES GROUP BY YEAR ORDER BY YEAR DESC");
		for($i=0; $i<count($set_year); $i++) { $data['set_year'][] = $set_year[$i]['year']; }
		$this->template->build('elder_inmates/index2', $data);
	}
}
