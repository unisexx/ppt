<?php 
//===== Ref:child/elderly =====//
class Elderly extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hf_elderly_model', 'elderly');
		$this->load->model('hf_elderlylist_model', 'elderly_list');
	}
	
	public function index()
	{
		$cat_list_tmp = $this->elderly_list->get(false, true);
		foreach($cat_list_tmp as $cat_list_) $cat_list[] = $cat_list_['name']; 


		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->elderly->get('SELECT YEAR FROM HF_ELDERLY_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//

		//CONDITION SEARCH
		$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
		$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];



		if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);
		
		foreach($cat_list as $cat_list_)
		{
			$qry_catlist = '';
				if($cat_list_ == 'อื่น ๆ')
				{
					for($i=0; $i<count($cat_list); $i++)
						{
							if($cat_list[$i] != 'อื่น ๆ')
								{
									if(@$cat_list[$i+1] && $i != 0) $qry_catlist .= 'AND ';
									$qry_catlist .= "NAME NOT LIKE '".$cat_list[$i]."%' ";
								} 
						}
				} else {
					$qry_catlist .= "NAME LIKE'".$cat_list_."%'";
						if($cat_list_ == 'สถานสงเคราะห์เด็ก') $qry_catlist .= " AND NAME NOT LIKE 'สถานสงเคราะห์เด็กอ่อน%'";
				}
			$rs_catlist = $this->elderly_list->where($qry_catlist)->get(false, true);
			$HF_ELDERLY_list[] = $rs_catlist;
		}		
		
		foreach($HF_ELDERLY_list as $key=>$rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM HF_ELDERLY_DATA WHERE (';
			foreach($rs as $key2=>$rs2)
			{
				if($key2 != 0 && $key2-1 != count($rs)) $qry_data .= 'OR ';
				$qry_data .= "WLIST_ID LIKE '".$rs2['id']."' ";
			}
			$qry_data .= ')';
			
			$qry_data .= (empty($_GET['year']))?" AND YEAR LIKE '".$_GET['YEAR']."'":'';

			$wdata = $this->elderly->get($qry_data, true);
				$result[$key] = $wdata[0];
				$result[$key]['title'] = $cat_list[$key];
				$result[$key]['id'] = $key;
			}
						
			
			
			$qry_data .= (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';

		$data['result'] = $result;	
		$this->template->build('elderly/index', $data);
	}

	function export()
	{
		
		$cat_list_tmp = $this->elderly_list->get(false, true);
		foreach($cat_list_tmp as $cat_list_) $cat_list[] = $cat_list_['name']; 


		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->elderly->get('SELECT YEAR FROM HF_ELDERLY_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//

		//CONDITION SEARCH
		$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
		$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];



		if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);
		
		foreach($cat_list as $cat_list_)
		{
			$qry_catlist = '';
				if($cat_list_ == 'อื่น ๆ')
				{
					for($i=0; $i<count($cat_list); $i++)
						{
							if($cat_list[$i] != 'อื่น ๆ')
								{
									if(@$cat_list[$i+1] && $i != 0) $qry_catlist .= 'AND ';
									$qry_catlist .= "NAME NOT LIKE '".$cat_list[$i]."%' ";
								} 
						}
				} else {
					$qry_catlist .= "NAME LIKE'".$cat_list_."%'";
						if($cat_list_ == 'สถานสงเคราะห์เด็ก') $qry_catlist .= " AND NAME NOT LIKE 'สถานสงเคราะห์เด็กอ่อน%'";
				}
			$rs_catlist = $this->elderly_list->where($qry_catlist)->get(false, true);
			$HF_ELDERLY_list[] = $rs_catlist;
		}		
		
		foreach($HF_ELDERLY_list as $key=>$rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM HF_ELDERLY_DATA WHERE (';
			foreach($rs as $key2=>$rs2)
			{
				if($key2 != 0 && $key2-1 != count($rs)) $qry_data .= 'OR ';
				$qry_data .= "WLIST_ID LIKE '".$rs2['id']."' ";
			}
			$qry_data .= ')';
			
			$qry_data .= (empty($_GET['year']))?" AND YEAR LIKE '".$_GET['YEAR']."'":'';

			$wdata = $this->elderly->get($qry_data, true);
				$result[$key] = $wdata[0];
				$result[$key]['title'] = $cat_list[$key];
				$result[$key]['id'] = $key;
			}
						
			
			
			$qry_data .= (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';

		
		$filename= "disabled_report_data_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		$data['result'] = $result;	
		$this->load->view('elderly/export', $data);
	}
}

