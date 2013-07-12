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
		$cat_list = $this->disabled_list->get();
		foreach($cat_list as $cat_list_) $data['main_list'][$cat_list_['id']] = $cat_list_['name'];

		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//


		if(@$_GET['WLIST'] != '') $cat_list = array($cat_list[$_GET['WLIST']]);


		foreach($cat_list as $key=>$cat_list_) 
		{
			$disabled_list[] = $cat_list_;
			
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM DISABLED_DATA WHERE (';
				$qry_data .= "WLIST_ID LIKE '".$cat_list_['id']."'";
			$qry_data .= ')';
			
			$get_value = $this->disabled->get($qry_data, true);
			$get_value = $get_value[0];
			
			
			$result[$key]['id'] = $cat_list_['id'];
			$result[$key]['title'] = $cat_list_['name'];
			$result[$key]['target'] = (empty($get_value['target']))?0:$get_value['target'];
			$result[$key]['balance'] = (empty($get_value['balance']))?0:$get_value['balance'];
			$result[$key]['admission'] = (empty($get_value['admission']))?0:$get_value['admission'];
			$result[$key]['distribution'] = (empty($get_value['distribution']))?0:$get_value['distribution'];
			$result[$key]['remain'] = (empty($get_value['remain']))?0:$get_value['remain'];
			$result[$key]['build'] = (empty($get_value['build']))?0:$get_value['build'];
			
		}
		

		//CONDITION SEARCH
		$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
		$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];

		$data['result'] = $result;	
		$this->template->build('disabled/index', $data);

	}


	function report2()
	{
		$cat_list = $this->disabled_list->get();
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
	public function export_index($status=false)
		{
			$data[1] = 1;
		if($status!='print')
		{
			$filename= "disabled_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			
			logs('ดาวน์โหลดข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		} else {
			
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
		$cat_list = array("บ้านพักเด็กและครอบครัว", "ศูนย์สงเคราะห์และฝึกอาชีพเด็กและเยาวชน", "สถานคุ้มครองสวัสดิภาพเด็ก", "สถานพัฒนาและฟื้นฟูเด็ก", "สถานสงเคราะห์เด็กอ่อน", "สถานสงเคราะห์เด็ก", "อื่น ๆ");
		
		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM DISABLED_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//


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
			$rs_catlist = $this->disabled_list->where($qry_catlist)->get(false, true);
			$disabled_list[] = $rs_catlist;
		}		
		
		foreach($disabled_list as $key=>$rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM disabled_DATA WHERE (';
			foreach($rs as $key2=>$rs2)
			{
				if($key2 != 0 && $key2-1 != count($rs)) $qry_data .= 'OR ';
				$qry_data .= "WLIST_ID LIKE '".$rs2['id']."' ";
			}
			$qry_data .= ')';
			
			//CONDITION SEARCH
			$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
			$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
			$qry_data .= (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';

			
			$wdata = $this->disabled->get($qry_data, true);
				$result[$key] = $wdata[0];
				$result[$key]['title'] = $cat_list[$key];
				$result[$key]['id'] = $key;
			}
		
		$data['result'] = $result;	
		
		logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		$this->load->view('disabled/export',$data);
		}
	


	function export_index2($status=FALSE)
	{
		if($status!='print')
		{
			$filename= "disabled_report2_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			
			logs('ดาวน์โหลดข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		} else {
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
		$cat_list = array("บ้านพักเด็กและครอบครัว", "ศูนย์สงเคราะห์และฝึกอาชีพเด็กและเยาวชน", "สถานคุ้มครองสวัสดิภาพเด็ก", "สถานพัฒนาและฟื้นฟูเด็ก", "สถานสงเคราะห์เด็กอ่อน", "สถานสงเคราะห์เด็ก", "อื่น ๆ");
		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->disabled->get('SELECT YEAR FROM disabled_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++) $data['year_list'][$year_list[$i]['year']] = $year_list[$i]['year'];

		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
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
			$rs_catlist = $this->disabled_list->where($qry_catlist)->get(false, true);
			$disabled_list[] = $rs_catlist;
		}
		
		//CONDITION
			$_GET['WLIST'] = ((@!$_GET['WLIST'] && @$_GET['WLIST'] != 0) || @$_GET['WLIST'] == '')?NULL:$_GET['WLIST'];
			$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
			
		
		foreach($disabled_list as $rs)
		{
			foreach($rs as $key2=>$rs2)
			{
				$qry_rs2 = "SELECT TARGET, BALANCE, ADMISSION, DISTRIBUTION, REMAIN, BUILD FROM disabled_DATA WHERE WLIST_ID LIKE '".$rs2['id']."' AND YEAR LIKE '".$_GET['YEAR']."'";
				$tmp_result = $this->disabled->get($qry_rs2, false); $tmp_result = $tmp_result[0];
					$data['rs'][] = array(
						'title' => $rs2['name'],
						'target' => $tmp_result['target'],
						'balance' => $tmp_result['balance'],
						'admission' => $tmp_result['admission'],
						'distribution' => $tmp_result['distribution'],
						'remain' => $tmp_result['remain'],
						'build' => $tmp_result['build']);
			}
		}

		$this->load->view('disabled/export2', $data);
	}

}

