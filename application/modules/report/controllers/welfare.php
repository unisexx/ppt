<?php 
//===== Ref:child/welfare =====//
class Welfare extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('welfarelist_model', 'welfare_list');
		$this->load->model('welfare_model', 'welfare');
	}
	
	public function index()
	{
		$data['sql'] = 'SELECT * FROM WELFARE_LIST WHERE 1=1 ';
			$data['sql'] .= (@$_GET['WLIST'])?"AND ID LIKE '".$_GET['WLIST']."'":'';
		$data['sql'] .= 'ORDER BY NAME ASC ';
		$data['list'] = $this->welfare_list->limit(100)->get($data['sql']);
		
		$this->template->build('welfare/index', $data);
	}
}
