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
		$cat_list = array("บ้านพักเด็กและครอบครัว", "ศูนย์สงเคราะห์และฝึกอาชีพเด็กและเยาวชน", "สถานคุ้มครองสวัสดิภาพเด็ก", "สถานพัฒนาและฟื้นฟูเด็ก", "สถานสงเคราะห์เด็กอ่อน", "สถานสงเคราะห์เด็ก", "อื่น ๆ");
		
		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
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
			$rs_catlist = $this->welfare_list->where($qry_catlist)->get(false, true);
			$welfare_list[] = $rs_catlist;
		}		
		
		foreach($welfare_list as $key=>$rs)
		{
			$qry_data = 'SELECT SUM(TARGET) target, SUM(BALANCE) balance, SUM(ADMISSION) admission, SUM(DISTRIBUTION) distribution, SUM(REMAIN) remain, SUM(BUILD) build FROM WELFARE_DATA WHERE (';
			foreach($rs as $key2=>$rs2)
			{
				if($key2 != 0 && $key2-1 != count($rs)) $qry_data .= 'OR ';
				$qry_data .= "WLIST_ID LIKE '".$rs2['id']."' ";
			}
			$qry_data .= ')';
			
			//CONDITION SEARCH
			$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
			$qry_data .= (@$_GET['YEAR'])?"AND YEAR LIKE '".$_GET['YEAR']."'":'';

			
			$wdata = $this->welfare->get($qry_data, true);
				$result[$key] = $wdata[0];
				$result[$key]['title'] = $cat_list[$key];
				$result[$key]['id'] = $key;
			}
		
		$data['result'] = $result;	
		$this->template->build('welfare/index', $data);

	}


	function report2()
	{
		$cat_list = array("บ้านพักเด็กและครอบครัว", "ศูนย์สงเคราะห์และฝึกอาชีพเด็กและเยาวชน", "สถานคุ้มครองสวัสดิภาพเด็ก", "สถานพัฒนาและฟื้นฟูเด็ก", "สถานสงเคราะห์เด็กอ่อน", "สถานสงเคราะห์เด็ก", "อื่น ๆ");
		$data['main_list'] = $cat_list;
		//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
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
			$rs_catlist = $this->welfare_list->where($qry_catlist)->get(false, true);
			$welfare_list[] = $rs_catlist;
		}
		
		//CONDITION
			$_GET['YEAR'] = (@!$_GET['YEAR'])?$year_list[0]['year']:$_GET['YEAR'];
			
		
		foreach($welfare_list as $rs)
		{
			foreach($rs as $key2=>$rs2)
			{
				$qry_rs2 = "SELECT TARGET, BALANCE, ADMISSION, DISTRIBUTION, REMAIN, BUILD FROM WELFARE_DATA WHERE WLIST_ID LIKE '".$rs2['id']."' AND YEAR LIKE '".$_GET['YEAR']."'";
				$tmp_result = $this->welfare->get($qry_rs2, false); $tmp_result = $tmp_result[0];
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
		$this->template->build('welfare/index2', $data);
	}

	function export_index($status=FALSE)
	{
		$data[1] = 1;
		if($status!='print')
		{
			$filename= "welfare_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			
			logs('ดาวน์โหลดข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		} else {
			
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
			//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][] = $year_list[$i]['year'];
		}
		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		
		//===== welfare list group =====//
		$data['list'] = $this->welfare_list->limit(100)->get('SELECT * FROM WELFARE_LIST WHERE 1=1 ORDER BY NAME ASC ');
		for($i=0; $i<count($data['list']); $i++)
		{


			$exp_list = explode('จังหวัด', $data['list'][$i]['name']);
			if(!@$exp_list[1]) { $exp_list = explode('ภาค', $data['list'][$i]['name']);}
			if(!@$exp_list[1]) { $exp_list = explode('บ้าน', $data['list'][$i]['name']); }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กหญิง', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กหญิง'; }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กอ่อน', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กอ่อน'; }
			$exp_list[0] = ($exp_list[0] == '')?@$cut_word:$exp_list[0];
			
			if(@$exp_list[1])
			{
				if($exp_list[0] == '') { $exp_list[0] = $data['list'][$i]['name']; }
				if(@$main_list)
				{
					if(!in_array($exp_list[0], $main_list)) { $main_list[] = $exp_list[0]; }
					else { $exp_list[0]; }
				} 
				else { $main_list[] = $exp_list[0]; }
			}
		}
		$data['main_list'] = $main_list;
		$wlist = @$data['main_list'][$_GET['WLIST']];
		//===== welfare list group =====//

				
		$data['sql'] = 'SELECT * FROM WELFARE_LIST WHERE 1=1 ';
			$data['sql'] .= (@$wlist)?"AND NAME LIKE '%".$wlist."%' ":'';
		$data['sql'] .= 'ORDER BY NAME ASC';
		unset($data['list']);
		
		$data['list'] = $this->welfare_list->get($data['sql']);
		
		logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		$this->load->view('welfare/export',$data);
	}

	function export_index2($status=FALSE)
	{
		if($status!='print')
		{
			$filename= "welfare_report2_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
			
			logs('ดาวน์โหลดข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		} else {
			?><script>window.print();</script><?
			logs('พิมพ์ข้อมูล เด็กและเยาวชนที่อยู่ในสถานอุปการะของสถานสงเคราะห์');
		}
		?><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><?
		
		
			//===== set year list group =====//
		$year_list = $this->welfare->get('SELECT YEAR FROM WELFARE_DATA GROUP BY YEAR ORDER BY YEAR DESC');
		for($i=0; $i<count($year_list); $i++)
		{
			$data['year_list'][] = $year_list[$i]['year'];
		}
		$data['ylist'] = @$data['year_list'][$_GET['YEAR']];
		//===== set year list group =====//
		
		//===== welfare list group =====//
		$data['list'] = $this->welfare_list->limit(100)->get('SELECT * FROM WELFARE_LIST WHERE 1=1 ORDER BY NAME ASC ');
		for($i=0; $i<count($data['list']); $i++)
		{
			$exp_list = explode('จังหวัด', $data['list'][$i]['name']);
			if(!@$exp_list[1]) { $exp_list = explode('ภาค', $data['list'][$i]['name']);}
			if(!@$exp_list[1]) { $exp_list = explode('บ้าน', $data['list'][$i]['name']); }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กหญิง', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กหญิง'; }
			if(!@$exp_list[1]) { $exp_list = explode('สถานสงเคราะห์เด็กอ่อน', $data['list'][$i]['name']); $cut_word = 'สถานสงเคราะห์เด็กอ่อน'; }
			$exp_list[0] = ($exp_list[0] == '')?@$cut_word:$exp_list[0];
			
			if(@$exp_list[1])
			{
				if($exp_list[0] == '') { $exp_list[0] = $data['list'][$i]['name']; }
				if(@$main_list)
				{
					if(!in_array($exp_list[0], $main_list)) { $main_list[] = $exp_list[0]; }
					else { $exp_list[0]; }
				} 
				else { $main_list[] = $exp_list[0]; }
			}
		}
		$data['main_list'] = $main_list;
		$wlist = @$data['main_list'][$_GET['WLIST']];
		//===== welfare list group =====//

		$this->load->view('welfare/export2', $data);
	}

}

