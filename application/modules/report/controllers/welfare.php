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
		
		$this->template->build('welfare/index', $data);
	}


	function report2()
	{
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

		$this->template->build('welfare/index2', $data);
	}

	function export_index($status=FALSE)
	{
		$data[1] = 1;
		if($status!='print')
		{
			$filename= "welfare_report_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
		}
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
		
		$this->load->view('welfare/export',$data);
	}

	function export_index2($status=FALSE)
	{
		if($status!='print')
		{
			$filename= "welfare_report2_data_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);
		}
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

