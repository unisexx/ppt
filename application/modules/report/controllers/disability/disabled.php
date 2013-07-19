<?php 
//===== Ref:child/disabled =====//
class Disabled extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('disabledlist_model', 'disabled_list');
		$this->load->model('disabled_model', 'disabled');
	}
	
	public function index()
	{
		$cat_list = $this->disabled_list->get(false, true);
		foreach($cat_list as $cat_list_) $data['main_list'][$cat_list_['id']] = $cat_list_['name'];
		
		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC', true);
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
		$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
		

		if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);
		
		if(empty($_GET['WLIST'])) {
			$dlist = "SELECT * FROM DISABLED_LIST WHERE 1=1";
		} else {
			$dlist = "SELECT * FROM DISABLED_LIST WHERE ID LIKE '".$_GET['WLIST']."'";
		}
		$dlist .= " ORDER BY ID ASC";
		$dlist = $this->disabled_list->get($dlist, true);
		
		foreach($dlist as $rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM DISABLED_DATA WHERE ';
			$qry_data .= "WLIST_ID LIKE '".$rs['id']."'";
				$qry_data .= (empty($_GET['YEAR']))?"":" AND YEAR LIKE '".$_GET['YEAR']."'";
			
			$ddata = $this->disabled->get($qry_data, true);
			$ddata = $ddata[0];
			$result[] = array(
				'id'=>$rs['id'],
				'title'=>$rs['name'],
				'target'=>(empty($ddata['target']))?0:$ddata['target'],
				'balance'=>(empty($ddata['balance']))?0:$ddata['balance'],
				'admission'=>(empty($ddata['admission']))?0:$ddata['admission'],
				'distribution'=>(empty($ddata['distribution']))?0:$ddata['distribution'],
				'remain'=>(empty($ddata['remain']))?0:$ddata['remain'],
				'build'=>(empty($ddata['build']))?0:$ddata['build']
			);
		}
		//CONDITION SEARCH

		$data['result'] = $result;	
		$this->template->build('disabled/index', $data);

	}
	

	function index2()
	{
		$cat_list = $this->disabled_list->get(false, true);
		foreach($cat_list as $cat_list_) $data['main_list'][$cat_list_['id']] = $cat_list_['name'];

		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		$wf_qry = "SELECT WL.NAME title, WD.* FROM DISABLED_LIST WL JOIN DISABLED_DATA WD ON WL.ID = WD.WLIST_ID WHERE 1=1 ";
			if(@$data['main_list'][$_GET['WLIST']]) {
					$wf_qry .= "AND (WL.NAME LIKE '".$data['main_list'][$_GET['WLIST']]."%')";
			}
		$wf_qry .= (empty($_GET['YEAR']))?'':"AND WD.YEAR LIKE '".$_GET['YEAR']."'";
		$wf_qry .= " ORDER BY WL.NAME ASC";
		
		$wf_list = $this->disabled_list->get($wf_qry, true);
		$data['rs'] = $wf_list;
		
		$this->template->build('disabled/index2', $data);
	}

	
	public function export()
	{
		$cat_list = $this->disabled_list->get();
		foreach($cat_list as $cat_list_) $data['main_list'][$cat_list_['id']] = $cat_list_['name'];
		
		

		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
		$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
		

		if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);
		
		if(empty($_GET['WLIST'])) {
			$dlist = "SELECT * FROM DISABLED_LIST WHERE 1=1";
		} else {
			$dlist = "SELECT * FROM DISABLED_LIST WHERE ID LIKE '".$_GET['WLIST']."'";
		}
		$dlist .= " ORDER BY NAME ASC";
		$dlist = $this->disabled_list->get($dlist);
		
		foreach($dlist as $rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM DISABLED_DATA WHERE ';
			$qry_data .= "WLIST_ID LIKE '".$rs['id']."'";
			
			$ddata = $this->disabled->get($qry_data);
			$ddata = $ddata[0];
			$result[] = array(
				'id'=>$rs['id'],
				'title'=>$rs['name'],
				'target'=>(empty($ddata['target']))?0:$ddata['target'],
				'balance'=>(empty($ddata['balance']))?0:$ddata['balance'],
				'admission'=>(empty($ddata['admission']))?0:$ddata['admission'],
				'distribution'=>(empty($ddata['distribution']))?0:$ddata['distribution'],
				'remain'=>(empty($ddata['remain']))?0:$ddata['remain'],
				'build'=>(empty($ddata['build']))?0:$ddata['build']
			);
		}
		//CONDITION SEARCH
		
		$filename= "disabled_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
		$data['result'] = $result;	
		$this->load->view('disabled/export',$data);
	}

	function export2()
	{
		$cat_list = $this->disabled_list->get(false, true);
		foreach($cat_list as $cat_list_) $data['main_list'][$cat_list_['id']] = $cat_list_['name'];

		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		$wf_qry = "SELECT WL.NAME title, WD.* FROM DISABLED_LIST WL JOIN DISABLED_DATA WD ON WL.ID = WD.WLIST_ID WHERE 1=1 ";
			if(@$data['main_list'][$_GET['WLIST']]) {
					$wf_qry .= "AND (WL.NAME LIKE '".$data['main_list'][$_GET['WLIST']]."%')";
			}
		$wf_qry .= (empty($_GET['YEAR']))?'':"AND WD.YEAR LIKE '".$_GET['YEAR']."'";
		$wf_qry .= " ORDER BY WL.NAME ASC";
		
		$wf_list = $this->disabled_list->get($wf_qry, true);
		$data['rs'] = $wf_list;
	
		$filename= "disabled_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		$this->load->view('disabled/export2', $data);
	}
}

